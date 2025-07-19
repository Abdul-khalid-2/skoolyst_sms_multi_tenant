<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request for serverless PostgreSQL.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Manually validate credentials against serverless PostgreSQL
        $user = $this->validateCredentials($request);

        // Log the user in
        auth()->login($user, $request->remember);

        // Regenerate session
        $request->session()->regenerate();

        // Log the login event
        $this->logLoginEvent($user->id, $request->ip());

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Validate user credentials against serverless PostgreSQL.
     */
    protected function validateCredentials(LoginRequest $request)
    {
        // Get connection to serverless PostgreSQL
        $connection = DB::connection('serverless-pgsql');

        // Find user by email
        $user = $connection->table('users')
            ->where('email', $request->email)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        // Check if user is active
        if (isset($user->is_active) && !$user->is_active) {
            throw ValidationException::withMessages([
                'email' => __('auth.inactive'),
            ]);
        }

        return $user;
    }

    /**
     * Log login event in serverless PostgreSQL.
     */
    protected function logLoginEvent($userId, $ipAddress): void
    {
        DB::connection('serverless-pgsql')
            ->table('user_login_logs')
            ->insert([
                'user_id' => $userId,
                'ip_address' => $ipAddress,
                'login_at' => now(),
            ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

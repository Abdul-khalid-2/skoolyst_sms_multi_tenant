@php
    $activeModules = auth()->user()->getActiveModules();
    $currentRoute = request()->route()->getName();
@endphp

<div class="iq-sidebar sidebar-default">
    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
        <a href="#" class="header-logo">
            <h5 class="logo-title light-logo ml-3">PAK-PINDI</h5>
        </a>
        <div class="iq-menu-bt-sidebar ml-0">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <!-- Dashboard -->
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="svg-icon">
                        <svg class="svg-icon" id="p-dash1" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>

                <!-- Dynamic Modules -->
                @foreach($activeModules as $module)
                    @php
                        $hasSubmodules = !empty($module->submodules);
                        $isActive = $hasSubmodules 
                            ? in_array($currentRoute, array_column($module->submodules, 'route'))
                            : request()->routeIs($module->route);
                    @endphp
                    
                    <li class="{{ $isActive ? 'active' : '' }}">
                        @if($hasSubmodules)
                            <a href="#module-{{ $module->code }}" class="collapsed" data-toggle="collapse" aria-expanded="{{ $isActive ? 'true' : 'false' }}">
                                <!-- SVG Icon for main module -->
                                @if($module->icon && str_contains($module->icon, 'svg-icon'))
                                    @include($module->icon)
                                @else
                                    <svg class="svg-icon" id="p-module-{{ $module->code }}" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                @endif
                                <span class="ml-4">{{ $module->name }}</span>
                                <!-- Collapse Arrow Icon -->
                                <svg class="svg-icon iq-arrow-right {{ $isActive ? 'arrow-active' : '' }}" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="10 15 15 20 20 15"></polyline>
                                    <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                </svg>
                            </a>
                            <ul id="module-{{ $module->code }}" class="iq-submenu collapse {{ $isActive ? 'show' : '' }}" data-parent="#iq-sidebar-toggle">
                                @foreach($module->submodules as $submodule)
                                    @php
                                        $subIsActive = request()->routeIs($submodule['route']);
                                    @endphp
                                    <li class="{{ $subIsActive ? 'active' : '' }}">
                                        <a href="{{ route($submodule['route']) }}">
                                            <!-- Submodule icon with minus sign -->
                                            <svg class="svg-icon" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                            <span>{{ $submodule['name'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <a href="{{ route($module->route) }}" class="{{ request()->routeIs($module->route) ? 'active' : '' }}">
                                <!-- SVG Icon for single module -->
                                @if($module->icon && str_contains($module->icon, 'svg-icon'))
                                    @include($module->icon)
                                @else
                                    <svg class="svg-icon" id="p-module-{{ $module->code }}" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                @endif
                                <span class="ml-4">{{ $module->name }}</span>
                            </a>
                        @endif
                    </li>
                @endforeach

                <!-- Settings Module (Always available for school admin) -->
                @if(auth()->user()->can('manage_settings'))
                    <li class="{{ request()->is('settings*') ? 'active' : '' }}">
                        <a href="#settings" class="collapsed" data-toggle="collapse" aria-expanded="{{ request()->is('settings*') ? 'true' : 'false' }}">
                            <!-- Settings SVG Icon -->
                            <svg class="svg-icon" id="p-settings" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                            </svg>
                            <span class="ml-4">Settings</span>
                            <!-- Collapse Arrow Icon -->
                            <svg class="svg-icon iq-arrow-right {{ request()->is('settings*') ? 'arrow-active' : '' }}" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline>
                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="settings" class="iq-submenu collapse {{ request()->is('settings*') ? 'show' : '' }}" data-parent="#iq-sidebar-toggle">
                            <li class="{{ request()->routeIs('module.settings') ? 'active' : '' }}">
                                <a href="{{ route('module.settings', ['school' => auth()->user()->school_id]) }}">
                                    <!-- Submenu icon -->
                                    <svg class="svg-icon" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    <span>Module Settings</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('school.settings') ? 'active' : '' }}">
                                <a href="{{ route('school.settings') }}">
                                    <!-- Submenu icon -->
                                    <svg class="svg-icon" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    <span>School Settings</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>

<style>
    .iq-sidebar .iq-menu li a i {
        width: 20px;
        text-align: center;
        margin-right: 10px;
    }
    .iq-sidebar .iq-submenu li a i.las.la-minus {
        font-size: 10px;
    }
</style>
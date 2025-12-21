    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email');
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });

    Schema::create('schools', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->string('email')->unique();
        $table->string('phone')->nullable();
        $table->text('address')->nullable();
        $table->string('logo')->nullable();
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->timestamps();
        $table->softDeletes();
    });

    Schema::create('branches', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->onDelete('cascade');
        $table->string('name');
        $table->string('phone')->nullable();
        $table->text('address')->nullable();
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->timestamps();
        $table->softDeletes();
    });

    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->nullable()->constrained()->onDelete('cascade');
        $table->string('key');
        $table->text('value')->nullable();
        $table->timestamps();

        $table->unique(['school_id', 'key']);
    });

    Schema::table('users', function (Blueprint $table) {
        $table->foreignId('school_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('cascade');
        $table->string('phone')->nullable();
        $table->string('address')->nullable();
        $table->string('profile_image')->nullable();
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->softDeletes();

        $table->unique(['school_id', 'email']);
    });

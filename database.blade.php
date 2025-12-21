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

    Schema::create('roles', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('guard_name')->default('web');
        $table->timestamps();
    });
    Schema::create('permissions', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('guard_name')->default('web');
        $table->timestamps();
    });
    Schema::create('model_has_roles', function (Blueprint $table) {
        $table->foreignId('role_id')->constrained()->onDelete('cascade');
        $table->morphs('model');
        $table->primary(['role_id', 'model_id', 'model_type']);
    });
    Schema::create('model_has_permissions', function (Blueprint $table) {
        $table->foreignId('permission_id')->constrained()->onDelete('cascade');
        $table->morphs('model');
        $table->primary(['permission_id', 'model_id', 'model_type']);
    });
    Schema::create('role_has_permissions', function (Blueprint $table) {
        $table->foreignId('permission_id')->constrained()->onDelete('cascade');
        $table->foreignId('role_id')->constrained()->onDelete('cascade');
        $table->primary(['permission_id', 'role_id']);
    });

    // ACADEMIC STRUCTURE (Improved)
    Schema::create('academic_years', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->string('name');
        $table->string('code')->nullable();
        $table->date('start_date');
        $table->date('end_date');
        $table->boolean('is_active')->default(false);
        $table->string('status')->default('active'); // Changed from ENUM
        $table->text('description')->nullable();
        $table->timestamps();
        $table->softDeletes();

        $table->index(['school_id', 'is_active']);
        $table->index(['school_id', 'status']);
    });

    // ✅ REMOVED fee columns from classes as suggested
    Schema::create('classes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->foreignId('academic_year_id')->nullable()->constrained()->restrictOnDelete();
        $table->string('name');
        $table->string('code')->nullable();
        $table->integer('order_no')->default(0);
        $table->string('education_system')->default('matric');
        $table->integer('min_age')->nullable();
        $table->integer('max_age')->nullable();
        $table->foreignId('next_class_id')->nullable()->constrained('classes')->nullOnDelete();
        $table->boolean('enable_sections')->default(true);
        $table->string('status')->default('active'); // Changed from ENUM
        $table->text('description')->nullable();
        $table->timestamps();
        $table->softDeletes();

        $table->index(['school_id', 'academic_year_id']);
        $table->index(['school_id', 'education_system']);
    });

    Schema::create('sections', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->foreignId('class_id')->constrained()->restrictOnDelete();
        $table->foreignId('academic_year_id')->nullable()->constrained()->restrictOnDelete();
        $table->string('name');
        $table->string('code')->nullable();
        $table->integer('capacity')->default(25);
        $table->string('shift')->default('morning');
        $table->string('room_number')->nullable();
        $table->time('start_time')->nullable();
        $table->time('end_time')->nullable();
        $table->json('weekdays')->nullable(); // ✅ JSON is OK here (config)
        $table->foreignId('class_teacher_id')->nullable()->constrained('users')->nullOnDelete();
        $table->foreignId('assistant_teacher_id')->nullable()->constrained('users')->nullOnDelete();
        $table->boolean('enable_attendance')->default(true);
        $table->boolean('enable_fee_collection')->default(true);
        $table->string('status')->default('active'); // Changed from ENUM
        $table->text('description')->nullable();
        $table->timestamps();
        $table->softDeletes();

        $table->index(['school_id', 'class_id']);
        $table->index(['school_id', 'class_teacher_id']);
    });

    // ✅ Fixed: Changed code to composite unique
    Schema::create('subjects', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->string('name');
        $table->string('code');
        $table->string('type')->default('theory'); // Changed from ENUM
        $table->string('category')->nullable();
        $table->decimal('credit_hours', 4, 1)->nullable();
        $table->integer('total_marks')->nullable();
        $table->integer('passing_marks')->nullable();
        $table->integer('weekly_periods')->default(5);
        $table->integer('period_duration')->default(40);
        $table->boolean('is_optional')->default(false);
        $table->boolean('has_lab')->default(false);
        $table->boolean('enable_exams')->default(true);
        $table->boolean('enable_homework')->default(true);
        $table->foreignId('default_teacher_id')->nullable()->constrained('users')->nullOnDelete();
        $table->text('short_description')->nullable();
        $table->text('syllabus')->nullable();
        $table->text('objectives')->nullable();
        $table->string('status')->default('active'); // Changed from ENUM
        $table->timestamps();
        $table->softDeletes();

        $table->unique(['school_id', 'code']); // ✅ Fixed: Composite unique
        $table->index(['school_id', 'category']);
    });

    Schema::create('class_subjects', function (Blueprint $table) {
        $table->id();
        $table->foreignId('class_id')->constrained()->restrictOnDelete();
        $table->foreignId('subject_id')->constrained()->restrictOnDelete();
        $table->boolean('is_compulsory')->default(true);
        $table->timestamps();
        
        $table->unique(['class_id', 'subject_id']);
    });

    // STUDENT MANAGEMENT (Improved)
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('academic_year_id')->constrained()->restrictOnDelete();
        $table->foreignId('class_id')->constrained()->restrictOnDelete();
        $table->foreignId('section_id')->nullable()->constrained()->nullOnDelete();
        $table->string('admission_no');
        $table->string('roll_no')->nullable();
        $table->string('first_name');
        $table->string('last_name');
        $table->string('full_name')->virtualAs('CONCAT(first_name, " ", last_name)');
        $table->date('date_of_birth');
        $table->string('gender'); // Changed from ENUM
        $table->string('blood_group')->nullable();
        $table->string('religion')->nullable();
        $table->string('nationality')->nullable();
        $table->string('cnic')->nullable();
        $table->string('phone')->nullable();
        $table->string('email')->nullable();
        $table->text('address')->nullable();
        $table->string('photo')->nullable();
        $table->date('admission_date');
        $table->string('status')->default('active'); // Changed from ENUM
        $table->text('previous_school')->nullable();
        $table->json('medical_info')->nullable(); // ✅ JSON is OK here (medical history)
        $table->timestamps();
        $table->softDeletes();
        
        $table->unique(['school_id', 'admission_no']);
        $table->index(['school_id', 'academic_year_id', 'class_id']);
        $table->index(['school_id', 'roll_no']);
        $table->index(['school_id', 'status']);
    });

    Schema::create('guardians', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->string('first_name');
        $table->string('last_name');
        $table->string('full_name')->virtualAs('CONCAT(first_name, " ", last_name)');
        $table->string('relation'); // Changed from ENUM
        $table->string('phone');
        $table->string('email')->nullable();
        $table->string('occupation')->nullable();
        $table->decimal('monthly_income', 12, 2)->nullable();
        $table->text('address')->nullable();
        $table->string('cnic')->nullable();
        $table->string('status')->default('active'); // Changed from ENUM
        $table->timestamps();
        $table->softDeletes();

        $table->index(['school_id', 'phone']);
    });

    Schema::create('student_guardians', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained()->restrictOnDelete();
        $table->foreignId('guardian_id')->constrained()->restrictOnDelete();
        $table->boolean('is_primary')->default(false);
        $table->timestamps();
        
        $table->unique(['student_id', 'guardian_id']);
        $table->index(['student_id', 'is_primary']);
    });

    Schema::create('student_academic_records', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained()->restrictOnDelete();
        $table->foreignId('academic_year_id')->constrained()->restrictOnDelete();
        $table->foreignId('class_id')->constrained()->restrictOnDelete();
        $table->foreignId('section_id')->nullable()->constrained()->nullOnDelete();
        $table->string('roll_no');
        $table->date('start_date');
        $table->date('end_date')->nullable();
        $table->string('result')->default('pending'); // Changed from ENUM
        $table->decimal('percentage', 5, 2)->nullable();
        $table->string('grade')->nullable();
        $table->integer('position')->nullable();
        $table->text('remarks')->nullable();
        $table->timestamps();
        
        $table->unique(['student_id', 'academic_year_id']);
        $table->index(['student_id', 'class_id']);
        $table->index(['academic_year_id', 'class_id']);
    });



    // FEE MANAGEMENT (Improved with Cascade Fixes)
    Schema::create('fee_groups', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->string('name');
        $table->string('code')->nullable();
        $table->string('type'); // Changed from ENUM
        $table->boolean('is_optional')->default(false);
        $table->text('description')->nullable();
        $table->string('status')->default('active'); // Changed from ENUM
        $table->timestamps();
        $table->softDeletes();

        $table->index(['school_id', 'type']);
    });

    Schema::create('fee_structures', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->foreignId('fee_group_id')->constrained()->restrictOnDelete();
        $table->foreignId('class_id')->constrained()->restrictOnDelete();
        $table->foreignId('academic_year_id')->constrained()->restrictOnDelete();
        $table->decimal('amount', 12, 2);
        $table->date('due_date')->nullable();
        $table->integer('due_days')->default(10);
        $table->decimal('late_fee_amount', 12, 2)->default(0);
        $table->string('late_fee_type')->default('fixed'); // Changed from ENUM
        $table->boolean('is_active')->default(true);
        $table->timestamps();
        
        $table->unique(['fee_group_id', 'class_id', 'academic_year_id']);
        $table->index(['school_id', 'academic_year_id', 'class_id']);
    });

    Schema::create('fee_transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->foreignId('student_id')->constrained()->restrictOnDelete();
        $table->foreignId('fee_structure_id')->constrained()->restrictOnDelete();
        $table->string('invoice_no')->unique();
        $table->decimal('amount', 12, 2);
        $table->decimal('discount', 12, 2)->default(0);
        $table->decimal('late_fee', 12, 2)->default(0);
        $table->decimal('paid_amount', 12, 2);
        $table->decimal('due_amount', 12, 2)->default(0);
        $table->date('due_date');
        $table->date('payment_date');
        $table->string('payment_method')->default('cash'); // Changed from ENUM
        $table->string('payment_reference')->nullable();
        $table->string('status')->default('unpaid'); // Changed from ENUM
        $table->foreignId('collected_by')->constrained('users')->restrictOnDelete();
        $table->text('remarks')->nullable();
        $table->timestamps();

        $table->index(['school_id', 'student_id']);
        $table->index(['school_id', 'payment_date']);
        $table->index(['school_id', 'status']);
    });

    Schema::create('fee_discounts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->string('name');
        $table->string('code')->nullable();
        $table->string('type'); // Changed from ENUM
        $table->decimal('value', 10, 2);
        $table->date('start_date');
        $table->date('end_date')->nullable();
        $table->boolean('is_active')->default(true);
        $table->json('applicable_classes')->nullable(); // ✅ JSON is OK here (config)
        $table->text('description')->nullable();
        $table->timestamps();
        $table->softDeletes();

        $table->index(['school_id', 'is_active']);
    });

    Schema::create('student_fee_discounts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained()->restrictOnDelete();
        $table->foreignId('fee_discount_id')->constrained()->restrictOnDelete();
        $table->foreignId('fee_transaction_id')->nullable()->constrained()->nullOnDelete();
        $table->decimal('amount', 12, 2);
        $table->date('applicable_from');
        $table->date('applicable_to')->nullable();
        $table->text('remarks')->nullable();
        $table->timestamps();

        $table->index(['student_id', 'fee_discount_id']);
    });

    // ATTENDANCE & EXAM (Improved with Renaming)
    // ✅ Renamed: student_attendance (was attendance)
    Schema::create('student_attendance', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->foreignId('student_id')->constrained()->restrictOnDelete();
        $table->foreignId('class_id')->constrained()->restrictOnDelete();
        $table->foreignId('section_id')->nullable()->constrained()->nullOnDelete();
        $table->date('date');
        $table->string('status'); // Changed from ENUM
        $table->time('check_in')->nullable();
        $table->time('check_out')->nullable();
        $table->text('remarks')->nullable();
        $table->foreignId('recorded_by')->constrained('users')->restrictOnDelete();
        $table->timestamps();
        
        $table->unique(['student_id', 'date']);
        $table->index(['school_id', 'date', 'class_id']);
        $table->index(['school_id', 'student_id', 'status']);
    });

    Schema::create('exams', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->foreignId('academic_year_id')->constrained()->restrictOnDelete();
        $table->string('name');
        $table->string('code')->nullable();
        $table->date('start_date');
        $table->date('end_date');
        $table->string('type'); // Changed from ENUM
        $table->decimal('total_marks', 6, 2);
        $table->decimal('passing_marks', 6, 2);
        $table->boolean('is_active')->default(true);
        $table->text('description')->nullable();
        $table->timestamps();
        $table->softDeletes();

        $table->index(['school_id', 'academic_year_id', 'is_active']);
    });

    // ✅ FIXED: Replaced JSON with relational table
    Schema::create('exam_classes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('exam_id')->constrained()->restrictOnDelete();
        $table->foreignId('class_id')->constrained()->restrictOnDelete();
        $table->timestamps();
        
        $table->unique(['exam_id', 'class_id']);
    });

    Schema::create('exam_schedules', function (Blueprint $table) {
        $table->id();
        $table->foreignId('exam_id')->constrained()->restrictOnDelete();
        $table->foreignId('class_id')->constrained()->restrictOnDelete();
        $table->foreignId('subject_id')->constrained()->restrictOnDelete();
        $table->date('exam_date');
        $table->time('start_time');
        $table->time('end_time');
        $table->string('venue')->nullable();
        $table->foreignId('supervisor_id')->nullable()->constrained('users')->nullOnDelete();
        $table->timestamps();

        $table->index(['exam_id', 'exam_date']);
        $table->index(['class_id', 'subject_id']);
    });

    Schema::create('exam_results', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained()->restrictOnDelete();
        $table->foreignId('exam_id')->constrained()->restrictOnDelete();
        $table->foreignId('subject_id')->constrained()->restrictOnDelete();
        $table->decimal('obtained_marks', 6, 2);
        $table->decimal('total_marks', 6, 2);
        $table->string('grade')->nullable();
        $table->decimal('percentage', 5, 2);
        $table->text('remarks')->nullable();
        $table->foreignId('graded_by')->constrained('users')->restrictOnDelete();
        $table->timestamps();
        
        $table->unique(['student_id', 'exam_id', 'subject_id']);
        $table->index(['student_id', 'exam_id']);
        $table->index(['exam_id', 'subject_id']);
    });


    // STAFF MANAGEMENT (Improved)
    Schema::create('teachers', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->restrictOnDelete();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
        $table->string('employee_id');
        $table->date('joining_date');
        $table->string('designation');
        $table->string('department')->nullable();
        $table->decimal('salary', 12, 2)->nullable();
        $table->json('qualifications')->nullable(); // ✅ JSON is OK here (complex data)
        $table->string('status')->default('active'); // Changed from ENUM
        $table->text('bio')->nullable();
        $table->timestamps();
        $table->softDeletes();

        $table->unique(['school_id', 'employee_id']);
        $table->index(['school_id', 'department']);
    });

    // ✅ FIXED: Replaced JSON with relational table
    Schema::create('teacher_subjects', function (Blueprint $table) {
        $table->id();
        $table->foreignId('teacher_id')->constrained()->restrictOnDelete();
        $table->foreignId('subject_id')->constrained()->restrictOnDelete();
        $table->boolean('is_primary')->default(false);
        $table->timestamps();
        
        $table->unique(['teacher_id', 'subject_id']);
    });

    Schema::create('timetables', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->foreignId('class_id')->constrained()->restrictOnDelete();
        $table->foreignId('section_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('academic_year_id')->constrained()->restrictOnDelete();
        $table->string('day');
        $table->integer('period_no');
        $table->time('start_time');
        $table->time('end_time');
        $table->foreignId('subject_id')->constrained()->restrictOnDelete();
        $table->foreignId('teacher_id')->constrained()->restrictOnDelete();
        $table->string('room')->nullable();
        $table->boolean('is_break')->default(false);
        $table->string('break_type')->nullable();
        $table->string('status')->default('active'); // Changed from ENUM
        $table->timestamps();
        
        $table->unique(['class_id', 'section_id', 'day', 'period_no', 'academic_year_id']);
        $table->index(['teacher_id', 'day', 'period_no']);
    });

    Schema::create('staff_attendance', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->foreignId('user_id')->constrained()->restrictOnDelete();
        $table->date('date');
        $table->time('check_in')->nullable();
        $table->time('check_out')->nullable();
        $table->string('status'); // Changed from ENUM
        $table->text('remarks')->nullable();
        $table->timestamps();
        
        $table->unique(['user_id', 'date']);
        $table->index(['school_id', 'date', 'status']);
    });

    // LIBRARY & INVENTORY (Same - Good)
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->string('title');
        $table->string('isbn')->nullable();
        $table->string('author');
        $table->string('publisher')->nullable();
        $table->integer('edition')->nullable();
        $table->integer('publication_year')->nullable();
        $table->string('category')->nullable();
        $table->integer('total_copies');
        $table->integer('available_copies');
        $table->decimal('price', 10, 2)->nullable();
        $table->string('rack_no')->nullable();
        $table->text('description')->nullable();
        $table->string('status')->default('available'); // Changed from ENUM
        $table->timestamps();
        $table->softDeletes();

        $table->index(['school_id', 'category']);
        $table->index(['school_id', 'status']);
    });


    Schema::create('book_issues', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->onDelete('cascade');
        $table->foreignId('book_id')->constrained()->onDelete('cascade');
        $table->foreignId('student_id')->constrained()->onDelete('cascade');
        $table->foreignId('issued_by')->constrained('users')->onDelete('cascade');
        $table->date('issue_date');
        $table->date('due_date');
        $table->date('return_date')->nullable();
        $table->decimal('fine_amount', 10, 2)->default(0);
        $table->enum('status', ['issued', 'returned', 'overdue', 'lost'])->default('issued');
        $table->text('remarks')->nullable();
        $table->timestamps();
    });

    Schema::create('inventory_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->onDelete('cascade');
        $table->string('name');
        $table->string('code')->nullable();
        $table->string('category'); // furniture, equipment, stationery, sports, lab
        $table->integer('quantity');
        $table->integer('minimum_quantity')->default(10);
        $table->string('unit')->nullable(); // piece, kg, liter, etc.
        $table->decimal('unit_price', 10, 2)->nullable();
        $table->string('storage_location')->nullable();
        $table->text('description')->nullable();
        $table->enum('status', ['available', 'low_stock', 'out_of_stock'])->default('available');
        $table->timestamps();
        $table->softDeletes();
    });

    Schema::create('inventory_transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->onDelete('cascade');
        $table->foreignId('item_id')->constrained('inventory_items')->onDelete('cascade');
        $table->enum('type', ['purchase', 'issue', 'return', 'damage', 'adjustment']);
        $table->integer('quantity');
        $table->foreignId('related_user_id')->nullable()->constrained('users')->onDelete('set null');
        $table->string('reference_no')->nullable();
        $table->text('remarks')->nullable();
        $table->foreignId('recorded_by')->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });
    ```

    ## Transportation & Hostel Management

    Schema::create('vehicles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->onDelete('cascade');
        $table->string('vehicle_no');
        $table->string('type'); // bus, van, car
        $table->integer('capacity');
        $table->string('driver_name');
        $table->string('driver_phone');
        $table->string('route');
        $table->time('pickup_time');
        $table->time('drop_time');
        $table->decimal('monthly_fee', 10, 2);
        $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');
        $table->timestamps();
        $table->softDeletes();
    });

    Schema::create('student_transport', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained()->onDelete('cascade');
        $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
        $table->date('start_date');
        $table->date('end_date')->nullable();
        $table->string('pickup_point');
        $table->string('drop_point');
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->timestamps();
    });

    Schema::create('hostels', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->onDelete('cascade');
        $table->string('name');
        $table->string('type'); // boys, girls, mixed
        $table->string('warden_name');
        $table->string('warden_phone');
        $table->text('address');
        $table->integer('total_rooms');
        $table->integer('available_rooms');
        $table->decimal('monthly_fee', 12, 2);
        $table->text('facilities')->nullable();
        $table->enum('status', ['active', 'inactive', 'full'])->default('active');
        $table->timestamps();
        $table->softDeletes();
    });

    Schema::create('student_hostel', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained()->onDelete('cascade');
        $table->foreignId('hostel_id')->constrained()->onDelete('cascade');
        $table->string('room_no');
        $table->date('check_in_date');
        $table->date('check_out_date')->nullable();
        $table->enum('status', ['active', 'left'])->default('active');
        $table->timestamps();
    });
    ```


    // COMMUNICATION (Improved - JSON Fixed)
    Schema::create('notices', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->string('title');
        $table->text('description');
        $table->string('type'); // Changed from ENUM
        $table->date('publish_date');
        $table->date('expiry_date')->nullable();
        $table->boolean('is_important')->default(false);
        $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
        $table->timestamps();
        $table->softDeletes();

        $table->index(['school_id', 'publish_date', 'type']);
    });

    // ✅ FIXED: Replaced JSON receiver_ids with relational table
    Schema::create('messages', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->restrictOnDelete();
        $table->foreignId('sender_id')->constrained('users')->restrictOnDelete();
        $table->string('subject');
        $table->text('message');
        $table->string('type'); // Changed from ENUM
        $table->string('status')->default('draft'); // Changed from ENUM
        $table->timestamp('sent_at')->nullable();
        $table->timestamps();

        $table->index(['school_id', 'sender_id', 'status']);
    });

    Schema::create('message_receivers', function (Blueprint $table) {
        $table->id();
        $table->foreignId('message_id')->constrained()->restrictOnDelete();
        $table->foreignId('receiver_id')->constrained('users')->restrictOnDelete();
        $table->boolean('is_read')->default(false);
        $table->timestamp('read_at')->nullable();
        $table->timestamps();
        
        $table->unique(['message_id', 'receiver_id']);
    });
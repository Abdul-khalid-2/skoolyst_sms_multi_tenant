<x-tenant-app-layout>
    @push('css')
        <!-- favicon
		============================================ -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <!-- Google Fonts
            ============================================ -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
        <!-- Bootstrap CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
        <!-- Bootstrap CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/css/font-awesome.min.css') }}">
        <!-- owl.carousel CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/owl.theme.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/owl.transitions.css') }}">
        <!-- animate CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/css/animate.css') }}">
        <!-- normalize CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/css/normalize.css') }}">
        <!-- meanmenu icon CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/css/meanmenu.min.css') }}">
        <!-- main CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/css/main.css') }}">
        <!-- educate icon CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/css/educate-custon-icon.css') }}">
        <!-- morrisjs CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/css/morrisjs/morris.css') }}">
        <!-- mCustomScrollbar CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/css/scrollbar/jquery.mCustomScrollbar.min.css') }}">
        <!-- metisMenu CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/css/metisMenu/metisMenu.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/metisMenu/metisMenu-vertical.css') }}">
        <!-- calendar CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/css/calendar/fullcalendar.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/calendar/fullcalendar.print.min.css') }}">
        <!-- x-editor CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/css/editor/select2.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/editor/datetimepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/editor/bootstrap-editable.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/editor/x-editor-style.css') }}">
        <!-- normalize CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/css/data-table/bootstrap-table.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/data-table/bootstrap-editable.css') }}">
        <!-- style CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/style.css') }}">
        <!-- responsive CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/css/responsive.css') }}">
        <!-- modernizr JS
            ============================================ -->
        <script src="{{ asset('backend/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    @endpush
    <x-slot name="header"></x-slot>
    
    <div class="data-table-area mg-b-15">
       <div class="container-fluid">
           <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcome-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="breadcome-heading" style="margin-top: 10px">
                                    <h3>All Teachers</h3>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <ul class="breadcome-menu">
                                    <li>
                                        <a href="{{ route('dashboard.add.teacher') }}" class="btn btn-primary btn-sm" style="color: white">
                                            <i class="fa fa-user-plus"></i> Add Teacher
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <div class="sparkline13-list">
                       
                       <div class="sparkline13-graph">
                           <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                <select class="form-control dt-tb">
                                    <option value="">Excel</option>
                                    <option value="">PDF</option>
                                    <option value="">CSV</option>
                                </select>
                            </div>
                            <table id="timetable-table" 
                                class="table hover-table timetable-datatable"
                                data-toggle="table" 
                                data-pagination="true" 
                                data-search="true"
                                data-show-columns="true" 
                                data-resizable="true"
                                data-cookie-id-table="teacher"
                                data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="id" data-sortable="true">ID</th>
                                        <th data-field="name" data-sortable="true">Name</th>
                                        <th data-field="employee_id" data-sortable="true">Employee ID</th>
                                        <th data-field="email">Email</th>
                                        <th data-field="phone">Phone</th>
                                        <th data-field="specialization">Specialization</th>
                                        <th data-field="class_teacher" data-sortable="true">Status</th>
                                        <th data-field="action">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teachers as $key => $teacher)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            @if(isset($teacher->profile_pic))
                                                <img src="{{ asset($teacher->profile_pic) }}" 
                                                    alt="{{ $teacher->name }}" 
                                                    class="rounded-circle" 
                                                    width="30" 
                                                    height="30">
                                                @else
                                                    <img src="{{ asset('backend/img/profile/1.jpg') }}" 
                                                        alt="{{ $teacher->name }}" 
                                                        class="rounded-circle" 
                                                        width="30" 
                                                        height="30">
                                            @endif
                                            {{ $teacher->name }}
                                        </td>
                                        <td>{{ $teacher->teacherProfile->employee_id ?? 'N/A' }}</td>
                                        <td>{{ $teacher->email }}</td>
                                        <td>{{ $teacher->phone }}</td>
                                        <td>{{ $teacher->teacherProfile->specialization ?? 'N/A' }}</td>
                                        <td>
                                            <div class="status-wrapper">
                                                <select class="form-control input-sm change-status" data-id="{{ $teacher->id }}">
                                                    <option value="active" {{ $teacher->status == 'active' ? 'selected' : '' }}>
                                                        ✅ Active
                                                    </option>
                                                    <option value="inactive" {{ $teacher->status == 'inactive' ? 'selected' : '' }}>
                                                        ❌ Inactive
                                                    </option>
                                                    <option value="pending" {{ $teacher->status == 'pending' ? 'selected' : '' }}>
                                                        ⏳ Pending
                                                    </option>
                                                </select>
                                                <small class="text-muted saving-status" style="display:none;">Saving...</small>
                                                <span class="label label-success status-label" style="display:none;">Updated</span>
                                            </div>
                                        </td>

                                        <td>
                                            <div style="display: flex; align-items: center; gap: 4px;">
                                                <a href="{{ route('admin.show.teacher', encrypt($teacher->id)) }}"
                                                class="btn btn-xs btn-success" 
                                                title="Edit">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.edit.teacher', encrypt($teacher->id)) }}" 
                                                class="btn btn-xs btn-primary" 
                                                title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                        
                                                <form action="{{ route('admin.destroy.teacher', encrypt($teacher->id)) }}" 
                                                    method="POST" 
                                                    class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-xs btn-danger" 
                                                            title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete this Teacher?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </div>



   @push('js')
       <!-- jquery ============================================ -->
    <script src="{{ asset('backend/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <!-- bootstrap JS ============================================ -->
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <!-- wow JS ============================================ -->
    <script src="{{ asset('backend/js/wow.min.js') }}"></script>
    <!-- price-slider JS ============================================ -->
    <script src="{{ asset('backend/js/jquery-price-slider.js') }}"></script>
    <!-- meanmenu JS ============================================ -->
    <script src="{{ asset('backend/js/jquery.meanmenu.js') }}"></script>
    <!-- owl.carousel JS ============================================ -->
    <script src="{{ asset('backend/js/owl.carousel.min.js') }}"></script>
    <!-- sticky JS ============================================ -->
    <script src="{{ asset('backend/js/jquery.sticky.js') }}"></script>
    <!-- scrollUp JS ============================================ -->
    <script src="{{ asset('backend/js/jquery.scrollUp.min.js') }}"></script>
    <!-- mCustomScrollbar JS ============================================ -->
    <script src="{{ asset('backend/js/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('backend/js/scrollbar/mCustomScrollbar-active.js') }}"></script>
    <!-- metisMenu JS ============================================ -->
    <script src="{{ asset('backend/js/metisMenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/js/metisMenu/metisMenu-active.js') }}"></script>
    <!-- data table JS ============================================ -->
    <script src="{{ asset('backend/js/data-table/bootstrap-table.js') }}"></script>
    <script src="{{ asset('backend/js/data-table/tableExport.js') }}"></script>
    <script src="{{ asset('backend/js/data-table/data-table-active.js') }}"></script>
    <script src="{{ asset('backend/js/data-table/bootstrap-table-editable.js') }}"></script>
    <script src="{{ asset('backend/js/data-table/bootstrap-editable.js') }}"></script>
    <script src="{{ asset('backend/js/data-table/bootstrap-table-resizable.js') }}"></script>
    <script src="{{ asset('backend/js/data-table/colResizable-1.5.source.js') }}"></script>
    <script src="{{ asset('backend/js/data-table/bootstrap-table-export.js') }}"></script>
    <!--  editable JS ============================================ -->
    <script src="{{ asset('backend/js/editable/jquery.mockjax.js') }}"></script>
    <script src="{{ asset('backend/js/editable/mock-active.js') }}"></script>
    <script src="{{ asset('backend/js/editable/select2.js') }}"></script>
    <script src="{{ asset('backend/js/editable/moment.min.js') }}"></script>
    <script src="{{ asset('backend/js/editable/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('backend/js/editable/bootstrap-editable.js') }}"></script>
    <script src="{{ asset('backend/js/editable/xediable-active.js') }}"></script>
    <!-- Chart JS ============================================ -->
    <script src="{{ asset('backend/js/chart/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('backend/js/peity/peity-active.js') }}"></script>
    <!-- tab JS ============================================ -->
    <script src="{{ asset('backend/js/tab.js') }}"></script>
    <!-- plugins JS ============================================ -->
    <script src="{{ asset('backend/js/plugins.js') }}"></script>
    <!-- main JS ============================================ -->
    <script src="{{ asset('backend/js/main.js') }}"></script>
    <script>
        $(document).on('change', '.change-status', function () {
            var $this = $(this);
            var teacherId = $this.data('id');
            var status = $this.val();
            var wrapper = $this.closest('.status-wrapper');
            var savingMsg = wrapper.find('.saving-status');
            var updatedLabel = wrapper.find('.status-label');

            // Show "saving" message
            savingMsg.show();
            updatedLabel.hide();

            $.ajax({
                url: '{{ route("teacher.update.status") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: teacherId,
                    status: status
                },
                success: function (response) {
                    savingMsg.hide();
                    updatedLabel.show().delay(1500).fadeOut();
                },
                error: function () {
                    savingMsg.hide();
                    alert('❌ Failed to update status');
                }
            });
        });
    </script>
   @endpush

    
</x-tenant-app-layout>

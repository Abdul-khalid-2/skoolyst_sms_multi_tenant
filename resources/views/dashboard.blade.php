<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css')}}">

    
    <style>
        .income-expense-chart {
            font-family: Arial, sans-serif;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            background: white;
            height: 100%;
        }

        .chart-bars {
            margin: 20px 0;
        }

        .bar-container {
            margin-bottom: 15px;
        }

        .bar-label {
            margin-bottom: 5px;
            font-size: 14px;
        }

        .bar {
            height: 40px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            padding-left: 10px;
            color: white;
            font-weight: bold;
            transition: width 0.5s ease;
        }

        .bar.income {
            background-color: #4CAF50;
        }

        .bar.expense {
            background-color: #F44336;
        }

        .chart-summary {
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        .summary-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .income-dot {
            background-color: #4CAF50;
        }

        .expense-dot {
            background-color: #F44336;
        }

        .summary-item.net {
            font-weight: bold;
            margin-top: 10px;
            color: #2196F3;
        }
    </style>
    @endpush



    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>

    <!-- Table Treeview JavaScript -->
    <script src="{{ asset('backend/assets/js/table-treeview.js') }}"></script>

    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('backend/assets/js/customizer.js') }}"></script>

    <!-- Apex Charts -->
    <script src="{{ asset('backend/assets/js/apexcharts.js') }}"></script>

    <!-- Chart Custom JavaScript -->
    {{-- <script async src="{{ asset('backend/assets/js/chart-custom.js') }}"></script> --}}

    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

</x-app-layout>
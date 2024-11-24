@extends('layouts.admin')

@section('content')
<div class="flex-grow-1" style="width: 100%!important;">
    <!-- Top Navbar -->
    @include('components.profilenav')

    <!-- Dashboard Content -->

    <!-- Display dynamic User Count -->
    <div class="d-flex gap-3 px-5 pt-5 pb-3">
        <div class="border border-primary rounded-4 p-3 px-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">Users</h4>
            <h2 class="text-primary fw-bolder">{{ $userCount }}</h2> 
        </div>
    <!-- Display dynamic Shop Count -->
    <div class="border border-primary rounded-4 p-3 px-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">Shops</h4>
            <h2 class="text-primary fw-bolder">{{ $shopCount }}</h2>
        </div>
    <!-- Dynamic active User count -->
    <div class="border border-primary rounded-4 p-3 px-4 flex-grow-1">
        <h4 class="text-secondary fw-bold">Active Users</h4>
        <h2 class="text-primary fw-bolder">{{ $activeUserCount }}</h2>
    </div>
    </div>
    <!-- Display dynamic Shop Count -->
    <div class="d-flex px-5 py-3 gap-4" style="display: table-row;">
        <!-- User Chart Section -->
        <div class="border border-primary rounded-4 p-4 user-chart-container" style="width: 70%; max-width: 100%; flex-shrink: 0;">
            <div class="d-flex justify-content-between">
                <h4 class="text-secondary fw-bold">User</h4>
                <a href="{{ route('admin.users') }}" class="text-secondary fs-3">See all</a>
            </div>
            <div style="position: relative; height: 400px; width: 100%;">
                <canvas id="myChart"></canvas>
            </div>
            <script>
                // Ensure the data is loaded properly
                const courseNames = @json(array_keys($userCountByCourse));
                const courseCounts = @json(array_values($userCountByCourse));

                const barColors = ["#f0c674", "#edb23d", "#d99324", "#b8731e", "#f0e68c"];

                new Chart("myChart", {
                    type: "pie",
                    data: {
                        labels: courseNames,
                        datasets: [{
                            backgroundColor: barColors,
                            data: courseCounts
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'User Chart'
                            },
                            legend: {
                                position: 'right',
                                labels: {
                                    boxWidth: 20,
                                    padding: 20
                                }
                            }
                        },
                        layout: {
                            padding: {
                                right: 50
                            }
                        }
                    }
                });
            </script>
        </div>

        <!-- Top Shops and Shops Section -->
        <div class="d-flex flex-column gap-4" style="flex: 3;">
            <div class="border border-primary rounded-4 p-4 flex-grow-1">
            <!-- Display dynamic Top Shops -->
            <div class="d-flex justify-content-between mb-2">
                <h4 class="text-secondary fw-bold">Top Shops</h4>
            </div>
            <div>
            @foreach($topShops as $shop)
                <div class="d-flex justify-content-between">
                    <h6 class="text-primary fw-bolder">{{ $shop->shop_name }}</h6>
                    <h6 class="text-primary fw-bolder">{{ $shop->total_amount }} sales</h6>
                </div>
            @endforeach
        </div>
        </div>
        <div class="border border-primary rounded-4 p-4 flex-grow-1" style="flex: 4;">
            <!-- Display dynamic Shops name -->
            <div class="d-flex justify-content-between mb-2">
                <h4 class="text-secondary fw-bold">Shops</h4>
                <a href="{{ route('admin.shops') }}" class="text-secondary fs-">See all</a>
            </div>
            <div>
                @foreach($allShops as $shop)
                    <h6 class="text-primary fw-bolder">{{ $shop }}</h6>
                @endforeach
            </div>
        </div>
    </div>
@endsection
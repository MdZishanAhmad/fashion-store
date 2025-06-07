@extends('admin.header')
@section('title', 'Admin-Dashboard')

@section('content')
    <div class="pcoded-main-container" style="z-index: 1">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <h5 class="m-b-10">Sales Report</h5>
                        </div>
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
                                <li class="breadcrumb-item">Sales Report</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @if(isset($error))
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @else
            
                <div class="row">
                    <div class="col-xl-8 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Top Selling Products</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="salesChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Top Products Summary</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Quantity Sold</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($topProducts as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>{{ $item->total_sold }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">No sales data available</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if(!isset($error))
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('salesChart').getContext('2d');
                const salesChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json($chartData['labels']),
                        datasets: [{
                            label: 'Quantity Sold',
                            data: @json($chartData['data']),
                            backgroundColor: @json($chartData['backgroundColors']),
                            borderColor: @json($chartData['backgroundColors']),
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return 'Sold: ' + context.raw;
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endif
@endsection
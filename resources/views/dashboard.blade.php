<x-app-layout>
    <div class="mb-4">
        <h3 class="fw-bold">Dashboard</h3>
        <p class="text-muted">Stock-in overview for the past month</p>
    </div>

    <!-- STATS CARDS -->
    <!-- STATS CARDS -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card stat-card p-4 h-100 border-0 shadow-sm">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary mb-3">
                    <i class="bi bi-box fs-4"></i>
                </div>
                <small class="text-muted fw-medium uppercase-tracking">Total Items</small>
                <h2 class="fw-bold mb-1">{{ number_format($totalItems) }}</h2>
                <div class="d-flex align-items-center gap-1 mt-2">
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-1" style="font-size: 0.7rem;">
                        {{ $recentStockIns->count() }} new entries
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card p-4 h-100 border-0 shadow-sm">
                <div class="stat-icon bg-danger bg-opacity-10 text-danger mb-3">
                    <i class="bi bi-wallet2 fs-4"></i>
                </div>
                <small class="text-muted fw-medium uppercase-tracking">Total Cost</small>
                <h2 class="fw-bold mb-1">₱{{ number_format($totalCost, 2) }}</h2>
                <div class="d-flex align-items-center gap-1 mt-2 text-muted" style="font-size: 0.75rem;">
                    Total stock investment
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card p-4 h-100 border-0 shadow-sm">
                <div class="stat-icon bg-indigo-soft text-indigo mb-3">
                    <i class="bi bi-graph-up-arrow fs-4"></i>
                </div>
                <small class="text-muted fw-medium uppercase-tracking">Potential Revenue</small>
                <h2 class="fw-bold mb-1">₱{{ number_format($potentialRevenue, 2) }}</h2>
                <div class="d-flex align-items-center gap-1 mt-2 text-muted" style="font-size: 0.75rem;">
                    Estimated sales value
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card p-4 h-100 border-0 shadow-sm">
                <div class="stat-icon bg-success bg-opacity-10 text-success mb-3">
                    <i class="bi bi-calendar-check fs-4"></i>
                </div>
                <small class="text-muted fw-medium uppercase-tracking">Potential Profit</small>
                <h2 class="fw-bold mb-1">₱{{ number_format($potentialProfit, 2) }}</h2>
                <div class="d-flex align-items-center gap-1 mt-2">
                    <span class="text-success fw-bold" style="font-size: 0.8rem;">
                        <i class="bi bi-arrow-up-right me-1"></i>{{ number_format($profitMargin, 1) }}% margin
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- CHARTS -->
    <div class="row g-4 mb-4">
        <div class="col-md-7">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Stock Cost Over Time</h5>
                    <small class="text-muted">Daily aggregation</small>
                </div>
                <div style="height: 300px;">
                    <canvas id="costChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Top Stocks by Quantity</h5>
                    <small class="text-muted">Inventory distribution</small>
                </div>
                <div style="height: 300px;">
                    <canvas id="quantityChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- RECENT RECORDS -->
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Recent Stock-In Records</h5>
            <a href="{{ route('stock-in.index') }}" class="btn btn-sm btn-light rounded-pill px-3">View All</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Product Details</th>
                        <th>Supplier</th>
                        <th>Quantity</th>
                        <th>Total Cost</th>
                        <th>Date Received</th>
                        <th>Processed By</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentStockIns as $item)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $item->products_name }}</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-building text-muted"></i>
                                {{ $item->supplier ?? 'N/A' }}
                            </div>
                        </td>
                        <td><span class="badge-unit">{{ number_format($item->quantity) }} units</span></td>
                        <td class="fw-bold text-danger">₱{{ number_format($item->total_cost_value, 2) }}</td>
                        <td>
                            <div class="text-muted">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ \Carbon\Carbon::parse($item->date_received)->format('M d, Y') }}
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border rounded-pill px-3 py-1">
                                <i class="bi bi-person me-1"></i>{{ $item->processed_by }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Chart Defaults
            Chart.defaults.font.family = "'Inter', sans-serif";
            Chart.defaults.color = '#64748b';

            // Cost Chart
            const costCtx = document.getElementById('costChart').getContext('2d');
            const costGradient = costCtx.createLinearGradient(0, 0, 0, 300);
            costGradient.addColorStop(0, 'rgba(239, 68, 68, 0.2)');
            costGradient.addColorStop(1, 'rgba(239, 68, 68, 0)');

            new Chart(costCtx, {
                type: 'line',
                data: {
                    labels: @json($costOverTime->pluck('date')),
                    datasets: [{
                        label: 'Cost (₱)',
                        data: @json($costOverTime->pluck('total_cost')),
                        borderColor: '#ef4444',
                        borderWidth: 3,
                        backgroundColor: costGradient,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#ef4444',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 12,
                            titleFont: { size: 14, weight: 'bold' },
                            callbacks: {
                                label: function(context) {
                                    return ' ₱' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { borderDash: [5, 5], color: '#e2e8f0' },
                            ticks: { callback: value => '₱' + value.toLocaleString() }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });

            // Quantity Chart
            const quantityCtx = document.getElementById('quantityChart').getContext('2d');
            
            // Create Gradient
            const quantityGradient = quantityCtx.createLinearGradient(0, 0, 0, 400);
            quantityGradient.addColorStop(0, '#4f46e5'); // Indigo
            quantityGradient.addColorStop(1, '#ef4444'); // Red

            new Chart(quantityCtx, {
                type: 'bar',
                data: {
                    labels: @json($stockDistribution->pluck('products_name')),
                    datasets: [{
                        label: 'Quantity',
                        data: @json($stockDistribution->pluck('total_quantity')),
                        backgroundColor: quantityGradient,
                        borderRadius: 10,
                        barThickness: 25,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    return ' ' + context.parsed.y.toLocaleString() + ' units';
                                }
                            }
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { borderDash: [5, 5], color: '#e2e8f0' } 
                        },
                        x: { 
                            grid: { display: false },
                            ticks: {
                                autoSkip: false,
                                maxRotation: 45,
                                minRotation: 45
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush

    @push('styles')
    <style>
        .uppercase-tracking {
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.7rem;
        }
        .bg-indigo-soft { background-color: rgba(79, 70, 229, 0.1) !important; }
        .text-indigo { color: #4f46e5 !important; }
        .stat-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .table thead th {
            background-color: #f8fafc;
            border-bottom: 2px solid #f1f5f9;
        }
    </style>
    @endpush
</x-app-layout>
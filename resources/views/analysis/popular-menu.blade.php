@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-8">Popular Menu Items</h2>

    <!-- Most Popular Items -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        @foreach($popularMenus as $menu)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-xl font-semibold mb-2">{{ $menu->name }}</h3>
                <p class="text-gray-600">Ordered {{ $menu->order_count }} times</p>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Category Statistics -->
    <h3 class="text-2xl font-bold mb-6">Category Statistics</h3>
    <div class="bg-white rounded-lg shadow-md p-6">
        <canvas id="categoryChart"></canvas>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const categoryData = @json($categoryStats);
    const labels = categoryData.map(item => item.category);
    const values = categoryData.map(item => item.total_orders);

    const ctx = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Orders by Category',
                data: values,
                backgroundColor: [
                    '#3b82f6',
                    '#ef4444',
                    '#10b981',
                    '#f59e0b',
                    '#6366f1'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
</script>
@endpush
@endsection
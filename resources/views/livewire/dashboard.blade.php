<div class="bg-gray-50 min-h-screen">
    <div class="bg-white border-b border-gray-200 py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <nav class="flex text-xs font-medium text-gray-500 items-center gap-2">
                <span class="text-gray-900 font-semibold">Dashboard</span>
            </nav>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                        <p class="text-sm font-medium text-gray-500 uppercase">Total Invoices</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $stats['total_invoices'] }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                        <p class="text-sm font-medium text-gray-500 uppercase">Paid Invoices</p>
                        <p class="text-3xl font-bold text-emerald-400">{{ $stats['paid_invoices'] }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                        <p class="text-sm font-medium text-gray-500 uppercase">Due Invoices</p>
                        <p class="text-3xl font-bold text-red-500">{{ $stats['due_invoices'] }}</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold mb-4">Invoice Generation Trend</h3>
                    <div id="chart"></div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
            <script>
                var options = {
                    chart: { type: 'area', height: 350, toolbar: { show: false } },
                    series: [{ name: 'Invoices', data: @json($chartValues) }],
                    xaxis: { categories: @json($chartLabels) },
                    stroke: { curve: 'smooth' },
                    colors: ['#2563EB']
                };
                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            </script>
        </div>
    </main>
</div>

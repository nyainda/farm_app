<x-app-layout title="Animal Treatments">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <div class="container mx-auto mt-8 p-4 mb-4 dark:bg-gray-800 dark:rounded-lg font-serif bg-white rounded-lg shadow-lg">

        <h1 class="text-4xl font-bold mb-6 text-gray-800 dark:text-gray-200 text-center">
            <a class="hover:text-yellow-500 flex items-center justify-center" href="{{ route('index') }}">
                <i class="fas fa-chart-bar text-2xl mr-2"></i> Animal Yield Dashboard
            </a>
        </h1>
        <div class="overflow-x-auto">
            <div class="min-w-full">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th class="border-r px-4 py-3">Animal</th>
                            <th class="border-r px-4 py-3">Animal_ID</th>
                            <th class="border-r px-4 py-3">Status</th>
                            <th class="px-4 text-center py-3">yieldrecords</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($animals as $animal)

                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            {{--<td class="whitespace-nowrap border-r px-4 py-3 font-medium dark:border-neutral-500">{{ $loop->index + 1 }}</td>--}}
                            <td class="whitespace-nowrap border-r px-4 py-3 dark:border-neutral-500">{{ $animal->name }}</td>
                            <td class="whitespace-nowrap border-r px-4 py-3 dark:border-neutral-500">{{ $animal->internal_id }}</td>
                            <td class="whitespace-nowrap px-4 py-3 dark-border-neutral-500">{{ $animal->status }}</td>
                            <td class="whitespace-nowrap px-4 py-3">
                                @if (isset($animalyieldrecords[$animal->id]))
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th class="border-r px-4 py-2"> Date</th>
                                                <th class="border-r px-4 py-2">Time</th>
                                                <th class="border-r px-4 py-2">Product</th>
                                                <th class="border-r px-4 py-2">Price</th>
                                                <th class="border-r px-4 py-2">Amount</th>
                                                {{--<th class="border-r px-4 py-2">quality</th>--}}
                                                <th class="border-r px-4 py-2"> Trace_no</th>
                                                <th class="border-r px-4 py-2"> Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($animalyieldrecords[$animal->id] as $yieldrecord)
                                            <tr class="border-b dark:border-neutral-500">
                                                <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500"> {{ $yieldrecord->date }}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500"> {{ $yieldrecord->yield_time }}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500"> {{ $yieldrecord->product }}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500"> ${{ number_format($yieldrecord->price, 2) }}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500"> {{ $yieldrecord->quantity }}/{{ ($yieldrecord->quality) }}</td>
                                                {{--<td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">  {{ ($yieldrecord->quality) }}</td>--}}
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{$yieldrecord->trace_number}}</td>
                                                <td class="whitespace-nowrap px-4 py-2">
                                                    @if ($animal->status !== 'Solid')
                                                    <a href="{{ route('Yield.yieldrecordedit', ['animal_id' => $animal->id, 'yieldrecord_id' => $yieldrecord->id]) }}" class="text-blue-600 hover:underline mr-2 print-hidden">Edit</a>
                                                @else
                                                    <span class="text-red-500">Cannot be edited</span>
                                                @endif

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <p class="text-gray-500 dark:text-gray-400 text-center">No yieldrecords for this animal.</p>


                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $animals->links() }}
            </div>
        </div>
    </div>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>

    <div class="container font-serif mx-auto mt-8 p-4 mb-4 bg-white dark:bg-gray-800 rounded-lg shadow-lg">


        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="animalSelect" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Animal:</label>
                <select id="animalSelect" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:text-gray-300">
                    @foreach ($animals as $animal)
                        <option value="{{ $animal->id }}">{{ $animal->name }} ({{ $animal->internal_id }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="dateRange" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date Range:</label>
                <select id="dateRange" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:text-gray-300">
                    <option value="7">Last 7 days</option>
                    <option value="30">Last 30 days</option>
                    <option value="90">Last 3 months</option>
                    <option value="365">Last year</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
                <canvas id="quantityChart"></canvas>
            </div>
            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
                <canvas id="qualityChart"></canvas>
            </div>
        </div>

        <div class="mt-4 bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
            <canvas id="priceChart"></canvas>
        </div>

        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full bg-white dark:text-gray-200 dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quality</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Collector</th>
                    </tr>
                </thead>
                <tbody id="yieldTable" class="divide-y dark:text-gray-200 divide-gray-200 dark:divide-gray-700">
                    <!-- Table rows will be dynamically populated here -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const animalData = @json($animalyieldrecords);
        let quantityChart, qualityChart, priceChart;

        function createChart(ctx, type, data, options) {
            return new Chart(ctx, {
                type: type,
                data: data,
                options: {
                    ...options,
                    responsive: true,
                    plugins: {
                        legend: {
                            labels: {
                                color: document.documentElement.classList.contains('dark') ? '#e2e8f0' : '#1f2937'
                            }
                        },
                        title: {
                            ...options.plugins.title,
                            color: document.documentElement.classList.contains('dark') ? '#e2e8f0' : '#1f2937'
                        }
                    },
                    scales: {
                        x: {
                            ...options.scales.x,
                            ticks: {
                                color: document.documentElement.classList.contains('dark') ? '#e2e8f0' : '#1f2937'
                            },
                            grid: {
                                color: document.documentElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'
                            }
                        },
                        y: {
                            ...options.scales.y,
                            ticks: {
                                color: document.documentElement.classList.contains('dark') ? '#e2e8f0' : '#1f2937'
                            },
                            grid: {
                                color: document.documentElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'
                            }
                        }
                    }
                }
            });
        }

        function updateCharts(animalId, days) {
            const yieldData = animalData[animalId] || [];
            const endDate = new Date();
            const startDate = new Date(endDate - days * 24 * 60 * 60 * 1000);

            const filteredData = yieldData.filter(record => new Date(record.date) >= startDate && new Date(record.date) <= endDate);

            updateQuantityChart(filteredData);
            updateQualityChart(filteredData);
            updatePriceChart(filteredData);
            updateTable(filteredData);
        }

        function updateQuantityChart(data) {
            const ctx = document.getElementById('quantityChart').getContext('2d');
            if (quantityChart) quantityChart.destroy();
            quantityChart = createChart(ctx, 'bar', {
                labels: data.map(record => record.date),
                datasets: [{
                    label: 'Quantity',
                    data: data.map(record => record.quantity),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 1
                }]
            }, {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day'
                        },
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Quantity'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Yield Quantity Over Time'
                    }
                }
            });
        }

        function updateQualityChart(data) {
            const ctx = document.getElementById('qualityChart').getContext('2d');
            if (qualityChart) qualityChart.destroy();
            qualityChart = createChart(ctx, 'line', {
                labels: data.map(record => record.date),
                datasets: [{
                    label: 'Quality',
                    data: data.map(record => record.quality),
                    borderColor: 'rgb(255, 99, 132)',
                    tension: 0.1,
                    fill: false
                }]
            }, {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day'
                        },
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Quality'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Yield Quality Over Time'
                    }
                }
            });
        }

        function updatePriceChart(data) {
            const ctx = document.getElementById('priceChart').getContext('2d');
            if (priceChart) priceChart.destroy();
            priceChart = createChart(ctx, 'line', {
                labels: data.map(record => record.date),
                datasets: [{
                    label: 'Price',
                    data: data.map(record => record.price),
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true
                }]
            }, {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day'
                        },
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Price ($)'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Yield Price Over Time'
                    }
                }
            });
        }

        function updateTable(data) {
            const tableBody = document.getElementById('yieldTable');
            tableBody.innerHTML = '';
            data.forEach(record => {
                const row = tableBody.insertRow();
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-300">${record.date}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-300">${record.product}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-300">${record.quantity}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-300">${record.quality}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-300">$${record.price.toFixed(2)}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-300">${record.collector}</td>
                `;
            });
        }

        document.getElementById('animalSelect').addEventListener('change', function() {
            updateCharts(this.value, document.getElementById('dateRange').value);
        });

        document.getElementById('dateRange').addEventListener('change', function() {
            updateCharts(document.getElementById('animalSelect').value, this.value);
        });

        // Initialize charts with first animal and last 7 days
        updateCharts(document.getElementById('animalSelect').value, 7);
    </script>





</x-app-layout>



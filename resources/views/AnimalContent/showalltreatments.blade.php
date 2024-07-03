<x-app-layout title="Animal Treatments">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <div class="container mx-auto mt-8 p-4 mb-4 dark:bg-gray-800 dark:rounded-lg font-serif bg-white rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold mb-6 dark:text-gray-200 text-center">
            <a class="hover:text-yellow-300 flex items-center justify-center" href="{{ route('index') }}">
                <i class="fas fa-paw text-2xl mr-2"></i> Treatments
            </a>
        <div class="overflow-x-auto">
            <div class="min-w-full">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th class="border-r px-4 py-3">Animal</th>
                            <th class="border-r px-4 py-3">Animal_ID</th>
                            <th class="border-r px-4 py-3">Status</th>
                            <th class="px-4 text-center py-3">Treatments</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($animals as $animal)
                        <tr class="bg-white text-sm lowercase capitalize  border-b dark:bg-gray-800 dark:border-gray-700">
                            {{--<td class="whitespace-nowrap border-r px-4 py-3 font-medium dark:border-neutral-500">{{ $loop->index + 1 }}</td>--}}
                            <td class="whitespace-nowrap border-r px-4 py-3 dark:border-neutral-500">{{ $animal->name }}</td>
                            <td class="whitespace-nowrap border-r px-4 py-3 dark:border-neutral-500">{{ $animal->internal_id }}</td>
                            <td class="whitespace-nowrap px-4 py-3 dark-border-neutral-500">{{ $animal->status }}</td>
                            <td class="whitespace-nowrap px-4 py-3">
                                @if (isset($animalTreatments[$animal->id]))
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs  text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th class="border-r px-4 py-2">Treatment Type</th>
                                                <th class="border-r px-4 py-2">Days to Withdrawal</th>
                                                <th class="border-r px-4 py-2">Mode</th>
                                                <th class="border-r px-4 py-2">Date</th>
                                                <th class="border-r px-4 py-2">Cost</th>
                                                <th class="border-r px-4 py-2">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($animalTreatments[$animal->id] as $treatment)
                                            <tr class="border-b text-sm lowercase capitalize dark:border-neutral-500">
                                                <td class="whitespace-nowrap px-4  py-2 dark:border-neutral-500">{{ $treatment->type ?: 'N/A' }}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{ $treatment->days_to_withdrawal ?: 'N/A' }}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{ $treatment->mode ?: 'N/A' }}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{ $treatment->created_at->format('M d, Y') ?: 'N/A'}}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{ $treatment->cost ?: 'N/A' }}/<span class="text-red-500 text-sm ">{{  $treatment->currency}}</span></td></td>
                                                <td class="whitespace-nowrap px-4 py-2">
                                                    @if ($animal->status !== 'Solid')
                                                    <a href="{{ route('treat.treatmentedit', ['animal_id' => $animal->id, 'treatment_id' => $treatment->id]) }}" class="text-blue-600 hover:underline mr-2 print-hidden">Edit</a>
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
                                <p class="text-gray-500 dark:text-gray-400 text-center">No treatments recorded for this animal.</p>
                                <a href="{{ route('treat.treatment', ['animal_id' => $animal->id]) }}" class="text-blue-500 hover:underline block text-center mt-2">Record treatment</a>

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




    <div class="container mx-auto p-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Treatment History</h2>
            <div class="flex flex-wrap">
                <div class="w-full lg:w-3/4 relative" style="height: 70vh; min-height: 400px;">
                    <canvas id="treatmentChart"></canvas>
                </div>
                <div class="w-full lg:w-1/4 relative" style="height: 30vh; min-height: 200px;">
                    <canvas id="typePieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@3.0.1/build/global/luxon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.1.0/dist/chartjs-adapter-luxon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@2.0.1"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const treatmentData = {!! json_encode($treatments->map(function($item) {
            return [
                'x' => $item->dates,
                'y' => $item->amount,
                'cost' => $item->cost,
                'type' => $item->type,
                'product' => $item->product,
                'batch' => $item->batch,
                'unit' => $item->unit,
                'mode' => $item->mode,
                'site' => $item->site,
                'technician' => $item->technician,
                'currency' => $item->currency,
                'description' => $item->treatment_description,
            ];
        })) !!};

        const amountData = treatmentData.map(item => ({ x: item.x, y: item.y }));
        const costData = treatmentData.map(item => ({ x: item.x, y: item.cost }));

        function formatLargeNumber(num) {
            const absNum = Math.abs(num);
            if (absNum >= 1e9) return (num / 1e9).toFixed(2) + 'B';
            if (absNum >= 1e6) return (num / 1e6).toFixed(2) + 'M';
            if (absNum >= 1e3) return (num / 1e3).toFixed(1) + 'K';
            return num.toFixed(0);
        }

        function getTimeUnit(dates) {
            const range = Math.abs(new Date(dates[dates.length - 1]) - new Date(dates[0]));
            const days = range / (1000 * 60 * 60 * 24);
            if (days > 365 * 2) return 'year';
            if (days > 60) return 'month';
            if (days > 7) return 'week';
            return 'day';
        }

        function getScaleType(data) {
            const maxVal = Math.max(...data.map(d => d.y));
            const minVal = Math.min(...data.map(d => d.y));
            return (maxVal / minVal > 1000) ? 'logarithmic' : 'linear';
        }

        const timeUnit = getTimeUnit(treatmentData.map(item => item.x));
        const amountScaleType = getScaleType(amountData);
        const costScaleType = getScaleType(costData);

        // Main chart
        const ctx = document.getElementById('treatmentChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                datasets: [
                    {
                        label: 'Treatment Amount',
                        data: amountData,
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgb(59, 130, 246)',
                        pointRadius: 3,
                        pointHoverRadius: 6,
                        fill: true,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Treatment Cost',
                        data: costData,
                        borderColor: 'rgb(239, 68, 68)',
                        backgroundColor: 'rgba(239, 68, 68, 0.2)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgb(239, 68, 68)',
                        pointRadius: 3,
                        pointHoverRadius: 6,
                        fill: true,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: timeUnit
                        },
                        title: {
                            display: true,
                            text: 'Date',
                            color: 'rgb(107, 114, 128)',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: 'rgba(107, 114, 128, 0.1)'
                        },
                        ticks: {
                            color: 'rgb(107, 114, 128)'
                        }
                    },
                    y: {
                        type: amountScaleType,
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Amount',
                            color: 'rgb(59, 130, 246)',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: 'rgba(107, 114, 128, 0.1)'
                        },
                        ticks: {
                            color: 'rgb(59, 130, 246)',
                            callback: function(value, index, values) {
                                return formatLargeNumber(value);
                            }
                        }
                    },
                    y1: {
                        type: costScaleType,
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Cost',
                            color: 'rgb(239, 68, 68)',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        },
                        grid: {
                            drawOnChartArea: false,
                        },
                        ticks: {
                            color: 'rgb(239, 68, 68)',
                            callback: function(value, index, values) {
                                return formatLargeNumber(value);
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        titleFont: {
                            size: 16,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 14
                        },
                        padding: 12,
                        cornerRadius: 4,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('en-US', {
                                        style: 'currency',
                                        currency: 'USD',
                                        notation: 'compact',
                                        compactDisplay: 'short',
                                        maximumFractionDigits: 2
                                    }).format(context.parsed.y);
                                }
                                return label;
                            },
                            afterBody: function(context) {
                                const dataIndex = context[0].dataIndex;
                                const data = treatmentData[dataIndex];
                                return [
                                    `Type: ${data.type}`,
                                    `Product: ${data.product}`,
                                    `Batch: ${data.batch}`,
                                    `Unit: ${data.unit}`,
                                    `Mode: ${data.mode}`,
                                    `Site: ${data.site}`,
                                    `Technician: ${data.technician}`,
                                    `Currency: ${data.currency}`,
                                    `Description: ${data.description}`
                                ];
                            }
                        }
                    },
                    zoom: {
                        pan: {
                            enabled: true,
                            mode: 'x'
                        },
                        zoom: {
                            wheel: {
                                enabled: true,
                            },
                            pinch: {
                                enabled: true
                            },
                            mode: 'x',
                        }
                    }
                }
            }
        });

        // Pie chart for treatment types
        const typeData = treatmentData.reduce((acc, item) => {
            acc[item.type] = (acc[item.type] || 0) + 1;
            return acc;
        }, {});

        const pieCtx = document.getElementById('typePieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: Object.keys(typeData),
                datasets: [{
                    data: Object.values(typeData),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: 'rgba(255, 255, 255, 0.8)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    title: {
                        display: true,
                        text: 'Treatment Types',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    }
                }
            }
        });
    });
    </script>





</x-app-layout>


<x-app-layout title="Animal Treatments">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <div class="container font-serif mx-auto mt-8 p-4 mb-4 bg-white rounded-lg shadow-lg dark:bg-gray-800">
        <h1 class="text-4xl font-bold font-serif text-center mb-4 dark:text-gray-200">
            <a class="flex items-center justify-center hover:text-yellow-300" href="{{ route('index') }}">
                <i class="fas fa-paw text-2xl mr-2"></i> Feeding
            </a>
        </h1>
        <div class="overflow-x-auto">
            <table class="w-full font-serif text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs font-serif text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="border-r px-4 py-3">Animal</th>
                        <th class="border-r px-4 py-3">Animal ID</th>
                        <th class="border-r px-4 py-3">Status</th>
                        <th class="px-4 text-center py-3">Feedings</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($animals as $animal)
                        <tr class="bg-white font-serif border-b dark:bg-gray-800 dark:border-gray-700">

                            <td class="whitespace-nowrap border-r px-4 py-3 dark:border-neutral-500">{{ $animal->name }}</td>
                            <td class="whitespace-nowrap border-r px-4 py-3 dark:border-neutral-500">{{ $animal->internal_id }}</td>
                            <td class="whitespace-nowrap px-4 py-3 dark-border-neutral-500">{{ $animal->status }}</td>
                            <td class="whitespace-nowrap px-4 py-3">
                                @if (isset($animalFeedings[$animal->id]))
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th class="border-r px-4 py-2">Created At </th>
                                                <th class="border-r px-4 py-2">Estimated Cost </th>
                                                <th class="border-r px-4 py-2">Feed Details </th>
                                                <th class="border-r px-4 py-2">Feeding Amount</th>
                                                <th class="border-r px-4 py-2">Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($animalFeedings[$animal->id] as $feeding)
                                            <tr class="border-b dark:border-neutral-500">
                                                <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500">{{ $feeding->feeding_date ?: 'N/A'}}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{ $feeding->estimated_cost ?: 'N/A' }}/<span class=" text-xs text-red-500">{{$feeding->feeding_currency}}</span></td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{ $feeding->feed_details ?: 'N/A' }}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{ $feeding->amount ?: 'N/A'}}/<span class="text-red-500 text-xs ">{{  $feeding->unit}}</span></td>
                                                <td class="whitespace-nowrap px-4 py-2">

                                                    @if ($animal->status !== 'Solid')
                                                    <a href="{{ route('Feed.feedingedit', ['animal_id' => $animal->id, 'feeding_id' => $feeding->id]) }}" class="inline-flex items-center px-2.5 py-1.5 bg-green-100 text-green-800 rounded-md hover:bg-green-200 transition duration-300 dark:bg-green-900 dark:text-green-300 dark:hover:bg-green-800">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </a>
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
                                <p class="text-gray-500 dark:text-gray-400 text-center">No Feedings recorded for this animal.</p>
    <a href="{{ route('Feed.feeding', ['animal_id' => $animal->id]) }}" class="text-blue-500 hover:underline block text-center mt-2">Record a Feeding</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $animals->links() }}

                <div class="container mx-auto p-6">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Feeding History</h2>
                        <div class="relative" style="height: 400px;">
                            <canvas id="feedingChart"></canvas>
                        </div>
                    </div>
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
    const ctx = document.getElementById('feedingChart').getContext('2d');
    const feedingData = {!! json_encode($feedings->map(function($item) {
        return [
            'x' => $item->feeding_date,
            'y' => $item->amount,
            'cost' => $item->estimated_cost
        ];
    })) !!};

    const amountData = feedingData.map(item => ({ x: item.x, y: item.y }));
    const costData = feedingData.map(item => ({ x: item.x, y: item.cost }));

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [
                {
                    label: 'Feeding Amount',
                    data: amountData,
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgb(54, 162, 235)',
                    pointRadius: 2,
                    pointHoverRadius: 5,
                    fill: true,
                    yAxisID: 'y'
                },
                {
                    label: 'Estimated Cost',
                    data: costData,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgb(255, 99, 132)',
                    pointRadius: 2,
                    pointHoverRadius: 5,
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
                        unit: 'month'
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
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Amount',
                        color: 'rgb(54, 162, 235)',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    grid: {
                        color: 'rgba(107, 114, 128, 0.1)'
                    },
                    ticks: {
                        color: 'rgb(54, 162, 235)'
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Estimated Cost',
                        color: 'rgb(255, 99, 132)',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    grid: {
                        drawOnChartArea: false,
                    },
                    ticks: {
                        color: 'rgb(255, 99, 132)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 12
                    },
                    padding: 10,
                    cornerRadius: 4,
                    displayColors: true
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
});
</script>



</x-app-layout>


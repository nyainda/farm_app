<x-app-layout title="New Measurement">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gray-100 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">New Measurement for {{ $animal->name }}</h1>
            </div>

            <form action="{{ route('Measurement.storemeasurement', ['animal_id' => $animal->id]) }}" method="POST" class="p-6">
                @csrf
                <input type="hidden" name="type" value="{{ $animal->type }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100 border-b pb-2">Basic Information</h2>

                        <div>
                            <label for="measurement_weight" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Weight (kg)</label>
                            <input type="number" name="weight" id="measurement_weight" step="any" max="100000" placeholder="Enter weight" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="measurement_height" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Height (meters)</label>
                            <input type="number" name="height" id="measurement_height" step="any" max="1000" placeholder="Enter height" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="measurement_condition_score" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Condition Score (BCS)</label>
                            <input type="number" name="condition_score" id="measurement_condition_score" step="0.5" min="0" max="100" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <!-- Health Indicators -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100 border-b pb-2">Health Indicators</h2>

                        <div>
                            <label for="measurement_temp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Temperature (°C)</label>
                            <input type="number" name="temp" id="measurement_temp" step="0.1" min="0" max="200" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="measurement_heart_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Heart Rate (bpm)</label>
                            <input type="number" name="heart_rate" id="measurement_heart_rate" min="0" max="300" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="measurement_respiratory_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Respiratory Rate (breaths/min)</label>
                            <input type="number" name="respiratory_rate" id="measurement_respiratory_rate" min="0" max="100" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <!-- Additional Health Data -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100 border-b pb-2">Additional Health Data</h2>

                        <div>
                            <label for="measurement_fec" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecal Egg Count (FEC)</label>
                            <input type="number" name="fec" id="measurement_fec" min="0" max="99999" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="measurement_systolic_bp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Systolic Blood Pressure (mmHg)</label>
                            <input type="number" name="systolic_bp" id="measurement_systolic_bp" min="0" max="300" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="measurement_diastolic_bp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Diastolic Blood Pressure (mmHg)</label>
                            <input type="number" name="diastolic_bp" id="measurement_diastolic_bp" min="0" max="200" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <!-- Measurement Details -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100 border-b pb-2">Measurement Details</h2>


                        <div>
                            <label for="measurement_pulse_oximetry" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pulse Oximetry (SpO2) (%)</label>
                            <input type="number" name="pulse_oximetry" id="measurement_pulse_oximetry" step="0.1" min="0" max="100" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="measurement_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Measurement Date</label>
                            <input type="date" name="date" id="measurement_date" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex justify-end space-x-4">
                    <a href="{{ route('index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:text-gray-700 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancel
                    </a>
                    <button type="submit" name="action" value="save" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save Measurement
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

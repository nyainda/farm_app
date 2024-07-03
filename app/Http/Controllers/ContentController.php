<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\AnimalContent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ContentController extends Controller
{
    public function storebill(Request $request, $animal_id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'descriptions' => 'nullable|string',
            'date' => 'nullable|date',
            'keyword' => 'nullable|string',
            'sold_to' => 'nullable|string',
            'sale_price' => 'numeric|max:99999999.99',
        ]);

        // Check for validation errors; if validator fails, return to index with an error about required fields
        if ($validator->fails()) {
            return redirect()->route('index')
                ->withErrors($validator, 'requiredFields')
                ->withInput();
        }

        // Find the animal by ID
        $animal = Animal::find($animal_id);

        // Check if the animal exists and if it has already been sold
        if (!$animal || $animal->status === 'sold') {
            return redirect()->route('index')
                ->with('error', 'This animal has already been sold or not found.');
        }

        // Generate a unique bill_of_sale_id (UUID) and store it in the session
        $billOfSaleId = $request->session()->get('billOfSaleId');

        // Create an instance of the AnimalContent model
        $animalContent = new AnimalContent($request->all());

        // Fill the model with validated data, including the generated bill_of_sale_id
        $animalContent->bill_of_sale_id = $billOfSaleId;

        // Save the animal content to the database
        $animalContent->save();

        // Update the status of the animal to 'sold'
        $animal->update(['status' => 'sold']);

        // Redirect to the bill of sale page with the bill details
        return view('Sale.bill_of_sale', [
            'animal' => $animal,
            'billOfSaleId' => $billOfSaleId,
            'descriptions' => $animalContent->descriptions,
            'date' => $animalContent->date,
            'keyword' => $animalContent->keyword,
            'soldTo' => $animalContent->sold_to,
            'salePrice' => $animalContent->sale_price,
        ]);
    }

    // Display information about a sold animal
    public function display(Request $request, $animal_id)
    {
        try {
            $user = auth()->user();

            // Fetch the Animal model by ID
            $animal = Animal::find($animal_id);

            // Check if the animal exists
            if (!$animal) {
                return redirect()->route('index')->with('error', 'Bill of Sale not found.');
            }

            // Generate a unique billOfSaleId (UUID)
            $billOfSaleId = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            // Store the generated billOfSaleId in the session
            $request->session()->put('billOfSaleId', $billOfSaleId);

            // Pass the data to the view
            return view('Sale.display', [
                'animal' => $animal,
                'billOfSaleId' => $billOfSaleId,
            ]);
        } catch (\Exception $e) {
            // Log the exception
            Log::error('An error occurred: ' . $e->getMessage());

            return redirect()->route('index')->with('error', 'Oops! Something went wrong. Please try again.');
        }
    }
}

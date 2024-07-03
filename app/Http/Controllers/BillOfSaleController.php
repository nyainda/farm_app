<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\BillOfSale;
use App\Models\AnimalContent;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
class BillOfSaleController extends Controller
{
    public function storeBillOfSale(Request $request, $animal_id)
    {
        // Validation rules for the form fields (you can customize these)
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|file|max:2048',
        ]);

        // If the validation fails, throw a ValidationException
        $validator->validate();

        $BillOfSale = new BillOfSale();

        // Generate a UUID for the id field
        $BillOfSale->id = Str::uuid();

        // Fill in the other BillOfSale fields
        $BillOfSale->fill($request->all());
        $BillOfSale->animal_id = $animal_id;
        $BillOfSale->user_id = auth()->user()->id;
        //$BillOfSale->save(); // Save the BillOfSale object

        return redirect()->route('Sale.showBillOfSale', ['id' => $animal_id])
            ->with('success', 'BillOfSale created successfully.');
    }

    public function showBillOfSale($animal_id)
{
    $user = auth()->user();
    $animal = Animal::find($animal_id);
    if (!$animal) {
        throw new AnimalNotFoundException($animal_id);
    }
    $animals = AnimalContent::find($animal_id);
    $billOfSaleId = $animals ? $animals->getBillOfSaleId() : null;
    $BillOfSales = BillOfSale::where('animal_id', $animal_id)->orderBy('created_at', 'desc')->get();
    $groupedBillOfSales = $BillOfSales->groupBy('category');

    return view('Sale.showBillOfSale', compact('animal', 'user', 'BillOfSales', 'groupedBillOfSales', 'billOfSaleId'));
}

    public function BillOfSale($animal_id)
    {
        // Retrieve the animal by ID
        $animal = Animal::find($animal_id);
        if (!$animal) {
            // Throw a custom exception if the animal is not found
            throw new AnimalNotFoundException($animal_id);
        }

        $animal->user_id = auth()->user()->id;

        return view('animals.BillOfSale', ['animal' => $animal]);
    }

    public function editBillOfSale($animal_id, $BillOfSale_id)
    {
        $animal = Animal::find($animal_id);
        if (!$animal) {
            // Throw a custom exception if the animal is not found
            throw new AnimalNotFoundException($animal_id);
        }

        // Find the BillOfSale by ID or throw a ModelNotFoundException
        $BillOfSale = BillOfSale::findOrFail($BillOfSale_id);

        return view('animals.BillOfSaleedit', ['animal' => $animal, 'BillOfSale' => $BillOfSale]);
    }

    // take care of the updating the animal treatment
    public function updateBillOfSale(Request $request, $animal_id, $BillOfSale_id)
    {
        // Validation rules for treatment update fields
        $validator = Validator::make($request->all(), [
            // ...
        ]);

        // If the validation fails, throw a ValidationException
        $validator->validate();

        // Find the BillOfSale by ID or throw a ModelNotFoundException
        $BillOfSale = BillOfSale::findOrFail($BillOfSale_id);

        // Update the BillOfSale fields
        $BillOfSale->update($request->all());

        return redirect()->route('animals.showBillOfSale', ['animal_id' => $animal_id])
            ->with('success', 'BillOfSale updated successfully.');
    }


    public function deleteBillOfSale($animal_id, $BillOfSale_id)
{
    $BillOfSale = BillOfSale::findOrFail($BillOfSale_id);
    $BillOfSale->delete();

    return redirect()->route('animals.showtask', ['animal_id' => $animal_id])
        ->with('success', 'task deleted successfully.');
}

public function downloadPDF($animal_id)
    {
        // Fetch the BillOfSales related to the specified animal
        $BillOfSales = BillOfSale::where('animal_id', $animal_id)->orderBy('created_at', 'desc')->get();

        // Group BillOfSales by category in the controller
        $groupedBillOfSales = $BillOfSales->groupBy('category');

        // Fetch the animal by ID
        $animal = Animal::find($animal_id);
        if (!$animal) {
            // Throw a custom exception if the animal is not found
            throw new AnimalNotFoundException($animal_id);
        }

        // View for the PDF content
        $pdfView = view('Sale.billofsale', compact('animal', 'BillOfSales', 'groupedBillOfSales'));

        // Generate PDF
        $pdf = PDF::loadHTML($pdfView)->setPaper('a4', 'landscape');

        // Download the PDF
        return $pdf->download('BillOfSale.pdf');
    }


}

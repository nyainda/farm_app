<?php

namespace App\Http\Controllers;


use App\Models\Animal;
use App\Models\Supplier;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\BatchDeletionNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;

class SupplierController extends Controller
{
    public function indexsupplier()
    {
        $suppliers = Supplier::latest()->get();
        return view('Supplier.index', compact('suppliers'));
    }

    public function createsupplier($animal_id)
    {
        $animal = Animal::find($animal_id);
        $contacts = Contact::where('contact_type', 'Supplier')->get();
        $suppliers = Supplier::all();

        $contactNames = $contacts->pluck('first_name', 'last_name')->map(function($firstName, $lastName) {
            return $firstName . ' ' . $lastName;
        })->toArray();

        return view('Supplier.create', compact('animal', 'contacts', 'contactNames', 'suppliers'));
    }

    public function storesupplier(Request $request, $animal_id)
    {
        $validator = Validator::make($request->all(), [
            // Add validation rules here
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $supplier = new Supplier();
        $image = $request->file('photo');
        $slug = Str::slug($request->input('name'));

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('supplier')) {
                Storage::disk('public')->makeDirectory('supplier');
            }

            $postImage = Image::make($image)->resize(480, 320)->stream();
            Storage::disk('public')->put('supplier/' . $imageName, $postImage);
        } else {
            $imageName = 'default.png';
        }

        $supplier->id = Str::uuid();
        $supplier->fill($request->all());
        $supplier->animal_id = $animal_id;
        $supplier->user_id = auth()->user()->id;
        $supplier->photo = $imageName;
        $supplier->save();

        return redirect()->route('Supplier.show', ['animal_id' => $animal_id])
            ->with('success', 'Supplier created successfully.');
    }

    public function showsupplier($animal_id)
    {
        try {
            $user = auth()->user();
            $animal = Animal::find($animal_id);
            $suppliers = Supplier::with('animal')
                ->where('user_id', $user->id)
                ->where('animal_id', $animal_id)
                ->orderBy('created_at', 'desc')
                ->paginate(5);

            if ($animal->status === 'sold') {
                return redirect()->route('index')->with('error', 'This animal has already been sold and cannot add measurement/edit.');
            }

            return view('Supplier.show', ['animal' => $animal, 'suppliers' => $suppliers, 'user' => $user]);
        } catch (Exception $e) {
            return redirect()->route('index')->with('error', 'An error occurred while displaying the suppliers.');
        }
    }

    public function supplier($animal_id)
    {
        try {
            $animal = Animal::find($animal_id);
            if (!$animal) {
                return Redirect::route('index')->with('error', 'Animal not found.');
            }

            return view('Supplier.supplier', ['animal' => $animal]);
        } catch (Exception $e) {
            return redirect()->route('index')->with('error', 'An error occurred while displaying the supplier form.');
        }
    }

    public function editsupplier($animal_id, $supplier_id)
    {
        $animal = Animal::find($animal_id);
        try {
            $supplier = Supplier::findOrFail($supplier_id);
        } catch (Exception $e) {
            return redirect()->route('index')->with('error', 'Supplier not found.');
        }

        $contacts = Contact::where('contact_type', 'Supplier')->get();
        $contactNames = $contacts->pluck('first_name', 'last_name')->map(function($firstName, $lastName) {
            return $firstName . ' ' . $lastName;
        })->toArray();

        return view('Supplier.edit', compact('animal', 'supplier', 'contacts', 'contactNames'));
    }

    public function updatesupplier(Request $request, $animal_id, $supplier_id)
    {
        $validator = Validator::make($request->all(), [
            // Validation rules
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $supplier = Supplier::findOrFail($supplier_id);
        $image = $request->file('photo');
        $slug = Str::slug($request->input('name'));

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('supplier')) {
                Storage::disk('public')->makeDirectory('supplier');
            }

            if (Storage::disk('public')->exists('supplier/' . $supplier->photo)) {
                Storage::disk('public')->delete('supplier/' . $supplier->photo);
            }

            $postImage = Image::make($image)->resize(480, 320)->stream();
            Storage::disk('public')->put('supplier/' . $imageName, $postImage);
        } else {
            $imageName = $supplier->photo;
        }

        $supplier->update($request->all());
        $supplier->photo = $imageName;
        $supplier->save();

        return redirect()->route('Supplier.show', ['animal_id' => $animal_id])
            ->with('success', 'Supplier updated successfully.');
    }

    public function deletesupplier($animal_id, $supplier_id)
    {
        $supplier = Supplier::findOrFail($supplier_id);
        $supplier->delete();

        return redirect()->route('Supplier.show', ['animal_id' => $animal_id])
            ->with('success', 'Supplier deleted successfully.');
    }

    public function batchDelete(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'selected_ids' => 'required|string',
            ]);

            $selectedIds = array_filter(explode(',', $validatedData['selected_ids']));

            if (empty($selectedIds)) {
                return redirect()->back()->with('error', 'No contacts selected for deletion.');
            }

            $deletedCount = Supplier::whereIn('id', $selectedIds)->delete();

            if ($deletedCount === 0) {
                return redirect()->back()->with('error', 'The selected suppliers could not be found.');
            }

            $user = $request->user();
            $user->notify(new BatchDeletionNotification($deletedCount));

            return redirect()->back()->with('success', 'Selected suppliers have been deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->with('error', 'Oops! Something went wrong. Please try again.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}




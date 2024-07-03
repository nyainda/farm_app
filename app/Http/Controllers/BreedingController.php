<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breeding;
use App\Models\Animal;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Exceptions\AnimalNotFoundException;

class BreedingController extends Controller
{
    public function storebreeding(Request $request, $animal_id)
    {
        // Validation rules for the form fields (you can customize these)
        $validator = Validator::make($request->all(), [
            //'file' => 'nullable|file|max:2048',
        ]);

        // If the validation fails, throw a ValidationException
        $validator->validate();

        $breeding = new Breeding();

        // Generate a UUID for the id field
        $breeding->id = Str::uuid();

        // Fill in the other breeding fields
        $breeding->fill($request->all());
        $breeding->animal_id = $animal_id;
        $breeding->user_id = auth()->user()->id;
        $breeding->save();

        return redirect()->route('breed.showbreeding', ['animal_id' => $animal_id])
            ->with('success', 'breeding created successfully.');
    }

    public function showbreeding($animal_id)
    {
        // Fetch the authenticated user
        $user = auth()->user();

        // Fetch the animal and check if it exists
        $animal = Animal::find($animal_id);
        if (!$animal) {
            // Throw a custom exception if the animal is not found
            throw new AnimalNotFoundException($animal_id);
        }

        // Check if the animal's status is 'sold'
        if ($animal->status === 'sold') {
            return redirect()->route('index')->with('error', 'This animal has already been sold, and you cannot add breedings.');
        }

        // Fetch breedings related to the specified animal, ordered by created_at in descending order and paginate them
        $breedings = Breeding::where('animal_id', $animal_id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // Group breedings by category in the controller
        $groupedbreedings = $breedings->groupBy('category');

        return view('breed.showbreeding', compact('animal', 'user', 'breedings', 'groupedbreedings'));
    }

    public function breeding($animal_id)
    {
        // Retrieve the animal by ID
        $animal = Animal::find($animal_id);
        if (!$animal) {
            // Throw a custom exception if the animal is not found
            throw new AnimalNotFoundException($animal_id);
        }

        $animal->user_id = auth()->user()->id;
        return view('breed.breeding', ['animal' => $animal]);
    }

    public function editbreeding($animal_id, $breeding_id)
    {
        $animal = Animal::find($animal_id);
        if (!$animal) {
            // Throw a custom exception if the animal is not found
            throw new AnimalNotFoundException($animal_id);
        }

        // Find the breeding by ID or throw a ModelNotFoundException
        $breeding = breeding::findOrFail($breeding_id);

        return view('breed.breedingedit', ['animal' => $animal, 'breeding' => $breeding]);
    }

    // take care of the updating the animal treatment
    public function updatebreeding(Request $request, $animal_id, $breeding_id)
    {
        // Validation rules for treatment update fields
        $validator = Validator::make($request->all(), [
            // ...
        ]);

        // If the validation fails, throw a ValidationException
        $validator->validate();

        // Find the breeding by ID or throw a ModelNotFoundException
        $breeding = breeding::findOrFail($breeding_id);

        // Update the breeding fields
        $breeding->update($request->all());

        return redirect()->route('breed.showbreeding', ['animal_id' => $animal_id])
            ->with('success', 'breeding updated successfully.');
    }


    public function deletebreeding($animal_id, $breeding_id)
{
    $breeding = Breeding::findOrFail($breeding_id);
    $breeding->delete();

    return redirect()->route('breed.showbreeding', ['animal_id' => $animal_id])
        ->with('success', 'task deleted successfully.');
}


}

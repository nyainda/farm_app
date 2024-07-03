<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnimalEvent;
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
use App\Exceptions\AnimalNotFoundException;

class EventController extends Controller
{
    public function storeEvent(Request $request, $animal_id)
    {
        // Validation rules for the form fields (you can customize these)
        $validator = Validator::make($request->all(), [
            'event_title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_theme' => 'required|string',
        ]);

        // If the validation fails, throw a ValidationException
        $validator->validate();

        $event = new AnimalEvent();

        // Generate a UUID for the id field
        $event->id = Str::uuid();

        // Fill in the other note fields
        $event->fill($request->all());
        $event->animal_id = $animal_id;
        $event->user_id = auth()->user()->id;
        $event->save();

        return redirect()->route('animals.shownote', ['animal_id' => $animal_id])
            ->with('success', 'note created successfully.');
    }


    public function Event($animal_id)
    {
        // Retrieve the animal by ID
        $animal = Animal::find($animal_id);
        if (!$animal) {
            // Throw a custom exception if the animal is not found
            throw new AnimalNotFoundException($animal_id);
        }

        $animal->user_id = auth()->user()->id;

        return view('animals.Event', ['animal' => $animal]);
    }



}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
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
use App\Notifications\BatchDeletionNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;


use App\Exceptions\AnimalNotFoundException; // A custom exception class

class NoteController extends Controller
{
    public function storenote(Request $request, $animal_id)
    {
        // Validation rules for the form fields
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|file|max:2048',
        ]);

        // If the validation fails, throw a ValidationException
        $validator->validate();

        $note = new Note();

        // Generate a UUID for the id field
        $note->id = Str::uuid();

        // Fill in the other note fields
        $note->fill($request->all());
        $note->animal_id = $animal_id;
        $note->user_id = auth()->user()->id;

        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $filePath = $uploadedFile->store('images');
            $note->file = $filePath;
        }
        $note->save();

        return redirect()->route('Notes.shownote', ['animal_id' => $animal_id])
            ->with('success', 'note created successfully.');
    }

    public function shownote($animal_id)
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
            return redirect()->route('index')->with('error', 'This animal has already been sold, and you cannot add notes.');
        }

        // Fetch notes related to the specified animal, ordered by created_at in descending order and paginate them
        $notes = Note::where('animal_id', $animal_id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // Group notes by category in the controller
        $groupedNotes = $notes->groupBy('category');

        return view('Notes.shownote', compact('animal', 'user', 'notes', 'groupedNotes'));
    }

    public function note($animal_id)
    {
        // Retrieve the animal by ID
        $animal = Animal::find($animal_id);
        if (!$animal) {
            // Throw a custom exception if the animal is not found
            throw new AnimalNotFoundException($animal_id);
        }

        $animal->user_id = auth()->user()->id;

        return view('Notes.note', ['animal' => $animal]);
    }

    public function editnote($animal_id, $note_id)
    {
        $animal = Animal::find($animal_id);
        if (!$animal) {
            // Throw a custom exception if the animal is not found
            throw new AnimalNotFoundException($animal_id);
        }

        // Find the note by ID or throw a ModelNotFoundException
        $note = Note::findOrFail($note_id);

        return view('Notes.noteedit', ['animal' => $animal, 'note' => $note]);
    }

    // take care of the updating the animal treatment
    public function updatenote(Request $request, $animal_id, $note_id)
    {
        // Validation rules for treatment update fields
        $validator = Validator::make($request->all(), [
            // ...
        ]);

        // If the validation fails, throw a ValidationException
        $validator->validate();

        // Find the note by ID or throw a ModelNotFoundException
        $note = Note::findOrFail($note_id);

        // Update the note fields
        $note->update($request->all());

        return redirect()->route('Notes.shownote', ['animal_id' => $animal_id])
            ->with('success', 'note updated successfully.');
    }


    public function deletenote($animal_id, $note_id)
{
    $note = Note::findOrFail($note_id);
    $note->delete();

    return redirect()->route('Notes.shownote', ['animal_id' => $animal_id])
        ->with('success', 'task deleted successfully.');
}

public function batchDelete(Request $request)
    {
        try {
            // Check if selected_ids is present in the request
            if (!$request->has('selected_ids')) {
                return redirect()->back()->with('error', 'No batches selected for deletion.');
            }

            // Split the selected_ids string into an array
            $selectedIds = explode(',', $request->input('selected_ids'));

            // Check if there are any selected batches
            if (empty($selectedIds)) {
                return redirect()->back()->with('error', 'No batches selected for deletion.');
            }

            // Delete the selected Contacts
            Note::whereIn('id', $selectedIds)->delete();

            // Send notification to user
            $user = $request->user(); // Assuming the user is authenticated
            $user->notify(new BatchDeletionNotification());

            return redirect()->back()->with('success', 'Selected notess have been deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->with('error', 'Oops! Something went wrong. Please try again.');
        }
    }
}

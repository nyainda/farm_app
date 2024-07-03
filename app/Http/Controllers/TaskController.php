<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Animal;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use App\Notifications\BatchDeletionNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Exceptions\AnimalNotFoundException;

class TaskController extends Controller
{
    public function storetask(Request $request, $animal_id)
    {
        // Validation rules for the form fields (you can customize these)
        $rules = [
            // Add your validation rules here
        ];

        // Validate the request and throw a ValidationException if it fails
        Validator::validate($request->all(), $rules);

        $task = new Task();

        // Generate a UUID for the id field
        $task->id = Str::uuid();
        $task->associated_to = Str::uuid();

        // Fill in the other task fields
        $task->fill($request->all());
        $task->animal_id = $animal_id;
        $task->user_id = auth()->user()->id;

        // Try to save the task to the database and catch any QueryException
        //try {
            $task->save();
        //} catch (QueryException $e) {
            // Log the exception or display an error message to the user
           // return redirect()->back()->with('error', 'An error occurred while saving the task.');
        //}

        return redirect()->route('Tasks.showtask', ['animal_id' => $animal_id])
        ->with('success', 'task created successfully.');

    }


    public function showtask($animal_id)
    {
        try {

            $user = auth()->user();
            // Use the findOrFail method to retrieve the animal by ID and throw a ModelNotFoundException if it does not exist
            $animal = Animal::findOrFail($animal_id);
            $tasks = Task::with('animal')
            ->where('user_id',$user->id)
            ->where('animal_id',$animal_id)
            ->orderBy('created_at','desc')
            ->paginate(5);

            if ($animal->status === 'sold') {
                // Throw a custom exception if the animal is sold
                throw new AnimalNotFoundException('This animal has already been sold and cannot add Task/edit.');
            }

            return view('Tasks.showtask', ['animal' => $animal, 'tasks' => $tasks,'user'=>$user]);
        } catch (ModelNotFoundException $e) {
            // Catch the ModelNotFoundException and display a "not found" flash message
            return redirect()->route('index')->with('error', 'Animal not found.');
        } catch (AnimalNotFoundException $e) {
            // Catch the AnimalNotFoundException and display a custom message
            return redirect()->route('index')->with('error', $e->getMessage());
        } catch (\Exception $e) {
            // Catch any other exception and display a generic error message
            return redirect()->route('index')->with('error', 'An error occurred while displaying the tasks.');
        }
    }



    public function task($animal_id)
    {
        try {
            // Use the findOrFail method to retrieve the animal by ID and throw a ModelNotFoundException if it does not exist
            $animal = Animal::findOrFail($animal_id);
            $animal->user_id = auth()->user()->id;

            return view('Tasks.task', ['animal' => $animal]);
        } catch (ModelNotFoundException $e) {
            // Catch the ModelNotFoundException and display a "not found" flash message
            return Redirect::route('index')->with('error', 'Animal not found.');
        } catch (\Exception $e) {
            // Catch any other exception and display a generic error message
            return redirect()->route('index')->with('error', 'An error occurred while displaying the task form.');
        }
    }

public function edittask($animal_id, $task_id)
{
    // Use the findOrFail method to retrieve the animal by ID and throw a ModelNotFoundException if it does not exist
    $animal = Animal::findOrFail($animal_id);
    // Use the findOrFail method to retrieve the task by ID and throw a ModelNotFoundException if it does not exist
    $task = Task::findOrFail($task_id);

    // Abort the request with a 403 status code and a custom message if the user is not the owner of the task or the animal
    if ($task->user_id != auth()->user()->id || $animal->user_id != auth()->user()->id) {
        abort(403, 'You are not authorized to edit this task.');
    }

    return view('Tasks.taskedit', ['animal' => $animal, 'task' => $task]);
}

   // take care of the updating the animal treatment
public function updatetask(Request $request, $animal_id, $task_id)
{
    $rules = [
        // Validation rules for treatment update fields
    ];

    // Validate the request and throw a ValidationException if it fails
    Validator::validate($request->all(), $rules);

    // Use the findOrFail method to retrieve the task by ID and throw a ModelNotFoundException if it does not exist
    $task = Task::findOrFail($task_id);
    $task->update($request->all());

    return redirect()->route('Tasks.showtask', ['animal_id' => $animal_id])
        ->with('success', 'task updated successfully.');
}
    // delete the animal treatment
public function deletetask($animal_id, $task_id)
{
    // Use the findOrFail method to retrieve the task by ID and throw a ModelNotFoundException if it does not exist
    $task = Task::findOrFail($task_id);
    $task->delete();

    return redirect()->route('Tasks.showtask', ['animal_id' => $animal_id])
        ->with('success', 'task deleted successfully.');
}

public function completeTask(Request $request, $animal_id, $task_id)
{
    try {
        // Find the task by ID
        $task = Task::findOrFail($task_id);

        // Check if the task belongs to the specified animal
        if ($task->animal_id != $animal_id) {
            return redirect()->back()->with('error', 'Invalid task ID for the specified animal.');
        }

        // Check if the task is already completed
        if ($task->status == 'completed') {
            // Undo completion
            $task->status = 'in_progress'; // Or whichever status indicates the task is in progress
            $task->save();

            return redirect()->back()->with('success', 'Task marked as in progress successfully.');
        }

        // Mark the task as completed
        $task->status = 'completed';
        $task->save();

        return redirect()->back()->with('success', 'Task marked as completed successfully.');
    } catch (ModelNotFoundException $e) {
        // Task not found
        return redirect()->back()->with('error', 'Task not found.');
    } catch (\Exception $e) {
        // Error occurred
        return redirect()->back()->with('error', 'An error occurred while completing the task.');
    }
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
            Task::whereIn('id', $selectedIds)->delete();

            // Send notification to user
            $user = $request->user(); // Assuming the user is authenticated
            $user->notify(new BatchDeletionNotification());

            return redirect()->back()->with('success', 'Selected Tasks have been deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->with('error', 'Oops! Something went wrong. Please try again.');
        }
    }

}

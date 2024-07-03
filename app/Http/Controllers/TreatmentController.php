<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\AnimalContent;
use App\Models\Treat;
use App\Models\Contact;
use App\Models\Feed;
use App\Models\Task;
use App\Models\Measurement;
use App\Models\YieldRecord;
use App\Notifications\AnimalBoosterDueNotification;
use App\Notifications\Notification;
use App\Models\Note;
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
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Notifications\BatchDeletionNotification;
class TreatmentController extends Controller
{
    public function storetreament(Request $request,$animal_id)
{
    $validator = Validator::make($request->all(), [
        'type' => 'required|string|max:255',
        'product' => 'nullable|string|max:60',
        //'batch' => 'nullable|string|max:63',
        'amount' => 'nullable|string|max:60',
        'inventory_amount' => 'nullable|numeric|between:0,999999.99',
        'unit' => 'nullable|string|max:255',
        'mode' => 'nullable|string|max:255',
        'site' => 'nullable|string|max:60',
        'days_to_withdrawal' => 'nullable|integer|min:0',
        'retreat_date' => 'nullable|date',
        'technician' => 'nullable|string|max:63',
        //'currency' => 'nullable|string|max:10',
        'cost' => 'nullable|numeric|between:0,9999999.99',
        'record_transaction' => 'boolean',
        'treatment_description' => 'nullable|string',
        'dates' => 'nullable|date',
        'treatment_keywords' => 'nullable|string|max:20'


    ]);
    $treatment = new Treat();
    $treatment->fill($request->all());
    $treatment->user_id = auth()->user()->id;
    $treatment->animal_id = $animal_id; // Associate the treatment with the animal
    $treatment->save();

    $animal = Animal::findOrFail($animal_id);
    if ($animal->next_booster_date == now()->toDateString()) {
        $this->checkBoosterDates();
    }

    return redirect()->route('treat.showtreatment', ['animal_id' => $animal_id])
        ->with('success', 'Treatment created successfully.');

}
     // add animal treatment by checking animal id
     public function treatment($animal_id)
     {
         try {
             // Find the animal by ID
             $animal = Animal::find($animal_id);
             $animal->user_id = auth()->user()->id;
             if (!$animal) {
                 // Redirect to the home page with a "not found" flash message
                 return redirect()->route('index')->with('error', 'Holly Smoke!! Sorry, something went wrong please try again..');
             }

             $Contacts = Contact::where('contact_type', 'Veterinarian')->get();


             return view('treat.treatment', ['animal' => $animal,'animal_id' => $animal_id,'Contacts' => $Contacts]);
         } catch (QueryException $e) {
             // Handle the exception here
             return redirect()->route('index')->with('error', 'Holly Smoke!! Sorry, something went wrong please try again..');
         }
     }


public function showtreatment($animal_id)
{
    try {
        $user = auth()->user();
        $animal = Animal::find($animal_id);
        $treatments = Treat::where('user_id', $user->id)->get();
        $treatments = Treat::where('animal_id', $animal_id)

        ->orderBy('created_at', 'desc') // Order by date in descending order (latest first)
        ->paginate(5);
        // Check if the animal's status is 'sold'
        if ($animal->status === 'sold') {
            return redirect()->route('index')->with('error', 'Holly Smoke !!!This animal has already been sold and cannot add treatement/edit.');
        }

        return view('treat.showtreatment', ['animal' => $animal, 'treatments' => $treatments,'user'=> $user]);
    } catch (\Exception $e) {
        //return redirect()->route('index')->with('error', 'An error occurred while displaying the treatments.');
    }
}

   // edit the animal treatment form
   public function edittreatment($animal_id, $treatment_id)
   {
       try {
           $animal = Animal::find($animal_id);
           $treatment = Treat::findOrFail($treatment_id);

           return view('treat.treatmentedit', ['animal' => $animal, 'treatment' => $treatment]);
       } catch (QueryException $e) {
           // Handle the exception here
           return redirect()->route('index')->with('error', 'Holly Smoke!! Sorry, something went wrong please try again..');
       } catch (ModelNotFoundException $e) {
           // Handle the case where the animal or treatment was not found
           return redirect()->route('index')->with('error', 'Holly Smoke!! Sorry, something went wrong please try again..');
       }
   }
   // take care of the updating the animal treatment
   public function updatetreatment(Request $request, $animal_id, $treatment_id)
   {
       try {
           $validator = Validator::make($request->all(), [
               // Validation rules for treatment update fields
           ]);

           if ($validator->fails()) {
               return redirect()->back()
                   ->withErrors($validator)
                   ->withInput();
           }

           $treatment = Treat::findOrFail($treatment_id);
           $treatment->update($request->all());

           return redirect()->route('treat.showtreatment', ['animal_id' => $animal_id])
               ->with('success', 'Treatment updated successfully.');
       } catch (ModelNotFoundException $e) {
           return redirect()->route('index')->with('error', 'Holly Smoke!! Sorry, something went wrong please try again..');
       }
   }

    // delete the animal treatment
public function deletetreatment($animal_id, $treatment_id)
{
    $treatment = Treat::findOrFail($treatment_id);
    $treatment->delete();

    return redirect()->route('treat.showtreatment', ['animal_id' => $animal_id])
        ->with('success', 'Treatment deleted successfully.');
}

/**
 * Check and send notifications for animals with upcoming booster dates.
 *
 * @return \Illuminate\Http\Response
 */
public function checkBoosterDates()
{
    $animals = Animal::whereDate('next_booster_date', now()->toDateString())->get();

    foreach ($animals as $animal) {
        $user = $animal->owner;
        $user->notify(new AnimalBoosterDueNotification($animal));
    }

    return response()->json([
        'message' => 'Notifications sent successfully.'
    ], 200);
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
            Treat::whereIn('id', $selectedIds)->delete();

            // Send notification to user
            $user = $request->user(); // Assuming the user is authenticated
            $user->notify(new BatchDeletionNotification());

            return redirect()->back()->with('success', 'Selected Employees have been deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->with('error', 'Oops! Something went wrong. Please try again.');
        }
    }
}

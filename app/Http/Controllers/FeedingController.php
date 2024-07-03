<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Feed;
use App\Models\Measurement;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Notifications\BatchDeletionNotification;
use App\Notifications\AnimalFeedingNotification;
use Illuminate\Support\Facades\Notification;
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

class FeedingController extends Controller
{
    public function storefeeding(Request $request, $animal_id)
{
    $validator = Validator::make($request->all(), [
        'amount' => 'nullable|numeric|between:0,9999999.99',
        'unit' => 'nullable|string|max:255',
        'feed_details' => 'nullable|string',
        'feed_weight' => 'nullable|numeric|between:0,9999999.99',
        'weight_unit' => 'nullable|string|max:255',
        'feeding_currency' => 'nullable|string',
        'estimated_cost' => 'nullable|numeric|between:0,9999999.99',
        'feeding_description' => 'nullable|string',
        'feeding_date' => 'nullable|date',
        'repeat_days' => 'nullable|numeric|min:1',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $repeatDays = $request->input('repeat_days', 1);
    $initialFeedingDate = $request->input('feeding_date');

    // Fetch the initial weight from the Animal model
    $animal = Animal::findOrFail($animal_id);
    $initialWeight = $animal->weight;

    for ($i = 0; $i < $repeatDays; $i++) {
        $feeding = new Feed();
        $feeding->fill($request->all());
        $feeding->animal_id = $animal_id;
        $feeding->user_id = auth()->user()->id;
        $feeding->feeding_date = $initialFeedingDate;

        // For the first feeding, use the initial weight from the Animal model
        if ($i === 0) {
            $feeding->feed_weight = $initialWeight;
        } else {
            // For subsequent feedings, fetch the latest weight from the Measurement model
            $latestMeasurement = Measurement::where('animal_id', $animal_id)
                ->orderByDesc('date')
                ->first();

            if ($latestMeasurement) {
                $feeding->feed_weight = $latestMeasurement->weight;
            }
        }

        $feeding->save();

        $initialFeedingDate = date('Y-m-d', strtotime($initialFeedingDate . ' +1 day'));
    }

    $user = auth()->user();
    $user->notify(new AnimalFeedingNotification($feeding));

    $feedEfficiency = $this->calculateFeedEfficiency($animal_id);

    return redirect()->route('Feed.showfeeding', ['animal_id' => $animal_id])
        ->with([
            'success' => 'Feeding created successfully. Feed efficiency: ' . $feedEfficiency,
            'initialWeight' => $initialWeight,
            //'latestWeight' => $latestWeight,
        ]);
}
public function calculateFeedEfficiency($animal_id)
{
    // Retrieve the animal by ID
    $animal = Animal::findOrFail($animal_id);

    // Fetch the initial weight from the Animal model
    $initialWeight = $animal->weight;

    // Fetch all feedings for the given animal
    $feedings = Feed::where('animal_id', $animal_id)->get();

    // Calculate total feed consumed
    $totalFeed = $feedings->sum('feed_weight');

    // Calculate weight gain using the latest measurement weight
    $latestMeasurement = Measurement::where('animal_id', $animal_id)
        ->orderByDesc('date')
        ->first();

    // If there's a latest measurement, use its weight; otherwise, use the current weight of the animal
    $latestWeight = $latestMeasurement ? $latestMeasurement->weight : $animal->current_weight;

    // Calculate weight gain
    $weightGain = $latestWeight - $initialWeight;

    // Avoid division by zero
    if ($totalFeed > 0) {
        // Calculate feed efficiency as a percentage
        $feedEfficiency = ($weightGain / $totalFeed) * 100;
    } else {
        $feedEfficiency = 0; // or any default value when totalFeed is zero
    }

    return $feedEfficiency;
}


public function feeding($animal_id)
{
    //$animal->user_id = auth()->user()->id;
    // Retrieve the animal by ID
    $animal = Animal::find($animal_id);
    $animal->user_id = auth()->user()->id;

    if (!$animal) {

        return Redirect::route('index')->with('error', 'Holly Smoke!! Sorry, something went wrong please try again..');
    }

    return view('Feed.feeding', ['animal' => $animal]);
}
public function showfeeding($animal_id)
{
    try {
        $user = auth()->user();
        $animal = Animal::find($animal_id);
        //$animals = Animal::paginate(5);
        $feedings = Feed::where('user_id', $user->id)->get();
        $feedings = Feed::where('animal_id', $animal_id)
        //->whereDate('created_at', '<', Carbon::now())
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        // Check if the animal's status is 'sold'
        if ($animal->status === 'sold') {
            return redirect()->route('index')->with('error', 'This animal has already been sold and cannot add feeeding/edit.');
        }

        return view('Feed.showfeeding', ['animal' => $animal, 'feedings' => $feedings,'user'=>$user]);
    } catch (\Exception $e) {
        return redirect()->route('index')->with('error', 'Holly Smoke!! Sorry, something went wrong please try again..');
    }
}



public function editfeeding($animal_id, $feeding_id)
{
    try {
        $animal = Animal::find($animal_id);
        $feeding = Feed::findOrFail($feeding_id);

        return view('Feed.feedingedit', ['animal' => $animal, 'feeding' => $feeding]);
    } catch (\Exception $e) {
        return redirect()->route('index')->with('error', 'An error occurred while editing the feeding.');
    }
}


   // take care of the updating the animal Feeding
   public function updatefeeding(Request $request, $animal_id, $feeding_id)
   {
       try {
           $validator = Validator::make($request->all(), [
               // Add your validation rules for feeding update fields here
           ]);

           if ($validator->fails()) {
               return redirect()->back()
                   ->withErrors($validator)
                   ->withInput();
           }

           $feeding = Feed::findOrFail($feeding_id);
           $feeding->update($request->all());

           return redirect()->route('Feed.showfeeding', ['animal_id' => $animal_id])
               ->with('success', 'Feeding updated successfully.');
       } catch (\Exception $e) {
           return redirect()->route('index')->with('error', 'An error occurred while updating the feeding.');
       }
   }

    // delete the animal Feeding
    public function deletefeeding($animal_id, $feeding_id)
    {
        try {
            $feeding = Feed::findOrFail($feeding_id);
            $feeding->delete();

            return redirect()->route('Feed.showfeeding', ['animal_id' => $animal_id])
                ->with('success', 'Feeding deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->with('error', 'Holly Smoke!! Sorry, something went wrong please try again..');
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

            // Delete the selected feedings
            Feed::whereIn('id', $selectedIds)->delete();

            // Send notification to user
            $user = $request->user(); // Assuming the user is authenticated
            $user->notify(new BatchDeletionNotification());

            return redirect()->back()->with('success', 'Selected feedings have been deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->with('error', 'Oops! Something went wrong. Please try again.');
        }
    }




}

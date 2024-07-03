<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Contact;
use App\Models\AnimalContent;
use App\Models\Treat;
use App\Models\Feed;
use App\Models\Health;
use App\Models\Task;
use App\Models\Breeding;
use App\Models\Measurement;
use App\Models\YieldRecord;
use App\Models\Note;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
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
class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $error = session('error');

        $animals = $this->getAnimals($user);
        $soldAnimals = $this->getSoldAnimals($user);
        $animalStats = $this->calculateAnimalStats($animals);
        $taskStats = $this->getTaskStats($user);
        $feedStats = $this->getFeedStats($user);

        return view('AnimalContent.index', array_merge(
            $animalStats,
            $taskStats,
            $feedStats,
            compact('animals', 'soldAnimals', 'error', 'user')
        ));
    }

    private function getAnimals($user)
    {
        return Animal::where('user_id', $user->id)
            ->latest()
            ->paginate(5);
    }

    private function getSoldAnimals($user)
    {
        return Animal::where('user_id', $user->id)
            ->where('status', 'sold')
            ->get();
    }

    private function calculateAnimalStats($animals)
    {
        $stats = [
            'recordCount' => $animals->total(),
            'maleCount' => 0,
            'femaleCount' => 0,
            'purchased' => 0,
            'raised' => 0,
            'soldAnimal' => 0,
            'goodHealthCount' => 0,
            'notVaccinatedCount' => 0,
            'partiallyVaccinatedCount' => 0,
            'fullyVaccinatedCount' => 0,
            'sickCount' => 0,
            'recoveringCount' => 0,
            'healthyCount' => 0,
        ];

        foreach ($animals as $animal) {
            $this->updateGenderCounts($animal, $stats);
            $this->updateAcquisitionCounts($animal, $stats);
            $this->updateHealthCounts($animal, $stats);
            $this->updateVaccinationCounts($animal, $stats);
        }

        $stats['totalAnimals'] = $stats['femaleCount'] + $stats['maleCount'];
        $stats['overallHealthStatus'] = $this->determineOverallHealthStatus($stats);

        return $stats;
    }

    private function updateGenderCounts($animal, &$stats)
    {
        $stats[$animal->gender == 'Male' ? 'maleCount' : 'femaleCount']++;
    }

    private function updateAcquisitionCounts($animal, &$stats)
    {
        $stats[$animal->raised_purchased == 'Raised' ? 'raised' : 'purchased']++;
        if ($animal->status == 'Sold') {
            $stats['soldAnimal']++;
        }
    }

    private function updateHealthCounts($animal, &$stats)
    {
        if ($animal->status == 'health') {
            $stats['healthyCount']++;
            $stats['goodHealthCount']++;
        } elseif ($animal->status == 'Sick') {
            $stats['sickCount']++;
        } elseif ($animal->status == 'Recovering') {
            $stats['recoveringCount']++;
        }
    }

    private function updateVaccinationCounts($animal, &$stats)
    {
        $latestHealthRecord = $animal->healthRecords()
            ->whereIn('vaccination_status', ['partially_vaccinated', 'fully_vaccinated'])
            ->latest()
            ->first();

        if (!$latestHealthRecord) {
            $stats['notVaccinatedCount']++;
        } else {
            switch ($latestHealthRecord->vaccination_status) {
                case 'partially_vaccinated':
                    $stats['partiallyVaccinatedCount']++;
                    break;
                case 'fully_vaccinated':
                    $stats['fullyVaccinatedCount']++;
                    break;
                default:
                    $stats['notVaccinatedCount']++;
                    break;
            }
        }
    }

    private function determineOverallHealthStatus($stats)
    {
        if ($stats['sickCount'] > 0) return 'Sick';
        if ($stats['recoveringCount'] > 0) return 'Recovering';
        return 'Good';
    }

    private function getTaskStats($user)
    {
        $taskCounts = Task::where('user_id', $user->id)
            ->select('status', 'priority', \DB::raw('count(*) as count'))
            ->groupBy('status', 'priority')
            ->get();

        $stats = [
            'tasksInProgress' => 0, 'tasksDone' => 0, 'tasksPending' => 0,
            'tasksIncomplete' => 0, 'tasksMissed' => 0, 'taskSkipped' => 0,
            'tasksHighest' => 0, 'tasksHigh' => 0, 'tasksMedium' => 0,
            'tasksLow' => 0, 'tasksLowest' => 0,
        ];

        foreach ($taskCounts as $task) {
            $stats["tasks" . ucfirst($task->status)] = $task->count;
            if (isset($stats["tasks" . ucfirst($task->priority)])) {
                $stats["tasks" . ucfirst($task->priority)] = $task->count;
            }
        }

        return $stats;
    }

    private function getFeedStats($user)
    {
        $totalAnimalsFeeding = Feed::where('user_id', $user->id)
            ->distinct('animal_id')
            ->count('animal_id');

        $totalFeedInventory = Feed::where('user_id', $user->id)->sum('feed_weight');

        $dailyFeedConsumption = Feed::where('user_id', $user->id)
            ->whereDate('feeding_date', now()->toDateString())
            ->sum('feed_weight');

        $totalFeedCount = Feed::where('user_id', $user->id)->count();
        $averageFeedPerAnimal = $totalFeedCount > 0 ? $totalFeedInventory / $totalFeedCount : 0;

        $feedDays = Feed::where('user_id', $user->id)->distinct('feeding_date')->count('feeding_date');
        $averageDailyFeedConsumption = $feedDays > 0 ? $totalFeedInventory / $feedDays : 0;

        return compact(
            'totalAnimalsFeeding', 'totalFeedInventory', 'dailyFeedConsumption',
            'averageFeedPerAnimal', 'averageDailyFeedConsumption'
        );
    }


  public function updateStatus(Request $request, $id)
    {
        $task = Task::find($id);

        if ($task->status == 'completed') {
            // Undo completion
            $task->status = 'in_progress'; // Or whichever status indicates the task is in progress
            $task->save();
        }

        // Redirect or return a response as needed
        return redirect()->back()->with('status', 'Task status updated!');
    }


    public function create()
    {
        return view('AnimalContent.create');
    }

    public function show($id)
    {
        // Get the current user and the animal with the given id
        $user = auth()->user();
        $animal = Animal::find($id);

        // Check if the animal exists and belongs to the user
        if ($animal && $animal->user_id == $user->id) {
            // Get the treatment data for the animal
            //$treatment = Treat::where('animal_id', $id)->first();

            // Return the view with the data
            return view('AnimalContent.show', compact('animal',  'user'));
        } else {
            // Abort with an error message
            abort(403, 'Unauthorized or invalid animal ID provided.');
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'type' => 'required|string',
            'breed' => 'nullable|string',
            'gender' => 'nullable|string',
            'keywords' => 'nullable|string',
            'internal_id' => 'nullable|string',
            'status' => 'required|string',
            'death_date' => 'nullable|date',
            'deceased_reason' => 'nullable|string',
            'is_neutered' => 'nullable|boolean',
            'is_breeding_stock' => 'nullable|boolean',
            'coloring' => 'nullable|string',
            'retention_score' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'body_condition_score' => 'nullable|numeric',
            'horn_length' => 'nullable|numeric',
            'tail_length_shape' => 'nullable|string',
            'fur_feather_scale_type' => 'nullable|string',
            'eye_color' => 'nullable|string',
            'beak_shape' => 'nullable|string',
            'tail_feather_pattern' => 'nullable|string',
            'saddle_markings' => 'nullable|string',
            'hoof_type' => 'nullable|string',
            'gait_or_movement' => 'nullable|string',
            'teeth_characteristics' => 'nullable|string',
            //
            'description' => 'nullable|string',

            'tag_number' => 'nullable|string',
            'color' => 'nullable|string',
            'location' => 'nullable|string',
            'electronic_id' => 'nullable|string',
            'other_tag' => 'nullable|string',
            'other_color' => 'nullable|string',
            'other_location' => 'nullable|string',
            'registry_number' => 'nullable|string',
            'tattoo_left' => 'nullable|string',
            'tattoo_right' => 'nullable|string',
            'photographs' => 'nullable|array',
            'photographs.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'dna_profile' => 'nullable|string',
            'scars' => 'nullable|string',

            'birth_date' => 'nullable|date',
            'dam' => 'nullable|string',
            'sire' => 'nullable|string',
            'birth_weight' => 'nullable|numeric',
            'weight_unit' => 'nullable|in:lbs,kg',
            'age_to_wean' => 'nullable|numeric',
            'date_weaned' => 'nullable|date',
            'birth_time' => 'nullable|date_format:H:i',
            'birth_status' => 'nullable|in:Natural,Assisted',
            'colostrum_intake' => 'nullable|numeric',
            'health_at_birth' => 'required|in:Healthy,Sick',
            'milk_feeding' => 'nullable|string',
            'vaccinations' => 'nullable|string',
            'breeder_info' => 'nullable|string',
           // 'raised_purchased' => 'required|in:Raised,Purchased',
           // 'birth_photos' => 'nullable|array',
            'birth_photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',





        ]);
        //$animal->raised_purchased = $request->input('raised_purchased');


        if ($validator->fails()) {
            return redirect()
                ->route('AnimalContent.create')
                ->withErrors($validator,'requiredFields')
                ->withInput();
        }

        $animal = new Animal();
       // $animal->name = $request->input('name', 'Default Name');
        if ($request->input('raised_purchased') === 'Purchased') {
            $animal->purchasedAnimal = $request->input('purchasedAnimal');
            $animal->purchaseDate = $request->input('purchaseDate');
            $animal->purchasePrice = $request->input('purchasePrice');
            $animal->vendor = $request->input('vendor');
            $animal->deficts = $request->input('deficts');
            $animal->treatments = $request->input('treatments');
            //$animal->healthStatus = $request->input('healthStatus');
        }
        // Fill the model with validated data
        $animal->fill($request->all());
        $animal->user_id = auth()->user()->id;
        // Save the animal to the database
        $animal->save();
        if ($request->hasFile('birth_photos')) {
            foreach ($request->file('birth_photos') as $photo) {
                $filename = $photo->getClientOriginalName();
                $path = $photo->storeAs('public/animal_images', $filename);
                $animal->photographs()->create(['path' => $path]);
            }
        }
        $action = $request->input('action');

        if ($action === 'create') {
            return redirect()->route('AnimalContent.show', ['id' => $animal->id])->with('success', 'Animal created successfully.');
        } elseif ($action === 'new_save') {
            return redirect()->route('index')->with('success', 'Animal saved successfully.');
        }
    }

/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Retrieve the animal with the given ID from the database
        $animal = Animal::where('id', $id)->where('user_id', Auth::id())->first();


        // If the animal does not exist or belongs to another user, abort with 403 Forbidden
        if (!$animal) {
            return abort(403);
        }

        // If the animal's status is 'sold', redirect with an error message
        if ($animal->status === 'sold') {
            return redirect()->route('index')->with('error', 'This animal has already been sold and cannot be edited.');
        }

        // Otherwise, return the view for editing the animal
        return view('AnimalContent.edit', compact('animal'));
    }



/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */

     public function update(Request $request, $id)
     {
         // Validate the form data
         $validatedData = $request->validate([
            //basic infomatiom of animal
            'name' => 'nullable|string',
            'breed' => 'nullable|string',
            'keywords' => 'nullable|string',
            'internal_id' => 'nullable|string',
            'status' => 'nullable|string',
            'death_date' => 'nullable|date',
            'deceased_reason' => 'nullable|string',

             // Validation for physical characteristics
             'is_neutered' => 'boolean',
             'is_breeding_stock' => 'boolean',
             'coloring' => 'nullable|string',
             'retention_score' => 'nullable|numeric',
             'weight' => 'nullable|numeric',
             'height' => 'nullable|numeric',
             'body_condition_score' => 'nullable|numeric',
             'horn_length' => 'nullable|numeric',
             'tail_length_shape' => 'nullable|string',
             'fur_feather_scale_type' => 'nullable|string',
             'eye_color' => 'nullable|string',
             'beak_shape' => 'nullable|string',
             'tail_feather_pattern' => 'nullable|string',
             'saddle_markings' => 'nullable|string',
             'hoof_type' => 'nullable|string',
             'gait_or_movement' => 'nullable|string',
             'teeth_characteristics' => 'nullable|string',
             'description' => 'nullable|string',
             'tag_number' => 'nullable|string',
             'color' => 'nullable|string',
             'location' => 'nullable|string',
             'electronic_id' => 'nullable|string',
             'other_tag' => 'nullable|string',
             'other_color' => 'nullable|string',
             'other_location' => 'nullable|string',
             'registry_number' => 'nullable|string',
             'tattoo_left' => 'nullable|string',
             'tattoo_right' => 'nullable|string',
             'photographs' => 'nullable|array',
             'photographs.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
             'dna_profile' => 'nullable|string',
             'scars' => 'nullable|string',
             'birth_photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',


         ]);

         $animal = Animal::find($id);


         $animal->fill($validatedData);


         $animal->save();
         if ($request->hasFile('birth_photos')) {
            foreach ($request->file('birth_photos') as $birthPhoto) {
                $filename = $birthPhoto->getClientOriginalName();
                $birthPath = $birthPhoto->storeAs('public/animal_birth_images', $filename);
                // Assuming you have a relationship for birth photos, adjust accordingly
                $animal->birthPhotos()->create(['path' => $birthPath]);
            }
        }
         // Redirect back with a success message
         return redirect()->route('index')->with('success', 'Animal information updated successfully.');
     }

     public function delete($id)
    {

        $animal = Animal::find($id);
        $animal -> delete();

        return redirect()->route('index');
    }


// show All treatments

public function showAllTreatments()
{
    try {
        // Get the currently authenticated user
        $currentUser = auth()->user();

        // Retrieve user animals with pagination
        $animals = $this->getUserAnimals();

        // Retrieve user treatments
        $treatments = Treat::where('user_id', $currentUser->id)->get()->collect();

        // Group treatments by animal ID
        $animalTreatments = $this->groupTreatmentsByAnimalId($treatments);

        // Pass the data to the view
        return view('AnimalContent.showalltreatments', compact('animals', 'animalTreatments', 'treatments'));

    } catch (\Illuminate\Database\QueryException $e) {
        \Log::error('Database error: ' . $e->getMessage());
        return redirect()->route('index')->with('error', 'Sorry, we encountered a problem while retrieving the data. Please try again later.');
    }
}


private function getUserAnimals()
{
    return Animal::where('user_id', auth()->user()->id)
        ->orderBy('created_at', 'desc')
        ->paginate(5);
}

private function getUserTreatments()
{
    return Treat::where('user_id', auth()->user()->id)->get();
}

private function groupTreatmentsByAnimalId($treatments)
{
    $animalTreatments = [];

    foreach ($treatments as $treatment) {
        $animalId = $treatment->animal_id;

        if (!isset($animalTreatments[$animalId])) {
            $animalTreatments[$animalId] = [];
        }

        $animalTreatments[$animalId][] = $treatment;
    }

    return $animalTreatments;
}


// show All treatments

private function getAuthenticatedUser()
{
    return auth()->user();
}

private function getPaginatedAnimals($user, $perPage = 5)
{
    return Animal::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->paginate($perPage);
}

private function groupRecordsByAnimalId($records)
{
    $groupedRecords = [];
    foreach ($records as $record) {
        $animalId = $record->animal_id;
        $groupedRecords[$animalId][] = $record;
    }
    return $groupedRecords;
}

private function handleException($e)
{
    Log::error($e);
    return redirect()->route('index')->with('error', 'Oops! Something went wrong. Please try again.');
}

public function showAllFeedings()
{
    try {
        $user = $this->getAuthenticatedUser();
        $feedings = Feed::where('user_id', $user->id)->get();
        $animals = $this->getPaginatedAnimals($user);
        $animalFeedings = $this->groupRecordsByAnimalId($feedings);

        return view('AnimalContent.showallfeedings', compact('animals', 'animalFeedings', 'feedings'));
    } catch (\Exception $e) {
        return $this->handleException($e);
    }
}

public function showAllMeasurements()
{
    try {
        $user = $this->getAuthenticatedUser();
        $measurements = Measurement::where('user_id', $user->id)->get();
        $animals = $this->getPaginatedAnimals($user);
        $animalMeasurements = $this->groupRecordsByAnimalId($measurements);

        return view('AnimalContent.showallmeasurements', compact('animals', 'animalMeasurements'));
    } catch (\Exception $e) {
        return $this->handleException($e);
    }
}

public function showAllYieldrecords()
{
    try {
        $user = $this->getAuthenticatedUser();
        $yieldrecords = YieldRecord::where('user_id', $user->id)->get();
        $animals = $this->getPaginatedAnimals($user);
        $animalyieldrecords = $this->groupRecordsByAnimalId($yieldrecords);

        return view('AnimalContent.showallyieldrecords', compact('animals', 'animalyieldrecords', 'user', 'yieldrecords'));
    } catch (\Exception $e) {
        return $this->handleException($e);
    }
}

public function showAllnotes()
{
    try {
        $user = $this->getAuthenticatedUser();
        $notes = Note::where('user_id', $user->id)->get();
        $animals = $this->getPaginatedAnimals($user);
        $animalnotes = $this->groupRecordsByAnimalId($notes);

        return view('AnimalContent.showallnotes', compact('animals', 'animalnotes', 'user', 'notes'));
    } catch (\Exception $e) {
        return $this->handleException($e);
    }
}

public function showAlltasks()
{
    try {
        $user = $this->getAuthenticatedUser();
        $tasks = Task::where('user_id', $user->id)->get();
        $animals = $this->getPaginatedAnimals($user);
        $animaltasks = $this->groupRecordsByAnimalId($tasks);

        return view('Task.showalltasks', compact('animals', 'animaltasks', 'user', 'tasks'));
    } catch (\Exception $e) {
        return $this->handleException($e);
    }
}

public function showAllcontact()
{
    try {
        $user = $this->getAuthenticatedUser();
        $suppliers = Contact::where('user_id', $user->id)->get();
        $animals = $this->getPaginatedAnimals($user);
        $animalsuppliers = $this->groupRecordsByAnimalId($suppliers);

        return view('Task.showallcontact', compact('animals', 'animalsuppliers', 'user', 'suppliers'));
    } catch (\Exception $e) {
        return $this->handleException($e);
    }
}

public function showAllHealths()
{
    try {
        $user = $this->getAuthenticatedUser();
        $animals = $this->getPaginatedAnimals($user);

        if ($animals->isEmpty()) {
            return view('AnimalContent.showallhealths', compact('animals'))->with('error', 'No animals found.');
        }

        $healths = Health::whereIn('animal_id', $animals->pluck('id'))->get();
        $animalHealths = $this->groupRecordsByAnimalId($healths);

        return view('AnimalContent.showallhealths', compact('animals', 'animalHealths'));
    } catch (\Exception $e) {
        return $this->handleException($e);
    }
}

public function showVaccinatedAnimals($status)
{
    $animals = Animal::whereHas('Health', function ($query) use ($status) {
        $query->where('vaccination_status', $status);
    })->with('Health')->get();

    return view('animals.show', compact('animals', 'status'));
}

public function showAllSuppliers()
{
    try {
        $user = $this->getAuthenticatedUser();
        $suppliers = Supplier::where('user_id', $user->id)->get();
        $animals = $this->getPaginatedAnimals($user);
        $animalsuppliers = $this->groupRecordsByAnimalId($suppliers);

        return view('Task.showallcontact', compact('animals', 'animalsuppliers', 'user', 'suppliers'));
    } catch (\Exception $e) {
        return $this->handleException($e);
    }
}

public function soldAnimals()
{
    $soldAnimals = Animal::where('status', 'sold')->get();
    return view('animals.sold', compact('soldAnimals'));
}
}

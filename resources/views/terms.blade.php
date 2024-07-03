<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-authentication-card-logo />
            </div>

            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                {!! $terms !!}
            </div>
        </div>
    </div>
</x-guest-layout>
Route::post('/animals/{animal_id}/storecontact', [ContactController::class, 'storecontact'])->name('animals.storecontact');
Route::get('/animals/{animal_id}/showcontact', [ContactController::class, 'showcontact'])->name('animals.showcontact');
Route::get('/animals/{animal_id}/contact', [ContactController::class, 'contact'])->name('animals.contact');
//Route::get('/animals/{animal}/Contact', [ContactController::class, 'Contact'])->name('animals.Contact');
Route::get('/animals/{animal_id}/contact/{contact_id}/edit', [ContactController::class, 'editcontact'])->name('animals.contactedit');
Route::put('/animals/{animal_id}/contact/{contact_id}', [ContactController::class, 'updatecontact'])->name('contact.update');
Route::get('/animals/{animal_id}/contact/{contact_id}', [ContactController::class, 'deletecontact'])->name('contact.delete');

public function storefeeding(Request $request,$animal_id)
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

    $repeatDays = $request->input('repeat_days', 1);

    $initialFeedingDate = $request->input('feeding_date');

    for ($i = 0; $i < $repeatDays; $i++) {
        $feeding = new Feeding();
        $feeding->fill($request->all());
        $feeding->animal_id = $animal_id;
        $feeding->user_id = auth()->user()->id;
        $feeding->feeding_date = $initialFeedingDate;
        $feeding->save();


        $initialFeedingDate = date('Y-m-d', strtotime($initialFeedingDate . ' +1 day'));
    }

    return redirect()->route('animals.showfeeding', ['animal_id' => $animal_id])
        ->with('success', 'feeding  created successfully.');

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

    return view('animals.feeding', ['animal' => $animal]);
}
public function showfeeding($animal_id)
{
    try {
        $user = auth()->user();
        $animal = Animal::find($animal_id);
        //$animals = Animal::paginate(5);
        $feedings = Feeding::where('user_id', $user->id)->get();
        $feedings = Feeding::where('animal_id', $animal_id)
        //->whereDate('created_at', '<', Carbon::now())
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        $totalCost = $feedings->sum('estimated_cost');
        // Check if the animal's status is 'sold'
        if ($animal->status === 'sold') {
            return redirect()->route('index')->with('error', 'This animal has already been sold and cannot add feeeding/edit.');
        }

        return view('animals.showfeeding', ['animal' => $animal, 'feedings' => $feedings,'user'=>$user,'totalCost' => $totalCost]);
    } catch (\Exception $e) {
        return redirect()->route('index')->with('error', 'Holly Smoke!! Sorry, something went wrong please try again..');
    }
}



public function editfeeding($animal_id, $feeding_id)
{
    try {
        $animal = Animal::find($animal_id);
        $feeding = Feeding::findOrFail($feeding_id);

        return view('animals.feedingedit', ['animal' => $animal, 'feeding' => $feeding]);
    } catch (\Exception $e) {
        return redirect()->route('index')->with('error', 'An error occurred while editing the feeding.');
    }
}


   // take care of the updating the animal treatment
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

           $feeding = Feeding::findOrFail($feeding_id);
           $feeding->update($request->all());

           return redirect()->route('animals.showfeeding', ['animal_id' => $animal_id])
               ->with('success', 'Feeding updated successfully.');
       } catch (\Exception $e) {
           return redirect()->route('index')->with('error', 'An error occurred while updating the feeding.');
       }
   }

    // delete the animal treatment
    public function deletefeeding($animal_id, $feeding_id)
    {
        try {
            $feeding = Feeding::findOrFail($feeding_id);
            $feeding->delete();

            return redirect()->route('animals.showfeeding', ['animal_id' => $animal_id])
                ->with('success', 'Treatment deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->with('error', 'Holly Smoke!! Sorry, something went wrong please try again..');
        }
    }


    protected $fillable = [
        'type',
        'heat_date',
        'breeding_date',
        'due_date',
        'pregnancy_status',
        'offspring_count',
        'offspring_ids',
        'egg_laying_start_date',
        'egg_laying_end_date',
        'temp',
        'hatching_date',
        'no_eggs',
        'period_day',
        'humidity',
        'nesting_material',
        'light_condition',
        'environmental_conditions',
        'number_of_chicks',
        'egg_stage',
        'pupal_stage',
        'adult_stage',
        'water_ph',
        'tank_size',
        'spawning_behavior',
        'fry_tank_setup',
        'fry_feeding',
        'spawning_substrate',
        'water_quality_monitoring',
        'date_of_breeding'
        'gender',
        'health_status',
        'breeding_history',
        'genetic_details',
        'breeding_recommendations',
        'future_breeding_plans'

    ];

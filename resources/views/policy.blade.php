<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-authentication-card-logo />
            </div>

            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                {!! $policy !!}
            </div>
        </div>
    </div>
</x-guest-layout>
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Animal;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Exceptions\AnimalNotFoundException;
use Illuminate\Validation\ValidationException;

class contactController extends Controller
{
    public function storecontact(Request $request, $animal_id)
{
    try {
        // Validation rules for the form fields (you can customize these)
        $validatedData = $request->validate([
            //'file' => 'nullable|file|max:2048',
            'postal_code' => 'nullable|max:50000000|integer',
            // Add more validation rules as needed
        ], [
            'postal_code.max' => 'The postal code must not exceed 5,0000 digits.',
        ]);

        $contact = new Contact();

        // Generate a UUID for the id field
        $contact->id = Str::uuid();

        // Fill in the other contact fields
        $contact->fill($validatedData);
        $contact->animal_id = $animal_id;
        $contact->user_id = auth()->user()->id;
        $contact->save();

        return redirect()->route('animals.showcontact', ['animal_id' => $animal_id])
            ->with('success', 'Contact created successfully.');
    } catch (ValidationException $e) {
        // If validation fails, redirect back with errors
        return redirect()->back()
            ->withErrors($e->errors(), 'requiredFields')
            ->withInput();
    }
}

    public function showcontact($animal_id)
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
            return redirect()->route('index')->with('error', 'This animal has already been sold, and you cannot add contacts.');
        }

        // Fetch contacts related to the specified animal, ordered by created_at in descending order and paginate them
        $contacts = Contact::where('animal_id', $animal_id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // Group contacts by category in the controller
        $groupedcontacts = $contacts->groupBy('category');

        return view('animals.showcontact', compact('animal', 'user', 'contacts', 'groupedcontacts'));
    }

    public function contact($animal_id)
    {
        // Retrieve the animal by ID
        $animal = Animal::find($animal_id);
        if (!$animal) {
            // Throw a custom exception if the animal is not found
            throw new AnimalNotFoundException($animal_id);
        }

        $animal->user_id = auth()->user()->id;

        return view('animals.contact', ['animal' => $animal,'animal_id' => $animal_id]);
    }

    public function editcontact($animal_id, $contact_id)
    {
        $animal = Animal::find($animal_id);
        if (!$animal) {
            // Throw a custom exception if the animal is not found
            throw new AnimalNotFoundException($animal_id);
        }

        // Find the contact by ID or throw a ModelNotFoundException
        $contact = Contact::findOrFail($contact_id);

        return view('animals.contactedit', ['animal' => $animal, 'contact' => $contact,'animal_id' => $animal_id]);
    }

    // take care of the updating the animal treatment
    public function updatecontact(Request $request, $animal_id, $contact_id)
    {
        // Validation rules for treatment update fields
        $validator = Validator::make($request->all(), [
            // ...
        ]);

        // If the validation fails, throw a ValidationException
        $validator->validate();

        // Find the contact by ID or throw a ModelNotFoundException
        $contact = Contact::findOrFail($contact_id);

        // Update the contact fields
        $contact->update($request->all());

        return redirect()->route('animals.showcontact', ['animal_id' => $animal_id])
            ->with('success', 'contact updated successfully.');
    }


    public function deletecontact($animal_id, $contact_id)
{
    $contact = Contact::findOrFail($contact_id);
    $contact->delete();

    return redirect()->route('animals.showcontact', ['animal_id' => $animal_id])
        ->with('success', 'contact deleted successfully.');
}
}



<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedingRequest;
use App\Http\Requests\UpdateFeedingRequest;
use App\Models\Animal;
use App\Models\Feed;
use App\Models\Measurement;
use App\Services\FeedEfficiencyCalculator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FeedingController extends Controller
{
    /**
     * Store a new feeding for the specified animal.
     *
     * @param StoreFeedingRequest $request
     * @param int $animalId
     * @return RedirectResponse
     */
    public function store(StoreFeedingRequest $request, int $animalId): RedirectResponse
    {
        $validated = $request->validated();
        $repeatDays = $validated['repeat_days'] ?? 1;
        $initialFeedingDate = $validated['feeding_date'];

        $animal = Animal::findOrFail($animalId);
        $initialWeight = $animal->weight;

        $feedEfficiencyCalculator = app(FeedEfficiencyCalculator::class);

        DB::transaction(function () use ($validated, $animalId, $repeatDays, $initialFeedingDate, $initialWeight, $feedEfficiencyCalculator) {
            for ($i = 0; $i < $repeatDays; $i++) {
                $feeding = new Feed($validated);
                $feeding->animal_id = $animalId;
                $feeding->user_id = Auth::id();
                $feeding->feeding_date = $initialFeedingDate;

                if ($i === 0) {
                    $feeding->feed_weight = $initialWeight;
                } else {
                    $latestMeasurement = Measurement::where('animal_id', $animalId)
                        ->orderByDesc('date')
                        ->first();

                    $feeding->feed_weight = $latestMeasurement?->weight ?? $initialWeight;
                }

                $feeding->save();

                $initialFeedingDate = date('Y-m-d', strtotime($initialFeedingDate . ' +1 day'));
            }
        });

        $feedEfficiency = $feedEfficiencyCalculator->calculate($animalId);

        return redirect()->route('feedings.show', ['animal' => $animalId])
            ->with('success', 'Feeding created successfully. Feed efficiency: ' . $feedEfficiency);
    }

    /**
     * Display the specified animal's feedings.
     *
     * @param int $animalId
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $animalId): \Illuminate\Contracts\View\View
    {
        $animal = Animal::findOrFail($animalId);
        $this->authorizeResource(Animal::class, $animal);

        if ($animal->status === 'sold') {
            return redirect()->route('index')->with('error', 'This animal has already been sold and cannot add feeding/edit.');
        }

        $feedings = Feed::where('animal_id', $animalId)
            ->orderByDesc('created_at')
            ->paginate();

        return view('feedings.show', compact('animal', 'feedings'));
    }

    /**
     * Show the form for editing the specified feeding.
     *
     * @param int $animalId
     * @param int $feedingId
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(int $animalId, int $feedingId): \Illuminate\Contracts\View\View
    {
        $animal = Animal::findOrFail($animalId);
        $this->authorizeResource(Animal::class, $animal);

        $feeding = Feed::findOrFail($feedingId);

        return view('feedings.edit', compact('animal', 'feeding'));
    }

    /**
     * Update the specified feeding.
     *
     * @param UpdateFeedingRequest $request
     * @param int $animalId
     * @param int $feedingId
     * @return RedirectResponse
     */
    public function update(UpdateFeedingRequest $request, int $animalId, int $feedingId): RedirectResponse
    {
        $validated = $request->validated();

        $feeding = Feed::findOrFail($feedingId);
        $feeding->update($validated);

        return redirect()->route('feedings.show', ['animal' => $animalId])
            ->with('success', 'Feeding updated successfully.');
    }

    /**
     * Remove the specified feeding.
     *
     * @param int $animalId
     * @param int $feedingId
     * @return RedirectResponse
     */
    public function destroy(int $animalId, int $feedingId): RedirectResponse
    {
        $animal = Animal::findOrFail($animalId);
        $this->authorizeResource(Animal::class, $animal);

        $feeding = Feed::findOrFail($feedingId);
        $feeding->delete();

        return redirect()->route('feedings.show', ['animal' => $animalId])
            ->with('success', 'Feeding deleted successfully.');
    }
}

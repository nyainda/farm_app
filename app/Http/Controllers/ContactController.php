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
use App\Notifications\BatchDeletionNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $contact->fill($request->all());
        $contact->animal_id = $animal_id;
        $contact->user_id = auth()->user()->id;


        $contact->save();



        return redirect()->route('Contacts.showcontact', ['animal_id' => $animal_id])
        ->with('success', 'contact created successfully.');

    } catch (ValidationException $e) {
        // If validation fails, redirect back with errors
        return redirect()->back()
            ->withErrors($e->errors(), 'requiredFields')
            ->withInput();
   }

    }


    public function showcontact($animal_id)
    {
        try {

            $user = auth()->user();
            $animal = Animal::find($animal_id);
            $contacts = Contact::with('animal')
                 ->where('user_id',$user->id)
                 ->where('animal_id',$animal_id)
                 ->orderBy('created_at','desc')
                 ->paginate(5);
            // Check if the animal's status is 'sold'
            if ($animal->status === 'sold') {
                return redirect()->route('index')->with('error', 'This animal has already been sold and cannot add meaasurement/edit.');
            }

            return view('Contacts.showcontact', ['animal' => $animal, 'animal_id' => $animal_id, 'contacts' => $contacts,'user'=>$user]);
        } catch (\Exception $e) {
            return redirect()->route('index')->with('error', 'An error occurred while displaying the contacts.');
        }
    }



    public function contact($animal_id)
    {
        try {
            // Retrieve the animal by ID
            $animal = Animal::find($animal_id);
            $animal->user_id = auth()->user()->id;
            if (!$animal) {
                // Redirect to the home page with a "not found" flash message
                return Redirect::route('index')->with('error', 'Animal not found.');
            }

            return view('Contacts.contact', ['animal' => $animal]);
        } catch (\Exception $e) {
            return redirect()->route('index')->with('error', 'An error occurred while displaying the contact form.');
        }
    }

public function editcontact($animal_id, $contact_id)
{
    $animal = Animal::find($animal_id);
    try {
        $contact = Contact::findOrFail($contact_id);
    } catch (\Exception $e) {
        // Handle the exception here, for example, redirect to an error page
        return redirect()->route('index')->with('error', 'contact not found.');
    }


    return view('Contacts.contactedit', ['animal' => $animal, 'contact' => $contact]);
}

   // take care of the updating the animal treatment
public function updatecontact(Request $request, $animal_id, $contact_id)
{
    $validator = Validator::make($request->all(), [

        // Validation rules for treatment update fields
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    $contact = Contact::findOrFail($contact_id);
    $contact->update($request->all());

    return redirect()->route('Contacts.showcontact', ['animal_id' => $animal_id])
        ->with('success', 'contact updated successfully.');
}
    // delete the animal treatment
public function deletecontact($animal_id, $contact_id)
{
    $contact = Contact::findOrFail($contact_id);
    $contact->delete();

    return redirect()->route('Contacts.showcontact', ['animal_id' => $animal_id])
        ->with('success', 'contact deleted successfully.');
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
            Contact::whereIn('id', $selectedIds)->delete();

            // Send notification to user
            $user = $request->user(); // Assuming the user is authenticated
            $user->notify(new BatchDeletionNotification());

            return redirect()->back()->with('success', 'Selected Contacts have been deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->with('error', 'Oops! Something went wrong. Please try again.');
        }
    }


}

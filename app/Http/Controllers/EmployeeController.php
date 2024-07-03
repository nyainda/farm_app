<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Employee;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Notifications\BatchDeletionNotification;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexemployee()
    {
        $employees = Employee::latest()->get();
        return view('Employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $animal_id
     * @return \Illuminate\Http\Response
     */
    public function createemployee($animal_id)
    {
        $animal = Animal::find($animal_id);
        $Contacts = Contact::where('contact_type', 'employee')->get();
        $employees = Employee::all();
        $contactNames = $Contacts->pluck('first_name', 'last_name')->toArray();

        return view('Employee.create', compact('animal', 'Contacts', 'contactNames', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $animal_id
     * @return \Illuminate\Http\Response
     */
    public function storeemployee(Request $request, $animal_id)
    {
        $validator = Validator::make($request->all(), [
            // Add your validation rules here
        ]);

        // ... Your image handling code ...
        $image = $request->file('photo');
        $slug =  Str::slug($request->input('name'));
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('employee'))
            {
                Storage::disk('public')->makeDirectory('employee');
            }
            $postImage = Image::make($image)->resize(480, 320)->stream();
            Storage::disk('public')->put('employee/'.$imageName, $postImage);
        } else
        {
            $imageName = 'default.png';
        }
        $employee = new Employee();
        $employee->id = Str::uuid();
        $employee->fill($request->all());
        $employee->animal_id = $animal_id;
        $employee->user_id = auth()->user()->id;
        $employee->save();

        return redirect()->route('Employee.show', ['animal_id' => $animal_id])
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $animal_id
     * @return \Illuminate\Http\Response
     */
    public function showemployee($animal_id)
    {
        // ... Your showemployee method ...
        try {

            $user = auth()->user();
            $animal = Animal::find($animal_id);
            $employees = Employee::with('animal')
                 ->where('user_id',$user->id)
                 ->where('animal_id',$animal_id)
                 ->orderBy('created_at','desc')
                 ->paginate(5);


            // Check if the animal's status is 'sold'
            if ($animal->status === 'sold') {
                return redirect()->route('index')->with('error', 'This animal has already been sold and cannot add meaasurement/edit.');
            }

            return view('Employee.show', ['animal' => $animal, 'employees' => $employees,'user'=>$user]);
        } catch (\Exception $e) {
            return redirect()->route('index')->with('error', 'An error occurred while displaying the employees.');
        }

    }

    /**
 * Show the form for editing the specified resource.
 *
 * @param  int  $animal_id
 * @param  int  $employee_id
 * @return \Illuminate\Http\Response
 */
public function editemployee($animal_id, $employee_id)
{
    // Retrieve the animal for the given $animal_id
    $animal = Animal::find($animal_id);

    try {
        // Attempt to find the employee with the given $employee_id
        $employee = Employee::findOrFail($employee_id);
    } catch (\Exception $e) {
        // Handle the exception, for example, redirect to an error page
        return redirect()->route('index')->with('error', 'Employee not found.');
    }

    // Fetch contacts of type 'employee'
    $contacts = Contact::where('contact_type', 'employee')->get();

    // Extract contact names for datalist
    $contactNames = $contacts->pluck('first_name', 'last_name')->toArray();

    // Render the edit view with the necessary data
    return view('Employee.edit', [
        'animal' => $animal,
        'employee' => $employee,
        'contacts' => $contacts,
        'contactNames' => $contactNames,
    ]);
}

    /**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $animal_id
 * @param  int  $employee_id
 * @param  \App\Models\Employee  $employee
 * @return \Illuminate\Http\Response
 */
public function updateemployee(Request $request, $animal_id, $employee_id, Employee $employee)
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        // Add your validation rules here
    ]);

    // Check for validation failure
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Handle image upload
    $image = $request->file('photo');
    $slug = Str::slug($request->input('name'));

    if (isset($image)) {
        $currentDate = Carbon::now()->toDateString();
        $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

        if (!Storage::disk('public')->exists('employee')) {
            Storage::disk('public')->makeDirectory('employee');
        }

        // Delete old photo
        if (Storage::disk('public')->exists('employee/' . $employee->photo)) {
            Storage::disk('public')->delete('employee/' . $employee->photo);
        }

        $postImage = Image::make($image)->resize(480, 320)->stream();
        Storage::disk('public')->put('employee/' . $imageName, $postImage);
    } else {
        $imageName = $employee->photo;
    }

    // Find the employee by ID and update the data
    $employee = Employee::findOrFail($employee_id);
    $employee->update($request->all());

    // Redirect with success message
    return redirect()->route('Employee.show', ['animal_id' => $animal_id])
        ->with('success', 'Employee updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $animal_id
     * @param  int  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function deleteemployee($animal_id, $employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        $employee->delete();

        return redirect()->route('Employee.show', ['animal_id' => $animal_id])
            ->with('success', 'Employee deleted successfully.');
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
            Employee::whereIn('id', $selectedIds)->delete();

            // Send notification to user
            $user = $request->user(); // Assuming the user is authenticated
            $user->notify(new BatchDeletionNotification());

            return redirect()->back()->with('success', 'Selected Employees have been deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->with('error', 'Oops! Something went wrong. Please try again.');
        }
    }

}

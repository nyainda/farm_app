<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\FarmflowController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\YieldRecordController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FeedingController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\BillOfSaleController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\BreedingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NotificationController;

use App\Models\addTask;
use App\Models\Contact;
use App\Models\Health;
use App\Models\Supplier;
use App\Models\Treatment;

// Default route
Route::get('/', function () {
    return view('welcome');
});

// Authenticated routes
Route::group(['middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified']], function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


// employee
    Route::get('/animals', [EmployeeController::class, 'indexemployee'])->name('Employee.index');
    Route::get('/employee/create/{animal_id}', [EmployeeController::class, 'createemployee'])->name('Employee.create');
    Route::post('/animals/{animal_id}/storeemployee', [EmployeeController::class, 'storeemployee'])->name('Employee.storeemployee');
    Route::get('/animals/{animal_id}/showemployee', [EmployeeController::class, 'showemployee'])->name('Employee.show');
    Route::get('/animals/{animal_id}/supplier', [EmployeeController::class, 'supplier'])->name('Employee.supplier');
    Route::get('/animals/{animal_id}/employee/{employee_id}/edit', [EmployeeController::class, 'editemployee'])->name('Employee.employeeedit');
    Route::put('/animals/{animal_id}/employee/{employee_id}', [EmployeeController::class, 'updateemployee'])->name('Employee.update');
    Route::get('/animals/{animal_id}/employee/{employee_id}', [EmployeeController::class, 'deleteemployee'])->name('Employee.delete');
    Route::delete('/employees/batchDelete', [EmployeeController::class, 'batchDelete'])->name('employees.batchDelete');
//feeding
    Route::post('/storefeeding/{animal_id}', [FeedingController::class, 'storefeeding'])->name('Feed.storefeeding');
    Route::get('/feeding/{animal_id}', [FeedingController::class, 'feeding'])->name('Feed.feeding');
    Route::get('/showfeeding/{animal_id}', [FeedingController::class, 'showfeeding'])->name('Feed.showfeeding');
    Route::get('/{animal_id}/feeding/{feeding_id}/edit', [FeedingController::class, 'editfeeding'])->name('Feed.feedingedit');
    Route::put('/{animal_id}/feeding/{feeding_id}', [FeedingController::class, 'updatefeeding'])->name('feeding.update');
    Route::get('/{animal_id}/feeding/{feeding_id}', [FeedingController::class, 'deletefeeding'])->name('feeding.delete');
    Route::delete('/feedings/batchDelete', [FeedingController::class, 'batchDelete'])->name('feedings.batchDelete');

//treatment
    Route::get('/AnimalContent/treatment/{animal_id}', [TreatmentController::class, 'treatment'])->name('treat.treatment');
    Route::post('/AnimalContent/storetreament/{animal_id}', [TreatmentController::class, 'storetreament'])->name('treat.storetreament');
    Route::get('AnimalContent/showtreatment/{animal_id}', [TreatmentController::class, 'showtreatment'])->name('treat.showtreatment');
    Route::get('/AnimalContent/{animal_id}/treatment/{treatment_id}/edit', [TreatmentController::class, 'edittreatment'])->name('treat.treatmentedit');
    Route::put('/AnimalContent/{animal_id}/treatment/{treatment_id}', [TreatmentController::class, 'updatetreatment'])->name('treat.update');
    Route::get('/AnimalContent/{animal_id}/treatment/{treatment_id}', [TreatmentController::class, 'deletetreatment'])->name('treatment.delete');
    Route::delete('/treatments/batchDelete', [TreatmentController::class, 'batchDelete'])->name('treatments.batchDelete');

//supplier

    Route::get('/animals', [SupplierController::class, 'indexsupplier'])->name('Supplier.index');
    Route::get('/supplier/create/{animal_id}', [SupplierController::class, 'createsupplier'])->name('Supplier.create');
    Route::post('/animals/{animal_id}/storesupplier', [SupplierController::class, 'storesupplier'])->name('Supplier.storesupplier');
    Route::get('/animals/{animal_id}/showsupplier', [SupplierController::class, 'showsupplier'])->name('Supplier.show');
    Route::get('/animals/{animal_id}/supplier', [SupplierController::class, 'supplier'])->name('Supplier.supplier');
    Route::get('/animals/{animal_id}/supplier/{supplier_id}/edit', [SupplierController::class, 'editsupplier'])->name('Supplier.Supplieredit');
    Route::put('/animals/{animal_id}/supplier/{supplier_id}', [SupplierController::class, 'updatesupplier'])->name('Supplier.update');
    Route::get('/animals/{animal_id}/supplier/{supplier_id}', [SupplierController::class, 'deletesupplier'])->name('Supplier.delete');
    Route::delete('/suppliers/batchDelete', [SupplierController::class, 'batchDelete'])->name('suppliers.batchDelete');
//breeding

    Route::post('/animals/{animal_id}/storebreeding', [BreedingController::class, 'storebreeding'])->name('breed.storebreeding');
    Route::get('/breed/display/{animal_id}', [BreedingController::class, 'display'])->name('breed.display');
    Route::get('animals/{animal_id}/showinsect', [BreedingController::class, 'showinsect'])->name('breed.showinsect');
    Route::get('/animals/{animal_id}/showbreeding', [BreedingController::class, 'showbreeding'])->name('breed.showbreeding');
    Route::get('/animals/{animal_id}/breeding', [BreedingController::class, 'breeding'])->name('breed.breeding');
    Route::get('/animals/{animal_id}/breeding/{breeding_id}/edit', [BreedingController::class, 'editbreeding'])->name('breed.breedingedit');
    Route::put('/animals/{animal_id}/breeding/{breeding_id}', [BreedingController::class, 'updatebreeding'])->name('breed.update');
    Route::get('/animals/{animal_id}/breeding/{breeding_id}', [BreedingController::class, 'deletebreeding'])->name('breeding.delete');

//notification
     Route::get('/notifications/{animal_id}/pending', [NotificationController::class, 'showPendingNotifications'])
    ->name('notifications.pending');

//health
    Route::post('/{animal_id}/storehealth', [HealthController::class, 'storehealth'])->name('Health.storehealth');
    Route::get('/{animal_id}/showhealth', [HealthController::class, 'showhealth'])->name('Health.showhealth');
    Route::get('/{animal_id}/health', [HealthController::class, 'health'])->name('Health.health');
    Route::get('/{animal_id}/health/{health_id}/edit', [HealthController::class, 'edithealth'])->name('Health.healthedit');
    Route::put('/{animal_id}/health/{health_id}', [HealthController::class, 'updatehealth'])->name('health.update');
    Route::get('/{animal_id}/health/{health_id}', [HealthController::class, 'deletehealth'])->name('health.delete');
    Route::delete('/healths/batch-delete', [HealthController::class, 'batchDelete'])->name('healths.batchDelete');
//billofsale
// routes/web.php

    Route::get('/sold-animals', [AnimalController::class, 'soldAnimals'])->name('sold-animals');

    Route::post('/animals/{animal_id}/storeBillOfSale', [BillOfSaleController::class, 'storeBillOfSale'])->name('AnimalContent.storeBillOfSale');
    Route::get('/animals/{animal_id}/showBillOfSale', [BillOfSaleController::class, 'showBillOfSale'])->name('animals.showBillOfSale');
    Route::get('/animals/{animal_id}/BillOfSale/{BillOfSale_id}/edit', [BillOfSaleController::class, 'editBillOfSale'])->name('animals.contacteditr');
    Route::put('/animals/{animal_id}/BillOfSale/{BillOfSale_id}', [BillOfSaleController::class, 'updateBillOfSale'])->name('contact7.update');
    Route::get('/animals/{animal_id}/BillOfSale/{BillOfSale_id}', [BillOfSaleController::class, 'deleteBillOfSale'])->name('contact8.delete');
    //Route::get('/animals/{animal_id}/download-pdf', [BillOfSaleController::class,'downloadPDF'])->name('Sale.bill_of_sale');
    Route::get('/bill_of_sale/{id}', [ContentController::class, 'storebill'])->name('Sale.showBillOfSale');
//contact

    Route::post('/animals/{animal_id}/storecontact', [ContactController::class, 'storecontact'])->name('Contacts.storecontact');
    Route::get('/animals/{animal_id}/showcontact', [ContactController::class, 'showcontact'])->name('Contacts.showcontact');
    Route::get('/animals/{animal_id}/contact', [ContactController::class, 'contact'])->name('Contacts.contact');
    Route::get('/animals/{animal_id}/contact/{contact_id}/edit', [ContactController::class, 'editcontact'])->name('Contacts.contactedit');
    Route::put('/animals/{animal_id}/contact/{contact_id}', [ContactController::class, 'updatecontact'])->name('contact.update');
    Route::get('/animals/{animal_id}/contact/{contact_id}', [ContactController::class, 'deletecontact'])->name('contact.delete');
    Route::delete('/contacts/batchDelete', [ContactController::class, 'batchDelete'])->name('contacts.batchDelete');
//measurement

    Route::post('/{animal_id}/storemeasurement', [MeasurementController::class, 'storemeasurement'])->name('Measurement.storemeasurement');
    Route::get('/{animal_id}/showmeasurement', [MeasurementController::class, 'showmeasurement'])->name('Measurement.showmeasurement');
    Route::get('/{animal_id}/measurement', [MeasurementController::class, 'measurement'])->name('Measurement.measurement');
    Route::get('/{animal_id}/measurement/{measurement_id}/edit', [MeasurementController::class, 'editmeasurement'])->name('Measurement.measurementedit');
    Route::put('/{animal_id}/measurement/{measurement_id}', [MeasurementController::class, 'updatemeasurement'])->name('measurement.update');
    Route::get('/{animal_id}/measurement/{measurement_id}', [MeasurementController::class, 'deletemeasurement'])->name('measurement.delete');
    Route::delete('/measurement/batch-delete', [MeasurementController::class, 'batchDelete'])->name('measurement.batchDelete');
//yield

    Route::post('/{animal_id}/storeyieldrecord', [YieldRecordController::class, 'storeyieldrecord'])->name('Yield.storeyieldrecord');
    Route::get('/{animal_id}/showyieldrecord', [YieldRecordController::class, 'showyieldrecord'])->name('Yield.showyieldrecord');
    Route::get('/{animal_id}/yieldrecord', [YieldRecordController::class, 'yieldrecord'])->name('Yield.yieldrecord');
    Route::get('/{animal_id}/yieldrecord/{yieldrecord_id}/edit', [YieldRecordController::class, 'edityieldrecord'])->name('Yield.yieldrecordedit');
    Route::put('/{animal_id}/yieldrecord/{yieldrecord_id}', [YieldRecordController::class, 'updateyieldrecord'])->name('yieldrecord.update');
    Route::get('/{animal_id}/yieldrecord/{yieldrecord_id}', [YieldRecordController::class, 'deleteyieldrecord'])->name('yieldrecord.delete');
    Route::delete('feedings/batch-delete', [YieldRecordController::class, 'batchDelete'])->name('yieldrecord.batchDelete');
//note

    Route::post('/{animal_id}/storenote', [NoteController::class, 'storenote'])->name('Notes.storenote');
    Route::get('/{animal_id}/shownote', [NoteController::class, 'shownote'])->name('Notes.shownote');
    Route::get('/{animal_id}/note', [NoteController::class, 'note'])->name('Notes.note');
    Route::get('/{animal_id}/note/{note_id}/edit', [NoteController::class, 'editnote'])->name('Notes.noteedit');
    Route::put('/{animal_id}/note/{note_id}', [NoteController::class, 'updatenote'])->name('note.update');
    Route::get('/{animal_id}/note/{note_id}', [NoteController::class, 'deletenote'])->name('note.delete');
    Route::delete('/batch-delete', [NoteController::class, 'batchDelete'])->name('notes.batchDelete');
//task

    Route::post('/{animal_id}/storetask', [TaskController::class, 'storetask'])->name('Tasks.storetask');
    Route::get('/{animal_id}/showtask', [TaskController::class, 'showtask'])->name('Tasks.showtask');
    Route::get('/tasks/{animal_id}', [TaskController::class, 'task'])->name('Tasks.task');
    Route::get('/{animal_id}/task/{task_id}/edit', [TaskController::class, 'edittask'])->name('Tasks.taskedit');
    Route::put('/{animal_id}/task/{task_id}', [TaskController::class, 'updatetask'])->name('task.update');
    Route::get('/{animal_id}/task/{task_id}', [TaskController::class, 'deletetask'])->name('task.delete');
    Route::post('/tasks/{animal_id}/{task_id}/complete',[TaskController::class, 'completeTask'])->name('Tasks.completeTask');
    Route::delete('/batch-delete', [TaskController::class, 'batchDelete'])->name('tasks.batchDelete');

//Billofsale

    Route::get('AnimalContent/bill_of_sale', [ContentController::class, 'billOfSale'])->name('Sale.bill_of_sale');
    Route::post('/AnimalContent/storebill/{animal_id}', [ContentController::class, 'storebill'])->name('Sale.storebill');
    Route::get('/AnimalContent/display/{animal_id}', [ContentController::class, 'display'])->name('Sale.display');
    Route::get('/bill_of_sale/{id}', [ContentController::class, 'showBillOfSale'])->name('Sale.showBillOfSale');

//show all
    Route::get('/AnimalContent/showallsuppliers', [AnimalController::class,'showAllSuppliers'])->name('AnimalContent.showallsuppliers');
    Route::get('/AnimalContent/showallhealths', [AnimalController::class,'showAllHealths'])->name('AnimalContent.showallhealths');
    Route::get('/AnimalContent/showalltreatments', [AnimalController::class,'showAllTreatments'])->name('AnimalContent.showalltreatments');
    Route::get('/AnimalContent/showallfeedings', [AnimalController::class,'showAllFeedings'])->name('AnimalContent.showallfeedings');
    Route::get('/AnimalContent/showallmeasurements', [AnimalController::class,'showAllMeasurements'])->name('AnimalContent.showallmeasurements');
    Route::get('/AnimalContent/showallyieldrecords', [AnimalController::class,'showAllYieldrecords'])->name('AnimalContent.showallyieldrecords');
    Route::get('/AnimalContent/showallnotes', [AnimalController::class,'showAllnotes'])->name('AnimalContent.showallnotes');
    Route::get('/Task/showalltasks', [AnimalController::class,'showAlltasks'])->name('Task.showalltasks');
    Route::get('/Task/showallcontact', [AnimalController::class,'showallcontact'])->name('Task.showallcontact');

//animalcontent

    Route::get('/AnimalContent', [AnimalController::class, 'index'])->name('index');
    Route::get('AnimalContent/create', [AnimalController::class, 'create'])->name('AnimalContent.create');
    Route::post('AnimalContent/store', [AnimalController::class, 'store'])->name('AnimalContent.store');
    Route::match(['get', 'post'], '/AnimalContent/edit/{id}', [AnimalController::class, 'edit'])->name('AnimalContent.edit');
    Route::put('AnimalContent/update/{id}', [AnimalController::class, 'update'])->name('AnimalContent.update');
    Route::get('AnimalContent/show/{id}', [AnimalController::class, 'show'])->name('AnimalContent.show');
    Route::get('AnimalContent/delete/{id}', [AnimalController::class, 'delete'])->name('AnimalContent.delete');
    Route::view('AnimalContent/edit', 'AnimalContent.edit')->name('edit');
    Route::view('AnimalContent/new', 'AnimalContent.new')->name('new');
// web.php

     Route::get('/animals/{status}', [AnimalController::class, 'showVaccinatedAnimals'])->name('animals.show');
    // Route::resource('tasks', 'addTasksController');



// Blog Routes
    Route::get('blog', [PostController::class, 'blog'])->name('blog');


    // Farmer Routes
    Route::view('Farmer/Fieldtech', 'Farmer.Fieldtech')->name('Fieldtech');
     // Display the Fieldtech view
    Route::get('Farmer/Farmflow', [FarmflowController::class, 'index'])->name('Farmflow');
    Route::post('/farmflow/toggle-sold', [FarmflowController::class, 'toggleSoldVisibility'])->name('farmflow.toggleSold');
    Route::post('/farmflow/{animal}/archive', [FarmflowController::class, 'archive'])->name('farmflow.archive');
    Route::post('/animals/import', [FarmflowController::class, 'import'])->name('animals.import');
    Route::post('/animals/bulk-update', [FarmflowController::class, 'bulkUpdate'])->name('animals.bulkUpdate');
    Route::get('/animals/download', [FarmflowController::class, 'download'])->name('animals.download');
    Route::get('/animals/download-all', [FarmflowController::class, 'downloadAll'])->name('animals.downloadAll');
    Route::get('/animals/print', [FarmflowController::class, 'print'])->name('animals.print');
    // Displays the Farmflow index
    Route::view('Farmer/Agroforecast', 'Farmer.Agroforecast')->name('Agroforecast');
    // Display the Agroforecast view
    Route::view('Farmer/Farmermarket', 'Farmer.Farmermarket')->name('Farmermarket');
    // Display the Farmermarket view
    Route::view('Farmer/CropCare', 'Farmer.CropCare')->name('CropCare');
    // Display the CropCare view
    Route::view('Farmer/AgroGuide', 'Farmer.AgroGuide')->name('AgroGuide');
     // Display the AgroGuide view
    Route::view('AnimalContent/Next', 'AnimalContent.Next')->name('Next');
    //display next view
    Route::view('settings', 'settings')->name('settings');
    //display setting view
    Route::get('/calendar', [CalendarController::class, 'index']);
    Route::get('/calendar/events', [CalendarController::class, 'events']);


    // About Us
    Route::get('about-us', [SiteController::class, 'about'])->name('about-us'); // Display the about us page

    // Search
    Route::get('/search', [PostController::class, 'search'])->name('search'); // Perform a search

    // View Posts by Category
    Route::get('category/{category:slug}', [PostController::class, 'byCategory'])->name('by-category'); // View posts by category

    // View Single Post
    Route::get('{post:slug}', [PostController::class, 'show'])->name('view'); // View a single blog post
});

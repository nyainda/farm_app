<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AnimalContentController;
use App\Http\Controllers\DisplayController;;
use App\Http\Controllers\SocialShareButtonsController;

Token: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


Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified']], function () {
    // Dashboard
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Blog
    Route::get('blog', [PostController::class, 'blog'])->name('blog');
    //Route::get('blog', [PostController::class, 'blog'])->name('blog');

    // Fieldtech
    Route::view('Farmer/Fieldtech', 'Farmer.Fieldtech')->name('Fieldtech');
    //setting
    Route::view('settings', 'settings')->name('settings');
    //animal
    //Route::view('AnimalContent/treatment', 'AnimalContent.treatment')->name('AnimalContent.treatment');
    Route::view('AnimalContent/Next', 'AnimalContent.Next')->name('Next');
    Route::get('/AnimalContent/display/{animal_id}', 'App\Http\Controllers\AnimalController@display')->name('AnimalContent.display');
    Route::get('/AnimalContent/treatment/{animal_id}', 'App\Http\Controllers\AnimalController@treatment')->name('AnimalContent.treatment');

    Route::view('AnimalContent/edit', 'AnimalContent.edit')->name('edit');

    Route::post('/animals/storefeeding/{animal_id}', 'App\Http\Controllers\AnimalController@storefeeding')->name('animals.storefeeding');
    Route::get('/animals/feeding/{animal_id}', 'App\Http\Controllers\AnimalController@feeding')->name('animals.feeding');
    Route::get('animals/showfeeding/{animal_id}', 'App\Http\Controllers\AnimalController@showfeeding')->name('animals.showfeeding');
    Route::get('/animals/{animal_id}/feeding/{feeding_id}/edit', 'App\Http\Controllers\AnimalController@editfeeding')->name('animals.feedingedit');
    Route::put('/animals/{animal_id}/feeding/{feeding_id}', 'App\Http\Controllers\AnimalController@updatefeeding')->name('feeding.update');
    Route::get('/animals/{animal_id}/feeding/{feeding_id}', 'App\Http\Controllers\AnimalController@deletefeeding')->name('feeding.delete');


    Route::view('AnimalContent/new', 'AnimalContent.new')->name('new');
    Route::post('/AnimalContent/storebill/{animal_id}', 'App\Http\Controllers\AnimalController@storebill')->name('AnimalContent.storebill');
    Route::post('/AnimalContent/storetreament/{animal_id}', 'App\Http\Controllers\AnimalController@storetreament')->name('AnimalContent.storetreament');
    Route::get('AnimalContent/showtreatment/{animal_id}', 'App\Http\Controllers\AnimalController@showtreatment')->name('AnimalContent.showtreatment');

    Route::get('/AnimalContent/{animal_id}/treatment/{treatment_id}/edit', 'App\Http\Controllers\AnimalController@edittreatment')->name('AnimalContent.treatmentedit');
    Route::put('/AnimalContent/{animal_id}/treatment/{treatment_id}', 'App\Http\Controllers\AnimalController@updatetreatment')->name('treatment.update');
    Route::get('/AnimalContent/{animal_id}/treatment/{treatment_id}', 'App\Http\Controllers\AnimalController@deletetreatment')->name('treatment.delete');

    //Route::get('AnimalContent/showtreament', [AnimalController::class, 'showtreament'])->name('AnimalContent.showtreatment');
    //Route::get('/AnimalContent/showtreatment/{id}', [AnimalController::class, 'showtreatment'])->name('AnimalContent.showtreatment');
    //Route::post('/AnimalContent/storebill/{animal_id}', 'App\Http\Controllers\AnimalController@storebill')->name('AnimalContents.storebill');
    Route::get('AnimalContent/bill_of_sale', 'App\Http\Controllers\AnimalController@billOfSale')->name('AnimalContent.bill_of_sale');
    Route::get('/bill_of_sale/{id}', 'AnimalController@showBillOfSale')->name('showBillOfSale');
    //Route::get('/AnimalContent/showtreatment/{treatment}/{animal_id}', 'YourController@showTreatment')->name('AnimalContent.showtreatment');

    Route::get('/AnimalContent', [AnimalController::class, 'index'])->name('index');
    Route::get('AnimalContent/create', [AnimalController::class, 'create'])->name('AnimalContent.create');
    Route::post('AnimalContent/store', [AnimalController::class, 'store'])->name('AnimalContent.store');
    Route::match(['get', 'post'], '/AnimalContent/edit/{id}', [AnimalController::class, 'edit'])->name('AnimalContent.edit');
    Route::put('AnimalContent/update/{id}', 'App\Http\Controllers\AnimalController@update')->name('AnimalContent.update');
    Route::get('AnimalContent/show/{id}', [AnimalController::class, 'show'])->name('AnimalContent.show');
    Route::get('AnimalContent/delete/{id}', [AnimalController::class, 'delete'])->name('AnimalContent.delete');



    //Farmflow
    //Route::view('Farmer/Farmflow', 'Farmer.Farmflow')->name('Farmflow');
    Route::get('Farmer/Farmflow', [FarmflowController::class, 'index'])->name('Farmflow');

    //Agroforecast
    Route::view('Farmer/Agroforecast', 'Farmer.Agroforecast')->name('Agroforecast');

    //Farmermarket
    Route::view('Farmer/Farmermarket', 'Farmer.Farmermarket')->name('Farmermarket');

    //CropCare

    Route::view('Farmer/CropCare', 'Farmer.CropCare')->name('CropCare');

    //AgroGuide

    Route::view('Farmer/AgroGuide', 'Farmer.AgroGuide')->name('AgroGuide');

    // About Us
    Route::get('about-us', [SiteController::class, 'about'])->name('about-us');

    // search


    Route::get('/search', [PostController::class, 'search'])->name('search');



    // View Posts by Category
    Route::get('category/{category:slug}', [PostController::class, 'byCategory'])->name('by-category');

    // View Single Post
    Route::get('{post:slug}', [PostController::class, 'show'])->name('view');

    //social-media-share
});
//MAIL_MAILER=smtp
//MAIL_HOST=127.0.0.1
//MAIL_PORT=1025
//MAIL_USERNAME=null
//MAIL_PASSWORD=null
//MAIL_ENCRYPTION=null

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=c9dc6718c73bf3
MAIL_PASSWORD=4f7bae6bf080d3
MAIL_ENCRYPTION=tls

MAIL_FROM_ADDRESS="oyugibruce2017@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"

DB_CONNECTION=pgsql
DB_HOST=aws-0-us-west-1.pooler.supabase.com
DB_PORT=6543
DB_DATABASE=postgres
DB_USERNAME=postgres.whtqpdxutlghijasrrmz
DB_PASSWORD=V3aBbNds3ymuqvxS
DB_SCHEMA=public

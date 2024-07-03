<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AnimalsExport;
use App\Imports\AnimalsImport;
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


class FarmflowController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $animalsData = Animal::select('id', 'gender', 'breed', 'name', 'status', 'created_at', 'internal_id')
            ->where('user_id', $userId)
            ->where('archived', false)
            ->orderBy('created_at', 'desc')
            ->paginate(8);
        $recordCount = Animal::where('user_id', $userId)->where('archived', false)->count();



        return view('Farmer.Farmflow', compact('animalsData', 'recordCount'));
    }

    public function sell(Animal $animal)
    {
        $this->authorize('update', $animal);
        if ($animal->user_id == auth()->user()->id) {
            $animal->update(['status' => 'Sold']);
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function archive(Animal $animal)
    {
        $this->authorize('update', $animal);
        if ($animal->user_id == auth()->user()->id) {
            $animal->update(['archived' => true]);
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function delete(Animal $animal)
    {
        $this->authorize('delete', $animal);
        if ($animal->user_id == auth()->user()->id) {
            $animal->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function toggleSoldVisibility(Request $request)
    {
        $showSold = $request->input('showSold', false);
        $userId = auth()->user()->id;
        $animals = Animal::select('id', 'gender', 'breed', 'name', 'status', 'created_at', 'internal_id')
            ->where('user_id', $userId)
            ->where('archived', false);
        if (!$showSold) {
            $animals->where('status', '!=', 'Sold');
        }
        $animalsData = $animals->paginate(5);
        return response()->json($animalsData);
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('file');
        $import = new AnimalsImport;
        Excel::import($import, $file);

        $importedAnimals = $import->getImportedAnimals();

        return view('animals.import', compact('importedAnimals'));
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('file');

        Excel::import(new AnimalsImport, $file);

        return redirect()->back()->with('success', 'Animals updated successfully.');
    }

    public function download()
    {
        $userId = auth()->user()->id;
        $animals = Animal::where('user_id', $userId)->where('archived', false)->get();

        return Excel::download(new AnimalsExport($animals), 'animals.xlsx');
    }

    public function downloadAll()
    {
        $userId = auth()->user()->id;
        $animals = Animal::where('user_id', $userId)->get();

        return Excel::download(new AnimalsExport($animals), 'all_animals.xlsx');
    }

    public function print()
    {
        $userId = auth()->user()->id;
        $animals = Animal::where('user_id', $userId)->where('archived', false)->get();

        $pdf = PDF::loadView('pdf.animals', compact('animals'));

        return $pdf->download('animals.pdf');
    }
}

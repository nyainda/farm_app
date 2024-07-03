<?php
namespace App\Imports;

use App\Models\Animal;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class AnimalsImport implements ToCollection
{
    public $importedAnimals;

    public function __construct()
    {
        $this->importedAnimals = collect();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $animal = Animal::updateOrCreate(
                ['id' => $row[0]], // Assuming the first column is the ID
                [
                    'name' => $row[1], // Adjust indices based on your Excel structure
                    'species' => $row[2],
                    // Add other fields as necessary
                ]
            );

            $this->importedAnimals->push($animal);
        }
    }

    public function getImportedAnimals()
    {
        return $this->importedAnimals;
    }
}

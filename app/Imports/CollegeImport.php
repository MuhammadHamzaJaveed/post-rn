<?php

namespace App\Imports;

use App\Models\College;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CollegeImport implements ToModel, WithHeadingRow
{
    /*public function model(array $row)
    {

        $existingCollege = College::where('name', $row['name'])
            ->where('district', $row['district'])
            ->first();
        if ($existingCollege) {
            return null;
        }
        return new College([
            'name' => $row['name'], // Adjust to match your Excel headers
            'isBds' => $row['isbds'],
            'district' => $row['district'],
            'openMeritSeats' => $row['openmeritseats'],
            'overSeasSeats' => $row['overseasseats'],
            'disabilitySeats' => $row['disabilityseats'],
            'underdevelopedAreas' => $row['underdevelopedareas'],
            'cholistanSeats' => $row['cholistanseats'],
            'isReciprocal' => $row['isreciprocal'],
            'isFemale' => $row['isfemale'],
        ]);
    }*/
    public function model(array $row)
    {
        // Validation example
        $validator = Validator::make($row, [
            'name' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'isbds' => 'required|boolean',
            'openmeritseats' => 'nullable|integer',
            'overseasseats' => 'nullable|integer',
            'disabilityseats' => 'nullable|integer',
            'underdevelopedareas' => 'nullable|integer',
            'cholistanseats' => 'nullable|integer',
            'isreciprocal' => 'nullable|integer',
            'isfemale' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            Filament::notify('danger', 'Invalid data in row ');
            return null;
        }
        // Check if the college already exists
        $existingCollege = College::where('name', $row['name'])
            ->where('district', $row['district'])
            ->first();
        if ($existingCollege) {
            return null;
        }
        // Create a new College record
        return new College([
            'name' => $row['name'],
            'isBds' => $row['isbds'],
            'district' => $row['district'],
            'openMeritSeats' => $row['openmeritseats'] ?? 0,
            'overSeasSeats' => $row['overseasseats'] ?? 0,
            'disabilitySeats' => $row['disabilityseats'] ?? 0,
            'underdevelopedAreas' => $row['underdevelopedareas'] ?? 0,
            'cholistanSeats' => $row['cholistanseats'] ?? 0,
            'isReciprocal' => $row['isreciprocal']?? 0,
            'isFemale' => $row['isfemale'],
        ]);
    }

}
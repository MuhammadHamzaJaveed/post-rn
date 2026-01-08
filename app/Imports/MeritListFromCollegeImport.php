<?php

namespace App\Imports;

use App\Models\MeritListFromCollege;
use Filament\Facades\Filament;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MeritListFromCollegeImport implements ToModel, WithHeadingRow
{
    public $selectionListId;
    public $seatCategoryId;
    public function __construct(int $selectionListId, int $seatCategoryId)
    {
        $this->selectionListId = $selectionListId;
        $this->seatCategoryId = $seatCategoryId;
    }

    public function model(array $row)
    {
        $row = array_filter($row, function ($value) {
            return !is_null($value);
        });
        // Validation example
        $validator = Validator::make($row, [
            'user_id' => 'required|int|exists:users,id',
            'college_from' => 'required|int',
            'college_to'   => 'required|int|exists:colleges,id',
        ]);

        /*if ($validator->fails()) {
            Filament::notify('danger', 'Some Issue in user_id or college_from college_to in the import file');
            return null;
        }
        // Check if the college already exists
        $existingUser = MeritListFromCollege::where('user_id', $row['user_id'])
            ->where('college_to', $row['college_to'])
            ->where('selection_list_id', $this->selectionListId)
            ->where('seat_category_id', $this->seatCategoryId)
            ->exists();
        if ($existingUser) {
            Filament::notify('danger', 'User already exists in the college');
            return null;
        }*/

        // Check if the user has 'is_stay' set to 1
        /*$hasStayStatus = MeritListFromCollege::where('user_id', $row['user_id'])
            ->where('is_stay', 1)
            ->exists();
        if ($hasStayStatus) {
            Filament::notify('danger', 'User cannot be imported as they are marked as "stay".');
            return null;
        }*/

        // Proceed with the existing query
       /* $existingUser = MeritListFromCollege::where('user_id', $row['user_id'])
            ->where('college_to', $row['college_to'])
            ->where('selection_list_id', $this->selectionListId)
            ->where('seat_id', $this->seatCategoryId)
            ->exists();

        if ($existingUser) {
            Filament::notify('danger', 'User already exists in the college.');
            return null;
        }
        // Create a new College record
        return new MeritListFromCollege([
            'user_id' => $row['user_id'],
            'college_from' => $row['college_from'],
            'college_to' => $row['college_to'],
            'seat_id' => $this->seatCategoryId,
            'selection_list_id' => $this->selectionListId,
        ]);*/




        $existingUser = MeritListFromCollege::where('user_id', $row['user_id'])
            ->where('college_to', $row['college_to'])
            ->where('selection_list_id', $this->selectionListId)
            ->where('seat_id', $this->seatCategoryId)
            ->exists();

        if ($existingUser) {
            Filament::notify('danger', 'User already exists in the college.');
            return null;
        }

// Check if user exists in any previous selection list with is_stay = 1
        $previousUserStay = MeritListFromCollege::where('user_id', $row['user_id'])
            ->where('college_to', $row['college_to'])
            ->where('selection_list_id', '<', $this->selectionListId) // Check previous lists
            ->where('seat_id', $this->seatCategoryId)
            ->where('is_stay', 1)
            ->where('is_joined', 1)
            ->exists();

// Create a new College record
        return new MeritListFromCollege([
            'user_id' => $row['user_id'],
            'college_from' => $row['college_from'],
            'college_to' => $row['college_to'],
            'seat_id' => $this->seatCategoryId,
            'selection_list_id' => $this->selectionListId,
            'is_stay' => $previousUserStay ? 1 : 0, // Set is_stay = 1 if found in previous list
            'is_joined' => $previousUserStay ? 1 : 0,
        ]);



    }
}

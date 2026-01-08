<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FilamentUserTableExport implements FromCollection, WithHeadings
{
    protected $records;
    protected $columns;
    protected $seatId;
    protected $isOpenMerit;

    public function __construct($records, $seatId = null, $isOpenMerit = null)
    {
        $this->records = $records;
        $this->seatId = $seatId;
        $this->isOpenMerit = $isOpenMerit;
        $this->columns = array_merge(
            $this->getBaseColumns(),
            $this->getPreferencesHeadings()
        );
    }

    public function collection()
    {
        $data = [];
        $serialNumber = 1;

        foreach ($this->records as $record) {
            $data[] = array_merge(
                [$serialNumber++],
                $this->mapRecordData($record),
                $this->getPreferences($record)
            );
        }

        return collect($data);
    }

    public function headings(): array
    {
        return array_keys($this->columns); // This will return the column names
    }

    private function getBaseColumns(): array
    {
        return [
            'Sr #' => '',
            'User id' => 'id',
            'Name' => 'name',
            'Email' => 'email',
            'Father_name' => 'father_name',
            'Mobile_number' => 'mobile_number',
            'Challan_id' => 'challan_id',
            'Aggreate' => 'aggregate',
            'Aggreate_overseas' => 'aggregate_overseas',
            'Foreigner' => 'foreigner',
            'Open Merit' => 'foreigner',
            'Open Merit Foreigner' => 'is_open_merit',
            'Comments' => 'comments',
            'Program' => 'program.name',
            'Gender' => 'personalDetails.gender.name',
            'CNIC / Passport / B-Form / CRC / POC / NICOP' => 'personalDetails.cnic_passport',
            'Nationality' => 'personalDetails.nationality.name',
            'country' => 'personalDetails.country',
            'District' => 'personalDetails.district.name',
            'Residence Area' => 'personalDetails.area.name',
            'Phone No' => 'personalDetails.mobile_number',
            'SSC Roll No' => 'qualifications.ssc_roll_no',
            'SSC Obtained Marks' => 'qualifications.ssc_marks_obtained',
            'SSC Total Marks' => 'qualifications.ssc_total_marks',
            'HSSC Roll No' => 'qualifications.hssc_roll_no',
            'HSSC Obtained Marks' => 'qualifications.hssc_marks_obtained',
            'HSSC Total Marks' => 'qualifications.hssc_total_marks'
        ];
    }

    private function getPreferencesHeadings(): array
    {
        $preferences = [];
        for ($i = 0; $i < 32; $i++) {
            $preferences["Preference " . ($i + 1)] = "Preference " . ($i + 1);
        }
        return $preferences;
    }

    private function mapRecordData($record): array
    {
        return [
            $record->id ?? 'N/A',
            $record->name ?? 'N/A',
            $record->email ?? 'N/A',
            $record->father_name ?? 'N/A',
            $record->mobile_number ?? 'N/A',
            $record->challan_id ?? 'N/A',
            $record->aggregate ?? 'N/A',
            $record->aggregate_overseas ?? 'N/A',
            $record->foreigner == 1 ? 'Yes' : 'No',
            $record->foreigner == 0 ? 'Yes' : 'No',
            $record->is_open_merit == 1 ? 'Yes' : 'No',
            $record->comments ?? 'N/A',
            $record->program->name ?? 'N/A',
            $record->personalDetails->gender->name ?? 'N/A',
            $record->personalDetails->cnic_passport ?? 'N/A',
            $record->personalDetails->nationality->name ?? 'N/A',
            $record->personalDetails->country ?? 'N/A',
            $record->personalDetails->district->name ?? 'N/A',
            $record->personalDetails->area->name ?? 'N/A',
            $record->personalDetails->mobile_number ?? 'N/A',
            $record->qualifications->ssc_roll_no ?? 'N/A',
            $record->qualifications->ssc_marks_obtained ?? 'N/A',
            $record->qualifications->ssc_total_marks ?? 'N/A',
            $record->qualifications->hssc_roll_no ?? 'N/A',
            $record->qualifications->hssc_marks_obtained ?? 'N/A',
            $record->qualifications->hssc_total_marks ?? 'N/A'
        ];
    }

    private function getPreferences($record): array
    {
        $preferences = [];
        if ($this->seatId == 3 && $this->isOpenMerit == 1) {
            $collegePreferences = $record->mbbsCollegeForeignerAsOpenMeritPreferences
                ->where('is_foreigner', 1)
                ->pluck('college_pref')
                ->first();
        }
        elseif ($this->seatId == 3 && is_null($this->isOpenMerit))
        {
            $collegePreferences = $record->mbbsCollegePreferences
                ->where('is_foreigner', 1)
                ->pluck('college_pref')
                ->first();
        }
        else {
            $collegePreferences = $record->mbbsCollegePreferences->pluck('college_pref')->first();
        }
        $collegeData = json_decode($collegePreferences, true) ?? [];

        for ($i = 0; $i < 32; $i++) {
            $preferences[] = $collegeData[$i]['name'] ?? 'N/A';
        }

        return $preferences;
    }
}



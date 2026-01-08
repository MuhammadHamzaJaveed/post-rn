<?php

namespace App\Console\Commands;

use App\Exports\ExcelExport;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Command\Command as CommandAlias;
use Symfony\Component\Console\Helper\ProgressBar;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportGeneratedMail;
use Carbon\Carbon;

class GenerateExcelReport extends Command
{
    protected $signature = 'report:generate-excel';
    protected $description = 'Generate an Excel report';
    private $serialNumber = 1;

    public function handle()
    {
        $columns = array_merge(
            $this->getBaseColumns(),
            /*$this->getPreferencesHeadings()*/
        );

        // Create a progress bar with custom format
        $totalRecords = User::where('is_paid',1)->count();
        $progressBar = $this->output->createProgressBar($totalRecords);
        $progressBar->setFormat('[%bar%] %current%/%max% [%percent:3s%%] %elapsed:6s% elapsed');
        $progressBar->setBarCharacter('<fg=green;bg=black>=</>'); // Custom bar character
        $progressBar->setEmptyBarCharacter('<fg=black;bg=white>-</>'); // Custom empty bar character
        $progressBar->setProgressCharacter('>'); // Custom progress character

        $progressBar->start();

        // Fetch and process records in chunks
        $data = $this->fetchDataInChunks($columns, $progressBar);

        // Ensure directory exists
        $this->ensureDirectoryExists(storage_path('app/public/excel'));

        $filename = 'excel/mbbs-private-report-' . Carbon::now()->format('Y-m-d_H-i-s') . '.xlsx';

        // Store the Excel file
        Excel::store(new ExcelExport($columns, $data), $filename);

        // Finish the progress bar
        $progressBar->finish();
        $this->info("\nExcel report generated successfully.");

       /* // Send an email with the report
        Mail::mailer('verification')
            ->to('openmerit-mbbs2025@uhs.edu.pk')
            ->send(new ReportGeneratedMail($filename,''));
        Mail::mailer('verification')
            ->to('naeemmaqbool08@gmail.com')
            ->send(new ReportGeneratedMail($filename,''));

        $this->info("\nEmail sent successfully.");*/

        return CommandAlias::SUCCESS;
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
            'Dob' => 'date_of_birth',
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
            'SSC Passing Year' => 'qualifications.ssc_passing_year',
            'SSC Obtained Marks' => 'qualifications.ssc_marks_obtained',
            'SSC Total Marks' => 'qualifications.ssc_total_marks',
            'HSSC Roll No' => 'qualifications.hssc_roll_no',
            'HSSC Passing Year' => 'qualifications.hssc_passing_year',
            'HSSC Obtained Marks' => 'qualifications.hssc_marks_obtained',
            'HSSC Total Marks' => 'qualifications.hssc_total_marks',
            'Mdcat Roll No' => 'admissionTest.md_cat_cnic',
            'Mdcat Marks' => 'admissionTest.md_cat_obtained_marks',
            'Ucat Candidate Id' => 'admissionTest.ucat_candidate_id',
            'Ucat Obtained Marks' => 'admissionTest.ucat_obtained_marks',
            'Sat Username' => 'admissionTest.sat_username',
            'Sat Password' => 'admissionTest.sat_password',
            'Sat Biology Marks' => 'admissionTest.sat_biology_obtained_marks',
            'Sat Chemistry Marks' => 'admissionTest.sat_chemistry_obtained_marks',
            'Sat Phy/Math Marks' => 'admissionTest.sat_phy_math_obtained_marks',
            'Mcat Username' => 'admissionTest.mcat_username',
            'Mcat Password' => 'admissionTest.mcat_password',
            'Mcat Obtained Marks' => 'admissionTest.mcat_obtained_marks',
            'Paid Status' => '',
            'User Edit Application' => '',
            'Application Status Verification' => '',
        ];
    }

    private function getPreferencesHeadings(): array
    {
        $preferences = [];
        for ($i = 0; $i < 35; $i++) {
            $preferences["Preference " . ($i + 1)] = "Preference " . ($i + 1);
        }
        return $preferences;
    }

    private function fetchDataInChunks(array $columns, ProgressBar $progressBar): array
    {
        $data = [];
       $query = User::with([
            'program',
            'personalDetails.gender',
            'personalDetails.nationality',
            'personalDetails.district',
            'personalDetails.area',
            'qualifications',
            'mbbsCollegePreferences'
        ])  ->where('is_paid',1)
           ->whereDoesntHave('roles', function ($query) {
               $query->where('name', 'Super_Admin')
                   ->orWhere('name', 'Admin')
                   ->orWhere('name', 'Verification_Team')
                   ->orWhere('name', 'Supervisory_Team')
                   ->orWhere('name', 'Incharge_Team')
                   ->orWhere('name', 'College');
           });
       $query->chunk(100, function ($records) use (&$data, $columns, $progressBar) {
            foreach ($records as $record) {
                $data[] = array_merge(
                    [$this->serialNumber++],
                    $this->mapRecordData($record),
                    /*$this->getPreferences($record)*/
                );
                $progressBar->advance();
            }
        });

        return $data;
    }

    private function mapRecordData($record): array
    {
        $status = '';
        if ($record->status == 1)
        {
            $status = 'Approved';
        }
        elseif ($record->status == 2)
        {
            $status = 'Pending';
        }
        elseif ($record->status == 3)
        {
            $status = 'Rejected';
        }
        elseif ($record->status == 4)
        {
            $status = 'Unverified';
        }
        else
        {
            $status = 'N/A';
        }
        return [
            $record->id ?? 'N/A',
            $record->name ?? 'N/A',
            $record->email ?? 'N/A',
            $record->father_name ?? 'N/A',
            $record->mobile_number ?? 'N/A',
            $record->challan_id ?? 'N/A',
            $record->personalDetails->date_of_birth ?? 'N/A',
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
            $record->qualifications->ssc_passing_year ?? 'N/A',
            $record->qualifications->ssc_marks_obtained ?? 'N/A',
            $record->qualifications->ssc_total_marks ?? 'N/A',
            $record->qualifications->hssc_roll_no ?? 'N/A',
            $record->qualifications->hssc_passing_year ?? 'N/A',
            $record->qualifications->hssc_marks_obtained ?? 'N/A',
            $record->qualifications->hssc_total_marks ?? 'N/A',
            $record->admissionTest->md_cat_cnic ?? 'N/A',
            $record->admissionTest->md_cat_obtained_marks ?? 'N/A',
            $record->admissionTest->ucat_candidate_id ?? 'N/A',
            $record->admissionTest->ucat_obtained_marks ?? 'N/A',
            $record->admissionTest->sat_username ?? 'N/A',
            $record->admissionTest->sat_password ?? 'N/A',
            $record->admissionTest->sat_biology_obtained_marks ?? 'N/A',
            $record->admissionTest->sat_chemistry_obtained_marks ?? 'N/A',
            $record->admissionTest->sat_phy_math_obtained_marks	 ?? 'N/A',
            $record->admissionTest->mcat_username ?? 'N/A',
            $record->admissionTest->mcat_password ?? 'N/A',
            $record->admissionTest->mcat_obtained_marks ?? 'N/A',
            $record->is_paid ? 'Yes' : 'No',
            $record->edit_user_status ? 'user_edit_data' : 'not_edit',
            $status,
        ];
    }

    private function getPreferences($record): array
    {
        $preferences = [];
        $collegePreferences = $record->mbbsCollegePreferences->pluck('college_pref')->first();
        $collegeData = json_decode($collegePreferences, true) ?? [];

        for ($i = 0; $i < 32; $i++) {
            $preferences[] = $collegeData[$i]['name'] ?? 'N/A';
        }

        return $preferences;
    }

    private function ensureDirectoryExists(string $path): void
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }
}



<?php

namespace App\Console\Commands;

use App\Exports\ExcelExport;
use App\Models\MeritListFromCollege;
use App\Models\User;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Command\Command as CommandAlias;
use Symfony\Component\Console\Helper\ProgressBar;

class GenerateExcelReportMeritListFromColleges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meritlist:from-colleges';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Excel report for merit list from colleges';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private $serialNumber = 1;

    public function handle()
    {
        $columns = array_merge(
            $this->getBaseColumns(),
            /*$this->getPreferencesHeadings()*/
        );

        // Create a progress bar with custom format
        $totalRecords = MeritListFromCollege::count();
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

        // Store the Excel file
        Excel::store(new ExcelExport($columns, $data), 'report/listfromcolleges.xlsx');

        // Finish the progress bar
        $progressBar->finish();
        $this->info("\nExcel report generated successfully.");
        return CommandAlias::SUCCESS;
    }

    private function getBaseColumns(): array
    {
        return [
            'Sr #' => '',
            'Name' => '',
            'Father_name' => '',
            'College' => '',
            'Aggreate' => '',
            'Aggreate_overseas' => '',
            'Student_status' => '',
            'College_status' => '',
            'Paid_status' => '',
            /*'Comments' => 'comments',
            'Program' => 'program.name',
            'Gender' => 'personalDetails.gender.name',
            'CNIC / Passport / B-Form / CRC / POC / NICOP' => 'personalDetails.cnic_passport',
            'Nationality' => 'personalDetails.nationality.name',
            'District' => 'personalDetails.district.name',
            'Residence Area' => 'personalDetails.area.name',
            'Phone No' => 'personalDetails.mobile_number',
            'SSC Obtained Marks' => 'qualifications.ssc_marks_obtained',
            'SSC Total Marks' => 'qualifications.ssc_total_marks',
            'HSSC Obtained Marks' => 'qualifications.hssc_marks_obtained',
            'HSSC Total Marks' => 'qualifications.hssc_total_marks'*/
        ];
    }

    /*private function getPreferencesHeadings(): array
    {
        $preferences = [];
        for ($i = 0; $i < 24; $i++) {
            $preferences["Preference " . ($i + 1)] = "Preference " . ($i + 1);
        }
        return $preferences;
    }*/

    private function fetchDataInChunks(array $columns, ProgressBar $progressBar): array
    {
        $data = [];
        MeritListFromCollege::with([
            'user',
        ])->chunk(100, function ($records) use (&$data, $columns, $progressBar) {
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
        return [
            /*$record->id ?? 'N/A',*/
            $record->user->name ?? 'N/A',
            $record->user->father_name ?? 'N/A',
            $record->college->name ?? 'N/A',
            $record->user->aggregate ?? 'N/A',
            $record->user->aggregate_overseas ?? 'N/A',
            $record->student_status == 1 ? 'Joining' : 'Pending',
            $record->college_status == 1 ? 'Joining' : 'Pending',
            $record->is_paid == 1 ? 'Yes' : 'No',


        ];
    }

    /*private function getPreferences($record): array
    {
        $preferences = [];
        $collegePreferences = $record->mbbsCollegePreferences->pluck('college_pref')->first();
        $collegeData = json_decode($collegePreferences, true) ?? [];

        for ($i = 0; $i < 24; $i++) {
            $preferences[] = $collegeData[$i]['name'] ?? 'N/A';
        }

        return $preferences;
    }*/

    private function ensureDirectoryExists(string $path): void
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }
}

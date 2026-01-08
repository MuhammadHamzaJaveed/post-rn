<?php

namespace App\Console;

use Illuminate\Console\Command;
use PDF;
use App\Models\User;

class GeneratePdfCommand extends Command
{
    public $pdfData = [];

    public $personalDetails;

    public $qualifications;

    public $admissionTest;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pdf:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate PDFs for specified number of users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    { 
        $users = User::query()
        // ->where('transaction_id', '!=', null);
        // ->where('id', '=', 301691);
        ->wherein('id',  [111794,100258]);


        // ->whereHas('meritListDetail', function ($query) {
            // $query->where('user_id', '!=', null);
        // });
        
        $users->chunk(50, function ($users) {
        foreach ($users as $user) {
            // $oldAggregate = $user->aggregate;
            $this->setPdfData($user);
            echo "\n\rGenerating Pdfs for $user->id \n\r";
            $pdfContent = PDF::loadView('livewire.sidebar.pdfusers',$this->pdfData);
            $filename = 'Users_' . $user->id  . '.pdf';
            $pdfContent->save(storage_path('app\\public\\pdfs\\'.$filename));

            echo "\n\rPdf Generated. :) \n\r";
            // $pdf = PDF::loadView('pdf.pdfusers', ['user' => $user]); 
        }});
    }


    /**
     * Set PDF data for the given user.
     *
     * @param \App\Models\User $user
     * @return void
     */
    private function setPdfData(User $user)
    {
        $this->personalDetails = $user->personalDetails ?? null;
        $this->qualifications = $user->qualifications ?? null;
        $this->admissionTest = $user->admissionTest ?? null;
        $this->program = $user->program ?? null;
        $mbbsCollegePreferences = $user->mbbsCollegePreferences->pluck('college_pref')->toArray() ?? null;
        $this->mbbsPreference = !empty($mbbsCollegePreferences) ? json_decode($mbbsCollegePreferences[0], true) : [] ; 
        
        $bdsCollegePreferences = $user->bdsCollegePreferences->pluck('college_pref')->toArray()?? null;
        $this->bdsPreference = !empty($bdsCollegePreferences) ? json_decode($bdsCollegePreferences[0], true) : [];  

        $this->seatCategories = $user->seatCategories->pluck('id')->toArray()?? null;

        $seatCategory = $user->seatCategories->pluck('name')->toArray()?? null;
        
        $this->pdfData = [
            'title' => 'Sample PDF',
            'challanId' => $user->challan_id ?? null,
            'applicationId' => $user->meritListDetail->user_id ?? null,

            'seatCategory' => $user->seatCategories->pluck('id')->toArray() ?? null,

            // Personal Information
            'cnic' => $this->personalDetails->cnic_passport ?? null,
            'name' => $user->name ?? null,
            'fatherName' => $user->father_name ?? null,
            'motherName' => $this->personalDetails->mother_name ?? null,
            'gender' => $this->personalDetails->gender->name ?? null,
            'nationality' => $this->personalDetails->nationality?->name ?? null,
            'country' => $this->personalDetails?->country ?? null,
            'dateOfBirth' => $this->personalDetails->date_of_birth ?? null,
            'districtOfDomicile' => $this->personalDetails->district?->name ?? null,
            'areaOfResidence' => $user->personalDetails->area->name ?? null,
            'mailingAddress' => $this->personalDetails->address ?? null,
            'telephone' => $this->personalDetails->telephone_number ?? null,
            'secondaryNumber' => $this->personalDetails->secondary_number ?? null,
            'phoneNumber' => $this->personalDetails->mobile_number ?? null,
            'email' => $user->email ?? null,

            // Qualifications Section
            'sscRollNumber' => $this->qualifications->ssc_roll_no ?? null,
            'hsscRollNumber' => $this->qualifications->hssc_roll_no ?? null,
            'sscExam' => $this->qualifications->sscExam->name ?? null,
            'hsscExam' => $this->qualifications->hsscExam->name ?? null,
            'sscSubjects' => $this->qualifications->ssc_science_subjects ?? null,
            'hsscSubjects' => $this->qualifications->hssc_science_subjects ?? null ,
            'sscInstitution' => $this->qualifications->sscInstitution->name ?? null,
            'hsscInstitution' => $this->qualifications->hsscInstitution->name ?? null,
            'sscBoard' => $this->qualifications->sscBoard->name ?? null,
            'hsscBoard' => $this->qualifications->hsscBoard->name ?? null,
            'sccPassingYear' => $this->qualifications->ssc_passing_year ?? null,
            'hsccPassingYear' => $this->qualifications->hssc_passing_year ?? null,
            'sscMarks' => $this->qualifications->ssc_marks_obtained ?? null,
            'hsscMarks' => $this->qualifications->hssc_marks_obtained ?? null,
            'sscTotalMarks' => $this->qualifications->ssc_total_marks ?? null,
            'hsscTotalMarks' => $this->qualifications->hssc_total_marks ?? null,
            'physics' => $this->qualifications->physics_score ?? null,
            'chemistry' => $this->qualifications->chemistry_score ?? null,
            'biology' => $this->qualifications->biology_score ?? null,
            'physicsTotal' => $this->qualifications->physics_total_score ?? null,
            'chemistryTotal' => $this->qualifications->chemistry_total_score ?? null,
            'biologyTotal' => $this->qualifications->biology_total_score ?? null,
            
            // Programs Name
            'programs'  => $this->program->name ?? null,
            
            // MBBS or BDS Prioirity
            'priority'  => $user->program_priority ?? null,

            // Seats Category
            // 'seats' => implode(', ', $seatCategory) ?? null,
            
            // Foreigner
            'foreigner' => $user->foreigner ?? null,
            
            //Aggregate
            'aggregate' => $user->meritListDetail->aggregate ?? null   ,
            'aggregate_overseas' => $user->aggregate_overseas !== null ? $user->aggregate_overseas : null,

            //MDACT INFORMATION
            'mdcatCnic' => $this->admissionTest->md_cat_cnic ?? null,
            'mdcatCenter' => optional($this->admissionTest->mdcatCenter)->name ?? 'N/A',
            'mdcatMarks' => $this->admissionTest->md_cat_obtained_marks ?? null,
            'mdcatApplicantCnic' => $this->personalDetails->cnic_passport ?? null,
            'mdcatPassingYear' => $this->admissionTest->mdcatPassingYear->name ?? null,
            
            //SAT INFORMATION
            'satTestDate' => $this->admissionTest->sat_test_date ?? null,
            'satBiologyMarks' => $this->admissionTest->sat_biology_obtained_marks ?? null,
            'satChemistryMarks' => $this->admissionTest->sat_chemistry_obtained_marks ?? null,
            'satPhyMathMarks' => $this->admissionTest->sat_phy_math_obtained_marks ?? null,
            'satUserName' => $this->admissionTest->sat_username ?? null,
            'satPassword' => $this->admissionTest->sat_password ?? null,
        
            //UCAT INFORMATION
            'ucatId' => $this->admissionTest->ucat_candidate_id ?? null,
            'ucatTestDate' => $this->admissionTest->ucat_test_date ?? null,
            'ucatObtainedMarks' => $this->admissionTest->ucat_obtained_marks ?? null,
            'ucatBandScore' => $this->admissionTest->ucat_band ?? null,

            // MCAT INFORMATION
            'mcatTestDate' => $this->admissionTest->mcat_test_date ?? null,
            'mcatObtaniedMarks' => $this->admissionTest->mcat_obtained_marks ?? null,
            'mcatUserName' => $this->admissionTest->mcat_username ?? null,
            'mcatPassword' => $this->admissionTest->mcat_password ?? null,

            //College Preferences
            'mbbsPreference' => !empty($mbbsCollegePreferences) ? json_decode($mbbsCollegePreferences[0], true) : [],
            'bdsPreference' => !empty($bdsCollegePreferences) ? json_decode($bdsCollegePreferences[0], true) : [], 
        ];
    }
}

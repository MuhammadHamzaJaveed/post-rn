<?php

namespace App\Http\Livewire\UhsForms\Steps;

use App\Services\UserServices\UserServices;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Qualifications extends Component
{
    protected $userServices;

    public $sscPassed;

    public $sscScienceSubjects;

    public $sscInstitutionType;

    public $sscBoard;

    public $sscPassingYear;

    public $sscMarksObtained;

    public $sscTotalMarks;

    public $hsscPassed;

    public $hsscScienceSubjects;

    public $hsscInstitutionType;

    public $hsscBoard;

    public $hsscPassingYear;

    public $hsscMarksObtained;

    public $hsscTotalMarks;

    public $physcisObtained;
    public $biologyObtained;
    public $chemisteryObtained;

    public $seatCategories =[];
    public $sscRollNo;
    public $hsscRollNo;

    public $experiences = [];

    public $nursingPassingYear;
    public $nursingRollNo;

    public $nursingMarksObtained;

    public $nursingTotalMarks;

    public $currentJob;


    /**
     * @return array
     */
    protected function rules(): array
    {   
        $rules = [
            'sscPassed'           => 'required',
            'sscScienceSubjects'  => 'nullable',
            'sscInstitutionType'  => 'required',
            'sscBoard'            => 'required',
            'sscPassingYear'      => 'required',
            'sscMarksObtained'    => 'required|numeric|lte:sscTotalMarks',
            'sscTotalMarks'       => 'required|numeric |lte:1200',
            'sscRollNo'           => 'required',
            'hsscPassed'          => 'required',
            'hsscScienceSubjects' => 'nullable',
            'hsscInstitutionType' => 'required',
            'hsscBoard'           => 'required',
            'hsscPassingYear'     => 'required',
            // 'hsscTotalMarks'      => 'required|numeric |lte:1200',
            'hsscRollNo'           => 'required',
            'experiences.*.fromDate' => 'required|date',
            'experiences.*.toDate' => 'required|date|after_or_equal:experiences.*.fromDate',
            'experiences.*.institute' => 'required|string|max:255',
            'experiences.*.duration' => 'required|string|max:255',
            'nursingPassingYear'     => 'required',
            'nursingRollNo'     => 'required',
            'nursingMarksObtained'     => 'required',
            'nursingTotalMarks'     => 'required',
            'currentJob'     => 'required',
        ];
        // $customRules = [
        //     'hsscMarksObtained' => [
        //         'required',
        //         'numeric',
        //         'lte:hsscTotalMarks',
        //         function ($attribute, $value, $fail) {
        //             $hsscTotalMarks = $this->hsscTotalMarks;
        //             $minimumMarks = (int) $hsscTotalMarks * 0.6;
    
        //             if ($value < $minimumMarks) {
        //                 $fail("The FSc/HSSC marks must be at least 60% or 660 of the Total Marks.");
        //             }
        //         },
        //     ],
        // ];
        if($this->hsscPassingYear == '2021'){
            $customRules = [
                'physcisObtained' => [
                    'required',
                    'numeric',
                    'lte:200'
                ],
                'biologyObtained' => [
                    'required',
                    'numeric',
                    'lte:200'
                ],
                'chemisteryObtained' => [
                    'required',
                    'numeric',
                    'lte:200'
                ]
            ];
        } else {
            $customRules = [
                'hsscTotalMarks' => [
                    'required',
                    'numeric',
                    'lte:1200'
                ],
                'hsscMarksObtained' => [
                    'required',
                    'numeric',
                    'lte:hsscTotalMarks',
                    function ($attribute, $value, $fail) {
                        $hsscTotalMarks = $this->hsscTotalMarks;
                        $minimumMarks = (int) $hsscTotalMarks * 0.5;
        
                        if ($value < $minimumMarks) {
                            $fail("The FSc/HSSC marks must be at least 50% of the Total Marks.");
                        }
                    },
                ],
            ];
        }
        return array_merge($rules,$customRules);
    }

    /**
     * Summary of boot
     * @param  UserServices  $userServices
     * @return void
     */
    public function boot(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function mount()
    {
        $this->seatCategories = auth()->user()->seatCategories->pluck('id')->toArray();
        $qualifications = auth()->user()->qualifications;
        $qualification = $qualifications;
        if ($qualification) {
            $this->qualificationId = $qualification->id;
            $this->experiences = $qualification->experiences ? json_decode($qualification->experiences, true) : [];
        } else {
            $this->experiences[] = [
                'fromDate' => '',
                'toDate' => '',
                'institute' => '',
                'duration' => '',
            ];
        }
        if ($qualifications) {
            $this->sscPassed = $qualifications->ssc_exam_passeds_id;
            $this->sscScienceSubjects = $qualifications->ssc_science_subjects;
            $this->sscInstitutionType = $qualifications->ssc_institution_id;
            $this->sscBoard = $qualifications->ssc_board_id;
            $this->hsscBoard = $qualifications->hssc_board_id;
            $this->sscPassingYear = $qualifications->ssc_passing_year;
            $this->sscMarksObtained = $qualifications->ssc_marks_obtained;
            $this->sscTotalMarks = $qualifications->ssc_total_marks;
            $this->sscRollNo = $qualifications->ssc_roll_no;
            $this->hsscPassed = $qualifications->hssc_exam_passeds_id;
            $this->hsscScienceSubjects = $qualifications->hssc_science_subjects;
            $this->hsscInstitutionType = $qualifications->hssc_institution_id;
            $this->hsscPassingYear = $qualifications->hssc_passing_year;
            $this->hsscMarksObtained = $qualifications->hssc_marks_obtained;
            $this->hsscTotalMarks = $qualifications->hssc_total_marks;
            $this->hsscRollNo = $qualifications->hssc_roll_no;
            $this->physcisObtained = $qualifications?->physics;
            $this->biologyObtained = $qualifications?->biology;
            $this->chemisteryObtained = $qualifications?->chemistery;
            $this->seatCategories = auth()->user()->seatCategories->pluck('id')->toArray();
            $this->nursingPassingYear = $qualifications->nursing_passing_year;
            $this->nursingRollNo = $qualifications->nursing_roll_no;
            $this->nursingMarksObtained = $qualifications->nursing_marks_obtained;
            $this->nursingTotalMarks = $qualifications->nursing_total_marks;
            $this->currentJob = $qualifications->current_job;

        }
    }


    public function updatedIsExperience($value)
    {
        if ($value) {
            // If experiences array is empty, add a default experience field
            if (empty($this->experiences)) {
                $this->experiences[] = [
                    'fromDate' => '',
                    'toDate' => '',
                    'institute' => '',
                    'duration' => '',
                ];
            }
        } else {
            // If "No" is selected, clear the experiences array
            $this->experiences = [];
        }
    }




    public function addExperience()
    {
        $this->experiences[] = [
            'fromDate' => '',
            'toDate' => '',
            'institute' => '',
            'duration' => '',
        ];
    }

    public function removeExperience($index)
    {
        unset($this->experiences[$index]);
        $this->experiences = array_values($this->experiences); // Reindex array
    }


    public function updatedExperiences($value, $key)
    {
        // $key example => "0.fromDate" OR "1.toDate"
        $parts = explode('.', $key);
        $index = $parts[0];

        if (
            !empty($this->experiences[$index]['fromDate']) &&
            !empty($this->experiences[$index]['toDate'])
        ) {
            $this->calculateDuration($index);
        }
    }

    /*public function calculateDuration($index)
    {
        try {
            $from = Carbon::parse($this->experiences[$index]['fromDate']);
            $to   = Carbon::parse($this->experiences[$index]['toDate']);

            if ($to->lt($from)) {
                $this->experiences[$index]['duration'] = "";
                return;
            }

            // FULL YEARS MONTHS DAYS CALCULATION
            $interval = $from->diff($to);

            $years  = $interval->y;
            $months = $interval->m;
            $days   = $interval->d;

            $durationString = "";

            if ($years > 0) {
                $durationString .= $years . " Year" . ($years > 1 ? "s " : " ");
            }
            if ($months > 0) {
                $durationString .= $months . " Month" . ($months > 1 ? "s " : " ");
            }
            if ($days > 0) {
                $durationString .= $days . " Day" . ($days > 1 ? "s " : " ");
            }

            $this->experiences[$index]['duration'] = trim($durationString);

        } catch (\Exception $e) {
            $this->experiences[$index]['duration'] = "";
        }
    }*/

    public function calculateDuration($index)
    {
        try {
            $from = Carbon::parse($this->experiences[$index]['fromDate']);
            $to   = Carbon::parse($this->experiences[$index]['toDate']);

            if ($to->lt($from)) {
                $this->experiences[$index]['duration'] = "";
                return;
            }

            $interval = $from->diff($to);

            $years  = $interval->y;
            $months = $interval->m;
            $days   = $interval->d;

            $parts = [];

            if ($years > 0) {
                $parts[] = $years . " Year" . ($years > 1 ? "s" : "");
            }

            if ($months > 0) {
                $parts[] = $months . " Month" . ($months > 1 ? "s" : "");
            }

            if ($days > 0) {
                $parts[] = $days . " Day" . ($days > 1 ? "s" : "");
            }

            $durationString = implode(", ", $parts);

            $this->experiences[$index]['duration'] = $durationString;

        } catch (\Exception $e) {
            $this->experiences[$index]['duration'] = "";
        }
    }


    private function calculateAggregate()
    {
        if(auth()->user()->submitted_at !== null){
        $qualifications = auth()->user()->qualifications;
        $admissionTest = auth()->user()->admissionTest;

        $sscObtainedMarks = $qualifications?->ssc_marks_obtained;
        $hsscObtainedMarks = $qualifications?->hssc_marks_obtained;

        $mdCatObtainedMarks = $admissionTest?->md_cat_obtained_marks;

        $programId = auth()->user()?->program_id;

        if (
            ($sscObtainedMarks && $hsscObtainedMarks) &&
            ($mdCatObtainedMarks)
        ) {
            $averageTotal = 1100;

            $ssc =  $sscObtainedMarks / $qualifications->ssc_total_marks * $averageTotal * 0.10;
            if($qualifications?->hssc_passing_year && $qualifications->hssc_passing_year == '2021'){
                $hssc = $hsscObtainedMarks / $qualifications->hssc_total_marks * $averageTotal * 0.40;
            } else {
                $hssc = $hsscObtainedMarks / $qualifications->hssc_total_marks * $averageTotal * 0.40;
            }
            

            $aggregation = [];

            $mdCatPercentile = $mdCatObtainedMarks / 200 * 100;

            if ((
                    ($programId == 1 || $programId == 3) && $mdCatPercentile > 55) ||
                ($programId == 2 && $mdCatPercentile > 45)
            ) {
                if ($mdCatObtainedMarks) {
                    $mdCat = $mdCatObtainedMarks / 200 * $averageTotal * 0.50;

                    $aggregation['mdCat'] = ($ssc + $hssc + $mdCat) / $averageTotal * 100;
                }
            } else {
                $aggregation['mdCat'] = 0;
            }

            $maxAggregate = max($aggregation);


            return $maxAggregate;
        } else {
            return 0;
        }
    }
    }


    private function calculateOverseasAggregate()
    {
        if(auth()->user()->submitted_at !== null)
        {
            $qualifications = auth()->user()->qualifications;
            $admissionTest = auth()->user()->admissionTest;
    
            $sscObtainedMarks = $qualifications?->ssc_marks_obtained;
            $hsscObtainedMarks = $qualifications?->hssc_marks_obtained;
    
            $mCatObtainedMarks = $admissionTest?->mcat_obtained_marks;
            $mdCatObtainedMarks = $admissionTest?->md_cat_obtained_marks;
            $uCatObtainedMarks = $admissionTest?->ucat_obtained_marks;
            $satObtainedMarks = ($admissionTest?->sat_biology_obtained_marks * 0.40) +
                ($admissionTest?->sat_chemistry_obtained_marks * 0.35) +
                ($admissionTest?->sat_phy_math_obtained_marks * 0.25);
    
            $programId = auth()->user()?->program_id;
    
            if (
                ($sscObtainedMarks && $hsscObtainedMarks) &&
                ($mdCatObtainedMarks || $uCatObtainedMarks || $satObtainedMarks || $mCatObtainedMarks)
            ) {
                $averageTotal = 1100;
    
                $ssc =  $sscObtainedMarks / $qualifications->ssc_total_marks * $averageTotal * 0.10;
                if($qualifications?->hssc_passing_year && $qualifications->hssc_passing_year == '2021'){
                    $hssc = $hsscObtainedMarks / $qualifications->hssc_total_marks * $averageTotal * 0.40;
                } else {
                    $hssc = $hsscObtainedMarks / $qualifications->hssc_total_marks * $averageTotal * 0.40;
                }
                $aggregation = [];
    
                $mdCatPercentile = $mdCatObtainedMarks / 200 * 100;
    
                if ((
                    ($programId == 1 || $programId == 3) && $mdCatPercentile >= 55) ||
                    ($programId == 2 && $mdCatPercentile >= 50))
                {
                    if ($mdCatObtainedMarks) {
                        $mdCat = $mdCatObtainedMarks / 200 * $averageTotal * 0.50;
    
                        $aggregation['mdCat'] = ($ssc + $hssc + $mdCat) / $averageTotal * 100 ;
                    }
                } else {
                    $aggregation['mdCat'] = 0;
                }
    
                if ($uCatObtainedMarks) {
                    $uCat = $uCatObtainedMarks / 3600 * $averageTotal * 0.50;
    
                    $aggregation['uCat'] = ($ssc + $hssc + $uCat) / $averageTotal * 100 ;
                }
    
                if ($satObtainedMarks) {
                    $sat2 = $satObtainedMarks / 800 * $averageTotal * 0.50;
    
                    $aggregation['sat2'] = ($ssc + $hssc + $sat2) / $averageTotal * 100 ;
                }
    
                if ($mCatObtainedMarks) {
                    $mCat = $mCatObtainedMarks / 528 * $averageTotal * 0.50;
            
                    $aggregation['mCat'] = ($ssc + $hssc + $mCat) / $averageTotal * 100;
                }
    
                $maxAggregate = max($aggregation);
    
    
                return $maxAggregate;
            } else {
                return 0;
            }
    }
    }
    
    public function submit()
    {
        $this->validate();

        
        $this->userServices->updateOrCreateQualifications(
            [
                'id' => auth()->user()->qualifications?->id,
            ],
            $this->formatQualificationsInfo()
        );
    

        $this->userServices->updateUser([
            'aggregate'                     => $this->calculateAggregate(),
            'aggregate_overseas'            => $this->calculateOverseasAggregate()

        ], auth()->user()->id);

        $this->cnic = auth()->user()->personalDetails->cnic_passport;
        /*
         * Please uncomment this comment this code when you want to fetch the data from the results table. And please also test it
         * should not create any new record in the database.
         *
        $secondDbData = DB::table('table_results')
            ->where('cnic', $this->cnic)
            ->first();

        if ($secondDbData) {
            if (auth()->user()->qualifications) {
                auth()->user()->qualifications->update([
                    'second_Db' => 1,
                ]);
            } else {
                auth()->user()->qualifications()->create([
                    'second_Db' => 1,
                ]);
            }
        } else {
            if (auth()->user()->qualifications) {
                auth()->user()->qualifications->update([
                    'second_Db' => 0,
                ]);
            } else {
                auth()->user()->qualifications()->create([
                    'second_Db' => 0,
                ]);
            }
        }*/

        $this->emit('completeStep', 'step3Completed');
        $this->emit('goToStep', 5);
    }

    /**
     * Summary of getAllInstitutionTypes
     * @return mixed
     */
    public function getGetAllInstitutionTypesProperty()
    {
        return $this->userServices->getAllInstitutionTypes();
    }

    /**
     * Summary of getAllUsersProperty
     * @return mixed
     */
    public function getAllBoardsProperty()
    {
        return $this->userServices->getAllBoards();
    }

    /**
     * Summary of getAllExamsProperty
     * @return mixed
     */
    public function getAllExamsProperty()
    {
        return $this->userServices->getAllExams();
    }

    /**
     * Summary of getSScExamsProperty
     * @return mixed
     */
    public function getSscExamsProperty()
    {
        return $this->userServices->getSscExams();
    }

    // public function getSpecificExams1Property()
    // {
    //     $allExams = $this->getAllExamsProperty(); // Get all exams
    //     // Filter the $allExams array based on specific names
    //     $specificExams1 = collect($allExams)->filter(function ($exam) {
    //         return in_array($exam['name'], $this->specificExamNames1);
    //     })->toArray();

    //     return $specificExams1;
    // }

    // public function getSpecificExams2Property()
    // {
    //     // Filter allExams options for specificExam2
    //     $allExams = $this->getAllExamsProperty(); // Get all exams
    //     // Filter the $allExams array based on specific names
    //     $specificExams2 = collect($allExams)->filter(function ($exam) {
    //         return in_array($exam['name'], $this->specificExamNames2);
    //     })->toArray();

    //     return $specificExams2;
    // }
    /**
     * @return array
     */
    private function formatQualificationsInfo(): array
    {  
        return [
            'user_id'               => auth()->user()->id,
            'ssc_exam_passeds_id'   => $this->sscPassed,
            'ssc_science_subjects'  => $this->sscScienceSubjects,
            'ssc_institution_id'    => $this->sscInstitutionType,
            'ssc_board_id'          => $this->sscBoard,
            'ssc_passing_year'      => $this->sscPassingYear,
            'ssc_marks_obtained'    => $this->sscMarksObtained,
            'ssc_total_marks'       => $this->sscTotalMarks,
            'ssc_roll_no'           => $this->sscRollNo,
            'hssc_exam_passeds_id'  => $this->hsscPassed,
            'hssc_science_subjects' => $this->hsscScienceSubjects,
            'hssc_institution_id'   => $this->hsscInstitutionType,
            'hssc_board_id'         => $this->hsscBoard,
            'hssc_passing_year'     => $this->hsscPassingYear,
            'hssc_marks_obtained'   => $this->hsscPassingYear == '2021' ? (string)($this->physcisObtained + $this->biologyObtained + $this->chemisteryObtained) : $this->hsscMarksObtained,
            'hssc_total_marks'      => $this->hsscPassingYear == '2021' ? "600" : $this->hsscTotalMarks,
            'hssc_roll_no'          => $this->hsscRollNo,
            'physics'               => $this->physcisObtained ?? '',
            'biology'               => $this->biologyObtained ?? '',
            'chemistery'            => $this->chemisteryObtained ?? '',
            'experiences'           =>  json_encode($this->experiences) ?? null,
            'current_job'           => $this->currentJob,
            'nursing_roll_no'       => $this->nursingRollNo,
            'nursing_passing_year'  => $this->nursingPassingYear,
            'nursing_marks_obtained'=> $this->nursingMarksObtained,
            'nursing_total_marks'   => $this->nursingTotalMarks,
        ];
    }
    

    public function render()
    {
        return view('livewire.uhs-forms.steps.qualifications');
    }
}

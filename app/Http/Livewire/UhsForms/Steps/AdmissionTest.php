<?php

namespace App\Http\Livewire\UhsForms\Steps;

use App\Models\SeatCategory;
use App\Services\UserServices\UserServices;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdmissionTest extends Component
{

    protected $userServices;

    public $selectedExam = 1;
    
    public $mdCatCenter;

    public $mdCatObtainedMarks;

    public $satBiologyMarks;

    public $satChemistryMarks;

    public $satPhyMathMarks;

    public $satUsername;

    public $satPassword;

    public $satTestDate;

    public $ucatTestDate;

    public $ucatBand;

    public $ucatObtainedMarks;

    public $ucatCandidateId;

    public $mcatObtainedMarks;

    public $mcatTestDate;

    public $mcatUsername;

    public $mcatPassword;

    public $cnic;

    public $mdCatCnic;

    public $seatCategories = [];

    public $readonlyCheck;

    public $mdCatPassingYear;

    /**
     * @return array
     */
    protected function rules(): array
    {
        $rules = [
            'selectedExam' => 'required|numeric',
        ];
            if ($this->selectedExam == 1 && auth()->user()->program_id == 1) {
                $rules += [
                    'mdCatCnic'          => 'required',
                    'mdCatCenter'        => 'required',
                    'mdCatObtainedMarks' => 'required|numeric|max:200|min:110',
                    'cnic'               => 'required',
                    'mdCatPassingYear' => 'required',
                    'selectedExam' => 'required'
                ];
            } elseif ($this->selectedExam == 1 && auth()->user()->program_id == 2) {
                $rules += [
                    'mdCatCnic'          => 'required',
                    'mdCatCenter'        => 'required',
                    'mdCatObtainedMarks' => 'required|numeric|max:200|min:100',
                    'cnic'               => 'required',
                    'mdCatPassingYear' => 'required',
                    'selectedExam' => 'required'
                ];
            } elseif ($this->selectedExam == 1 && auth()->user()->program_id == 3 && auth()->user()->program_priority == 1 || auth()->user()->program_id == 3 && auth()->user()->program_priority == 2) {
                $rules += [
                    'mdCatCnic'          => 'required',
                    'mdCatCenter'        => 'required',
                    'mdCatObtainedMarks' => 'required|numeric|max:200|min:110',
                    'cnic'               => 'required',
                    'mdCatPassingYear' => 'required',
                    'selectedExam' => 'required'
                ];
            }
            elseif ($this->selectedExam == 2) {
                $rules += [

                    'satBiologyMarks'    => 'required|numeric|max:800',
                    'satChemistryMarks'  => 'required|numeric|max:800',
                    'satPhyMathMarks'    => 'required|numeric|max:800',
                    'satTestDate'        => 'required',
                    'satUsername'        => 'required',
                    'satPassword'        => 'required',
                    'selectedExam' => 'required'
                ];
            } elseif ($this->selectedExam == 3) {
                $rules += [
                    'ucatBand' => 'required',
                    'ucatObtainedMarks' => 'required|numeric|max:3600',
                    'ucatCandidateId' => 'required',
                    'ucatTestDate' => 'required',
                    'selectedExam' => 'required'
                ];
            } elseif ($this->selectedExam == 4) {
                $rules += [
                    'mcatObtainedMarks'           => 'required|numeric|max:528',
                    'mcatTestDate'  => 'required',
                    'mcatUsername'       => 'required',
                    'mcatPassword'       => 'required',
                    'selectedExam' => 'required'

                ];
            }


        return $rules;
    }

    /*protected function rules(): array
    {
        $rules = [
            'selectedExam' => 'required|numeric',
        ];
        if (!in_array(5, $this->seatCategories)) {

            if ($this->selectedExam == 1 && auth()->user()->program_id == 1) {
                $rules += [
                    'mdCatCnic' => 'required',
                    'mdCatCenter' => 'required',
                    'mdCatPassingYear' => 'required',
                    'mdCatObtainedMarks' => 'required|numeric|max:200|min:110',
                    'cnic' => 'required',
                    'selectedExam' => 'required'
                ];
            } elseif ($this->selectedExam == 1 && auth()->user()->program_id == 2) {
                $rules += [
                    'mdCatCnic' => 'required',
                    'mdCatCenter' => 'required',
                    'mdCatPassingYear' => 'required',
                    'mdCatObtainedMarks' => 'required|numeric|max:200|min:100',
                    'cnic' => 'required',
                    'selectedExam' => 'required'
                ];
            }
            elseif ($this->selectedExam == 1 && auth()->user()->program_id == 3 && auth()->user()->program_priority == 1 || auth()->user()->program_id == 3 && auth()->user()->program_priority == 2) {
                $rules += [
                    'mdCatCnic' => 'required',
                    'mdCatCenter' => 'required',
                    'mdCatPassingYear' => 'required',
                    'mdCatObtainedMarks' => 'required|numeric|max:200|min:110',
                    'cnic' => 'required',
                ];
            }
        } else {
            if ($this->selectedExam == 2) {
                $rules += [
                    'satBiologyMarks' => 'required|numeric|max:800|min:550',
                    'satChemistryMarks' => 'required|numeric|max:800|min:550',
                    'satPhyMathMarks' => 'required|numeric|max:800|min:550',
                    'satTestDate' => 'required',
                    'satUsername' => 'required',
                    'satPassword' => 'required',
                    'selectedExam' => 'required'
                ];
            } elseif ($this->selectedExam == 3) {
                $rules += [
                    'ucatBand' => 'required|numeric|lte:3',
                    'ucatObtainedMarks' => 'required|numeric|max:3600',
                    'ucatCandidateId' => 'required',
                    'ucatTestDate' => 'required',
                    'selectedExam' => 'required'
                ];
            } elseif ($this->selectedExam == 4) {
                $rules += [
                    'mcatObtainedMarks' => 'required|numeric|max:528',
                    'mcatTestDate' => 'required',
                    'mcatUsername' => 'required',
                    'mcatPassword' => 'required',
                    'selectedExam' => 'required'

                ];
            } elseif ($this->selectedExam == 1) {
                if (auth()->user()->program_id == 1) {
                    $rules += [
                        'mdCatCnic' => 'required',
                        'mdCatCenter' => 'required',
                        'mdCatPassingYear' => 'required',
                        'mdCatObtainedMarks' => 'required|numeric|max:200|min:110',
                        'cnic' => 'required',
                        'selectedExam' => 'required'
                    ];
                } elseif (auth()->user()->program_id == 2) {
                    $rules += [
                        'mdCatCnic' => 'required',
                        'mdCatCenter' => 'required',
                        'mdCatPassingYear' => 'required',
                        'mdCatObtainedMarks' => 'required|numeric|max:200|min:100',
                        'cnic' => 'required',
                        'selectedExam' => 'required'
                    ];
                }
                elseif ( auth()->user()->program_id == 3 && auth()->user()->program_priority == 1 || auth()->user()->program_id == 3 && auth()->user()->program_priority == 2) {
                    $rules += [
                        'mdCatCnic' => 'required',
                        'mdCatCenter' => 'required',
                        'mdCatPassingYear' => 'required',
                        'mdCatObtainedMarks' => 'required|numeric|max:200|min:100',
                        'cnic' => 'required',
                    ];
                }
            }
        }
        return $rules;
    }*/

    protected $messages = [
        'mdCatPassingYear.required' => "MDCAT Passing Year is required",
    ];
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
        $this->cnic = auth()->user()?->personalDetails?->cnic_passport;
//        $secondDbData = DB::table('table_results')
//            ->where('cnic', $this->cnic)
//            ->first();
        $admissionTest = auth()->user()->admissionTest;
        if (!empty($admissionTest?->selectedExam))
        {
            $this->selectedExam = $admissionTest->selectedExam;
        }
        else
        {
            $this->selectedExam = 1;
        }
        $this->seatCategories = auth()->user()->seatCategories->pluck('id')->toArray();

//        if ($secondDbData) {
//
//            $this->mdCatCnic = $secondDbData->roll_no;
//
//            $this->mdCatObtainedMarks = $secondDbData->total_score;
//
//        } else {
//            if ($admissionTest) {
//
//            }
//        }

        if ($admissionTest) {
            $this->mdCatCnic = $admissionTest->md_cat_cnic;
            $this->mdCatObtainedMarks = $admissionTest->md_cat_obtained_marks;
            $this->mdCatCenter = $admissionTest->md_catCenter_id;
            $this->mdCatPassingYear = $admissionTest->mdcat_passing_year_id;
            $this->satBiologyMarks = $admissionTest->sat_biology_obtained_marks;
            $this->satChemistryMarks = $admissionTest->sat_chemistry_obtained_marks;
            $this->satPhyMathMarks = $admissionTest->sat_phy_math_obtained_marks;
            $this->satTestDate = $admissionTest->sat_test_date;
            $this->satUsername = $admissionTest->sat_username;
            $this->satPassword = $admissionTest->sat_password;
            $this->ucatBand = $admissionTest->ucat_band;
            $this->ucatObtainedMarks = $admissionTest->ucat_obtained_marks;
            $this->ucatCandidateId = $admissionTest->ucat_candidate_id;
            $this->ucatTestDate = $admissionTest->ucat_test_date;
            //mcat part
            $this->mcatTestDate = $admissionTest->mcat_test_date;
            $this->mcatObtainedMarks = $admissionTest->mcat_obtained_marks;
            $this->mcatUsername = $admissionTest->mcat_username;
            $this->mcatPassword = $admissionTest->mcat_password;
        }
    }

    public function submit()
    {
        $this->validate();
        $this->userServices->updateOrCreateAdmissionTests(
            [
                'id' => auth()->user()->admissionTest?->id,
            ],
            $this->formatAdmissionDetailInfo()
        );

        $this->emit('completeStep', 'step4Completed');
        $this->emit('goToStep', 5);
    }

    /**
     * Summary of getAllInstitutionTypes
     * @return mixed
     */
    public function getAllmdcatCenterProperty()
    {
        return $this->userServices->getAllMdcatCenter();
    }

    public function getAllmdcatPassingYearProperty()
    {
        return $this->userServices->getAllMdcatPassingYear();
    }

    /**
     * @return array
     */
    private function formatAdmissionDetailInfo(): array
    {
        $data = [
            'user_id' => auth()->user()->id,
            'selectedExam' => $this->selectedExam,
            'md_cat_cnic' => $this->mdCatCnic,
            'md_catCenter_id' => $this->mdCatCenter,
            'mdcat_passing_year_id' => $this->mdCatPassingYear ? $this->mdCatPassingYear : 0,
            'md_cat_obtained_marks' => $this->mdCatObtainedMarks,
            'ucat_band' => $this->ucatBand,
            'ucat_obtained_marks' => $this->ucatObtainedMarks,
            'ucat_candidate_id' => $this->ucatCandidateId,
            'ucat_test_date' => $this->ucatTestDate,
            'mcat_obtained_marks' => $this->mcatObtainedMarks,
            'mcat_test_date' => $this->mcatTestDate,
            'mcat_username' => $this->mcatUsername,
            'mcat_password' => $this->mcatPassword,
            // SAT fields initially set to null
            'sat_biology_obtained_marks' => $this->satBiologyMarks,
            'sat_chemistry_obtained_marks' => $this->satChemistryMarks,
            'sat_phy_math_obtained_marks' => $this->satPhyMathMarks,
            'sat_test_date' =>$this->satTestDate,
            'sat_username' => $this->satUsername,
            'sat_password' => $this->satPassword,
        ];

        if ($this->selectedExam == 2) {
            // If selectedExam is 1, nullify fields for selectedExam 2 and 3
            $data['ucat_band'] = null;
            $data['ucat_obtained_marks'] = null;
            $data['ucat_candidate_id'] = null;
            $data['ucat_test_date'] = null;
            $data['mcat_obtained_marks'] = null;
            $data['mcat_test_date'] = null;
            $data['mcat_username'] = null;
            $data['mcat_password'] = null;
            //mdcat
            $data['md_cat_cnic'] = null;
            $data['md_catCenter_id'] = null;
            $data['md_cat_obtained_marks'] = null;
        } elseif ($this->selectedExam == 3) {
            // If selectedExam is 2, nullify fields for selectedExam 1 and 3
            $data['sat_test_date'] = null;
            $data['sat_biology_obtained_marks'] = null;
            $data['sat_chemistry_obtained_marks'] = null;
            $data['sat_phy_math_obtained_marks'] = null;
            $data['sat_password'] = null;
            $data['sat_username'] = null;

            $data['mcat_obtained_marks'] = null;
            $data['mcat_test_date'] = null;
            $data['mcat_username'] = null;
            $data['mcat_password'] = null;
            //mdcat
            $data['md_cat_cnic'] = null;
            $data['md_catCenter_id'] = null;
            $data['md_cat_obtained_marks'] = null;
        } elseif ($this->selectedExam == 4) {
            // If selectedExam is 3, nullify fields for selectedExam 1 and 2
            $data['sat_test_date'] = null;
            $data['sat_biology_obtained_marks'] = null;
            $data['sat_chemistry_obtained_marks'] = null;
            $data['sat_phy_math_obtained_marks'] = null;
            $data['sat_password'] = null;
            $data['sat_username'] = null;
            $data['ucat_band'] = null;
            $data['ucat_obtained_marks'] = null;
            $data['ucat_candidate_id'] = null;
            $data['ucat_test_date'] = null;
            //mdcat
            $data['md_cat_cnic'] = null;
            $data['md_catCenter_id'] = null;
            $data['md_cat_obtained_marks'] = null;
        }
        elseif ($this->selectedExam == 1) {
            // If selectedExam is 3, nullify fields for selectedExam 1 and 2
            $data['sat_test_date'] = null;
            $data['sat_biology_obtained_marks'] = null;
            $data['sat_chemistry_obtained_marks'] = null;
            $data['sat_phy_math_obtained_marks'] = null;
            $data['sat_password'] = null;
            $data['sat_username'] = null;
            $data['ucat_band'] = null;
            $data['ucat_obtained_marks'] = null;
            $data['ucat_candidate_id'] = null;
            $data['ucat_test_date'] = null;

            $data['mcat_obtained_marks'] = null;
            $data['mcat_test_date'] = null;
            $data['mcat_username'] = null;
            $data['mcat_password'] = null;
        }
        return $data;
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.admission-test');
    }
}

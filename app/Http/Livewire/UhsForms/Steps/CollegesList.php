<?php

namespace App\Http\Livewire\UhsForms\Steps;

use App\Models\College;
use App\Services\UserServices\UserServices;
use Livewire\Component;

class CollegesList extends Component
{
    protected $userServices;

    public  $selectedMbbsList = [];

    public $selectedMbbsListForeignerAsOpenMerit = [];

    public $selectedEveningList = [];

    public $selectedMorningList = [];

    public $mbbsTabSelected = true;

    public $message;

    public $agreed;

    /**
     * @return array
     */
    protected function rules(): array
    {
        $user = auth()->user();
        $minRule = $user?->personalDetails?->gender_id == 2 ? 'min:3' : '';
        $rules = [
//            'selectedMbbsList'    => 'required_without:selectedMorningList|array',

            'agreed'             => 'required | accepted',
        ];

        if (auth()->user()->seat_id == 1 || auth()->user()->seat_id == 3)
        {
            $rules += [
                'selectedMorningList'    => "required | array | $minRule",
            ];
        }


        if (auth()->user()->seat_id == 2 || auth()->user()->seat_id == 3)
        {
            $rules += [
                'selectedEveningList'
                => "required | array | $minRule",
            ];
        }

        return $rules;

//        return [
//            'selectedMbbsList'    => 'required_without:selectedMorningList|array',
//            'selectedMorningList'    => 'required_without:selectedMbbsList|array',
//            /*'selectedMbbsList'    => 'required_without:selectedMorningList|array|min:7',
//            'selectedMorningList'    => 'required_without:selectedMbbsList|array|min:5',*/
//            'agreed'             => 'required | accepted',
//        ];

    }

    public function boot(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function mount()
    {
        $user = auth()->user();

//        $mbbsCollegePreferences = $user->mbbsCollegePreferences->pluck('college_pref')->toArray();
//        $mbbsCollegeForeignerAsOpenMeritPreferences = $user->mbbsCollegeForeignerAsOpenMeritPreferences->pluck('college_pref')->toArray();

//        $bdsCollegePreferences = $user->bdsCollegePreferences->pluck('college_pref')->toArray();

        $morningCollegePreferences = $user->morningCollegePreferences->pluck('college_pref')->toArray();

//        $bdsCollegeForeignerAsOpenMeritPreferences = $user->bdsCollegeForeignerAsOpenMeritPreferences->pluck('college_pref')->toArray();

        $eveningCollegePreferences = null;
        $morningEveningCollegePreferences = null;

        if (auth()->user()?->seat_id == 2)
        {
            $eveningCollegePreferences = $user?->eveningCollegePreferences?->pluck('college_pref')->toArray();
        }
        if(auth()->user()?->seat_id == 3)
        {
            $morningEveningCollegePreferences = $user?->morningEveningCollegePreferences?->pluck('college_pref')->toArray();
        }

//        if ($mbbsCollegePreferences) {
//            $data = json_decode($mbbsCollegePreferences[0],true);
//
//            foreach($data as $college){
//                $this->selectedMbbsList[] = (string)$college['name'];
//            }
//        }
//
//        if ($mbbsCollegeForeignerAsOpenMeritPreferences) {
//            $data = json_decode($mbbsCollegeForeignerAsOpenMeritPreferences[0],true);
//
//            foreach($data as $college){
//                $this->selectedMbbsListForeignerAsOpenMerit[] = (string)$college['name'];
//            }
//        }


//        if ($bdsCollegePreferences) {
//            $data = json_decode($bdsCollegePreferences[0],true);
//
//            foreach($data as $college){
//                $this->selectedMorningList[] = (string)$college['name'];
//            }
//        }
//
//        if ($bdsCollegeForeignerAsOpenMeritPreferences) {
//            $data = json_decode($bdsCollegeForeignerAsOpenMeritPreferences[0],true);
//
//            foreach($data as $college){
//                $this->selectedEveningList[] = (string)$college['name'];
//            }
//        }

        if ($morningCollegePreferences) {
            $data = json_decode($morningCollegePreferences[0],true);

            foreach($data as $college){
                $this->selectedMorningList[] = (string)$college['name'];
            }
        }

        if ($eveningCollegePreferences) {
            $data = json_decode($eveningCollegePreferences[0],true);

            foreach($data as $college){
                $this->selectedEveningList[] = (string)$college['name'];
            }
        }

        if ($morningEveningCollegePreferences) {
            $data = json_decode($morningEveningCollegePreferences[0],true);

            foreach($data as $college){
                $this->selectedEveningList[] = (string)$college['name'];
            }
        }

    }
    protected $messages = [
        'selectedMorningList.min' => "You must select at least 5 from the Bds List ",
    ];

    /*public function updatedSelectedMbbsList()
    {

    }*/

    public function resetMbbsListScreen()
    {
        // Reset the selected colleges and any related variables
        $this->selectedMbbsList = [];
    }
    public function resetMbbsListForeignerAsOpenMeritScreen()
    {
        // Reset the selected colleges and any related variables
        $this->selectedMbbsListForeignerAsOpenMerit = [];
    }

    public function resetMorningScreen()
    {
        // Reset the selected colleges and any related variables
        $this->selectedMorningList = [];
    }
    public function resetEveningScreen()
    {
        // Reset the selected colleges and any related variables
        $this->selectedEveningList = [];
    }
    public function getMbbsCollegesProperty()
    {
        return $this->userServices->getMbbsColleges();
    }

    public function getBdsCollegesProperty()
    {
        return $this->userServices->getBdsColleges();
    }
  public function getAllSelectedProperty()
    {
        // Check if all colleges are selected
        $collegeIds = array_column($this->getNursingMorningCollegesProperty()->toArray(), 'id');
        return count($collegeIds) === count($this->selectedMorningList);
    }
    public function getNursingMorningCollegesProperty()
    {

        $user = auth()->user();
        $college = College::query();

        // discipline_id contains ONLY ONE category id
        $category = $user->discipline_id;

        if (!empty($category)) {
            $column = $this->getColumnNameForCategory($category);

            if ($column) {
                $college->where($column, '>', 0);
            }
        }
        return $college->get();
    }

    private function getColumnNameForCategory($category)
    {
        $categoryToColumn = [
            1 => 'lahore',
            2 => 'gujranwala',
            3 => 'hafizabad',
            4 => 'nankana_sahib',
            5 => 'sheikhupura',
            6 => 'multan',
            7 => 'lodhran',
            8 => 'muzaffargarh',
            9 => 'okara',
            10 => 'kasur',
            11 => 'bahawalpur',
            12 => 'rahim_yar_khan',
            13 => 'sialkot',
            14 => 'gujrat',
            15 => 'mandi_bahauddin',
            16 => 'narowal',
            17 => 'dera_ghazi_khan',
            18 => 'rajanpur',
            19 => 'bhakkar',
            20 => 'bahawalnagar',
            21 => 'vehari',
            22 => 'pakpattan',
            23 => 'chakwal',
            24 => 'sargodha',
            25 => 'mianwali',
            26 => 'sahiwal',
            27 => 'khanewal',
            28 => 'toba_tek_singh',
            29 => 'attock',
            30 => 'rawalpindi',
            31 => 'jhelum',
            32 => 'jhang',
            33 => 'faisalabad',
            34 => 'khushab',
            35 => 'chiniot',
            36 => 'layyah',
        ];


        return $categoryToColumn[$category] ?? null;
    }

    public function getNursingEveningCollegesProperty()
    {
        $colleges = College::query();
        $user = auth()->user();
        $gender = $user->personalDetails->gender()->pluck('name')->first();
        if ($gender == 'Male' || $gender == 'Other') {
            $colleges->where('isFemale', 0);
        }
        else
        {
            $colleges->where('isFemale', 1);
        }

        // Seat-based filter: show evening colleges only for seat_id 2 or 3
        if (!in_array($user->seat_id, [2, 3])) {
            $colleges->where('is_evening', 0);
        }

        return $colleges->get();
    }






    public function reorderMbbsList($fromIndex, $toIndex)
    {
        $fromValue = $this->selectedMbbsList[$fromIndex];
        $toValue = $this->selectedMbbsList[$toIndex];


        $this->selectedMbbsList[$fromIndex] = $toValue;
        $this->selectedMbbsList[$toIndex] = $fromValue;
        
    }

    public function reorderMbbsListForeignerAsOpenMerit($fromIndex, $toIndex)
    {
        $fromValue = $this->selectedMbbsListForeignerAsOpenMerit[$fromIndex];
        $toValue = $this->selectedMbbsListForeignerAsOpenMerit[$toIndex];


        $this->selectedMbbsListForeignerAsOpenMerit[$fromIndex] = $toValue;
        $this->selectedMbbsListForeignerAsOpenMerit[$toIndex] = $fromValue;

    }

    public function reorderBdsList($fromIndex, $toIndex)
    {
        $fromValue = $this->selectedMorningList[$fromIndex];
        $toValue = $this->selectedMorningList[$toIndex];

        $this->selectedMorningList[$fromIndex] = $toValue;
        $this->selectedMorningList[$toIndex] = $fromValue;
    }

    public function reorderBdsListForeignerAsOpenMerit($fromIndex, $toIndex)
    {
        $fromValue = $this->selectedEveningList[$fromIndex];
        $toValue = $this->selectedEveningList[$toIndex];


        $this->selectedEveningList[$fromIndex] = $toValue;
        $this->selectedEveningList[$toIndex] = $fromValue;

    }

    private function calculateAggregate()
    {
        $qualifications = auth()->user()->qualifications;
        $admissionTest = auth()->user()->admissionTest;

        $sscObtainedMarks = $qualifications->ssc_marks_obtained;
        $hsscObtainedMarks = $qualifications->hssc_marks_obtained;

        $mdCatObtainedMarks = $admissionTest->md_cat_obtained_marks;

        $programId = auth()->user()->program_id;

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


    private function calculateOverseasAggregate()
    {


        $qualifications = auth()->user()->qualifications;
        $admissionTest = auth()->user()->admissionTest;

        $sscObtainedMarks = $qualifications->ssc_marks_obtained;
        $hsscObtainedMarks = $qualifications->hssc_marks_obtained;

        $mCatObtainedMarks = $admissionTest->mcat_obtained_marks;
        $mdCatObtainedMarks = $admissionTest->md_cat_obtained_marks;
        $uCatObtainedMarks = $admissionTest->ucat_obtained_marks;
        $satObtainedMarks = ($admissionTest->sat_biology_obtained_marks * 0.40) +
            ($admissionTest->sat_chemistry_obtained_marks * 0.35) +
            ($admissionTest->sat_phy_math_obtained_marks * 0.25);

        $programId = auth()->user()->program_id;

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


    public function submit()
    {
        $user = auth()->user();
//        $this->saveMbbsList();
//        $this->saveMbbsListForeignAsOpenMerit();
 if (!$this->allSelected) {
            $this->addError('selectedMorningList', 'Please Select ' . count($this->getNursingMorningCollegesProperty()->toArray()) . ' Colleges');
            return;
        }
        $this->saveMorningList();
        if($user->seat_id == 2)
        {
        $this->saveEveningList();
        }

        if ($user->seat_id == 3)
        {
        $this->saveMorningEveningList();
        }
        // $this->userServices->updateUser([
            //     'aggregate' => $this->calculateAggregate(),
            //     'aggregate_overseas' => $this->calculateOverseasAggregate(),

            // ], auth()->user()->id);

        $this->emit('completeStep', 'step5Completed');
        $this->emit('goToStep', 6);
    }

    private function saveMbbsList(){

        $this->validateOnly('selectedMbbsList');
        if(! empty($this->selectedMbbsList))
        {
            foreach($this->selectedMbbsList as $key => $college){
                $data[] = ['id' => $key + 1, 'name' => $college];
            }

            $this->userServices->updateOrCreateCollegePreference([
                'id' => ! blank(auth()->user()->mbbsCollegePreferences) ? auth()->user()->mbbsCollegePreferences[0]->id : null
            ],
                [
                'college_pref' => json_encode($data),
                'user_id' => auth()->user()->id,
//                'is_mbbs' => true,
                'is_foreigner' => boolval(auth()->user()->foreigner),
            ]);
        }
    }

    private function saveMbbsListForeignAsOpenMerit(){


        $this->validateOnly('selectedMbbsListForeignerAsOpenMerit');
        if(! empty($this->selectedMbbsListForeignerAsOpenMerit))
        {
            foreach($this->selectedMbbsListForeignerAsOpenMerit as $key => $college){
                $data[] = ['id' => $key + 1, 'name' => $college];
            }

            $this->userServices->updateOrCreateCollegePreference([
                'id' => ! blank(auth()->user()->mbbsCollegeForeignerAsOpenMeritPreferences) ? auth()->user()->mbbsCollegeForeignerAsOpenMeritPreferences[0]->id : null
            ],
                [
                    'college_pref' => json_encode($data),
                    'user_id' => auth()->user()->id,
//                    'is_mbbs' => true,
//                    'is_open_merit_seat' => boolval(auth()->user()->is_open_merit),
//                    'is_foreigner' => boolval(auth()->user()->foreigner),
                ]);
        }
    }

    private function saveMorningList(){
        $this->validateOnly('selectedMorningList');
        if(! empty($this->selectedMorningList))
        {
            foreach($this->selectedMorningList as $key => $college){
                $data[] = ['id' => $key + 1, 'name' => $college];
            }

            $this->userServices->updateOrCreateCollegePreference([
                'id' => ! blank(auth()->user()->morningCollegePreferences) ? auth()->user()->morningCollegePreferences[0]->id : null
            ],
                [
                    'college_pref' => json_encode($data),
                    'user_id' => auth()->user()->id,
                ]);
        }
    }

    private function saveEveningList(){


        $this->validateOnly('selectedEveningList');
        if(! empty($this->selectedEveningList))
        {
            foreach($this->selectedEveningList as $key => $college){
                $data[] = ['id' => $key + 1, 'name' => $college];
            }

            $this->userServices->updateOrCreateCollegePreference([
                'id' => ! blank(auth()->user()->eveningCollegePreferences) ? auth()->user()->eveningCollegePreferences[0]->id : null
            ],
                [
                    'college_pref' => json_encode($data),
                    'user_id' => auth()->user()->id,
                    'both_seat' => 0,
                    'is_evening' => 1,
                ]);
        }
    }

    private function saveMorningEveningList(){


        $this->validateOnly('selectedEveningList');
        if(! empty($this->selectedEveningList))
        {
            foreach($this->selectedEveningList as $key => $college){
                $data[] = ['id' => $key + 1, 'name' => $college];
            }

            $this->userServices->updateOrCreateCollegePreference([
                'id' => ! blank(auth()->user()->morningEveningCollegePreferences) ? auth()->user()->morningEveningCollegePreferences[0]->id : null
            ],
                [
                    'college_pref' => json_encode($data),
                    'user_id' => auth()->user()->id,
                    'both_seat' => 1,
                    'is_evening' => 1,
                ]);
        }
    }

    public function removeMbbsCollege($index){
        if (isset($this->selectedMbbsList[$index])) {
            unset($this->selectedMbbsList[$index]);
        }
        $this->selectedMbbsList = array_values($this->selectedMbbsList);
        $this->emit('refresh');
    }

    public function removeMbbsForeignerAsOpenMeritCollege($index){
        if (isset($this->selectedMbbsListForeignerAsOpenMerit[$index])) {
            unset($this->selectedMbbsListForeignerAsOpenMerit[$index]);
        }
        $this->selectedMbbsListForeignerAsOpenMerit = array_values($this->selectedMbbsListForeignerAsOpenMerit);
        $this->emit('refresh');
    }

    public function removeMorningColleges($index){
        if (isset($this->selectedMorningList[$index])) {
            unset($this->selectedMorningList[$index]);
        }
        $this->selectedMorningList = array_values($this->selectedMorningList);
        $this->emit('refresh');
    }

    public function removeEveningColleges($index){
        if (isset($this->selectedEveningList[$index])) {
            unset($this->selectedEveningList[$index]);
        }
        $this->selectedEveningList = array_values($this->selectedEveningList);
        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.colleges-list');
    }
}

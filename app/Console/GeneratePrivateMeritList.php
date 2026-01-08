<?php

namespace App\Console;

use Illuminate\Console\Command;

use App\Models\User;
use App\Models\Qualification;
use App\Models\AdmissionTest;
use App\Models\SeatCategoryUser;
use App\Models\CollegePreference;
use App\Models\College;
use App\Models\PersonalDetail;
use App\Models\CollegeSeatsAvailableQuota;
use App\Models\MeritList;
use App\Models\MeritListDetail;
use DB;

class GeneratePrivateMeritList extends Command
{
    protected $signature = 'private-meritlistgen';
    /**
     * The console command description.
     *  
     * @var string
     */
    protected $description = 'Create merit list (Open merit only)';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*
    * @param  UserServices  $userServices
    * @return void
    */
//    public function boot(UserServices $userServices): void
//    {
       
//    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        // dd("Update Script");
        $id = $this->ask("Merit list ID: ");
        // dd($id);
        $this->createNewMeritList($id);
        // $this->testingMeritUhsData();
    }

    public function createNewMeritList(int $meritReportId,?int $year=null, ?int $college_id=null)
    {   
        // Models
        $collegeModel = new College;
        $meritList = new MeritList;
        $meritListDetilas = new MeritListDetail();
        
        $collegeData =  $collegeModel->get()->toArray();
        // last merit list id this year
        // $lastMeritReportId = $meritList->where('merit_report_id',$meritReportId)
        // ->value('merit_report_id');

        $year = (($year!=0) ? $year : date('Y')); 
        
        //If meritListReportID exists then return
        // $previousMeritListId = $meritList->where('merit_report_id',($meritReportId-1))
        //                                 ->where('year',$year)
        //                                 ->value('id');

        $meritListId = $meritList->where('merit_report_id',$meritReportId)
                                        ->where('year',$year)
                                        ->value('id');

        echo "Testing Merit List"."\n\r";
        // echo $meritListData;

        // set default year to current year 
        // if($previousMeritListId){
        if($meritListId){
            $report  = $this->getMeritReport($meritListId, $year ,(isset($college_id) ? $college_id: null));
            echo "Old Report Available";
            dd($report);
            // return $report;
        } 
        else 
        {
            $currentMeritListId = $meritList->insertGetId(['name'=>'Merit List ','merit_report_id'=> $meritReportId,'year'=>date('Y')]);
            // $currentMeritListId = 2; //only for testing

            // if it is first meritList Report then collegeAllowedRemainingSeats need to coppied form Colleges Table
            // echo "<br>loading available colleges ... ";
            $this->updateCollegeSeatsQuota($currentMeritListId,$year);            
            
            // dd($availableSeats);
            

            // dd("Available Seats Updated");
            
            //Custom Function to test the UHS given data 
            $response = $this->testingMeritUhsData($currentMeritListId);
            
            // Saving meritlist data
            $meritListDetilas->insert($response['selectedMeritList']);

        }

    }

    /**
     *  getMeritReportId() will return Merit Report ID 
     *  @$meritListId : merit_list_id from merit_list table 
     */
    private function getMeritReportId(int $meritListId)
    {
        $meritList = new MeritList;
        $reportid =  $meritList->where('id',$meritListId)->value('merit_report_id');
        return $reportid;
    }


    private function validateApplicant(array $arrData ,int $applicantId, int $meritListReportId,int $year){
        // echo "<br>. Validating Data: ".print_r($arrData,true);  
        $meritList = new MeritList;
        $meritListDetails = new MeritListDetail;

        // if($meritListReportId==1) {return 1; }

        $previous_meritlist_id = $meritList->where('merit_report_id',($meritListReportId-1))
                                            ->where('year',$year)
                                            ->value('id');

        // dd("Previous : ".$previous_meritlist_id);
        if($previous_meritlist_id){ //if previous meritlist not found return 0 otherwise look for student
            $meritListOldData = $meritListDetails->where('user_id',$applicantId)
                                                ->where('merit_list_id',$previous_meritlist_id)
                                                ->where('admission_status',1) 
                                                ->get();
            // dd("Previous MeritList Data : ".$meritListOldData);
            foreach($meritListOldData as $meritListOld){
                // echo "<br>Compairing ";
                // echo "<br>-------> ".$arrData['college_id'] . " == " . $meritListOld->college_id  ;
                // echo "<br>-------> ".$arrData['seat_categories_id'] . '==' . $meritListOld->seat_categories_id  ;

                if($arrData['college_id'] == $meritListOld->college_id || $arrData['seat_categories_id'] == $meritListOld->seat_categories_id){
                    // echo "<br>-------Return False 1";
                    return false;
                } else {
                    // echo "<br> Upgrading from : " . $meritListOld->college_id . " Seat Cat : ". $meritListOld->seat_categories_id;
                    // echo "<br> Upgrading To : " . $arrData['college_id'] .", ". $arrData['seat_categories_id'] ;
                    // // dd("data found return 1");
                    // echo "<br>-------Status changed";

                    return true;
                }
            }
        } else {
            // echo "<br>-------Return False 2";
            return false;
        }
    }

    public function updateCollegeSeatsQuota(int $currentMeritListId, int $year){
        
        $collegeModel = new College;
        $eduModel = new Qualification;
        $admTestModel = new AdmissionTest;
        $collPrefModel = new CollegePreference;
        $userSeatModel =  new SeatCategoryUser;
        $collegeAvailableQuota = new CollegeSeatsAvailableQuota;
        $meritList = new MeritList;
        $meritListDetails = new MeritListDetail;

        $collegeData =  $collegeModel->get()->toArray();

        $meritListReportId = $this->getMeritReportId($currentMeritListId);
        
        // dd("Previous Merit Report ID ".$meritListReportId);
        
        echo "<br> UpdateCollegeSeatQuota for List ".$meritListReportId."<br>";
        if($meritListReportId==1){
            $availableSeats = [];
            foreach($collegeData as $college){
                // echo $college['id'];
                $availableSeats[] = ['college_id'      => $college['id'],
                                    'merit_list_id'    => $currentMeritListId,
                                    'openMeritSeats'   => $college['openMeritSeats'],
                                    'overSeasSeats'    => $college['overSeasSeats'],
                                    'disabilitySeats'  => $college['disabilitySeats'],
                                    'cholistanSeats'   => $college['cholistanSeats'],
                                    'isReciprocal'     => $college['isReciprocal'],
                                    'underDevelopArea' => $college['underdevelopedAreas'],
                ];
            }
            $collegeAvailableQuota = new CollegeSeatsAvailableQuota;
            $collegeAvailableQuota->insert($availableSeats);
               
        } else {
            //calulate available seats from MeritList_details Table and update College_allowed_seate_quota Table
            //RAW Query 
            //select mld.college_id, mld.seat_categories_id, count(mld.seat_categories_id) from merit_list_details mld group by mld.college_id ,mld.seat_categories_id; 

            //Eloquent Query
            $arrSeats = array(1=>'openMeritSeats',2=>'overSeasSeats',3=>'disabilitySeats',4=>'cholistanSeats',5=>'isReciprocal',6=>'underDevelopArea');
            // get previous list

            // $previous_meritlist_id = $meritList->where('merit_report_id',($meritListReportId-1))
            //                                     ->where('year',$year)
            //                                     ->value('id');
            
            $previousMeritListId = $meritList->where('merit_report_id',$meritListReportId-1)
                                                ->where('year',$year)
                                                ->orderByDesc('id')
                                                ->value('id');

            $result = DB::table(DB::raw('(
                                        SELECT
                                            mld.college_id,
                                            IFNULL(SUM(CASE WHEN mld.seat_categories_id = 1 THEN 1 ELSE 0 END), 0) AS openMeritSeats,
                                            IFNULL(SUM(CASE WHEN mld.seat_categories_id = 2 THEN 1 ELSE 0 END), 0) AS disabilitySeats,
                                            IFNULL(SUM(CASE WHEN mld.seat_categories_id = 3 THEN 1 ELSE 0 END), 0) AS overSeasSeats,
                                            IFNULL(SUM(CASE WHEN mld.seat_categories_id = 4 THEN 1 ELSE 0 END), 0) AS cholistanSeats,
                                            IFNULL(SUM(CASE WHEN mld.seat_categories_id = 5 THEN 1 ELSE 0 END), 0) AS isReciprocal,
                                            IFNULL(SUM(CASE WHEN mld.seat_categories_id = 6 THEN 1 ELSE 0 END), 0) AS underDevelopArea
                                        FROM merit_list_details mld
                                        WHERE mld.admission_status = 0
                                            AND mld.merit_list_id = '.$previousMeritListId.'
                                        GROUP BY mld.college_id
                                        UNION ALL
                                        SELECT
                                            csaq.college_id,
                                            csaq.openMeritSeats,
                                            csaq.disabilitySeats,
                                            csaq.overSeasSeats,
                                            csaq.cholistanSeats,
                                            csaq.isReciprocal,
                                            csaq.underDevelopArea
                                        FROM college_seats_available_quotas csaq
                                        WHERE merit_list_id = '.$previousMeritListId.'
                                    ) AS subquery'))
                                    ->select([
                                        'college_id',
                                        DB::raw('SUM(openMeritSeats) AS openMeritSeats'),
                                        DB::raw('SUM(disabilitySeats) AS disabilitySeats'),
                                        DB::raw('SUM(overSeasSeats) AS overSeasSeats'),
                                        DB::raw('SUM(cholistanSeats) AS cholistanSeats'),
                                        DB::raw('SUM(isReciprocal) AS isReciprocal'),
                                        DB::raw('SUM(underDevelopArea) AS underDevelopArea'),
                                    ])
                                    ->groupBy('college_id')
                                    ->get();
            
            foreach ($result as $row) {
                $collegeAvailableQuota->insert([
                    'college_id' => $row->college_id,
                    'merit_list_id' => $meritListReportId,
                    'openMeritSeats' => $row->openMeritSeats,
                    'disabilitySeats' => $row->disabilitySeats,
                    'overSeasSeats' => $row->overSeasSeats,
                    'cholistanSeats' => $row->cholistanSeats,
                    'isReciprocal' => $row->isReciprocal,
                    'underDevelopArea' => $row->underDevelopArea,
                    // You might want to set other columns as well if they are required
                ]);
            }
  
        }

    }

    //updated List
    private function updateCollegeAvailabeSeats($qty, $seat,$college_id,$meritListReportId)
    {
        $collegeAvailableQuota = new CollegeSeatsAvailableQuota;
        $collegeAvailableQuota->where('college_id',$college_id)
                                ->where('merit_list_id',$meritListReportId)
                                ->update([$seat=>$qty]);

    } 

    // Single merit list with entire flow [tested]
    public function testingMeritUhsData($meritlist_id = 1){
        /**
         * Rules:
         * BDS Selection : Aggregation > 50
         * MBBS Selection: Aggregation > 55
         * ----------------
         * Seats will be alloted based on Max Aggregation, 
         * if tie in aggregate then date of birth
         * if tie in date of birth then MDCAT obtained Marks
         * if tie in MDCAT then HSSC obtained marks
         * if tie in HSSC then SSC obtained
         * if tie in SSC then Application submittion date
         * ----------------
         * Seat selection will be based on availability of the seat in user preffered colleges list,
         * Seat catagory merit order as given bellow 
         * 1    openMeritSeats      (Considered as highest merit)
         * 2    disabilitySeats
         * 3    underDevelopArea
         * 4    cholistanSeats
         * 5    overSeasSeats
         * 6    isReciprocal
         * ----------------
         * if 1st merit list and
         *      if applicant applied on OpenMerit and Overseas,
         *      if overseas_aggregation > general_aggregation
         *      assign Overseas Seat
         * If not 1st merit list
         *      above student coud be 
         *       
         * 
         */

        // Models
        $userModel = new User;
        $personalModel = new PersonalDetail;
        $collegeModel = new College;
        $eduModel = new Qualification;
        $admTestModel = new AdmissionTest;
        $collPrefModel = new CollegePreference;
        $userSeatModel =  new SeatCategoryUser;
        $collegeAvailableQuota = new CollegeSeatsAvailableQuota;
        $meritListDetails = new MeritListDetail;
        $meritList = new MeritList;

        $defaultPassingAggregate = 50;
        
        $openPassMarks = [0=>50,1=>55];
        // $overseasPassMarks = [0=>50,1=>55];

        $selectedMeritList =[]; //Outpu data 
        $selectedApplicants = []; //selected Candidates will be added to this array to restrict duplicate selection  
        $csvData = [];

        //previous meritlist
        $year = ((isset($year)) ? $year : date('Y'));
        if($meritlist_id>1){
            $previous_meritlist_id = $meritList->where('merit_report_id',($meritlist_id-1))
                                                ->where('year',$year)
                                                ->value('id');
        }else {
            $previous_meritlist_id = $meritlist_id;
        }
        $csvColumns = array('id','aggregate');
        $uersData = $userModel->select(DB::raw('DISTINCT users.id'),'users.mobile_number','users.status','users.name','users.father_name','users.transaction_id','users.aggregate','users.aggregate_overseas','pd.gender_id','users.program_id','users.program_priority','pd.date_of_birth','at2.md_cat_cnic','at2.md_cat_obtained_marks','q.ssc_total_marks','q.ssc_marks_obtained','q.hssc_total_marks','q.hssc_marks_obtained','users.submitted_at','users.foreigner','pd.cnic_passport','pd.cnic_passport_id','d.name as district', 'ra.name as area', 'n.name as natinality' , 'users.comments' , 'users.status'
        ) 
                            ->leftjoin('personal_details as pd','pd.user_id','=','users.id')
                            ->leftjoin('admission_tests as at2', 'at2.user_id','=' ,'users.id')
                            ->leftjoin('qualifications as q', 'q.user_id', '=' ,'users.id')
                            ->leftjoin('districts as d','d.id','=','pd.district_id') //district
                            ->leftjoin('nationalities as n','n.id','=','pd.nationality_id') //nationality
                            ->leftjoin('residence_areas as ra','ra.id','=','pd.residence_area_id') //Area
                            ->whereNotNull('users.transaction_id')
                            ->whereNotNull('q.ssc_marks_obtained')
                            ->whereNotNull('q.hssc_marks_obtained')
                            ->orderBy('users.aggregate','desc')
                            ->orderBy('pd.date_of_birth')
                            ->orderByDesc('at2.md_cat_obtained_marks','desc')
                            ->orderByDesc('q.hssc_marks_obtained','desc')
                            ->orderByDesc('q.ssc_marks_obtained','desc')
                            ->orderBy('users.submitted_at')
                            ->limit(10);
                            // ->get();
        dd($uersData->toSql());
        $arrSeats = array(1=>'openMeritSeats',2=>'disabilitySeats',3=>'underDevelopArea',4=>'cholistanSeats',5=>'overSeasSeats',6=>'isReciprocal');
        
        $j=1;
        echo "\n\r"." Starting Advance";
        foreach($uersData as $applicant){           // Loop 1
            $csvDataRow = [];
            $csvDataRow['id'] = $applicant->id;
            $csvDataRow['name'] =  $applicant->name;
            $csvDataRow['father_name'] = $applicant->father_name;
            $csvDataRow['cnic'] = $applicant->cnic_passport;
            $csvDataRow['mobile_number'] = $applicant->mobile_number;
            switch($applicant->gender_id){
                case 1: { $csvDataRow['gender'] = 'Male'; break; }
                case 2: { $csvDataRow['gender'] = 'Female'; break; }
                case 3: { $csvDataRow['gender'] = 'Other'; break;}
            }

            $csvDataRow['transaction_id'] = $applicant->transaction_id;
            $csvDataRow['aggregate'] = $applicant->aggregate;
            $csvDataRow['aggregate_overseas'] = $applicant->aggregate_overseas;
            switch($applicant->program_id){
                case 1: { $csvDataRow['program'] = 'MBBS'; break; }
                case 2: { $csvDataRow['program'] = 'BDS'; break; }
                case 3: { $csvDataRow['program'] = 'MBBS & BDS'; break;}
            }
            
            $csvDataRow['priority'] = ($applicant->program_priority==1 ? 'MBBS' : 'BDS');
            $csvDataRow['date_of_birth'] = $applicant->date_of_birth;
            $csvDataRow['ssc_total_marks'] = $applicant->ssc_total_marks;
            $csvDataRow['ssc_marks_obtained'] = $applicant->ssc_marks_obtained;
            $csvDataRow['hssc_total_marks'] = $applicant->hssc_total_marks;
            $csvDataRow['hssc_marks_obtained'] = $applicant->hssc_marks_obtained;

            $csvDataRow['submitted_at'] = $applicant->submitted_at;
            $csvDataRow['md_cat_cnic'] = $applicant->md_cat_cnic;
            $csvDataRow['md_cat_obtained_marks'] = $applicant->md_cat_obtained_marks;
            $csvDataRow['status'] = $applicant->status; 
            // echo "\n\r".$j++;
            echo "\n\r"." ---------------------------------------------------------------------------------------------------------------------------------------------------- ". $j++;
            
            echo "\n\r"." Application ID : " .print_r($applicant->id,true);
        
            // $aggregation = $applicant->grossAggregate;

            // echo "\n\r"."| Aggregated : " .print_r($aggregation,true);
            //Looking for Applicant prefered Colleges based on there priorty
            // If priorty is mbbs then $arrCollPref->is_mbbs =1 shoud diplay first otherwise
            // echo "\n\r"."| Prior program : ". $applicant->program_priority;

            if($applicant->program_priority==1){
                $arrCollPref = $collPrefModel->where('user_id',$applicant->id)
                                            ->orderBy('is_mbbs','desc')
                                            ->get(); // mbbs priority 
            } else {
                $arrCollPref = $collPrefModel->where('user_id',$applicant->id)
                                            ->orderBy('is_mbbs','asc')
                                            ->get(); // bds priority
            }
            
            $pid= 1;
            foreach($arrCollPref as $collPref){         // Loop 2
                $prefjson = json_decode($collPref['college_pref'],true);
                // // current applicant prefered colleges ,  //Maping applicant prefered colleges
                // echo "\n\r"."| Program : ".(($collPref->is_mbbs) ? 'MBBS' : "BDS");
                foreach($prefjson as $preferedCollege){     // Loop 3
                    $csvDataRow['pref_'.$pid] = $preferedCollege['name'];
                    echo "\n\r"."||---> Priority : ".$pid; 
                    $pid++;
                    // echo "\n\r"."|| -------> College  : ". $preferedCollege['name'] . " for ". (($collPref['is_mbbs']==1) ? 'MBBS' : 'BDS') ;
                    // dd($preferedCollege);
                    if ($applicant->gender_id!=2 && $this->collegeIsFemale($preferedCollege['name']) == 1){
                        echo "\n\r"."| ->>> Gender Missmatch ".print_r($this->collegeIsFemale($preferedCollege['name']),true);
                        continue 2;
                    }

                    // Looking for Available specific Seats in Selected Current College
                    $collegeAvailableQuotas = $collegeAvailableQuota->select('college_seats_available_quotas.openMeritSeats',
                                                                                'college_seats_available_quotas.overSeasSeats',
                                                                                'college_seats_available_quotas.disabilitySeats',
                                                                                'college_seats_available_quotas.cholistanSeats',
                                                                                'college_seats_available_quotas.isReciprocal',
                                                                                'college_seats_available_quotas.underDevelopArea',
                                                                                'colleges.isFemale',
                                                                                'colleges.id',
                                                                                'colleges.name'
                                                                                )
                                                                    ->join('colleges','colleges.id','=','college_id')
                                                                    ->where('colleges.name',$preferedCollege['name'])
                                                                    ->where('merit_list_id',$previous_meritlist_id)
                                                                    ->get()
                                                                    ->toArray();
                    // dd($collegeAvailableQuotas);
                    // $arrAvailableQuota = [];
                    // foreach($collegeAvailableQuotas as $availableQuota){
                    //     $arrAvailableQuota = $availableQuota;
                    // }
                    $arrAvailableQuota = $collegeAvailableQuotas[0];
                    //checking if applicant pass the minimum selection criteria mbbs >= 55 & bds = 50
                    
                    if($collPref['is_mbbs'] == 1 && ($applicant->program_id==1 || ($applicant->program_id==3 && $applicant->priority_id=1))) {
                        $selection_status = "MBBS Potantial Candidate";
                    }elseif($collPref['is_mbbs'] == 0  && ($applicant->program_id==2 || ($applicant->program_id==3 && $applicant->priority_id=2))) {
                        $selection_status = "BDS Potantial Candidate";
                    } else {
                        $selection_status = "Droping...";
                        // break ;
                    }
                    $minPassMarks = $openPassMarks[$collPref['is_mbbs']]; // Minimum Passing marks according to the Selected College Mode 1 MBBS 2 BDS
                    // echo "\n\r"."|| ----------> Selection Status : ". $selection_status;

                    // Looping through Applicant selected seats
                    // for private college only
                    if($applicant->foreigner==0){
                        $userSeatData[0] = ['user_id'=>$applicant->id,'seat_category_id'=>1];
                        $csvDataRow['openMeritSeats']="Yes";
                        $csvDataRow['foreigner']="No";
                    }else{
                        $userSeatData[0] = ['user_id'=>$applicant->id,'seat_category_id'=>1]; //There are no overseas seats, applicats for foreigner seats will be adjusted in openmerit category. 
                        $csvDataRow['openMeritSeats']="No";
                        $csvDataRow['foreigner']="Yes";
                    }
                    // echo "Applicant Applied Seats Quota";
                    // dd($userSeatData);
                    $i = 1;
                    $selectedMeritItem = [];
                    $allocated = false;
                    foreach($userSeatData as $userSeat)                 // Loop 4
                    {
                        $currentSeat = $arrSeats[$userSeat['seat_category_id']];
                        // echo "\n\r"."|| ----------> Seat : ".print_r($currentSeat,true);
                        if($userSeat['seat_category_id']==5){
                            $aggregatedPercentile =   $applicant->aggregate_overseas;
                        } else {
                            $aggregatedPercentile =   $applicant->aggregate;
                        }
                        // check current seat quota 
                        // echo "<br>".print_r($arrAvailableQuota,true);
                        $admission_status  =  (rand(1,10)-rand(1,10)==0) ? 0 : 1 ;
                        
                        // if($applicant->foreigner==0){
                        //     $csvDataRow['openMeritSeats']="Yes";
                        //     $csvDataRow['foreigner']="No";
                        // }else{
                        //     $csvDataRow['openMeritSeats']="No";
                        //     $csvDataRow['foreigner']="Yes";
                        // }
                        if ($arrAvailableQuota[$currentSeat] > 0){
                            // if selected seat is open merit based 
                            if($aggregatedPercentile >= $minPassMarks){
                                $selectedMeritItem=['user_id' => $applicant->id,
                                                    // 'aggregate'          => $applicant->aggregate,
                                                    'aggregate'          => $aggregatedPercentile,
                                                    // 'college_id'         => $preferedCollege['id'],
                                                    'college_id'         => $arrAvailableQuota['id'],
                                                    'seat_categories_id' => $userSeat['seat_category_id'],
                                                    'merit_list_id'      => $meritlist_id,
                                                    'admission_status'   => $admission_status,
                                                ];
                                $csvMeritItem=['user_id' => $applicant->id,
                                                // 'aggregate'          => $applicant->aggregate,
                                                'aggregate'          => $aggregatedPercentile,
                                                // 'college_id'         => $preferedCollege['id'],
                                                'college_id'         => $arrAvailableQuota['id'],
                                                'college_name'         => $arrAvailableQuota['name'],
                                                'seat_categories_id' => $userSeat['seat_category_id'],
                                                'merit_list_id'      => $meritlist_id,
                                                'admission_status'   => $admission_status,
                                            ];
                            }
                            // dd($selectedMeritItem);
                            // echo "\n\r"."||| **********> Applied on : ".$currentSeat . " and available"."\n\r"; 
                            if(!in_array($applicant->id,$selectedApplicants) && !empty($selectedMeritItem) ){
                                // echo "\n\r"."||| ===========> <b>Application ".$selectedMeritItem['user_id']." Selected on the Seat ".$selectedMeritItem['seat_categories_id']. " College :". $selectedMeritItem['college_id']."\n\r";
                                $selectedApplicants[] = $applicant->id ;
                                $selectedMeritList[] = $selectedMeritItem;
                                $arrAvailableQuota[$currentSeat] -=1;
                                $this->updateCollegeAvailabeSeats($arrAvailableQuota[$currentSeat],$currentSeat,$arrAvailableQuota['id'],$meritlist_id);
                                $csvDataRow['selected_college_id']   = (isset($csvMeritItem['college_id']) ? $csvMeritItem['college_id'] : '');
                                $csvDataRow['selected_college_name'] = (isset($csvMeritItem['college_name']) ? $csvMeritItem['college_name'] : '');
                                $csvDataRow['selected_seat']         = (isset($csvMeritItem['seat_categories_id']) ? $csvMeritItem['seat_categories_id'] : '');
                                $csvDataRow['merit_list_id']         = (isset($csvMeritItem['merit_list_id']) ? $csvMeritItem['merit_list_id'] : '');
                                $csvDataRow['user_id']               = (isset($csvMeritItem['user_id']) ? $csvMeritItem['user_id'] : '');
                                if($meritlist_id==1){
                                    // break 2;
                                    $allocated = true;
                                }
                            }
                        } 
                    }
                    if($allocated){
                        // break 3;
                    }
                }
            }
            $csvData[] = $csvDataRow;
        }
        $filename = "private_college_pref_".$meritlist_id.".csv";
        $handle = fopen($filename, 'w');
        
        fputcsv($handle,[
            'id',
            'name',
            'father_name',
            'cnic',
            'gender',
            'mobile_number',
            'transaction_id',
            'program',
            'priority',
            'date_of_birth',
            'ssc_total_marks',
            'ssc_marks_obtained',
            'hssc_total_marks',
            'hssc_marks_obtained',
            'md_cat_cnic',
            'md_cat_obtained_marks',
            'submitted_at',
            'aggregate',
            'aggregate_overseas',
            'openMeritSeats',
            'foreigner',
            'status',
            'comments',
            'pref_1',
            'pref_2',
            'pref_3',
            'pref_4',
            'pref_5',
            'pref_6',
            'pref_7',
            'pref_8',
            'pref_9',
            'pref_10',
            'pref_11',
            'pref_12',
            'pref_13',
            'pref_14',
            'pref_15',
            'pref_16',
            'pref_17',
            'pref_18',
            'pref_19',
            'pref_20',
            'pref_21',
            'pref_22',
            'pref_23',
            'pref_24',
            'pref_25',
            'pref_26',
            'pref_27',
            'pref_28',
            'pref_29',
            'pref_30',
            'pref_31',
            'pref_32',
            'pref_33',
            'pref_34',
            'pref_35',
            'pref_36',
            'pref_37',
            'pref_38',
            'pref_39',
            'pref_40',
            'pref_41',
            'pref_42',
            'pref_43',
            'pref_44',
            'pref_45',
            'pref_46',
            'pref_47',
            'pref_48',
            'pref_49',
            'selected_college_id',
            'selected_college_name',
            'selected_seat',
            'meritlist_id',
            'user_id',

        ]);
        foreach($csvData as $row){
            fputcsv($handle,[
                    $row['id'],
                    $row['name'],
                    $row['father_name'],
                    $row['cnic'],
                    $row['gender'],
                    $row['mobile_number'],
                    $row['transaction_id'],
                    $row['program'],
                    $row['priority'],
                    $row['date_of_birth'],
                    $row['ssc_total_marks'],
                    $row['ssc_marks_obtained'],
                    $row['hssc_total_marks'],
                    $row['hssc_marks_obtained'],
                    $row['md_cat_cnic'],
                    $row['md_cat_obtained_marks'],
                    $row['submitted_at'],
                    $row['aggregate'],
                    $row['aggregate_overseas'],
                    (isset($row['openMeritSeats']) ? $row['openMeritSeats'] : ''),
                    (isset($row['foreigner']) ? $row['foreigner'] : ''),
                    (isset($row['status']) ? $row['status'] : ''),
                    (isset($row['comments']) ? $row['comments'] : ''),
                    (isset($row['pref_1']) ? $row['pref_1']  : '') ,
                    (isset($row['pref_2']) ? $row['pref_2']  : '') ,
                    (isset($row['pref_3']) ? $row['pref_3']  : '') ,
                    (isset($row['pref_4']) ? $row['pref_4']  : '') ,
                    (isset($row['pref_5']) ? $row['pref_5']  : '') ,
                    (isset($row['pref_6']) ? $row['pref_6']  : '') ,
                    (isset($row['pref_7']) ? $row['pref_7']  : '') ,
                    (isset($row['pref_8']) ? $row['pref_8']  : '') ,
                    (isset($row['pref_9']) ? $row['pref_9']  : '') ,
                    (isset($row['pref_10']) ? $row['pref_10'] : '') ,
                    (isset($row['pref_11']) ? $row['pref_11'] : '') ,
                    (isset($row['pref_12']) ? $row['pref_12'] : '') ,
                    (isset($row['pref_13']) ? $row['pref_13'] : '') ,
                    (isset($row['pref_14']) ? $row['pref_14'] : '') ,
                    (isset($row['pref_15']) ? $row['pref_15'] : '') ,
                    (isset($row['pref_16']) ? $row['pref_16'] : '') ,
                    (isset($row['pref_17']) ? $row['pref_17'] : '') ,
                    (isset($row['pref_18']) ? $row['pref_18'] : '') ,
                    (isset($row['pref_19']) ? $row['pref_19'] : '') ,
                    (isset($row['pref_20']) ? $row['pref_20'] : '') ,
                    (isset($row['pref_21']) ? $row['pref_21'] : '') ,
                    (isset($row['pref_22']) ? $row['pref_22'] : '') ,
                    (isset($row['pref_23']) ? $row['pref_23'] : '') ,
                    (isset($row['pref_24']) ? $row['pref_24'] : '') ,
                    (isset($row['pref_25']) ? $row['pref_25'] : '') ,
                    (isset($row['pref_26']) ? $row['pref_26'] : '') ,
                    (isset($row['pref_27']) ? $row['pref_27'] : '') ,
                    (isset($row['pref_28']) ? $row['pref_28'] : '') ,
                    (isset($row['pref_29']) ? $row['pref_29'] : '') ,
                    (isset($row['pref_30']) ? $row['pref_30'] : '') ,
                    (isset($row['pref_31']) ? $row['pref_31'] : '') ,
                    (isset($row['pref_32']) ? $row['pref_32'] : '') ,
                    (isset($row['pref_33']) ? $row['pref_33'] : '') ,
                    (isset($row['pref_34']) ? $row['pref_34'] : '') ,
                    (isset($row['pref_35']) ? $row['pref_35'] : '') ,
                    (isset($row['pref_36']) ? $row['pref_36'] : '') ,
                    (isset($row['pref_37']) ? $row['pref_37'] : '') ,
                    (isset($row['pref_38']) ? $row['pref_38'] : '') ,
                    (isset($row['pref_39']) ? $row['pref_39'] : '') ,
                    (isset($row['pref_40']) ? $row['pref_40'] : '') ,
                    (isset($row['pref_41']) ? $row['pref_41'] : '') ,
                    (isset($row['pref_42']) ? $row['pref_42'] : '') ,
                    (isset($row['pref_43']) ? $row['pref_43'] : '') ,
                    (isset($row['pref_44']) ? $row['pref_44'] : '') ,
                    (isset($row['pref_45']) ? $row['pref_45'] : '') ,
                    (isset($row['pref_46']) ? $row['pref_46'] : '') ,
                    (isset($row['pref_47']) ? $row['pref_47'] : '') ,
                    (isset($row['pref_48']) ? $row['pref_48'] : '') ,
                    (isset($row['pref_49']) ? $row['pref_49'] : '') ,
                    (isset($row['selected_college_id']) ? $row['selected_college_id'] : '' ), 
                    (isset($row['selected_college_name']) ? $row['selected_college_name'] : ''),
                    (isset($row['selected_seat']) ? $row['selected_seat'] : '') ,
                    (isset($row['merit_list_id']) ? $row['merit_list_id'] : '') ,
                    (isset($row['user_id']) ? $row['user_id'] : '') , 

                ]);
        }
        // $arrSeats = array(1=>'openMeritSeats',2=>'disabilitySeats',3=>'underDevelopArea',4=>'cholistanSeats',5=>'overSeasSeats',6=>'isReciprocal');
        fclose($handle);
        // dd($csvData);

        $data['selectedMeritList'] = $selectedMeritList;
        return $data;
    }

    function collegeIsFemale($name) 
    {
        $collegeModel = new College;
        return $collegeModel->where('name',$name)
                                ->value('isFemale');
    }

    /**
     * Get previously generated MeritListReports
     * 
     */
    function getMeritReport(int $meritReportId, ?int $year,?int $college_id=0) {
        $meritListDetails = new MeritListDetail;
        $meritList = new MeritList;
        // dd($id);
        // $meritListDetailsData = $meritListDetails->where('meritlist_report_id',$id)->get(); 
        // dd($meritListDetailsData);
        $meritListId = $meritList->where('merit_report_id', $meritReportId)->where('year',$year)->value('id'); 
        if($college_id){
            $meritListDetailsData = $meritListDetails->where('merit_list_id',$meritListId)
                                                      ->where('college_id',$college_id)
                                                      ->get();
        } else {
            $meritListDetailsData = $meritListDetails->where('merit_list_id',$meritListId)->get();
        }
        return $meritListDetailsData;
    }
}
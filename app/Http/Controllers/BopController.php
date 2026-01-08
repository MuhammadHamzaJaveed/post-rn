<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\{
    User,
    PersonalDetail
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BopController extends Controller
{
    public function createChallan($type_id){
        if(empty($type_id)){
            return "Challan Type ID is required";
        }
        $user = auth()->user();
        try{

            $challan_id = $user->challan_id;

            if($challan_id){
                return $this->viewChallan(base64_encode($challan_id));
            } else {
                $data = PersonalDetail::where('user_id', $user->id)->first();
                $cnic = $data->cnic_passport;
                $print_name = $user->name;
                $case_no = $user->id;
                $college = 'University of Health Sciences Lahore';
                $program_exam = 'Lady Health Visitor';
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'content-type' => 'application/json'
                ])->get('https://fms.uhs.edu.pk/login/generate_admission_challan', [
                    'registeration_no' => $user->id,
                    'cnic_pass' => $cnic,
                    'challan_type_id' => $type_id,
                    'print_name' => $print_name,
                    'case_no' => $case_no,
                    'college' => $college,
                    'program_exam' => $program_exam
                ]);

                $challan_id  = (int)$response->getbody()->getContents();

                $user->update([
                    'challan_id' => $challan_id,
                ]);

                return $this->viewChallan(base64_encode($challan_id));
            }
        
        }catch(\Exception $e){
            return $e->getMessage();
        }

    }

    private function viewChallan($id){
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'content-type' => 'application/json'
        ])->get('https://fms.uhs.edu.pk/login/preview_admission_challan/'.$id);

        $pdfData = $response->getbody();
        return $pdfData;
    }


        public function downloadCollegeAffidavit($id){
        $record = \App\Models\MeritListFromCollege::findOrFail($id);

        if (!$record->college_affidavit_path || !Storage::disk('public')->exists($record->college_affidavit_path)) {
            abort(404, 'File not found.');
        }
        $filePath = $record->college_affidavit_path;
        $originalFileName = basename($filePath);

        return Storage::disk('public')->download($filePath, $originalFileName);
    }
}

@php
    /*
     ```````````````````````````````````````````````````````````````
                                   *
                                  ***
                                 *****
                                *******
                               *********
                                *******
                                 *****
                                  ***
                                   *
      ``````````````````````````````````````````````````````````````
      ````````````````````````*```````*````*````````````````````````
      ```````````````````````*`*``````*````*````````````````````````
      ``````````````````````*`*`*``--`******````````````````````````
      `````````````````````*`````*````*````*````````````````````````
      ````````````````````*```````*```*````*````````````````````````
      ``````````````````````````````````````````````````````````````
                                   *
                                  ***
                                 *****
                                *******
                               *********
                                *******
                                 *****
                                  ***
                                   *
      ```````````````````````````````````````````````````````````````*/

    use App\Helpers\MediaHelper;
    use App\Models\MeritListFromCollege;


    //  Student's Personal Information
    $applicantId        = $record->id;
    $name               = $record->name;
    $fatherName         = $record->father_name;
    $motherName         = $record->personalDetails?->mother_name;
    $dateOfBirth        = $record->personalDetails?->date_of_birth;
    $cnicPassport       = $record->personalDetails?->cnic_passport;
    $district           = $record->personalDetails?->district?->name;
    $nationality        = $record->personalDetails?->nationality?->name;
    $country            = $record->personalDetails?->country;
    $email              = $record->email;
    $challanId          = $record->challan_id;
    $foreigner          = $record->foreigner;
    $aggregate          = $record->aggregate;
    $aggregate_overseas = $record->aggregate_overseas;

    // Student's Selected Programs and Seat Categories
    $program            = $record->program->name;
    $seatCategory       = $record->seatCategories->pluck('name');
    $programPriority    = $record->program_priority;

    // Student's Qualification Details
    $sscMarks           = $record->qualifications->ssc_marks_obtained;
    $sscTotal           = $record->qualifications->ssc_total_marks;
    $sscRollNo          = $record->qualifications->ssc_roll_no;
    $hsscMarks          = $record->qualifications->hssc_marks_obtained;
    $hsscTotal          = $record->qualifications->hssc_total_marks;
    $hsscRollNo         = $record->qualifications->hssc_roll_no;

    // Student's Admission Test Information
    $mdcatRollNo        = $record->admissionTest->md_cat_cnic;
    $mdcatPassingYear   = $record->admissionTest?->mdcatPassingYear?->name;
    $mdcatMarks         = $record->admissionTest->md_cat_obtained_marks;
	
    $mdcatCenter          = $record->admissionTest->mdcatCenter;
	
	$mcatMarks          = $record->admissionTest->mcat_obtained_marks;

    $ucatMarks          = $record->admissionTest->ucat_obtained_marks;
    $ucatBand           = $record->admissionTest->ucat_obtained_marks;


    $satBiology         = $record->admissionTest->sat_biology_obtained_marks;
    $satChemistry       = $record->admissionTest->sat_chemistry_obtained_marks;
    $satPhyMaths        = $record->admissionTest->sat_phy_math_obtained_marks;

    $universityMbbsPreferences = $record->mbbsCollegePreferences->pluck('college_pref')->toArray();
    if($universityMbbsPreferences){
    $preferences = json_decode($universityMbbsPreferences[0], true);
    }
    $universityBdsPreferences = $record->bdsCollegePreferences->pluck('college_pref')->toArray();
    if($universityBdsPreferences){
    $preferencesBDS = json_decode($universityBdsPreferences[0], true);
    }

    $mbbsCollegeForeignerAsOpenMeritPreferences = $record->mbbsCollegeForeignerAsOpenMeritPreferences->pluck('college_pref')->toArray();

    if($mbbsCollegeForeignerAsOpenMeritPreferences){

        $mbbsCollegeForeignerAsOpenMeritPreference = json_decode($mbbsCollegeForeignerAsOpenMeritPreferences[0], true);
    }

    $bdsCollegeForeignerAsOpenMeritPreferences = $record->bdsCollegeForeignerAsOpenMeritPreferences->pluck('college_pref')->toArray();

    if($bdsCollegeForeignerAsOpenMeritPreferences){

        $bdsCollegeForeignerAsOpenMeritPreference = json_decode($bdsCollegeForeignerAsOpenMeritPreferences[0], true);
    }
    // User Docs and Profile Images
    $cnic = $record->userCnic?->path ? MediaHelper::GetImageUrl($record->userCnic?->path) : null;
    $cnicBackSide = $record->userCnicBackSide?->path ? MediaHelper::GetImageUrl($record->userCnicBackSide?->path) : null;
    $fatherCnic = $record->userFatherCnic?->path ? MediaHelper::GetImageUrl($record->userFatherCnic?->path) : null;
    $fatherCnicBackSide = $record->userFatherCnicBackSide?->path ? MediaHelper::GetImageUrl($record->userFatherCnicBackSide?->path) : null;
    $signature = $record->userSignatureImage?->path ? MediaHelper::GetImageUrl($record->userSignatureImage?->path) : null;
    $photo = $record->userColorPhoto?->path ? MediaHelper::GetImageUrl($record->userColorPhoto?->path) : null;
    $schoolLeaving = $record->userSchoolLeavingPhoto?->path ? MediaHelper::GetImageUrl($record->userSchoolLeavingPhoto?->path) : null;
    $stayCard = $record->userStayCardPhoto?->path ? MediaHelper::GetImageUrl($record->userStayCardPhoto?->path) : null;
    $intermediateTranscript = $record->userIntermediateTranscriptPhoto?->path ? MediaHelper::GetImageUrl($record->userIntermediateTranscriptPhoto?->path) : null;
    $verifiedByCeo = $record->userVerifiedByCeoPhoto?->path ? MediaHelper::GetImageUrl($record->userVerifiedByCeoPhoto?->path) : null;
    $domicileCertificate = $record->userDomicileCertificatePhoto?->path ? MediaHelper::GetImageUrl($record->userDomicileCertificatePhoto?->path) : null;
    $mdcatResultCard = $record->userMdcatResultCardPhoto?->path ? MediaHelper::GetImageUrl($record->userMdcatResultCardPhoto?->path) : null;
    $matricTranscript = $record->userMatricTranscriptPhoto?->path ? MediaHelper::GetImageUrl($record->userMatricTranscriptPhoto?->path) : null;

    $foreignHsscCertificatePhoto = $record->userForeignHsscCertificatePhoto?->path ? MediaHelper::GetImageUrl($record->userForeignHsscCertificatePhoto?->path) : null;
    $intermediateTranscriptBackSidePhoto = $record->userIntermediateTranscriptBackSidePhoto?->path ? MediaHelper::GetImageUrl($record->userIntermediateTranscriptBackSidePhoto?->path) : null;
    $matricTranscriptBackSidePhoto = $record->userMatricTranscriptBackSidePhoto?->path ? MediaHelper::GetImageUrl($record->userMatricTranscriptBackSidePhoto?->path) : null;
    $equivalenceSscPhoto = $record->userEquivalenceSscPhoto?->path ? MediaHelper::GetImageUrl($record->userEquivalenceSscPhoto?->path) : null;
    $equivalenceHsscPhoto = $record->userEquivalenceHsscPhoto?->path ? MediaHelper::GetImageUrl($record->userEquivalenceHsscPhoto?->path) : null;
    $documentRequirementOnePhoto = $record->userDocumentRequirementOnePhoto?->path ? MediaHelper::GetImageUrl($record->userDocumentRequirementOnePhoto?->path) : null;
    $documentRequirementTwoPhoto = $record->userDocumentRequirementTwoPhoto?->path ? MediaHelper::GetImageUrl($record->userDocumentRequirementTwoPhoto?->path) : null;
    $documentRequirementThreePhoto = $record->userDocumentRequirementThreePhoto?->path ? MediaHelper::GetImageUrl($record->userDocumentRequirementThreePhoto?->path) : null;
    $documentRequirementFourPhoto = $record->userDocumentRequirementFourPhoto?->path ? MediaHelper::GetImageUrl($record->userDocumentRequirementFourPhoto?->path) : null;
    $documentRequirementFivePhoto = $record->userDocumentRequirementFivePhoto?->path ? MediaHelper::GetImageUrl($record->userDocumentRequirementFivePhoto?->path) : null;
    $documentRequirementSixPhoto = $record->userDocumentRequirementSixPhoto?->path ? MediaHelper::GetImageUrl($record->userDocumentRequirementSixPhoto?->path) : null;
    $documentRequirementSevenPhoto = $record->userDocumentRequirementSevenPhoto?->path ? MediaHelper::GetImageUrl($record->userDocumentRequirementSevenPhoto?->path) : null;
    $documentRequirementEightPhoto = $record->userDocumentRequirementEightPhoto?->path ? MediaHelper::GetImageUrl($record->userDocumentRequirementEightPhoto?->path) : null;
    $documentRequirementNinePhoto = $record->userDocumentRequirementNinePhoto?->path ? MediaHelper::GetImageUrl($record->userDocumentRequirementNinePhoto?->path) : null;
    $documentRequirementTenPhoto = $record->userDocumentRequirementTenPhoto?->path ? MediaHelper::GetImageUrl($record->userDocumentRequirementTenPhoto?->path) : null;
    $userEdits = $record->user_application_edit;
    /*Student Record*/

    /*$allUserColleges = SelectionList::query()
            /*->where('status', 1)
            ->whereHas('meritListFromCollege', function ($query) use ($record) {
                // Filter by the currently authenticated user's ID
                $query->where('user_id', $record->id);
            })
            ->with('meritListFromCollege.college') // Eager load the related college data
            ->get()
            ->reject(function ($selectionItem) use (&$previousMeritStatus) {
                // Retrieve the first related meritListFromCollege, if available
                $currentMerit = $selectionItem->meritListFromCollege->first();
                // If no related meritListFromCollege, keep the item
                if (!$currentMerit) {
                    return false;
                }
                // Extract the is_stay and is_joined statuses, defaulting to false if not set
                $currentIsStay = $currentMerit->is_stay ?? false;
                $currentIsJoined = $currentMerit->is_joined ?? false;
                // If a previous merit status exists and both is_stay and is_joined are true, reject the current item
                if (isset($previousMeritStatus) && $previousMeritStatus['is_stay'] && $previousMeritStatus['is_joined']) {
                    // Update the previous status for subsequent iterations
                    $previousMeritStatus = [
                        'is_stay' => $currentIsStay,
                        'is_joined' => $currentIsJoined,
                    ];
                    return true; // Reject the current item
                }
                // Update the previous merit status with the current item's values
                $previousMeritStatus = [
                    'is_stay' => $currentIsStay,
                    'is_joined' => $currentIsJoined,
                ];
                // Keep the current item
                return false;
            });*/

        $allUserColleges = MeritListFromCollege::query()
            ->where('user_id', $record->id)
            ->with(['college', 'selectionList'])
            ->get()
            ->reject(function ($selectionItem) use (&$previousMeritStatus) {
                $currentMerit = $selectionItem?->meritListFromCollege?->first();
                if (!$currentMerit) {
                    return false;
                }
                $currentIsStay = $currentMerit->is_stay ?? false;
                $currentIsJoined = $currentMerit->is_joined ?? false;
                if (isset($previousMeritStatus) && $previousMeritStatus['is_stay'] && $previousMeritStatus['is_joined']) {
                    $previousMeritStatus = [
                        'is_stay' => $currentIsStay,
                        'is_joined' => $currentIsJoined,
                    ];
                    return true;
                }
                $previousMeritStatus = [
                    'is_stay' => $currentIsStay,
                    'is_joined' => $currentIsJoined,
                ];
                return false;
            });

@endphp

<style>
    .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        font-size: 12px;
        color: #555;
    }

    .footer-table {
        width: 100%;
    }

    .footer-left,
    .footer-right {
        width: 50%;
    }

    .footer-left {
        text-align: left;
    }

    .footer-right {
        text-align: right;
    }
</style>

<div style="padding: 1cm; font-family: sans-serif; ">
    <div style="text-align: center; font-size: larger; font-weight: bold;color:red;">{{ now()->format('Y-m-d h:i A') }}</div>
    <div style="border: 2px solid #000;  text-align: center; font-size: larger; font-weight: bold; margin-bottom: 10px;">
        Final Copy
    </div>

    <div style="margin-top: 10px;text-align: center;padding: 10px;  font-size: large; font-weight: bold;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="text-align: center;">
                    <img style="width: 50px; height: 50px" class="profile" src="images/login.png"
                         alt="placeholder image">
                </td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: 500;">{{ config('envdata.pdf_title')}}</td>
            </tr>
        </table>

        <div style="text-align: center; font-weight: 200; font-size: medium; margin-top: 10px;">Admission Form</div>
        <div style="margin-top: 2px; text-align: center; font-weight: 200; font-size: medium;">For Admission to First
            Year {{ config('envdata.pdf_program')}} Programme
        </div>
        <div style="margin-top: 2px; text-align: center; font-size: medium;">
            SESSION {{ config('envdata.pdf_session')}}</div>
        {{--<div style="margin-top: 10px; text-align: center; font-size: medium;">Your %aggregate of (MDCAT): <span style="color:red;">{{$aggregate}}</span></div>
        @if($aggregate_overseas != null)
            <div style="margin-top: 10px; text-align: center; font-size: medium;">Your %aggregate (Overseas): <span style="color:red;">{{$aggregate_overseas}}</span></div>
        @endif--}}
        @if($foreigner == 0)
            <div style="margin-top: 10px; text-align: center; font-size: medium;">Your %aggregate of (MDCAT): <span
                        style="color:red;">{{ $aggregate }}</span></div>
        @endif
        @if($foreigner == 1)
            @if ($aggregate_overseas !== null && $aggregate_overseas !== '0.0000')
                <div style="margin-top: 10px; text-align: center; font-size: medium;">Your %aggregate (Overseas
                    Pakistani/Foreigner): <span style="color:red;">{{ $aggregate_overseas }}</span></div>
            @endif
        @endif

        <div style="margin-top: 10px; text-align: center; font-size: medium;">Challan ID: <span
                    style="color:green;">{{$challanId}}</span></div>
        <div style="margin-top: 10px; text-align: center; font-size: medium;">Application ID: <span
                    style="color:green;">{{$applicantId}}</span></div>
        <hr style="border: 1px solid #000; margin: 10px 0;">

        <div style="display: flex; margin-top: 10px; width: 100%; justify-content: space-between;">
            <div style="font-size: small; text-align: left;font-size:large; color:green; font-weight: 100; margin-top: 10px;">
                Part 1: Program (Your selected program is as follow)
            </div>
            <div style="font-size: small; text-align: left; font-weight: 100; margin-top: 10px;"> {{$program}}Private
            </div>
            {{--<div style="font-size: small; text-align: left; font-weight: 100; margin-top: 10px;">
                Program Priority: {{$programPriority}} <span style="color:red; font-weight: bold;"> (1 means your currently selected program is your first priority and incase of 2 BDS is your highest priority and MBBS is your second priority) </span>
            </div>--}}
        </div>

        @if ($foreigner == 1)
            <div style="display: flex; margin-top: 10px; width: 100%; justify-content: space-between;">
                <div
                        style="font-size: small; text-align: left;font-size:large; color:green; font-weight: 100; margin-top: 10px;">
                    Part 2: Overseas Pakistani/ Foreigner
                </div>
                <div style="font-size: small; text-align: left; font-weight: 100; margin-top: 10px;"> Yes</div>
            </div>
        @endif
        @if ($foreigner == 0)
            <div style="display: flex; margin-top: 10px; width: 100%; justify-content: space-between;">
                <div
                        style="font-size: small; text-align: left;font-size:large; color:green; font-weight: 100; margin-top: 10px;">
                    Part 2: Overseas Pakistani/ Foreigner
                </div>
                <div style="font-size: small; text-align: left; font-weight: 100; margin-top: 10px;"> No</div>
            </div>
        @endif
        <div style="display: flex; margin-top: 10px; width: 100%; justify-content: space-between;">
            <div
                    style=" text-align: left;font-size:large; color:green; font-weight: 100; margin-top: 10px;">
                Part 3: Apply On Following Quota
            </div>
            <div style="font-size: small; text-align: left">
                <ol class="list-decimal ml-0 text-sm">
                    @if((boolval($record?->foreigner) && boolval($record?->is_open_merit) || boolval(!$record?->foreigner)))
                        <li>Open Merit</li>
                    @endif
                    @if(boolval($record?->foreigner))
                        <li>Overseas</li>
                    @endif

                </ol>
            </div>
        </div>
        <div style="margin-top: 2px;">
            <div style="font-size: small; text-align: left;font-size:large; color:green; font-weight: 100; margin-top: 10px;">
                Part 4: Personal Information
            </div>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 50%; vertical-align: top; font-size: small; text-align: left;">

                        <div style="font-weight: bold;">Name:</div>
                        <div>{{ $name }}</div>
                        <div style="font-weight: bold; margin-top: 10px;">Father Name:</div>
                        <div>{{ $fatherName }}</div>
                        <div style="font-weight: bold; margin-top: 10px;">Mother Name:</div>
                        <div>{{ $motherName }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <div style="padding-top:-5px;display: flex; margin-top: 20px; width: 100%; justify-content: space-between;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                        Gender:
                    </td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $record->personalDetails->gender->name }}</td>
                </tr>

                @if ($foreigner == 1)
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            Nationality:
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $nationality }}</td>
                    </tr>
                @endif
                @if ($foreigner == 0)
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            Country:
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $country }}</td>
                    </tr>
                @endif

                @if($district !== null)
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            District Of Domicile:
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $district }}</td>
                    </tr>
                @endif
                <tr>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                        CNIC / Passport No:
                    </td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $cnicPassport }}</td>
                </tr>


                <tr>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                        Phone Number:
                    </td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $record->personalDetails->mobile_number }}</td>
                </tr>

                <tr>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                        Date Of Birth:
                    </td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">@php
                            $formattedDate = date("d-m-Y", strtotime($record->personalDetails->date_of_birth));
                echo $formattedDate;
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                        Area of Residence:
                    </td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;"> {{ $record->personalDetails->area->name }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                        Email:
                    </td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $email }}</td>
                </tr>
            </table>
            <div class="footer">
                <table class="footer-table">
                    <tr>
                        <td class="footer-left">
                            @php
                                $finalSubmitTime = $userEdits?->where('action', 'final_submit')->first()?->time;
                                if($finalSubmitTime){
                                    echo 'Final Submit : ' .
                                        \Carbon\Carbon::parse($finalSubmitTime)->format('d M Y, h:i A');
                                }
                            @endphp
                        </td>
                        <td class="footer-right">
                            @php
                                $updateTime = $userEdits
                                    ?->where('action', '!=', 'final_submit')
                                    ->sortByDesc('created_at')
                                    ->first()?->time;
                                echo 'Update At : ' . \Carbon\Carbon::parse($updateTime)->format('d M Y, h:i A');
                            @endphp
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div style="page-break-before: always;"></div>

        <div style="display: flex; margin-top: 20px; width: 100%; justify-content: space-between;">
            <div style="font-size: small; text-align: left;font-size:large; color:green; font-weight: 100; margin-top: 10px;">
                Part 5: Qualification Details
            </div>

            <table style="margin-top:10px; width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left; font-weight: bold;">
                        Examination Passed
                    </td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">Science
                        Subjects
                    </td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">Institution
                        Type
                    </td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">Board /
                        University
                    </td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">Roll No</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">Year of
                        Passing
                    </td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">Marks
                        Obtained
                    </td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">Total Marks
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left; font-weight: bold;">{{$record->qualifications->sscExam->name}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">
                        {{ $record->qualifications->ssc_science_subjects }}
                    </td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">{{$record->qualifications->sscInstitution->name}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">{{$record->qualifications->sscBoard->name}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">{{$sscRollNo}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">{{$record->qualifications->ssc_passing_year}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">{{$sscMarks}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">{{$sscTotal}}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left; font-weight: bold;">{{$record->qualifications->hsscExam->name}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">
                        {{ $record->qualifications->hssc_science_subjects }}
                    </td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">{{$record->qualifications->hsscInstitution->name}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">{{$record->qualifications->hsscBoard->name}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">{{$hsscRollNo}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">{{$record->qualifications->hssc_passing_year}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">{{$hsscMarks}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: small; text-align: left;">{{$hsscTotal}}</td>
                </tr>
            </table>
        </div>


        <div style="display: flex; margin-top: 20px; width: 100%; justify-content: space-between;">
            <div style="font-size: small; text-align: left;font-size:large; color:green; font-weight: 100; margin-top: 10px;">
                Part 6: Admission Test
            </div>
            @if ($mdcatRollNo !== null)
                <table style="margin-top:10px; width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            MDCAT Roll No
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $mdcatRollNo }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            MDCAT Passing Year
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $mdcatPassingYear }}</td>
                    </tr>
                    @if ( $mdcatCenter !== null)
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                                Center From Where Appeard
                            </td>
                            <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $record->admissionTest->mdcatCenter->name }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            MDCAT Obtained Marks
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $mdcatMarks }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            MDCAT Applicant CNIC
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $cnicPassport }}</td>
                    </tr>

                </table>
            @endif
            @if ($satBiology !== null)
                <table style="margin-top:30px; width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            SAT Test Date
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $record->admissionTest->sat_test_date }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            SAT Chemistry Marks
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $satChemistry }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            SAT Biology Marks
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $satBiology }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            SAT Physics/Maths Marks
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $satPhyMaths }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            SAT User Name
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $record->admissionTest->sat_username }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            SAT Password
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $record->admissionTest->sat_password }}</td>
                    </tr>
                </table>
            @endif

            @if ($ucatMarks !== null)
                <table style="margin-top:30px; width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            UCAT Candidate Id
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $record->admissionTest->ucat_candidate_id }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            UCAT Test Date
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $record->admissionTest->ucat_test_date }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            UCAT Score
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $ucatMarks }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            UCAT Band Score
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $ucatBand }}</td>
                    </tr>
                </table>
            @endif

            @if ($mcatMarks !== null)
                <table style="margin-top:30px; width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            MCAT Test Date
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $record->admissionTest->mcat_tets_date }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            MCAT Marks Obtained
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $mcatMarks }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            MCAT User Name
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $record->admissionTest->mcat_username }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left; font-weight: bold;">
                            MCAT Password
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; font-size: small;text-align: left;">{{ $record->admissionTest->mcat_password }}</td>
                    </tr>
                </table>
            @endif
            <div class="footer">
                <table class="footer-table">
                    <tr>
                        <td class="footer-left">
                            @php
                                $finalSubmitTime = $userEdits?->where('action', 'final_submit')->first()?->time;
                                if($finalSubmitTime){
                                    echo 'Final Submit : ' .
                                        \Carbon\Carbon::parse($finalSubmitTime)->format('d M Y, h:i A');
                                }
                            @endphp
                        </td>
                        <td class="footer-right">
                            @php
                                $updateTime = $userEdits
                                    ?->where('action', '!=', 'final_submit')
                                    ->sortByDesc('created_at')
                                    ->first()?->time;
                                echo 'Update At : ' . \Carbon\Carbon::parse($updateTime)->format('d M Y, h:i A');
                            @endphp
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="page-break-before: always;"></div>


        <div style="display: flex; margin-top: 100px; width: 100%; justify-content: space-between;">
            <div
                    style="font-size: small; text-align:left; font-size: large;  font-weight: 100; margin-top: 10px; color:green">
                Part 7: College Preference
            </div>

            <!-- For MBBS Preferences -->
            @if ($record->program_id == 1)
                @if (!empty($preferences))
                    <div>
                        <div style="margin-top: 20px;">MBBS Preferences</div>
                        <hr style="border: 1px solid #000; margin: 10px 0;">
                        <table>
                            <tbody>
                            @foreach ($preferences as $index => $preference)
                                <tr>
                                    <td>{{ $index + 1 }}. {{ $preference['name'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endif

            @if ($record->program_id === 1 && $record->foreigner === 1 && $record->is_open_merit === 1)
                <div style="page-break-before: always;"></div>
                @if (!empty($mbbsCollegeForeignerAsOpenMeritPreference))
                    <div>
                        <div style="margin-top: 20px;">MBBS Preferences on Open Merit Seat</div>
                        <hr style="border: 1px solid #000; margin: 10px 0;">
                        <table>
                            <tbody>
                            @foreach ($mbbsCollegeForeignerAsOpenMeritPreference as $index => $preference)
                                <tr>
                                    <td>{{ $index + 1 }}. {{ $preference['name'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endif

            <!-- For BDS Preferences -->
            @if ($record->program_id == 2)
                @if (!empty($preferencesBDS))
                    <div>
                        <div style="margin-top: 20px;">BDS Preferences</div>
                        <hr style="border: 1px solid #000; margin: 10px 0;">
                        <table>
                            <tbody>
                            @foreach ($preferencesBDS as $index => $preference)
                                <tr>
                                    <td>{{ $index + 1 }}. {{ $preference['name'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endif

            @if ($record->program_id == 2 && $record->seat_id == 3)
                @if (!empty($bdsCollegeForeignerAsOpenMeritPreference))
                    <div style="page-break-before: always;"></div>
                    <div>
                        <div style="margin-top: 20px;">BDS Preferences on Overseas Seat</div>
                        <hr style="border: 1px solid #000; margin: 10px 0;">
                        <table>
                            <tbody>
                            @foreach ($bdsCollegeForeignerAsOpenMeritPreference as $index => $preference)
                                <tr>
                                    <td>{{ $index + 1 }}. {{ $preference['name'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endif

            @if ($record->program_id == 3)
                @if($record->program_priority == 1)
                    <div>

                        @if (!empty($preferences))
                            <div>
                                <div style="margin-top: 20px;">MBBS Preferences</div>
                                <hr style="border: 1px solid #000; margin: 10px 0;">
                                <table>
                                    <tbody>
                                    @foreach ($preferences as $index => $preference)
                                        <tr>
                                            <td>{{ $index + 1 }}. {{ $preference['name'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <div>

                        @if (!empty($preferencesBDS))
                            <div>
                                <div style="margin-top: 20px;">BDS Preferences</div>
                                <hr style="border: 1px solid #000; margin: 10px 0;">
                                <table>
                                    <tbody>
                                    @foreach ($preferencesBDS as $preference)
                                        <li>{{ $preference['name'] }}</li>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                @else
                    <div>
                        @if (!empty($preferencesBDS))
                            <div>
                                <div style="margin-top: 20px;">BDS Preferences</div>
                                <hr style="border: 1px solid #000; margin: 10px 0;">
                                <table>
                                    <tbody>
                                    @foreach ($preferencesBDS as $index => $preference)
                                        <tr>
                                            <td>{{ $index + 1 }}. {{ $preference['name'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div>
                        @if (!empty($preferences))
                            <div>
                                <div style="margin-top: 20px;">MBBS Preferences</div>
                                <hr style="border: 1px solid #000; margin: 10px 0;">
                                <table>
                                    <tbody>
                                    @foreach ($preferences as $index => $preference)
                                        <tr>
                                            <td>{{ $index + 1 }}. {{ $preference['name'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                @endif
            @endif
            <div class="footer">
                <table class="footer-table">
                    <tr>
                        <td class="footer-left">
                            @php
                                $finalSubmitTime = $userEdits?->where('action', 'final_submit')->first()?->time;
                                if($finalSubmitTime){
                                    echo 'Final Submit : ' .
                                        \Carbon\Carbon::parse($finalSubmitTime)->format('d M Y, h:i A');
                                }
                            @endphp
                        </td>
                        <td class="footer-right">
                            @php
                                $updateTime = $userEdits
                                    ?->where('action', '!=', 'final_submit')
                                    ->sortByDesc('created_at')
                                    ->first()?->time;
                                echo 'Update At : ' . \Carbon\Carbon::parse($updateTime)->format('d M Y, h:i A');
                            @endphp
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="page-break-before: always;"></div>


        <div style="display: flex; margin-top: 100px; width: 100%; justify-content: space-between;">
            <div style="font-size: small; text-align: left;font-size:large; color:green; font-weight: 100; margin-top: 10px;">
                Part 8: Undertaking By the Candidate
            </div>
            <div style="font-size: small; text-align: left; font-weight: 100; margin-top: 10px; line-height: 1.5;word-spacing: 2px; margin-bottom: 10px;">
                I <span style="color:red; font-weight: bold;"> {{$name}} </span> S/D/O <span
                        style="color:red; font-weight: bold;"> {{$fatherName}} </span> do hereby solemnly declare that all information furnished by me in the Admission Form, along with the documents submitted in support thereof, is true, correct, and complete to the best of my knowledge and belief.

                <br><br>

                I acknowledge and agree that in the event any information or document is found to be false, misleading, incomplete, or fabricated at any stage, the University shall be fully entitled to reject my application or cancel my admission, in accordance with the Admission Policy and applicable rules and regulations, without any prior notice.
                <br><br>
                I confirm that I have carefully read, fully understood, and accepted all applicable rules, regulations, instructions, and policies of the University, and I hereby undertake to abide by the same in letter and spirit.

                <br><br>

                I further acknowledge that the Order of Preference of colleges submitted by me in the Admission Form is final and irrevocable after the submission deadline, and that mere submission of the Admission Form does not confer any right or guarantee of admission, which shall be granted strictly on merit.

                <br><br>

                I further acknowledge that the right to admission shall vest only upon deposit of the prescribed college fee and joining of the allotted college within the time period specified in the relevant merit list.


                <br><br>

                I clearly understand and accept that no stipend shall be admissible to students enrolled in the BSN Generic Program, both Morning and Evening batches.

                <br><br>

                I also understand that failure to deposit the prescribed fee within the stipulated time, or cancellation of admission through a written request submitted on a duly attested Rs. 100/- stamp paper, shall render me ineligible for participation in any further selection process.


                <br><br>

                I further acknowledge that mutual transfers are strictly prohibited and shall not be permissible under any circumstances.

                <br><br>
                I hereby affirm my unconditional acceptance of all the terms and conditions stated above.

            </div>
            <div
                    style="font-size: small; text-align: left;font-size:large; color:green; font-weight: 100; margin-top: 10px;">
                Undertaking by the Parent/ Guardian
            </div>

            <div
                    style="font-size: small; text-align: left; font-weight: 100; margin-top: 10px; line-height: 1.5;word-spacing: 2px; margin-bottom: 10px;">

                I <span style="color:red; font-weight: bold;"> {{ $fatherName }} </span> being the Parent/ Guardian of
                the
                applicant <span style="color:red; font-weight: bold;"> {{ $name }} </span> do hereby affirm that I have read, understood, and consented to all the terms and conditions contained in this Undertaking.
                <br><br>
                I acknowledge that the University is duly authorized to take any action, including rejection of the application or cancellation of admission, if any information or document submitted by the applicant is found to be false, misleading, or incomplete at any stage.
                <br><br>
                I further acknowledge and accept that all decisions of the University shall be final and shall be taken strictly in accordance with its rules, regulations, policies, and applicable laws.
            </div>
            <div class="footer">
                <table class="footer-table">
                    <tr>
                        <td class="footer-left">
                            @php
                                $finalSubmitTime = $userEdits?->where('action', 'final_submit')->first()?->time;
                                if($finalSubmitTime){
                                    echo 'Final Submit : ' .
                                        \Carbon\Carbon::parse($finalSubmitTime)->format('d M Y, h:i A');
                                }
                            @endphp
                        </td>
                        <td class="footer-right">
                            @php
                                $updateTime = $userEdits
                                    ?->where('action', '!=', 'final_submit')
                                    ->sortByDesc('created_at')
                                    ->first()?->time;
                                echo 'Update At : ' . \Carbon\Carbon::parse($updateTime)->format('d M Y, h:i A');
                            @endphp
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="page-break-before: always;"></div>

        <div style="display: flex; width: 100%; justify-content: space-between;">
            <div style="font-size: small; text-align: left; font-size: large; color: green; font-weight: 100; ">Part 9:
                Uploaded Documents
            </div>
            <div style="margin-top: 10px; font-size: medium; flex-grow: 1;">
                @if ($cnic != null)
                    <page size="A4">
                        <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                            Cnic Image
                        </div>
                        <div style="text-align: center;">
                            <img style="width: 100%; height: auto;" src="{{ $cnic }}" alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>
                @endif


                @if ($cnicBackSide != null)
                    <page size="A4">
                        <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                            Cnic Backside Image
                        </div>
                        <div style="text-align: center;">
                            <img style="width: 100%; height: auto;" src="{{ $cnicBackSide }}" alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>
                @endif

                <!-- For $fatherCnicImage -->
                @if ($fatherCnic != null)
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                Father Cnic Image
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $fatherCnic }}" alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>
                @endif



                @if ($fatherCnicBackSide != null)
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                Father Backside Cnic Image
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $fatherCnicBackSide }}"
                                 alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>
                @endif



                <!-- For $signatureImage -->
                @if ($signature != null)
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                Signature Image
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $signature }}" alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>
                @endif


                <!-- For $photoImage -->
                @if ($photo != null)
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                Recent Colored Image
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $photo }}" alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>
                @endif




                <!-- For $intermediateTranscriptImage -->
                @if ($intermediateTranscript != null)
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                Intermediate Transcript Image
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $intermediateTranscript }}"
                                 alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>
                @endif


                <!-- For $intermediateTranscriptImage -->
                @if ($intermediateTranscriptBackSidePhoto != null)
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                Intermediate Transcript Backside Image
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $intermediateTranscriptBackSidePhoto }}"
                                 alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>
                @endif




                <!-- For $domicileCertificateImage -->
                @if ($domicileCertificate != null)
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                Domicile Certificate Image
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $domicileCertificate }}"
                                 alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>
                @endif


                <!-- For $mdcatResultCardImage -->
                @if ($mdcatResultCard != null)
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                MDCAT Result Image
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $mdcatResultCard }}"
                                 alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>
                @endif


                <!-- For $matricTranscriptImage -->
                @if ($matricTranscript != null)
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                Matric Transcript Image
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $matricTranscript }}"
                                 alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>
                @endif


                <!-- For $matricTranscriptImage -->
                @if ($matricTranscriptBackSidePhoto != null)
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                Matric Transcript Backside Image
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $matricTranscriptBackSidePhoto }}"
                                 alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>
                @endif

                <!-- For $schoolLeavingImage -->
                <!-- @if ($schoolLeaving != null)
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">School Leaving Image </div>
                            <img style="width: 100%; height: auto;" src="{{ $schoolLeaving }}" alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>

                @endif -->

                <!-- For $stayCardImage -->
                @if ($stayCard != null)
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                Stay Card Image
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $stayCard }}" alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>

                @endif

                <!-- For $verifiedByCeoImage -->
                <!-- @if ($verifiedByCeo != null)
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">Verified By CEO Image </div>
                            <img style="width: 100%; height: auto;" src="{{ $verifiedByCeo }}" alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>


                @endif -->

                <!-- For $foreignHsscCertificate -->
                @if ($foreignHsscCertificatePhoto != null)
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                Foriegn Hssc Certificate Image
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $foreignHsscCertificatePhoto }}"
                                 alt="placeholder image">
                        </div>
                    </page>
                @endif

                <!-- For $HsscCertificate -->
                @if ($equivalenceSscPhoto != null)
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                Equivalence Ssc Certificate Image
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $equivalenceSscPhoto }}"
                                 alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>

                @endif

                <!-- For $SscCertificate -->
                @if ($equivalenceHsscPhoto != null)
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                Equivalence Hssc Certificate Image
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $equivalenceHsscPhoto }}"
                                 alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>
                @endif


                <!-- For Extra Documents -->
                @if ($documentRequirementOnePhoto != null)
                    <div style="page-break-before: always;"></div>
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                Extra Document Image 1
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $documentRequirementOnePhoto }}"
                                 alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>
                @endif

                @if ($documentRequirementTwoPhoto != null)
                    <div style="page-break-before: always;"></div>
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                Extra Document Image 2
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $documentRequirementTwoPhoto }}"
                                 alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>
                @endif


                @if ($documentRequirementThreePhoto != null)
                    <div style="page-break-before: always;"></div>
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">
                                Extra Document Image 3
                            </div>
                            <img style="width: 100%; height: auto;" src="{{ $documentRequirementThreePhoto }}"
                                 alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>
                @endif


                <!-- @if ($documentRequirementFourPhoto != null)
                    <div style="page-break-before: always;"></div>
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">Extra Document Image 4</div>
                            <img style="width: 100%; height: auto;" src="{{ $documentRequirementFourPhoto }}" alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>

                @endif


                @if ($documentRequirementFivePhoto != null)
                    <div style="page-break-before: always;"></div>
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">Extra Document Image 5</div>
                            <img style="width: 100%; height: auto;" src="{{ $documentRequirementFivePhoto }}" alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>

                @endif


                @if ($documentRequirementSixPhoto != null)
                    <div style="page-break-before: always;"></div>
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">Extra Document Image 6</div>
                            <img style="width: 100%; height: auto;" src="{{ $documentRequirementSixPhoto }}" alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>

                @endif


                @if ($documentRequirementSevenPhoto != null)
                    <div style="page-break-before: always;"></div>
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">Extra Document Image 7</div>
                            <img style="width: 100%; height: auto;" src="{{ $documentRequirementSevenPhoto }}" alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>

                @endif


                @if ($documentRequirementEightPhoto != null)
                    <div style="page-break-before: always;"></div>
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">Extra Document Image 8</div>
                            <img style="width: 100%; height: auto;" src="{{ $documentRequirementEightPhoto }}" alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>

                @endif


                @if ($documentRequirementNinePhoto != null)
                    <div style="page-break-before: always;"></div>
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">Extra Document Image 9</div>
                            <img style="width: 100%; height: auto;" src="{{ $documentRequirementNinePhoto }}" alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>

                @endif


                @if ($documentRequirementTenPhoto != null)
                    <div style="page-break-before: always;"></div>
                    <page size="A4">
                        <div style="text-align: center; margin-top: 20px;">
                            <div style="margin-top: 10px; font-size: small; text-align: center; font-size: small; color: red; font-weight: 100; ">Extra Document Image 10</div>
                            <img style="width: 100%; height: auto;" src="{{ $documentRequirementTenPhoto }}" alt="placeholder image">
                        </div>
                    </page>
                    <div style="page-break-before: always;"></div>

                @endif -->
            </div>
            <div style="page-break-before: always;"></div>
            {{--Student Record--}}
            <table style="width: 100%; margin-top: 10%; border-collapse: collapse; font-size: 12px; text-align: left;">
                <thead>
                <tr style="background-color: #f1f5f9; font-weight: bold;">
                    <th style="padding: 8px; border: 1px solid #ddd;">List</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Seat</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">College</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Date</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Joined Status</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Stay Status</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Upgrade Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($allUserColleges as $colleges)
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $colleges?->selectionList?->name }}</td>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $colleges?->seat?->name }}</td>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ \App\Models\College::where('id',$colleges?->college_to)?->first()?->name }}</td>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ date('d-M-Y',strtotime($colleges?->updated_at)) }}</td>
                        <td style="padding: 8px; border: 1px solid #ddd; text-align: center;">
                <span style="display: inline-block; padding: 4px 8px; border-radius: 4px; color: #fff; background-color: {{ $colleges?->is_joined ? '#10b981' : '#6b7280' }};">
                    {{ $colleges?->is_joined ? 'Joined' : 'Pending' }}
                </span>
                        </td>
                        <td style="padding: 8px; border: 1px solid #ddd; text-align: center;">
                <span style="display: inline-block; padding: 4px 8px; border-radius: 4px; color: #fff; background-color: {{ $colleges?->is_stay ? '#10b981' : '#6b7280' }};">
                    {{ $colleges?->is_stay ? 'Stay' : 'Pending' }}
                </span>
                        </td>
                        <td style="padding: 8px; border: 1px solid #ddd; text-align: center;">
                            @if(
                                boolval($colleges?->is_stay)
                             && boolval($colleges?->is_joined)
                              )
                                <span style="display: inline-block; padding: 4px 8px; border-radius: 4px; color: #fff; background-color: #fbbf24;">Current College</span>
                            @else
                                @if(boolval($colleges?->is_joined))
                                    <span style="display: inline-block; padding: 4px 8px; border-radius: 4px; color: #fff; background-color: #3b82f6;">Upgraded</span>
                                @else
                                    <span style="display: inline-block; padding: 4px 8px; border-radius: 4px; color: #000; background-color: #fff;">-</span>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
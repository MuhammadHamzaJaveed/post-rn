@php
    use App\Helpers\MediaHelper;

    $cnic = MediaHelper::GetImageUrl(optional($getRecord()->userCnic)->path);
    $userChallan = MediaHelper::GetImageUrl(optional($getRecord()->userChallanImage)->path);
    $cnicBackSide = MediaHelper::GetImageUrl(optional($getRecord()->userCnicBackSide)->path);
    $fatherCnic = MediaHelper::GetImageUrl(optional($getRecord()->userFatherCnic)->path);
    $fatherCnicBackSide = MediaHelper::GetImageUrl(optional($getRecord()->userFatherCnicBackSide)->path);
    $signature = MediaHelper::GetImageUrl(optional($getRecord()->userSignatureImage)->path);
    $photo = MediaHelper::GetImageUrl(optional($getRecord()->userColorPhoto)->path);
    
    $stayCard = MediaHelper::GetImageUrl(optional($getRecord()->userStayCardPhoto)->path);
    $intermediateTranscript = MediaHelper::GetImageUrl(optional($getRecord()->userIntermediateTranscriptPhoto)->path);
    $verifiedByCeo = MediaHelper::GetImageUrl(optional($getRecord()->userVerifiedByCeoPhoto)->path);
    $domicileCertificate = MediaHelper::GetImageUrl(optional($getRecord()->userDomicileCertificatePhoto)->path);
    $mdcatResultCard = MediaHelper::GetImageUrl(optional($getRecord()->userMdcatResultCardPhoto)->path);
    $matricTranscript = MediaHelper::GetImageUrl(optional($getRecord()->userMatricTranscriptPhoto)->path);

    $provisionalCertificatePhoto = MediaHelper::GetImageUrl(optional($getRecord()->userProvisionalCertificatePhoto)->path);
    $foreignHsscCertificatePhoto = MediaHelper::GetImageUrl(optional($getRecord()->userForeignHsscCertificatePhoto)->path);
    //$intermediateTranscriptBackSidePhoto = MediaHelper::GetImageUrl($getRecord()->userIntermediateTranscriptBackSidePhoto?->path);
    //$matricTranscriptBackSidePhoto = MediaHelper::GetImageUrl($getRecord()->userMatricTranscriptBackSidePhoto?->path);
    $equivalenceSscPhoto = MediaHelper::GetImageUrl(optional($getRecord()->userEquivalenceSscPhoto)->path);
    $equivalenceHsscPhoto = MediaHelper::GetImageUrl(optional($getRecord()->userEquivalenceHsscPhoto)->path);
    $documentRequirementOnePhoto = MediaHelper::GetImageUrl(optional($getRecord()->userDocumentRequirementOnePhoto)->path);
    $documentRequirementTwoPhoto = MediaHelper::GetImageUrl(optional($getRecord()->userDocumentRequirementTwoPhoto)->path);
    $documentRequirementThreePhoto = MediaHelper::GetImageUrl(optional($getRecord()->userDocumentRequirementThreePhoto)->path);
    //$documentRequirementFourPhoto = MediaHelper::GetImageUrl($getRecord()->userDocumentRequirementFourPhoto?->path);
    //$documentRequirementFivePhoto = MediaHelper::GetImageUrl($getRecord()->userDocumentRequirementFivePhoto?->path);
    //$documentRequirementSixPhoto = MediaHelper::GetImageUrl($getRecord()->userDocumentRequirementSixPhoto?->path);
    //$documentRequirementSevenPhoto = MediaHelper::GetImageUrl($getRecord()->userDocumentRequirementSevenPhoto?->path);
    //$documentRequirementEightPhoto = MediaHelper::GetImageUrl($getRecord()->userDocumentRequirementEightPhoto?->path);
    //$documentRequirementNinePhoto = MediaHelper::GetImageUrl($getRecord()->userDocumentRequirementNinePhoto?->path);
    //$documentRequirementTenPhoto = MediaHelper::GetImageUrl($getRecord()->userDocumentRequirementTenPhoto?->path);
@endphp

<div class="mt-7 mb-7 pb-10 bg-white rounded-lg"
     style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.03);">
    <div>
        <p class=" px-5 md:px-10 py-4 text-2xl font-medium text-[#333333] tracking-[0.29px] font-sans">Uploaded
            Documents</p>
        <hr class="border-t-2 w-full border-[#DAE4EA]">
    </div>

    {{-- <div class="p-10 grid grid-cols-3 gap-5 mt-4">
        <!-- CNIC Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    CNIC Image
                </span>
            <img src="{{ $cnic }}" alt="CNIC Image"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        <!-- Father's CNIC Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Father's CNIC Image
                </span>
            <img src="{{ $fatherCnic }}" alt="Father's CNIC Image"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        <!-- Signature Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Signature Image
                </span>
            <img src="{{ $signature }}" alt="Signature Image"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        <!-- Color Photo Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Recent Color Photograph
                </span>
            <img src="{{ $photo }}" alt="Color Photo Image"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        <!-- Disability Photo Image -->
        @if (in_array(2, $seatCategories))
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Disability Image
                </span>
                <img src="{{ $disability }}" alt="Disability Photo Image"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif

        <!-- Cholistan Certificate Image -->
        @if (in_array(4, $seatCategories))
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Cholistan Certificate Image
                </span>
                <img src="{{ $cholistanCertificate }}" alt="Cholistan Certificate Image"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>

            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Cholistan Certificate Image
                </span>
                <img src="{{ $cholistanCertificateSecondPhoto }}" alt="Cholistan Certificate Image"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif

        <!-- Stay Card Image -->
        @if (in_array(5, $seatCategories))
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Stay Card Image
                </span>
                <img src="{{ $stayCard }}" alt="Stay Card Image"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>

            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Stay Card Image
                </span>
                <img src="{{ $foreignHsscCertificatePhoto }}" alt="Stay Card Image"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif

        <!-- Intermediate Transcript Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Intermediate Transcript Image
                </span>
            <img src="{{ $intermediateTranscript }}" alt="Intermediate Transcript Image"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        @if ($getRecord()->qualifications->ssc_exam_passeds_id == 2)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Foreign Ssc Certificate
                </span>
                <img src="{{ $equivalenceSscPhoto }}" alt="Intermediate Transcript Image"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif

        @if ($getRecord()->qualifications->hssc_exam_passeds_id == 2)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Foreign Hssc Certificate
                </span>
                <img src="{{ $equivalenceHsscPhoto }}" alt="Intermediate Transcript Image"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif

        <!-- Verified by CEO Image -->
        @if (in_array(3, $seatCategories))
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Verified by CEO Image
                </span>
                <img src="{{ $verifiedByCeo }}" alt="Verified by CEO Image"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>

            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Provisional Certificate Image
                </span>
                <img src="{{ $provisionalCertificatePhoto }}" alt="Matric Transcript Image"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>

            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Under Developed First Image
                </span>
                <img src="{{ $underDevelopedFirstPhoto }}" alt="Matric Transcript Image"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>

            <!-- School Leaving Certificate Image -->
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    School Leaving Certificate Image
                </span>
                <img src="{{ $schoolLeaving }}" alt="School Leaving Certificate Image"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>

            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    School Leaving Certificate Image
                </span>
                <img src="{{ $underDevelopedSecondPhoto }}" alt="School Leaving Certificate Image"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>

            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    School Leaving Certificate Image
                </span>
                <img src="{{ $underDevelopedThirdPhoto }}" alt="School Leaving Certificate Image"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif

        <!-- Domicile Certificate Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Domicile Certificate Image
                </span>
            <img src="{{ $domicileCertificate }}" alt="Domicile Certificate Image"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        <!-- MDCAT Result Card Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    MDCAT Result Card Image
                </span>
            <img src="{{ $mdcatResultCard }}" alt="MDCAT Result Card Image"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        <!-- Matric Transcript Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Matric Transcript (Front Side) Image
                </span>
            <img src="{{ $matricTranscript }}" alt="Matric Transcript Image"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Matric Transcript (Front Side) Image
                </span>
            <img src="{{ $matricTranscript }}" alt="Matric Transcript Image"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>
    </div> --}}

    <div class="p-10 grid grid-cols-3 gap-5 mt-4">

        <!-- CNIC Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
            <span
                    class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                CNIC Image
            </span>
            <img src="{{ url($cnic) }}" alt="CNIC Image" onclick="openModal('{{ url($cnic) }}')"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        <!-- cnicBackSide Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
            <span
                    class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                CNIC (Back Side) Image
            </span>
            <img src="{{ url($cnicBackSide) }}" alt="cnicBackSide Image" onclick="openModal('{{ url($cnicBackSide) }}')"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        <!-- Father's CNIC Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

            <span
                    class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                Father's CNIC Image
            </span>
            <img src="{{ url($fatherCnic) }}" alt="Father's CNIC Image" onclick="openModal('{{ url($fatherCnic) }}')"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        <!-- fatherCnicBackSide Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
            <span
                    class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                Father's CNIC (Back Side) Image
            </span>
            <img src="{{ url($fatherCnicBackSide) }}" alt="fatherCnicBackSide Image"
                 onclick="openModal('{{ url($fatherCnicBackSide) }}')"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        <!-- Intermediate Transcript Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

            <span
                    class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                Intermediate Transcript (Front Side) Image
            </span>
            <img src="{{ url($intermediateTranscript) }}" alt="Intermediate Transcript Image"
                 onclick="openModal('{{ url($intermediateTranscript) }}')"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        <!-- intermediateTranscriptBackSide Image -->
        @if (auth()->user()->intermediateTranscriptBackSide !== null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
                <span
                        class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Intermediate Transcript (Back Side) Image
                </span>
                <img src="{{ url($intermediateTranscriptBackSide) }}" alt="intermediateTranscriptBackSide Image"
                     onclick="openModal('{{ url($intermediateTranscriptBackSide) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif


        <!-- Matric Transcript Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

            <span
                    class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                Matric Transcript Image
            </span>
            <img src="{{ url($matricTranscript) }}" alt="Matric Transcript Image"
                 onclick="openModal('{{ url($matricTranscript) }}')"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        <!-- matricTranscriptBackSide Image -->
        @if (auth()->user()->matricTranscriptBackSide !== null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
                <span
                        class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Matric Transcript (Back Side) Image
                </span>
                <img src="{{ url($matricTranscriptBackSide) }}" alt="matricTranscriptBackSide Image"
                     onclick="openModal('{{ url($matricTranscriptBackSide) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif
        @if (auth()->user()->equivalenceCertificateSsc != null)
            <!-- equivalenceCertificateSsc Image -->

            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
                <span
                        class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Equivalence Certificate SSC Image
                </span>
                <img src="{{ url($equivalenceCertificateSsc) }}" alt="equivalenceCertificateSsc Image"
                     onclick="openModal('{{ url($equivalenceCertificateSsc) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif
        @if (auth()->user()->equivalenceCertificateHssc != null)
            <!-- equivalenceCertificateSsc Image -->
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
                <span
                        class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Equivalence Certificate HSSC Image
                </span>
                <img src="{{ url($equivalenceCertificateHssc) }}" alt="equivalenceCertificateHssc Image"
                     onclick="openModal('{{ url($equivalenceCertificateHssc) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif


        <!-- Signature Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

            <span
                    class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                Signature Image
            </span>
            <img src="{{ url($signature) }}" alt="Signature Image" onclick="openModal('{{ url($signature) }}')"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        <!-- Color Photo Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

            <span
                    class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                Recent Color Photograph
            </span>
            <img src="{{ url($photo) }}" alt="Color Photo Image" onclick="openModal('{{ url($photo) }}')"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        <!-- Disability Photo Image -->
        @if (auth()->user()->disability != null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span
                        class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Disability First Image
                </span>
                <img src="{{ url($disability) }}" alt="Disability Photo Image" onclick="openModal('{{ url($disability) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
            @if (auth()->user()->disabilitySecond !== null)
                <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                     style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Disability Second Image
                    </span>
                    <img src="{{ url($disabilitySecond) }}" alt="disabilitySecond Photo Image"
                         onclick="openModal('{{ url($disabilitySecond) }}')"
                         class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
                </div>
            @endif
        @endif



        <!-- Cholistan Certificate Image -->
        @if (auth()->user()->cholistanCertificate !== null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span
                        class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Cholistan Certificate First Image
                </span>
                <img src="{{ url($cholistanCertificate) }}" alt="Cholistan Certificate Image"
                     onclick="openModal('{{ url($cholistanCertificate) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif
        @if (auth()->user()->cholistanCertificateSecond !== null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span
                        class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Cholistan Certificate Second Image
                </span>
                <img src="{{ url($cholistanCertificateSecond) }}" alt="cholistanCertificateSecond Certificate Image"
                     onclick="openModal('{{ url($cholistanCertificateSecond) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif


        <!-- Stay Card Image -->

        @if (auth()->user()->foreignHsscCertificate !== null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Foreign HSSC Certificate Image
                    </span>
                <img src="{{ url($foreignHsscCertificate) }}" alt="foreignHsscCertificate Card Image"
                     onclick="openModal('{{ url($foreignHsscCertificate) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif
        @if (auth()->user()->stayCard !== null)

            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Stay Card Image
                    </span>
                <img src="{{ url($stayCard) }}" alt="Stay Card Image" onclick="openModal('{{ url($stayCard) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif




        <!-- Verified by CEO Image -->
        @if (auth()->user()->verifiedByCeo)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Under-Developed Districts Third Page
                    </span>
                <img src="{{ url($verifiedByCeo) }}" alt="Verified by CEO Image"
                     onclick="openModal('{{ url($verifiedByCeo) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif

        <!-- School Leaving Certificate Image -->
        @if (auth()->user()->schoolLeaving !== null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Under-Developed Districts First Page
                    </span>
                <img src="{{ url($schoolLeaving) }}" alt="School Leaving Certificate Image"
                     onclick="openModal('{{ url($schoolLeaving) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif
        @if (auth()->user()->provisionalCertificate !== null)

            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Under-Developed Districts Second Page
                    </span>
                <img src="{{ url($provisionalCertificate) }}" alt="School Leaving Certificate Image"
                     onclick="openModal('{{ url($provisionalCertificate) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif

        @if (auth()->user()->underDevelopedExtra1 !== null)

            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Under-Developed Districts Fourth Page
                    </span>
                <img src="{{ url($underDevelopedExtra1) }}" alt="underDevelopedExtra1 Leaving Certificate Image"
                     onclick="openModal('{{ url($underDevelopedExtra1) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif
        @if (auth()->user()->underDevelopedExtra2 !== null)

            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Under-Developed Districts Fifth Page
                    </span>
                <img src="{{ url($underDevelopedExtra2) }}" alt="underDevelopedExtra2 Leaving Certificate Image"
                     onclick="openModal('{{ url($underDevelopedExtra2) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif
        @if (auth()->user()->underDevelopedExtra3 !== null)

            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Under-Developed Districts Sixth Page
                    </span>
                <img src="{{ url($underDevelopedExtra3) }}" alt="underDevelopedExtra3 Leaving Certificate Image"
                     onclick="openModal('{{ url($underDevelopedExtra3) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif



        <!-- Domicile Certificate Image -->
        @if (auth()->user()->domicileCertificate !== null)

            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Domicile Certificate Image
                    </span>
                <img src="{{ url($domicileCertificate) }}" alt="Domicile Certificate Image"
                     onclick="openModal('{{ url($domicileCertificate) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif


        <!-- MDCAT Result Card Image -->
        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span
                        class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    MDCAT Result Card Image
                </span>
            <img src="{{ url($mdcatResultCard) }}" alt="MDCAT Result Card Image"
                 onclick="openModal('{{ url($mdcatResultCard) }}')"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>

        <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">

                <span
                        class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                    Challan Form Image
                </span>
            <img src="{{ url($userChallan) }}" alt="Challan Form Image"
                 onclick="openModal('{{ url($userChallan) }}')"
                 class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
        </div>
        
        


        @if (auth()->user()->extraDocRequire1 !== null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Extra Document Require 1 Image
                    </span>
                <img src="{{ url($extraDocRequire1) }}" alt="CNIC Image"
                     onclick="openModal('{{ url($extraDocRequire1) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif

        @if (auth()->user()->extraDocRequire2 !== null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Extra Document Require 2 Image
                    </span>
                <img src="{{ url($extraDocRequire2) }}" alt="extraDocRequire2 Image"
                     onclick="openModal('{{ url($extraDocRequire2) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif

        @if (auth()->user()->extraDocRequire3 !== null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Extra Document Require 3 Image
                    </span>
                <img src="{{ url($extraDocRequire3) }}" alt="extraDocRequire3 Image"
                     onclick="openModal('{{ url($extraDocRequire3) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif

        @if (auth()->user()->extraDocRequire4 !== null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Extra Document Require 4 Image
                    </span>
                <img src="{{ url($extraDocRequire4) }}" alt="extraDocRequire4 Image"
                     onclick="openModal('{{ url($extraDocRequire4) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif

        @if (auth()->user()->extraDocRequire5 !== null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Extra Document Require 5 Image
                    </span>
                <img src="{{ url($extraDocRequire5) }}" alt="extraDocRequire5 Image"
                     onclick="openModal('{{ url($extraDocRequire5) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif

        @if (auth()->user()->extraDocRequire6 !== null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Extra Document Require 6 Image
                    </span>
                <img src="{{ url($extraDocRequire6) }}" alt="extraDocRequire6 Image"
                     onclick="openModal('{{ url($extraDocRequire6) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif

        @if (auth()->user()->extraDocRequire7 !== null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Extra Document Require 7 Image
                    </span>
                <img src="{{ url($extraDocRequire7) }}" alt="extraDocRequire7 Image"
                     onclick="openModal('{{ url($extraDocRequire7) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif

        @if (auth()->user()->extraDocRequire8 !== null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Extra Document Require 8 Image
                    </span>
                <img src="{{ url($extraDocRequire8) }}" alt="extraDocRequire8 Image"
                     onclick="openModal('{{ url($extraDocRequire8) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif

        @if (auth()->user()->extraDocRequire9 !== null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Extra Document Require 9 Image
                    </span>
                <img src="{{ url($extraDocRequire9) }}" alt="extraDocRequire9 Image"
                     onclick="openModal('{{ url($extraDocRequire9) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif
        @if (auth()->user()->extraDocRequire10 !== null)
            <div class="mt-5 border-2 border-[#DAE4EA] p-5 rounded-lg flex flex-col justify-center items-center transition-transform hover:transform hover:-translate-y-2"
                 style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.10);">
                    <span
                            class="text-lg md:text-xl text-start md:text-center font-medium ml-2 -mt-1 md:-mt-3 md:leading-10 text-[#179F9E]">
                        Extra Document Require 10 Image
                    </span>
                <img src="{{ url($extraDocRequire10) }}" alt="extraDocRequire10 Image"
                     onclick="openModal('{{ url($extraDocRequire10) }}')"
                     class="border border-[#DAE4EA] rounded-lg justify-center object-cover object-center w-72 h-72 cursor-pointer">
            </div>
        @endif
    </div>
</div>

<div id="imageModal" class="fixed inset-0 items-center justify-center hidden">
    <div class="absolute inset-0 bg-black opacity-75" onclick="closeModal()"></div>
    <div class="bg-white p-4 flex items-center justify-center rounded-lg shadow-lg"
         style="width: 550px; height: 800px; z-index: 9999;">
        <!-- Close button (optional) -->
        <span class="absolute top-0 right-0 m-2 text-white cursor-pointer text-3xl"
              onclick="closeModal()">&times;</span>
        <div>
            <img id="modalImage" class="w-auto object-cover object-center h-auto" src="" alt="Modal Image">
        </div>
    </div>
</div>



<script>
    function openModal(imageSrc) {
        var modal = document.getElementById('imageModal');
        var modalImage = document.getElementById('modalImage');
        modal.style.display = 'flex';
        modalImage.src = imageSrc;
    }

    function closeModal() {
        var modal = document.getElementById('imageModal');
        modal.style.display = 'none';
    }
</script>
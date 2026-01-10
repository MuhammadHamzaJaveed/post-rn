<form wire:submit.prevent="submit" enctype="multipart/form-data">
    <div class="mt-7 mb-7 bg-white rounded-lg "
        style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.03);">
        <div>
            <p class=" p-5 md:px-10 md:py-4 text-2xl font-medium text-red-600 tracking-[0.29px] font-sans">IMPORTANT
                INSTRUCTION:</p>

            <hr class="border-t-2 w-full border-[#DAE4EA]">
        </div>
        <div class="p-5 pb-10 md:px-10 md:pt-5 md:pb-10 gap-4 ">
            <div class="md:mr-4">
                <ol>
                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-blue-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800" />
                        </span>
                        <p> Documents should be in JPG/JPEG format, with a file size not exceeding 1 MB per document. Apps like CamScanner can be used for this purpose.
                        </p>
                    </li>
                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-blue-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800" />
                        </span> Upload the original scanned documents, except for the SSC and HSSC result cards. For these, upload photocopies that have been attested by the relevant Board of Intermediate and Secondary Education.
                    </li>

                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                                class="text-blue-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800" />
                        </span> 
                        <span> Ensure that each uploaded image is clear and legible.
                        </span>
                    </li>

                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-blue-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800" />
                        </span> For double-sided documents like the CNIC, prepare separate files for both sides.
                        Save each document with a unique name, and double-check before uploading.
                    </li>
                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-blue-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800" />
                        </span>  Candidates are responsible for uploading the correct documents in the required format. Incorrect or improperly uploaded documents will result in the application being rejected without notice, and the university will not be held responsible.

                    </li>

                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-blue-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800" />
                        </span>  Prepare your documents according to the instructions and seek assistance if needed. Uploading fake or fabricated documents will lead to immediate rejection and possible legal action
                    </li>

                </ol>

                <div class="mt-7 flex items-center gap-4">
                    <input type="checkbox" wire:model.defer="agreed" required id="agree-label" class="w-5 h-5 rounded border-3 text-2xl font-bold text-blue-600 bg-gray-100 border-gray-900 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-100 dark:border-gray-300">
                        {{--<span class="text-black font-semibold text-lg">Candidates are responsible for uploading the correct documents in the required format. Incorrect or improperly uploaded documents will result in the application being rejected without notice, and the university will not be held responsible. Prepare your documents according to the instructions and seek assistance if needed. Uploading fake or fabricated documents will lead to immediate rejection and possible legal action</span>--}}
                        <span class="text-black font-semibold text-lg">I have read the instructions carefully.</span>
                </input>
                </div>
                @error('agreed')
                    <div class="error text-red-600 mt-2 ">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="mt-7 mb-7 bg-white rounded-lg"
        style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.03);">
        <div>
            <p class="p-5 md:px-10 py-4 text-2xl font-medium text-[#333333] tracking-[0.29px] font-sans">Documents
                Upload</p>
            <hr class="border-t-2 w-full border-[#DAE4EA]">
        </div>

        <div class="p-5 md:p-10 mb-5 font-medium">
            <div>
                <p class="text-base text-center mb-6 font-bold tracking-[0.29px] font-sans">Attach Documents <span
                        class="text-red-600">*</span></p>
            </div>
            {{-- domicile certificate --}}
            @if (auth()->user()->foreigner == 0 || auth()->user()->seat_id == 3)
                
                <div id="domicileCertificate"
                    class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">

                    <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                        <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                            <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                            <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                                class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-2xl w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">

                                <ul>
                                    <li>Punjab Domicile is mandatory for candidates.</li>
                                    <li>No other document, including ID cards, B-forms, passports, or birth
                                        certificates,
                                        can substitute for the Punjab Domicile.</li>
                                    <li>Receipts for domicile application or a parent's domicile on behalf of the
                                        candidate

                                    <li>Candidates with Islamabad (ICT) domicile can apply for Open Merit seats in
                                        Punjab.
                                    </li>
                                    <li>Overseas Pakistanis/residents with dual nationality do not need a domicile for
                                        their
                                        quota seats.</li>
                                   
                                </ul>

                            </div>
                        </div>
                        <p>
                            Upload your Certificate of Domicile
                            <span class="text-red-600">*</span>
                        </p>
                    </div>

                    <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                    required
                    label="Domicile Certificate"
                    name="domicileCertificate"
                    :filePath="auth()->user()->userDomicileCertificatePhoto?->path ?? ''"
                    :fileName="auth()->user()->userDomicileCertificatePhoto?->name ?? ''" />
                </div>

            @endif

            {{-- ssc certificate --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">

                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>Please upload your Matriculation/Secondary School Certificate (SSC) or an equivalent
                                document (e.g., Matric/O Levels, etc.). <span class="text-red-500">Only IBCC’s attested
                                    document to be
                                    uploaded.</span></p>
                        </div>
                    </div>
                    <p>
                        Upload (Front Side) Matriculation/ Secondary School
                        Certificate- SSC or equivalent
                        <span class="text-red-600">*</span>
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                required
            label="Matric Transcript"
            name="matricTranscript"
            :filePath="auth()->user()->userMatricTranscriptPhoto?->path ?? ''"
            :fileName="auth()->user()->userMatricTranscriptPhoto?->name ?? ''" />
            </div>

            {{-- SSC TranscriptBackSide --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">

                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>Please upload your Matriculation/Secondary School Certificate (SSC) or an equivalent
                                document (e.g., Matric/O Levels, etc.) Back Side. <span class="text-red-500">Only IBCC’s attested
                                    document to be
                                    uploaded.</span></p>
                        </div>
                    </div>
                    <p>
                        Upload (Back Side) Matriculation/ Secondary School
                        Certificate- SSC or equivalent
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                required
            label="Matric Transcript Backside"
            name="matricTranscriptBackSide"
            :filePath="auth()->user()->userMatricTranscriptBackSidePhoto?->path ?? ''"
            :fileName="auth()->user()->userMatricTranscriptBackSidePhoto?->name ?? ''"
    />

            </div>

            @if (auth()->user()?->qualifications?->ssc_exam_passeds_id == 2)
                {{-- SSc Equivalence Certificate --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">

                    <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                        <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                            <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                            <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                                class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                                <p>Please upload image of Equivalence Certificate/ Provisional
                                    Equivalence Letter from IBCC (For
                                    HSSC/ Equivalent Foreign Qualifications
                                    only, i.e. O-Level/ IB/ 10th Grade etc.)
                                </p>
                            </div>
                        </div>
                        <p>
                            Equivalence Certificate/ Provisional
                            Equivalence Letter from IBCC <span class="text-red-600">*</span>
                        </p>
                    </div>

                    <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                            required
                            label="Equivalence Certificate Ssc"
                            name="equivalenceCertificateSsc"
                            :filePath="auth()->user()->userEquivalenceSscPhoto?->path ?? ''"
                            :fileName="auth()->user()->userEquivalenceSscPhoto?->name ?? ''"
                    />

                </div>
            @endif


            {{-- Hssc Certificate --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>Please provide details of your Intermediate/Higher Secondary School Certificate (HSSC) or
                                equivalent qualifications (e.g., F.Sc, A Levels, etc.) in the form of an image.<span
                                    class="text-red-500">Only IBCC’s attested
                                    document to be
                                    uploaded.</span></p>
                        </div>
                    </div>
                    <p>
                        Upload (Front Side) Intermediate/ Higher Secondary
                        School Certificate- HSSC or
                        equivalent<span class="text-red-600">*</span>
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                required
            label="Intermediate Transcript"
            name="intermediateTranscript"
            :filePath="auth()->user()->userIntermediateTranscriptPhoto?->path ?? ''"
            :fileName="auth()->user()->userIntermediateTranscriptPhoto?->name ?? ''"
    />
            </div>

            {{-- Hssc TranscriptBackSide --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">

                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>Please provide details of your Intermediate/Higher Secondary School Certificate (HSSC) or
                                equivalent qualifications (e.g., F.Sc, A Levels, etc.) (Back side) in the form of an
                                image.<span class="text-red-500">Only IBCC’s attested
                                    document to be
                                    uploaded.</span></p>
                        </div>
                    </div>
                    <p>
                        Upload (Back Side) Intermediate/ Higher Secondary
                        School Certificate- HSSC or
                        equivalent
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                required
            label="Intermediate Transcript Backside"
            name="intermediateTranscriptBackSide"
            :filePath="auth()->user()->userIntermediateTranscriptBackSidePhoto?->path ?? ''"
            :fileName="auth()->user()->userIntermediateTranscriptBackSidePhoto?->name ?? ''"
    />

            </div>

            @if (auth()?->user()?->qualifications?->hssc_exam_passeds_id == 2)
                {{-- equivalenceCertificateHssc --}}

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">

                    <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                        <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                            <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                            <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                                class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                                <p>Please upload clear and legible images of Equivalence Certificate/ Provisional
                                    Equivalence Letter from IBCC (For
                                    HSSC/ Equivalent Foreign Qualifications
                                    only, i.e. A Level/ IB/ 12th Grade etc.)
                                </p>
                            </div>
                        </div>
                        <p>
                            Equivalence Certificate/ Provisional
                            Equivalence Letter from IBCC
                            <span class="text-red-600">*</span>
                        </p>
                    </div>

                    <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                            required
                            label="Equivalence Certificate Hssc"
                            name="equivalenceCertificateHssc"
                            :filePath="auth()->user()->userEquivalenceHsscPhoto?->path ?? ''"
                            :fileName="auth()->user()->userEquivalenceHsscPhoto?->name ?? ''"
                    />

                </div>
            @endif


            {{-- cnic field --}}
            <div id="cnicqweqwedddd" class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">

                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>Please upload your valid CNIC (Computerized National Identity Card), B-Form (Child
                                Registration Certificate), or equivalent identification document. For overseas
                                applicants, provide NICOP (National Identity Card for Overseas Pakistanis), POC
                                (Pakistan Origin Card), or Passport.</p>
                        </div>
                    </div>
                    <p>
                        Upload (Front Side) Valid CNIC/ Smart Card
                        for Juvenile/ B-Form/ CRC (or NICOP/POC/Passport for Overseas)
                        <span class="text-red-600">*</span>
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                required
            label="User Cnic"
            name="cnic"
            :filePath="auth()->user()->userCnic?->path ?? ''"
            :fileName="auth()->user()->userCnic?->name ?? ''"
    />
            </div>

            {{-- cnicBackSide --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">

                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>Please upload your valid CNIC (Computerized National Identity Card), B-Form (Child
                                Registration Certificate), or equivalent identification document (Back Side). For
                                overseas
                                applicants, provide NICOP (National Identity Card for Overseas Pakistanis), POC
                                (Pakistan Origin Card), or Passport.</p>
                        </div>
                    </div>
                    <p>
                        Upload (Back Side) Valid CNIC/ Smart Card
                        for Juvenile/ B-Form/ CRC (or NICOP/POC/Passport for Overseas) <span
                            class="text-red-600">*</span>
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                required
            label="User Cnic Backside"
            name="cnicBackSide"
            :filePath="auth()->user()->userCnicBackSide?->path ?? ''"
            :fileName="auth()->user()->userCnicBackSide?->name ?? ''"
    />

            </div>

            {{-- father cnic --}}

            <div id="fatherCnicasd" class="grid grid-cols-1 gap-8 md:grid-cols-2 items-center justify-center mt-8">

                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>Please upload the valid CNIC (Computerized National Identity Card), POC (Pakistan Origin
                                Card), B-Form (Child Registration Certificate), or Passport of the candidate's father,
                                mother, or guardian. For overseas applicants, provide NICOP (National Identity Card for
                                Overseas Pakistanis), POC, or Passport of the parents.</p>
                        </div>
                    </div>
                    <p>
                        Upload (Front Side) Valid Parent/Guardian CNIC/Passport (Overseas: NICOP/POC/Passport)
                        <span class="text-red-600">*</span>
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                required
            label="User Father Cnic"
                id="fatherCnic"
            name="fatherCnic"
            :filePath="auth()->user()->userFatherCnic?->path ?? ''"
            :fileName="auth()->user()->userFatherCnic?->name ?? ''"
    />

            </div>

            {{-- fatherCnicBackSide --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">

                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>Please upload the valid CNIC (Computerized National Identity Card), POC (Pakistan Origin
                                Card), B-Form (Child Registration Certificate), or Passport of the candidate's father,
                                mother, or guardian. For overseas applicants, provide NICOP (National Identity Card for
                                Overseas Pakistanis), POC, or Passport of the parents (Back Side).</p>
                        </div>
                    </div>
                    <p>
                        Upload (Back Side) Valid Parent/Guardian CNIC/Passport (Overseas: NICOP/POC/Passport)
                        <span class="text-red-600">*</span>
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                required
                id="fatherCnicBackSide"
            label="User Father Cnic Backside"
            name="fatherCnicBackSide"
            :filePath="auth()->user()->userFatherCnicBackSide?->path ?? ''"
            :fileName="auth()->user()->userFatherCnicBackSide?->name ?? ''"
    />

            </div>


            {{-- finger print --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">

                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>Please upload clear and legible images of the candidate's signatures and left thumb
                                impression (LTI).Use only blue color/ ink is admissible for signature and thump impression. Ensure the
                                images are well-lit and easy to read.</p>
                        </div>
                    </div>
                    <p>
                        Upload Specimen Signatures and Left Thumb
                        Impression- LTI of the candidate (in blue color ink only)
                        <span class="text-red-600">*</span>
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                required
            label="Signature"
            name="signature"
            :filePath="auth()->user()->userSignatureImage?->path ?? ''"
            :fileName="auth()->user()->userSignatureImage?->name ?? ''"
    />

            </div>

            {{-- Recent color Photograph --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">

                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>Please upload a recent color photograph of the candidate. The photograph should have a
                                white background only, and the candidate's face should be clearly visible and
                                without any obstructions.</p>
                        </div>
                    </div>
                    <p>
                        Upload Recent color Photograph with white background only
                        <span class="text-red-600">*</span>
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                required
            label="Photo"
            name="photo"
            :filePath="auth()->user()->userColorPhoto?->path ?? ''"
            :fileName="auth()->user()->userColorPhoto?->name ?? ''"
    />

            </div>


            {{-- mdcat result card --}}
            <div id="mdcatResultCard" class="grid grid-cols-1  md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                             class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>General Nursing Diploma Document</p>
                        </div>
                    </div>
                    <p>
                         General Nursing Diploma Document
                        <span class="text-red-600">*</span>
                    </p>
                </div>

                <x-dynamic-file-upload
                        inputHeading="Only Jpg or Jpeg"
                        required
                        label="General Nursing Diploma"
                        name="mdcatResultCard"
                        :filePath="auth()->user()->userMdcatResultCardPhoto?->path ?? ''"
                        :fileName="auth()->user()->userMdcatResultCardPhoto?->name ?? ''"
                />
            </div>


                              {{-- Valid Stay Card/Residence --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">


                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                             class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>
                                @if(auth()->user()->seat_id == 1)
                                    One-Year Post-Basic Specialty
                                @else
                                    Midwifery
                                @endif
                                    Diploma Document
                            </p>
                        </div>
                    </div>
                    <p>
                        @if(auth()->user()->seat_id == 1)
                            One-Year Post-Basic Specialty
                        @else
                            Midwifery
                        @endif
                            Diploma Document
                        <span class="text-red-600">*</span>
                    </p>
                </div>

                <x-dynamic-file-upload
                        inputHeading="Only Jpg or Jpeg"
                        required
                        label="{{ auth()->user()->seat_id == 1 ? 'One-year Post-Basic Specialty Diploma' : 'Midwifery Diploma' }}"
                        name="stayCard"
                        :filePath="auth()->user()->userStayCardPhoto?->path ?? ''"
                        :fileName="auth()->user()->userStayCardPhoto?->name ?? ''"
                />
            </div>

            {{--

                        --}}{{-- Mandatory Fields end here --}}{{--



                        --}}{{-- Valid Stay Card/Residence --}}{{--
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">


                            <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                                <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                                    <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                                    <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                                         class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                                        <p>Valid Stay Card/ Residence Card/ blue Card/ Iqama or related
                                            documents for Overseas Pakistanis (being a Pakistani citizen
                                            permanently resident in a foreign country)</p>
                                    </div>
                                </div>
                                <p>
                                    Upload Valid Stay Card/Residence Document
                                    <span class="text-red-600">*</span>
                                </p>
                            </div>

                            <x-dynamic-file-upload
                                    inputHeading="Only Jpg or Jpeg"
                                    required
                                    label="Stay Card"
                                    name="stayCard"
                                    :filePath="auth()->user()->userStayCardPhoto?->path ?? ''"
                                    :fileName="auth()->user()->userStayCardPhoto?->name ?? ''"
                            />
                        </div>


                        --}}{{-- foreignHsscCertificate  --}}{{--

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">

                            <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                                <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                                    <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                                    <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                                         class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                                        <p>Please upload clear and legible images of High School Certificate issued by the
                                            respective
                                            foreign educational institute confirming applicant to
                                            have completed HSSC/ equivalent studies as a
                                            regular student.</p>
                                    </div>
                                </div>
                                <p>
                                    High School Certificate for HSSC/ Equivalent Studies Confirmation
                                    <span class="text-red-600">*</span>
                                </p>
                            </div>

                            <x-dynamic-file-upload
                                    inputHeading="Only Jpg or Jpeg"
                                    required
                                    label="Foreign Hssc Certificate"
                                    name="foreignHsscCertificate"
                                    :filePath="auth()->user()->userForeignHsscCertificatePhoto?->path ?? ''"
                                    :fileName="auth()->user()->userForeignHsscCertificatePhoto?->name ?? ''"
                            />

                        </div>--}}



            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                             class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>Experience Document First</p>
                        </div>
                    </div>
                    <p>
                        Experience Document First
                        <span class="text-red-600">*</span>
                    </p>
                </div>

                <x-dynamic-file-upload
                        inputHeading="Only Jpg or Jpeg"
                        label="Experience Document First"
                        name="extraDocRequire1"
                        required
                        :filePath="auth()->user()->userDocumentRequirementOnePhoto?->path ?? ''"
                        :fileName="auth()->user()->userDocumentRequirementOnePhoto?->name ?? ''"
                />
            </div>



            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                             class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>Experience Document Second </p>
                        </div>
                    </div>
                    <p>
                        Experience Document Second
                    </p>
                </div>

                <x-dynamic-file-upload
                        inputHeading="Only Jpg or Jpeg"
                        label="Experience Document Second"
                        name="extraDocRequire2"
                        :filePath="auth()->user()->userDocumentRequirementTwoPhoto?->path ?? ''"
                        :fileName="auth()->user()->userDocumentRequirementTwoPhoto?->name ?? ''"
                />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                             class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>Experience Document Third</p>
                        </div>
                    </div>
                    <p>
                        Experience Document Third
                    </p>
                </div>

                <x-dynamic-file-upload
                        inputHeading="Only Jpg or Jpeg"
                        label="Experience Document Third"
                        name="extraDocRequire3"
                        :filePath="auth()->user()->userDocumentRequirementThreePhoto?->path ?? ''"
                        :fileName="auth()->user()->userDocumentRequirementThreePhoto?->name ?? ''"
                />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                             class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>Experience Document Fourth</p>
                        </div>
                    </div>
                    <p>
                        Experience Document Fourth
                    </p>
                </div>

                <x-dynamic-file-upload
                        inputHeading="Only Jpg or Jpeg"
                        label="Experience Document Fourth"
                        name="extraDocRequire4"
                        :filePath="auth()->user()->userDocumentRequirementFourPhoto?->path ?? ''"
                        :fileName="auth()->user()->userDocumentRequirementFourPhoto?->name ?? ''"
                />
            </div>

          {{--  <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                             class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>Nursing Result Card Document </p>
                        </div>
                    </div>
                    <p>
                        Nursing Result Card Document
                    </p>
                </div>

                <x-dynamic-file-upload
                        inputHeading="Only Jpg or Jpeg"
                        label="Extra Document 5"
                        name="extraDocRequire5"
                        :filePath="auth()->user()->userDocumentRequirementFivePhoto?->path ?? ''"
                        :fileName="auth()->user()->userDocumentRequirementFivePhoto?->name ?? ''"
                />
            </div>--}}


        </div>
    </div>



    @if(1 != 1)
    <div class="mt-7 mb-7 bg-white rounded-lg"
        style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.03);">
        <div>
            <p class="p-5 md:px-10 py-4 text-2xl font-medium text-[#333333] tracking-[0.29px] font-sans">
                Other
                Document(s)
                (if any)
            </p>
            <hr class="border-t-2 w-full border-[#DAE4EA]">
        </div>

        <div class="p-5 md:p-10 mb-5 font-medium">

            <div>
                <p class="text-base text-center mb-6 font-bold tracking-[0.29px] font-sans">Attach Document Translated
                    from any other foreign
                    language etc (if any).</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>i.e. Document Translated from any other foreign
                                language etc. </p>
                        </div>
                    </div>
                    <p>
                        Other
                        Document(s) First Page
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                label="Extra Document 1"
                name="extraDocRequire1"
                :filePath="auth()->user()->userDocumentRequirementOnePhoto?->path ?? ''"
                :fileName="auth()->user()->userDocumentRequirementOnePhoto?->name ?? ''"
        />
            </div>



            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>i.e. Document Translated from any other foreign
                                language etc. </p>
                        </div>
                    </div>
                    <p>
                        Other
                        Document(s) Second Page
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                label="Extra Document 2"
                name="extraDocRequire2"
                :filePath="auth()->user()->userDocumentRequirementTwoPhoto?->path ?? ''"
                :fileName="auth()->user()->userDocumentRequirementTwoPhoto?->name ?? ''"
        />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>i.e. Document Translated from any other foreign
                                language etc. </p>
                        </div>
                    </div>
                    <p>
                        Other
                        Document(s) Third Page
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                label="Extra Document 3"
                name="extraDocRequire3"
                :filePath="auth()->user()->userDocumentRequirementThreePhoto?->path ?? ''"
                :fileName="auth()->user()->userDocumentRequirementThreePhoto?->name ?? ''"
        />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>i.e. Document Translated from any other foreign
                                language etc. </p>
                        </div>
                    </div>
                    <p>
                        Other
                        Document(s) Fourth Page
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                label="Extra Document 4"
                name="extraDocRequire4"
                :filePath="auth()->user()->userDocumentRequirementFourPhoto?->path ?? ''"
                :fileName="auth()->user()->userDocumentRequirementFourPhoto?->name ?? ''"
        />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>i.e. Document Translated from any other foreign
                                language etc. </p>
                        </div>
                    </div>
                    <p>
                        Other
                        Document(s) Fifth Page
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                label="Extra Document 5"
                name="extraDocRequire5"
                :filePath="auth()->user()->userDocumentRequirementFivePhoto?->path ?? ''"
                :fileName="auth()->user()->userDocumentRequirementFivePhoto?->name ?? ''"
        />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>i.e. Document Translated from any other foreign
                                language etc. </p>
                        </div>
                    </div>
                    <p>
                        Other
                        Document(s) Sixth Page
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                label="Extra Document 6"
                name="extraDocRequire6"
                :filePath="auth()->user()->userDocumentRequirementSixPhoto?->path ?? ''"
                :fileName="auth()->user()->userDocumentRequirementSixPhoto?->name ?? ''"
        />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>i.e. Document Translated from any other foreign
                                language etc. </p>
                        </div>
                    </div>
                    <p>
                        Other
                        Document(s) Seventh Page
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                label="Extra Document 7"
                name="extraDocRequire7"
                :filePath="auth()->user()->userDocumentRequirementSevenPhoto?->path ?? ''"
                :fileName="auth()->user()->userDocumentRequirementSevenPhoto?->name ?? ''"
        />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>i.e. Document Translated from any other foreign
                                language etc. </p>
                        </div>
                    </div>
                    <p>
                        Other
                        Document(s) Eigth Page
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                label="Extra Document 8"
                name="extraDocRequire8"
                :filePath="auth()->user()->userDocumentRequirementEightPhoto?->path ?? ''"
                :fileName="auth()->user()->userDocumentRequirementEightPhoto?->name ?? ''"
        />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>i.e. Document Translated from any other foreign
                                language etc. </p>
                        </div>
                    </div>
                    <p>
                        Other
                        Document(s) Ninth Page
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                label="Extra Document 9"
                name="extraDocRequire9"
                :filePath="auth()->user()->userDocumentRequirementNinePhoto?->path ?? ''"
                :fileName="auth()->user()->userDocumentRequirementNinePhoto?->name ?? ''"
        />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center justify-center mt-8">
                <div x-data="{ tooltipOpen: false }" class="flex items-start gap-3">
                    <div @click="tooltipOpen = !tooltipOpen" class="relative group">
                        <x-heroicon-s-information-circle class="h-7 w-7 text-blue-600 cursor-pointer" />
                        <div x-show="tooltipOpen" @click.away="tooltipOpen = false"
                            class="absolute bg-gray-300 text-black p-3 shadow-md rounded-md border max-w-lg w-96 border-gray-500 top-8 left-0 z-10 opacity-100 transition-opacity duration-300">
                            <p>i.e. Document Translated from any other foreign
                                language etc. </p>
                        </div>
                    </div>
                    <p>
                        Other
                        Document(s) Tenth Page
                    </p>
                </div>

                <x-dynamic-file-upload
                            inputHeading="Only Jpg or Jpeg"
                label="Extra Document 10"
                name="extraDocRequire10"
                :filePath="auth()->user()->userDocumentRequirementTenPhoto?->path ?? ''"
                :fileName="auth()->user()->userDocumentRequirementTenPhoto?->name ?? ''"
        />
            </div>



        </div>
    </div>
    @endif
    <div class="grid grid-cols-2 mb-16">
        <div>
            <button wire:click.prevent="$emit('goToStep', 5)"
                class=" bg-transparent hover:bg-white text-sm px-3 py-2 md:px-6 md:py-3 mb-2 rounded-lg border-2 border-[#9BABB7]  gap-2 "
                type="button">
                <span class="flex flex-row items-center gap-2 justify-center text-[#687076] font-semibold text-base">
                    <x-heroicon-s-arrow-narrow-left class="w-5 h-5" />
                    Previous Step
                </span>
            </button>
        </div>
        <div class="text-right">
            <button
                class=" bg-[#3c1fff] hover:bg-[#5345ff] text-sm px-3 py-2 md:px-6 md:py-3 mb-2 rounded-lg border border-[#179F9E]  gap-2 "
                type="submit">
                <span class="flex flex-row items-center gap-2 justify-center text-white font-semibold text-base">
                    Save & Submit
                    <x-heroicon-s-arrow-narrow-right class="w-5 h-5" />
                    <span wire:loading wire:target="submit">
                        <p class="flex"><x-loader /></p>
                    </span>
                </span>
            </button>
        </div>
    </div>
</form>

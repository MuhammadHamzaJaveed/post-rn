<?php

namespace App\Services\UserServices;

use App\Models\OTPS;
use App\Models\AdmissionTest;
use App\Models\College;
use App\Models\CollegePreference;
use App\Models\PersonalDetail;
use App\Models\Program;
use App\Models\Qualification;
use App\Models\SeatCategory;
use App\Repository\MdcatCenter\Interfaces\MdcatCenterRepositoryInterface;
use App\Repository\InstitutionType\Interfaces\InstitutionTypeRepositoryInterface;
use App\Repository\AdmissionTest\Interfaces\AdmissionTestRepositoryInterface;
use App\Repository\College\Interfaces\CollegePreferenceRepositoryInterface;
use App\Repository\College\Interfaces\CollegeRepositoryInterface;
use App\Repository\Gender\Interfaces\GenderRepositoryInterface;
use App\Repository\CnicPassport\Interfaces\CnicPassportRepositoryInterface;
use App\Repository\Boards\Interfaces\BoardsRepositoryInterface;
use App\Repository\MdcatPassingYear\Interfaces\MdcatPassingYearRepositoryInterface;
use App\Repository\Nationality\Interfaces\NationalityRepositoryInterface;
use App\Repository\ExamPassed\Interfaces\ExamPassedRepositoryInterface;
use App\Repository\District\Interfaces\DistrictRepositoryInterface;
use App\Repository\PersonalDetails\Interfaces\PersonalDetailsRepositoryInterface;
use App\Repository\Program\Interfaces\ProgramRepositoryInterface;
use App\Repository\Qualifications\Interfaces\QualificationRepositoryInterface;
use App\Repository\ResidenceArea\Interfaces\ResidenceAreaRepositoryInterface;
use App\Repository\SeatCategory\Interfaces\SeatCategoryRepositoryInterface;
use App\Repository\Users\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\SscExamPassed\Interfaces\SscExamPassedRepositoryInterface;

class UserServices
{
    protected $userRepository;

    protected $institutionRepository;

    protected $mdcatcenterRepository;

    protected $programRepository;

    protected $seatCategoryRepository;

    protected $genderRepository;

    protected $cnicPassportRepository;

    protected $nationalityRepository;

    protected $districtRepository;

    protected $boardsRepository;

    protected $examPassedRepository;

    protected $residenceAreaRepository;

    protected $personalDetailsRepository;

    protected $qualificationRepository;

    protected $admissionTestRepository;

    protected $collegeRepository;

    protected $collegePreferenceRepository;

    protected $sscExamPassedRepository;

    protected $mdcatpassingYearRepository;

    /**
     * UserServices  constructor.
     * @param MdcatCenterRepositoryInterface $mdcatcenterRepository
     * @param MdcatPassingYearRepositoryInterface $mdcatpassingYearRepository
     *@param InstitutionTypeRepositoryInterface $institutionRepository
     * @param  UserRepositoryInterface  $userRepository
     * @param  ProgramRepositoryInterface  $programRepository
     * @param  SeatCategoryRepositoryInterface  $seatCategoryRepository
     * @param  GenderRepositoryInterface  $genderRepository
     * @param  CnicPassportRepositoryInterface $cnicPassportRepository
     * @param  NationalityRepositoryInterface  $nationalityRepository
     * @param  DistrictRepositoryInterface  $districtRepository
     * @param  BoardsRepositoryInterface  $boardsRepository
     * @param  ExamPassedRepositoryInterface  $examPassedRepository
     * @param  ResidenceAreaRepositoryInterface  $residenceAreaRepository
     * @param  PersonalDetailsRepositoryInterface  $personalDetailsRepository
     * @param  QualificationRepositoryInterface  $qualificationRepository
     * @param  AdmissionTestRepositoryInterface  $admissionTestRepository
     * @param  CollegeRepositoryInterface  $collegeRepository
     * @param  CollegePreferenceRepositoryInterface  $collegePreferenceRepository
     * @param  SscExamPassedRepositoryInterface $sscExamPassedRepository
     */
    public function __construct(
        MdcatCenterRepositoryInterface $mdcatcenterRepository,
        InstitutionTypeRepositoryInterface $institutionRepository,
        UserRepositoryInterface $userRepository,
        ProgramRepositoryInterface $programRepository,
        SeatCategoryRepositoryInterface $seatCategoryRepository,
        GenderRepositoryInterface $genderRepository,
        CnicPassportRepositoryInterface $cnicPassportRepository,
        NationalityRepositoryInterface $nationalityRepository,
        DistrictRepositoryInterface $districtRepository,
        BoardsRepositoryInterface $boardsRepository,
        ExamPassedRepositoryInterface  $examPassedRepository,
        ResidenceAreaRepositoryInterface $residenceAreaRepository,
        PersonalDetailsRepositoryInterface $personalDetailsRepository,
        QualificationRepositoryInterface $qualificationRepository,
        AdmissionTestRepositoryInterface $admissionTestRepository,
        CollegeRepositoryInterface $collegeRepository,
        CollegePreferenceRepositoryInterface $collegePreferenceRepository,
        SscExamPassedRepositoryInterface $sscExamPassedRepository,
        MdcatPassingYearRepositoryInterface $mdcatpassingYearRepository,
    ) {
        $this->mdcatcenterRepository = $mdcatcenterRepository;
        $this->mdcatpassingYearRepository = $mdcatpassingYearRepository;
        $this->institutionRepository = $institutionRepository;
        $this->userRepository = $userRepository;
        $this->programRepository = $programRepository;
        $this->seatCategoryRepository = $seatCategoryRepository;
        $this->genderRepository = $genderRepository;
        $this->cnicPassportRepository = $cnicPassportRepository;
        $this->nationalityRepository = $nationalityRepository;
        $this->districtRepository = $districtRepository;
        $this->boardsRepository = $boardsRepository;
        $this->examPassedRepository = $examPassedRepository;
        $this->residenceAreaRepository = $residenceAreaRepository;
        $this->personalDetailsRepository = $personalDetailsRepository;
        $this->qualificationRepository = $qualificationRepository;
        $this->admissionTestRepository = $admissionTestRepository;
        $this->collegeRepository = $collegeRepository;
        $this->collegePreferenceRepository = $collegePreferenceRepository;
        $this->sscExamPassedRepository = $sscExamPassedRepository;
    }

    /**
     * Update or create an OTP record for a user.
     *
     * @param  int  $userId
     * @param  string  $otp
     * @param  int  $otpTypeId
     * @param  int  $otpReasonId
     * @return OTPS
     */
    public function updateOrCreateOTP(int $userId, string $otp, int $otpTypeId, int $otpReasonId): OTPS
    {
        return OTPS::updateOrCreate(
            ['user_id' => $userId],
            [
                'value' => $otp,
                'otp_type_id' => $otpTypeId,
                'otp_reason_id' => $otpReasonId,
                'sent_at' => now(),
            ]
        );
    }

    /**
     * @param  array  $columns
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return Collection<Program>
     */
    public function getAllCnicPassport(
        array $columns = ['*'],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): Collection {
        return $this->cnicPassportRepository->all($columns, $with, $orderBy, $sortBy);
    }


    /**
     * @param  array  $columns
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return Collection<Program>
     */
    public function getAllGenders(
        array $columns = ['*'],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): Collection {
        return $this->genderRepository->all($columns, $with, $orderBy, $sortBy);
    }


    /**
     * @param  array  $columns
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return Collection<Program>
     */
    public function getAllInstitutionTypes(
        array $columns = ['*'],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): Collection {
        return $this->institutionRepository->all($columns, $with, $orderBy, $sortBy);
    }

    /**
     * @param  array  $columns
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return Collection<Program>
     */
    public function getAllMdcatCenter(
        array $columns = ['*'],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): Collection {
        return $this->mdcatcenterRepository->all($columns, $with, $orderBy, $sortBy);
    }

    public function getAllMdcatPassingYear(
        array $columns = ['*'],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): Collection {
        return $this->mdcatpassingYearRepository->all($columns, $with, $orderBy, $sortBy);
    }

    /**
     * @param  array  $where
     * @param  array  $columns
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return Collection<College>
     */
    public function allCollegesWhere(
        array $columns = ['*'],
        array $where = [],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): Collection {
        return $this->collegeRepository->allWhere($columns, $where, $with, $orderBy, $sortBy);
    }

    /**
     * @param  array  $columns
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return Collection<Program>
     */
    public function getAllNationalities(
        array $columns = ['*'],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): Collection {
        return $this->nationalityRepository->all($columns, $with, $orderBy, $sortBy);
    }

    /**
     * @param  array  $columns
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return Collection<Program>
     */
    public function getAllExams(
        array $columns = ['*'],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): Collection {
        return $this->examPassedRepository->all($columns, $with, $orderBy, $sortBy);
    }

    /**
     * @param  array  $columns
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return Collection<Program>
     */
    public function getAllDomicileDistricts(
        array $columns = ['*'],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): Collection {
        return $this->districtRepository->all($columns, $with, $orderBy, $sortBy);
    }

    /**
     * @param  array  $columns
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return Collection<Program>
     */
    public function getAllBoards(
        array $columns = ['*'],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): Collection {
        return $this->boardsRepository->all($columns, $with, $orderBy, $sortBy);
    }

    /**
     * @param  array  $columns
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return Collection<Program>
     */
    public function getAllResidenceAreas(
        array $columns = ['*'],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): Collection {
        return $this->residenceAreaRepository->all($columns, $with, $orderBy, $sortBy);
    }

    /**
     * @param  array  $columns
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return Collection<Program>
     */
    public function getAllPrograms(
        array $columns = ['*'],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): Collection {
        return $this->programRepository->all($columns, $with, $orderBy, $sortBy);
    }

    /**
     * @param  array  $columns
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return Collection<SeatCategory>
     */
    public function getAllSeatCategories(
        array $columns = ['*'],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): Collection {
        return $this->seatCategoryRepository->all($columns, $with, $orderBy, $sortBy);
    }

    /**
     * @param  int  $perPage
     * @param  string  $searchByName
     * @param  array  $with
     * @return mixed
     */
    public function getAllUsersPaginatedResults(
        int    $perPage,
        string $searchByName,
        array  $with = []
    ) {
        $users = $this->userRepository->newModelInstance()::query();

        if (!blank($searchByName)) {
            $users->where('name', 'like', '%' . $searchByName . '%');
        }

        return $users->whereNotIn('email', [auth()->user()->email])->with($with)->paginate($perPage);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteUser(int $id): bool
    {
        return $this->userRepository->delete($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findOneUserById(int $id)
    {
        return $this->userRepository->findBy(['id' => $id]);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function createUser(array $attributes)
    {
        return $this->userRepository->create($attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function createCollegePreference(array $attributes)
    {
        return $this->collegePreferenceRepository->create($attributes);
    }

    /**
     * @param  array  $search
     * @param  array  $attributes
     * @return CollegePreference
     */
    public function updateOrCreateCollegePreference(array $search, array $attributes): CollegePreference
    {
        return $this->collegePreferenceRepository->updateOrCreate($search, $attributes);
    }

    /**
     * @param  array  $attributes
     * @param  int  $id
     * @return mixed
     */
    public function updateUser(array $attributes, int $id)
    {
        return $this->userRepository->update($attributes, $id);
    }

    /**
     * @param  array  $search
     * @param  array  $attributes
     * @return PersonalDetail
     */
    public function updateOrCreatePersonalDetails(array $search, array $attributes): PersonalDetail
    {
        return $this->personalDetailsRepository->updateOrCreate($search, $attributes);
    }

    /**
     * @param  array  $search
     * @param  array  $attributes
     * @return Qualification
     */
    public function updateOrCreateQualifications(array $search, array $attributes): Qualification
    {
        return $this->qualificationRepository->updateOrCreate($search, $attributes);
    }

    /**
     * @param  array  $search
     * @param  array  $attributes
     * @return AdmissionTest
     */
    public function updateOrCreateAdmissionTests(array $search, array $attributes): AdmissionTest
    {
        return $this->admissionTestRepository->updateOrCreate($search, $attributes);
    }

    /**
     * @return mixed
     */
    private function getColleges()
    {
        $college = $this->collegeRepository->newModelInstance()::query();
        $seatCategories = auth()->user()->seatCategories->pluck('id')->toArray();
        $gender = auth()?->user()?->personalDetails?->gender?->name;

        if ($gender == 'Male' || $gender == 'Others') {
            $college->where('isFemale', 0);
        }
        $college->where(function ($query) use ($seatCategories) {
            foreach ($seatCategories as $category) {
                $column = $this->getColumnNameForCategory($category);

                if ($column) {
                    $query->orWhere($column, '>', 0);
                }
            }
        });
        return $college;
    }
    private function getColumnNameForCategory($category)
    {
        // Define a mapping of category IDs to column names
        $categoryToColumn = [
            1 => 'openMeritSeats',
            2 => 'disabilitySeats',
            3 => 'underdevelopedAreas',
            4 => 'cholistanSeats',
            5 => 'overSeasSeats',
            6 => 'isReciprocal',
        ];

        // Return the column name if it exists in the mapping, otherwise return null
        return $categoryToColumn[$category] ?? null;
    }

    /**
     * @param  array  $columns
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return Collection<Program>
     */
    public function getSscExams(
        array $columns = ['*'],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): Collection {
        return $this->sscExamPassedRepository->all($columns, $with, $orderBy, $sortBy);
    }

    public function getMbbsColleges()
    {
        return $this->getCollege(0);
    }

    public function getBdsColleges()
    {
        return $this->getCollege(1);
    }

    private function getCollege($isBds)
    {
        $college = $this->getColleges();

        $college->where('isBds', $isBds);

        return $college->get();
    }
}

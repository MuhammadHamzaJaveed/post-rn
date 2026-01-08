<?php

namespace App\Providers;

use App\Repository\CnicPassport\CnicPassportRepository;
use App\Repository\CnicPassport\Interfaces\CnicPassportRepositoryInterface;
use App\Repository\MdcatCenter\MdcatCenterRepository;
use App\Repository\MdcatCenter\Interfaces\MdcatCenterRepositoryInterface;
use App\Repository\InstitutionType\InstitutionTypeRepository;
use App\Repository\InstitutionType\Interfaces\InstitutionTypeRepositoryInterface;
use App\Repository\AdmissionTest\AdmissionTestRepository;
use App\Repository\AdmissionTest\Interfaces\AdmissionTestRepositoryInterface;
use App\Repository\Base\BaseRepository;
use App\Repository\Base\Interfaces\BaseRepositoryInterface;
use App\Repository\College\CollegePreferenceRepository;
use App\Repository\College\CollegeRepository;
use App\Repository\College\Interfaces\CollegePreferenceRepositoryInterface;
use App\Repository\College\Interfaces\CollegeRepositoryInterface;
use App\Repository\Gender\GenderRepository;
use App\Repository\Gender\Interfaces\GenderRepositoryInterface;
use App\Repository\MdcatPassingYear\Interfaces\MdcatPassingYearRepositoryInterface;
use App\Repository\MdcatPassingYear\MdcatPassingYearRepository;
use App\Repository\Nationality\Interfaces\NationalityRepositoryInterface;
use App\Repository\Nationality\NationalityRepository;
use App\Repository\District\Interfaces\DistrictRepositoryInterface;
use App\Repository\District\DistrictRepository;
use App\Repository\PersonalDetails\Interfaces\PersonalDetailsRepositoryInterface;
use App\Repository\PersonalDetails\PersonalDetailRepository;
use App\Repository\Program\Interfaces\ProgramRepositoryInterface;
use App\Repository\Program\ProgramRepository;
use App\Repository\Qualifications\Interfaces\QualificationRepositoryInterface;
use App\Repository\Qualifications\QualificationRepository;
use App\Repository\ResidenceArea\Interfaces\ResidenceAreaRepositoryInterface;
use App\Repository\ResidenceArea\ResidenceAreaRepository;
use App\Repository\SeatCategory\Interfaces\SeatCategoryRepositoryInterface;
use App\Repository\SeatCategory\SeatCategoryRepository;
use App\Repository\ExamPassed\ExamPassedRepository;
use App\Repository\ExamPassed\Interfaces\ExamPassedRepositoryInterface;
use App\Repository\Users\UserRepository;
use App\Repository\Users\Interfaces\UserRepositoryInterface;
use App\Repository\Media\MediaRepository;
use App\Repository\Media\Interfaces\MediaRepositoryInterface;
use App\Repository\Department\DepartmentRepository;
use App\Repository\Department\Interfaces\DepartmentRepositoryInterface;
use App\Repository\Boards\Interfaces\BoardsRepositoryInterface;
use App\Repository\Boards\BoardsRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\SscExamPassed\Interfaces\SscExamPassedRepositoryInterface;
use App\Repository\SscExamPassed\SscExamPassedRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $_SERVER['SERVER_NAME'] = gethostname();
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(MediaRepositoryInterface::class, MediaRepository::class);
        $this->app->bind(ProgramRepositoryInterface::class, ProgramRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(SeatCategoryRepositoryInterface::class, SeatCategoryRepository::class);
        $this->app->bind(GenderRepositoryInterface::class, GenderRepository::class);
        $this->app->bind(NationalityRepositoryInterface::class, NationalityRepository::class);
        $this->app->bind(ResidenceAreaRepositoryInterface::class, ResidenceAreaRepository::class);
        $this->app->bind(PersonalDetailsRepositoryInterface::class, PersonalDetailRepository::class);
        $this->app->bind(QualificationRepositoryInterface::class, QualificationRepository::class);
        $this->app->bind(AdmissionTestRepositoryInterface::class, AdmissionTestRepository::class);
        $this->app->bind(DistrictRepositoryInterface::class, DistrictRepository::class);
        $this->app->bind(BoardsRepositoryInterface::class, BoardsRepository::class);
        $this->app->bind(ExamPassedRepositoryInterface::class, ExamPassedRepository::class);
        $this->app->bind(CollegeRepositoryInterface::class, CollegeRepository::class);
        $this->app->bind(CollegePreferenceRepositoryInterface::class, CollegePreferenceRepository::class);
        $this->app->bind(InstitutionTypeRepositoryInterface::class, InstitutionTypeRepository::class);
        $this->app->bind(MdcatCenterRepositoryInterface::class,MdcatCenterRepository::class);
        $this->app->bind(CnicPassportRepositoryInterface::class,CnicPassportRepository::class);
        $this->app->bind(SscExamPassedRepositoryInterface::class,SscExamPassedRepository::class);
        $this->app->bind(MdcatPassingYearRepositoryInterface::class,MdcatPassingYearRepository::class);
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\GradeRepositoryInterface;
use App\Repositories\GradeRepository;
use App\Repositories\SchoolRepositoryInterface;
use App\Repositories\SchoolRepository;
use App\Repositories\SectionRepositoryInterface;
use App\Repositories\SectionRepository;
use App\Repositories\StudentRepository;
use App\Repositories\StudentRepositoryInterface;
use App\Repositories\SiteRepository;
use App\Repositories\SiteRepositoryInterface;
use App\Repositories\TeacherRepository;
use App\Repositories\TeacherRepositoryInterface;
use App\Repositories\SettingRepository;
use App\Repositories\SettingRepositoryInterface;
use App\Repositories\CourseRepository;
use App\Repositories\CourseRepositoryInterface;
use App\Repositories\ChapterCategoryRepository;
use App\Repositories\ChapterCategoryRepositoryInterface;
use App\Repositories\ChapterRepository;
use App\Repositories\ChapterRepositoryInterface;
use App\Repositories\CourseResourceRepository;
use App\Repositories\CourseResourceRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(GradeRepositoryInterface::class, GradeRepository::class);
        $this->app->bind(SchoolRepositoryInterface::class, SchoolRepository::class);
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(SiteRepositoryInterface::class, SiteRepository::class);
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind(ChapterCategoryRepositoryInterface::class, ChapterCategoryRepository::class);
        $this->app->bind(ChapterRepositoryInterface::class, ChapterRepository::class);
        $this->app->bind(CourseResourceRepositoryInterface::class, CourseResourceRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

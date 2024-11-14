<?php

namespace App\Repositories;

class SiteRepository extends DM_BaseRepository implements SiteRepositoryInterface
{
    protected $schoolRepository;
    protected $gradeRepository;
    protected $sectionRepository;

    public function __construct(
        SchoolRepositoryInterface $schoolRepository,
        GradeRepositoryInterface $gradeRepository,
        SectionRepositoryInterface $sectionRepository
    ) {
        $this->schoolRepository = $schoolRepository;
        $this->gradeRepository = $gradeRepository;
        $this->sectionRepository = $sectionRepository;
    }

    public function getSchool()
    {
        return $this->schoolRepository->getAll();
    }

    public function getGrade()
    {
        return $this->gradeRepository->getAll();
    }

    public function getSection()
    {
        return $this->sectionRepository->getAll();
    }
}

<?php

namespace StudentBundle\Services;

use Doctrine\ORM\EntityRepository;

/**
 * Class StudentService
 * @package StudentBundle\Services
 */
class StudentService
{
    /**
     * @var EntityRepository
     */
    protected $studentRepository;

    /**
     * StudentService constructor.
     * @param EntityRepository $studentRepository
     */
    public function __construct(EntityRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * @return array
     */
    public function getRandomData()
    {
        return [$this->studentRepository->findOneBy(['id' => random_int(1, 25000)])];
    }

    /**
     * @param string $path
     *
     * @return null|object
     */
    public function getInfo($path)
    {
        return $this->studentRepository->findOneBy(['path' => $path]);
    }
}

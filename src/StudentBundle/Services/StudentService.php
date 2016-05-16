<?php

namespace StudentBundle\Services;

use Doctrine\ORM\EntityRepository;

/**
 * Class StudentService
 * @package StudentBundle\Services
 */
class StudentService
{
    const STUDENT_PATH_SEPARATOR = '_';

    /**
     * @var EntityRepository
     */
    protected $studentRepository;

    /**
     * @var array
     */
    private $duplicates = [];

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

    /**
     * @param $name
     *
     * @return string
     */
    public function getUniquePath($name)
    {
        $path = strtolower(str_replace(' ', self::STUDENT_PATH_SEPARATOR, $name));

        if (array_key_exists($path, $this->duplicates)) {
            $count = $this->duplicates[$path];
            $path = $path . self::STUDENT_PATH_SEPARATOR . ++$count;
            $this->duplicates[$path] = $count;

            return $path;
        }

        $this->duplicates[$path] = 1;
        $path = $path . self::STUDENT_PATH_SEPARATOR . '1';

        return $path;
    }
}

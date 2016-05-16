<?php

namespace StudentBundle\Command;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

/**
 * Class GeneratePathCommand
 * @package StudentBundle\Command
 */
class GeneratePathCommand extends ContainerAwareCommand
{
    const STUDENTS_TOTAL_COUNT = 25000;
    const STUDENTS_UPDATE_STEP = 100;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * GeneratePathCommand constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    /**
     * Configure command
     */
    protected function configure()
    {
        $this
            ->setName('students:generate:paths')
            ->setDescription('Generate paths')
        ;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $progressBar = new ProgressBar($output, self::STUDENTS_TOTAL_COUNT);
        $progressBar->setFormat(
            '%current%/%max% [%bar%] <info>%percent:3s%%</info> %elapsed:6s% <fg=white;bg=blue>%memory:6s%</>'
        );
        $progressBar->start();

        $iterator = 0;
        $query = $this->entityManager->createQuery('select s from StudentBundle\Entity\Student s');
        $iterableResult = $query->iterate();
        foreach ($iterableResult as $row) {
            $student = $row[0];
            $path = $this->getContainer()->get('student.services.student_service')->getUniquePath($student->getName());

            $student->setPath($path);
            if (($iterator % self::STUDENTS_UPDATE_STEP) === 0) {
                $this->entityManager->flush(); // Executes all updates.
                $this->entityManager->clear(); // Detaches all objects from Doctrine!
            }
            $progressBar->advance();
            ++$iterator;
        }
        $this->entityManager->flush();
        $this->entityManager->clear();
        $progressBar->finish();

        echo PHP_EOL;
    }
}

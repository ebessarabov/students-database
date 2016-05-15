<?php

namespace StudentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

/**
 * Class StudentController
 * @package StudentBundle\Controller
 */
class StudentController extends Controller
{
    /**
     * @Route("students/random", name="student_list")
     * @Cache(expires="15 minutes", public=true)
     * @Template
     *
     * @return array
     */
    public function indexAction()
    {
        return [
            'students' => $this->get('student.services.student_service')->getRandomData()
        ];
    }

    /**
     * @Route("students/detail/{path}", name="student_info")
     * @Cache(expires="15 minutes", public=true)
     * @Template
     * @param $path
     *
     * @return array
     */
    public function infoAction($path)
    {
        return [
            'student' => $this->get('student.services.student_service')->getInfo($path)
        ];
    }
}

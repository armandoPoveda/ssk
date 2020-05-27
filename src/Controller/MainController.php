<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\{Contact, Faq, User, Course, Product, ProductType, CourseType};
use App\Form\{ContactType};
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class MainController extends AbstractController
{
    /**
     * @Route("/{_locale?}", name="home")
     */
    public function home(Request $request)
    {
        // $page = 'home';
        $title = 'HOME';
      
        $filesHome = scandir('images/home/');
        foreach ($filesHome as $key => $value) {
            if ($value != "." && $value != "..") {
                $this->resize_image('images/home/' . $value, 1000, 1000);
            }
        }
        return $this->render('home/home.html.twig', [
            'title' => $title
        ]);
    }

    /**
     * @Route("/{_locale?}/faq", name="faq")
     */
    public function faq()
    {
        $title = 'FAQ';

        $faq = $this->getDoctrine()
            ->getRepository(Faq::class)
            ->findAll();

        return $this->render('faq/faq.html.twig', [
            'title' => $title, 'faq' => $faq
        ]);
    }

    /**
     * @Route("/{_locale?}/course/{type?}", name="course")
     */
    public function courses($type)
    {
        $title = 'COURSES';

        if ($type === null) {
            $type = 1;
        }

        $courses = $this->getDoctrine()
            ->getRepository(Course::class)
            ->findBy((['type' => $type]));

        foreach ($courses as $key => $value) {

            $this->resize_image('images/courses/' . $value->getImage(), 1000, 1000);
        }

        $coursesType = $this->getDoctrine()
            ->getRepository(CourseType::class)
            ->findAll();

        return $this->render('course/course.html.twig', [
            'title' => $title, 'courses' => $courses, 'coursesType' => $coursesType
        ]);
    }

    function resize_image($file, $w, $h, $crop = true)
    {
        // dd($file, $w, $h);
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        // dd($r);
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width - ($width * abs($r - $w / $h)));
            } else {
                $height = ceil($height - ($height * abs($r - $w / $h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w / $h > $r) {
                $newwidth = $h * $r;
                $newheight = $h;
            } else {
                $newheight = $w / $r;
                $newwidth = $w;
            }
        }
        // dd($file);
        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 100, 100, 100, 100, $newwidth, $newheight, $width, $height);

        return $dst;
    }
}

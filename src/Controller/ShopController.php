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


class ShopController extends AbstractController
{

/**
     * @Route("/{_locale?}/shop/{type?}", name="shop")
     */
    public function shop($type)
    {
        $title = 'SHOP';
        $page = 'shop';
        if ($type === null) {
            $type = 1;
        }

        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findBy((['type' => $type]));
        foreach ($products as $key => $value) {

            $this->resize_image('images/products/' . $value->getImage(), 1000, 1000);
        }
        // dd($rst);
        $productTypes = $this->getDoctrine()
            ->getRepository(ProductType::class)
            ->findAll();

        return $this->render('product/shop.html.twig', [
            'title' => $title, 'products' => $products, 'productTypes' => $productTypes
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
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


class ContactController extends AbstractController
{

  /**
     * @Route("/{_locale?}/contact", name="contact")
     */
    public function contact(Request $request)
    {
        $title = 'CONTACTO';

        $user = new Contact();

        $formContact = $this->createForm(ContactType::class, $user);

        $formContact->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $user->setDate(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->render('contact/contact.html.twig', [
            'title' => $title,
            'formContact' => $formContact->createView()
        ]);
    }


}
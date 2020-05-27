<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\{Contact, Faq, User, Course, Product, ProductType, CourseType};
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/{_locale?}/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        $title = 'HOME';

        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        } else {
            echo '<script language="javascript">';
            echo 'alert("Usuario o contraseña incorrectas")';
            echo '</script>';
        }

        return $this->redirectToRoute('home');

        // dd($authenticationUtils);
        // get the login error if there is one
        // $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        // $lastUsername = $authenticationUtils->getLastUsername();

        // return $this->redirectToRoute('app_login', ['last_username' => $lastUsername, 'error' => $error]);
      
    }

    /**
     * @Route("/{_locale?}/logout", name="app_logout", methods={"GET"})
     */
    public function logout(Request $request)
    {
        $locale = $request->getLocale();
        // dd($locale);
        $request->setLocale($locale);

        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

     /**
     * @Route("/{_locale?}/register", name="register")
     */
    public function register(EntityManagerInterface $entityManager, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $error = null;
        $title = 'HOME';

        $parametersToValidate = $request->query->all();

        $userName = $parametersToValidate['userNameRegister'];
        $passwordRegister = $parametersToValidate['passwordRegister'];
        $repeatPassword = $parametersToValidate['repeatPassword'];

        $queryUserName = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneByUserName($userName);

        if ($queryUserName === null) {
            if ($passwordRegister === $repeatPassword) {
                $user = new User();
                $user->setuserName($userName);
                $user->setPassword($passwordEncoder->encodePassword($user, $passwordRegister));
                $entityManager->persist($user);
                $entityManager->flush();
                echo '<script language="javascript">';
                echo 'alert("Usuario registrado con éxito")';
                echo '</script>';
                return $this->render('/home/home.html.twig', ['title' => $title]);
            } else {
                echo '<script language="javascript">';
                echo 'alert("Las contraseñas no son idénticas")';
                echo '</script>';
                return $this->render('/home/home.html.twig', ['title' => $title]);
            }
        } else {
            echo '<script language="javascript">';
            echo 'alert("El usuario existe, elige otro")';
            echo '</script>';
            return $this->render('/home/home.html.twig', ['title' => $title]);
        }
    }
}

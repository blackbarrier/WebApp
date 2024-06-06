<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\EditUserType;
use App\Form\PasswordChangeType;
use App\Repository\RolRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType as TypePasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, RolRepository $rolRepository, UserRepository $userRepository ): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // dd("Formulario enviado");

            $userEncontrado= $userRepository->findby(["dni"=> $user->getDni()]);
            if(!$userEncontrado){
                // dd("NOExisteDNI");
                $user->setBorrado(0);
                $user->setRol($rolRepository->find(1));    
                $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));    
                $entityManager->persist($user);
                $entityManager->flush();
            }else{
                // dd("ExisteDNI");
                return $this->redirectToRoute('app_user_new', [], Response::HTTP_SEE_OTHER);
            }
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/registro.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/change_password', name: 'app_change_pass', methods: ['GET', 'POST'])]
    public function cambiar_pass(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PasswordChangeType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $pass_old=($form->get('password_old')->getData());
            $pass_old=($form->getData(('password_old'))->getData());
            $new_pass=($form->get('password')->getData());
            $new_pass2=($form->get('password2')->getData());

            dd($pass_old,$new_pass,$new_pass2);

            if (password_verify($pass_old, $this->getUser()->getPassword())){

                if ($new_pass == $new_pass2){                    
                }else{
                    
                }
                
            }else{
                dd("Contraseña actual incorrecta");
            }
            
            
            
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('app_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/password.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}

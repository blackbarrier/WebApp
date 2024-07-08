<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminMedicoController extends AbstractController
{
    #[Route('/turnos', name: 'app_turnos_medico', methods: ['POST'])]
    public function turnos_medico(): Response
    {
        $user = $this->getUser();
        $roles = $user->getRoles();

        dd($user);
        // return $this->render('turno/show.html.twig', [
        //     'turno' => $turno,
        // ]);
    }
}

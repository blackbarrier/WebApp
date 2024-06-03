<?php

namespace App\Controller;

use App\Entity\EstadoTurno;
use App\Entity\Turno;
use App\Entity\User;
use App\Form\TurnoType;
use App\Repository\EstadoRepository;
use App\Repository\EstadoTurnoRepository;
use App\Repository\MedicoRepository;
use App\Repository\TurnoRepository;
use ContainerK6J2kLI\getUserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Date;

use function Symfony\Component\Clock\now;

#[Route('/turno')]
class TurnoController extends AbstractController
{
    #[Route('/', name: 'app_turno_index', methods: ['GET'])]
    public function index(TurnoRepository $turnoRepository, MedicoRepository $medicoRepository): Response
    {   
        $pacientedni = $this->getUser()->getDni();       
        $turnos = $turnoRepository->findBy(['paciente'=> $pacientedni]);
        // dd($turnos);

        return $this->render('turno/index.html.twig', [
            'turnos' => $turnoRepository->findAll(),
        ]);
    }
    #[Route('/editar', name: 'app_editar_index', methods: ['GET'])]
    public function editar_index(TurnoRepository $turnoRepository, MedicoRepository $medicoRepository): Response
    {
        $pacientedni = $this->getUser()->getDni();
        $turnos = $turnoRepository->findBy(['paciente' => $pacientedni]);
        // dd($turnos);

        return $this->render('turno/editar_index.html.twig', [
            'turnos' => $turnoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_turno_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, EstadoTurnoRepository $estadoTurnoRepository): Response
    {
        $turno = new Turno();
        $hoy = new \DateTime();  
        $user = $this->getUser()->getUserIdentifier();
        $form = $this->createForm(TurnoType::class, $turno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $turno->setFechaSolicitado($hoy);
            $turno->setPaciente($user);
            $turno->setEstado($estadoTurnoRepository->find(1));
            $entityManager->persist($turno);
            $entityManager->flush();

            return $this->redirectToRoute('app_turno_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('turno/new.html.twig', [
            'turno' => $turno,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_turno_show', methods: ['GET'])]
    public function show(Turno $turno): Response
    {
        return $this->render('turno/show.html.twig', [
            'turno' => $turno,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_turno_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Turno $turno, EntityManagerInterface $entityManager, EstadoRepository $estadoTurnoRepository): Response
    {
        $form = $this->createForm(TurnoType::class, $turno);
        $form->handleRequest($request);
        $hoy = new \DateTime();
        $user = $this->getUser()->getUserIdentifier();

        if ($form->isSubmitted() && $form->isValid()) {
            $turno->setFechaSolicitado($hoy);
            $turno->setPaciente($user);
            $turno->setEstado($estadoTurnoRepository->find(1));
            $entityManager->flush();

            return $this->redirectToRoute('app_turno_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('turno/edit.html.twig', [
            'turno' => $turno,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_turno_delete', methods: ['POST'])]
    public function delete(Request $request, Turno $turno, EntityManagerInterface $entityManager): Response
    {
        // dd("Borrar");
        if ($this->isCsrfTokenValid('delete'.$turno->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($turno);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_turno_index', [], Response::HTTP_SEE_OTHER);
    }
}

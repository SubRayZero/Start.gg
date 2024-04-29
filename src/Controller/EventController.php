<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\ResponseEntity;
use App\Entity\User;
use App\Form\EventFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{


    #[Route('/create', name: 'app_create_event')]

    public function creatEvent(Request $request, EntityManagerInterface $entityManager)
    {

        $createEvent = new Event();
        $form = $this->createForm(EventFormType::class, $createEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser();
            if ($user) {
                $createEvent->setUser($user);
            }

            $entityManager->persist($createEvent);
            $entityManager->flush();

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('event/create.html.twig', [
            'controller_name' => 'EventController',
            'createEvent' => $form
        ]);
    }


    #[Route('/event', name: 'app_event')]
    public function index(): Response
    {
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }


    #[Route('/home/{id}', name: 'app_home_details')]

    public function eventDetails($id, EntityManagerInterface $entityManager, Request $request, Security $security)
    {
        $user = $this->getUser();

        $eventRepository = $entityManager->getRepository(Event::class);
        $events = $eventRepository->find($id);

        return $this->render('event/details.html.twig', [
            'controller_name' => 'EventController',
            'user'=> $user,
            'events' => $events,
        ]);
    }



    #[Route('/home', name: 'app_home_event')]

    public function EventAll(EntityManagerInterface $entityManager)
    {

        $eventRepository = $entityManager->getRepository(Event::class);
        $events = $eventRepository->findAll();


        return $this->render('home/index.html.twig', [
            'controller_name' => 'EventController',
            'events' => $events
        ]);
    }

    /*#[Route('/user/{id}/threads', name: 'app_user_threads')]
    public function userThreads($id, EntityManagerInterface $entityManager): Response
    {
        $userRepository = $entityManager->getRepository(User::class);
        $user = $userRepository->find($id);

        $eventRepository = $entityManager->getRepository(Event::class);
        $event = $eventRepository->findBy(['user' => $user]);

        return $this->render('profil/user.html.twig', [
            'user' => $user,
            'event' => $event
        ]);
    }*/
}

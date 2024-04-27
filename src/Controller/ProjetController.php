<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use App\Repository\TacheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\HttpFoundation\JsonResponse;



#[Route('/projet')]
class ProjetController extends AbstractController
{

    #[Route('/calender', name: 'app_projet_calender', methods: ['GET'])]
    public function calendar(ProjetRepository $projetRepository)
    {
        $projets = $projetRepository->findAll();
    
        $calendarEvents = [];
        foreach ($projets as $projet) {
            $event = new Event(
                $projet->getNomProjet(), // Titre de l'événement
                $projet->getDateDebut(), // Date de début
                $projet->getDateFin() // Date de fin
            );
            // Ajoutez d'autres informations à l'événement si nécessaire
            $calendarEvents[] = $event;

        }
        return $this->render('projet/calender.html.twig', [
            'calendarEvents' => $calendarEvents,
        ]);
    }
 

    #[Route('/', name: 'app_projet_index', methods: ['GET'])]
    public function index(ProjetRepository $projetRepository): Response
    {
        return $this->render('projet/index.html.twig', [
            'projets' => $projetRepository->findAll(),
        ]);
    }
    private $projetRepository;

    public function __construct(ProjetRepository $projetRepository)
    {
        $this->projetRepository = $projetRepository;
    }
    #[Route('/projet/{id}/details', name: 'app_projet_details', methods: ['GET'])]
    public function details(int $id): Response
    {
        $projet = $this->projetRepository->find($id); // Utilisation du repository injecté

        return $this->render('details.html.twig', [
            'projet' => $projet,
        ]);
    }
    #[Route('/projet/stats', name: 'app_stat', methods: ['GET'])]
public function stat(ProjetRepository $projetRepository, TacheRepository $tacheRepository): Response
{
    $projets = $projetRepository->findAll();
    $data = [];

    foreach ($projets as $projet) {
        $nbTaches = count($tacheRepository->findBy(['projet' => $projet->getIdProjet()]));
        $data[] = [
            'nom' => $projet->getNomProjet(),
            'nbTaches' => $nbTaches,
        ];
    }

    return $this->render('projet/indexStat.html.twig', [
        'data' => $data,
    ]);
}


    #[Route('/front', name: 'app_projet_index_front', methods: ['GET'])]
    public function indexFront(ProjetRepository $projetRepository): Response
    {
        return $this->render('projet/indexFront.html.twig', [
            'projets' => $projetRepository->findAll(),
        ]);
    }
    #[Route('/taches/{id}', name: 'app_projet_taches', methods: ['GET'])]
    public function taches(TacheRepository $tacheRepository, Projet $projet): Response
    {
        return $this->render('tache/indexFront.html.twig', [
            'taches' => $tacheRepository->findByProjet($projet),
        ]);
    }


    #[Route('/search', name: 'app_search_projet', methods: ['GET','POST'])]
    public function search(Request $request,ProjetRepository $repo): Response
    {
        $search=$request->request->get('search');
        return $this->render('projet/index.html.twig', [
            'projets' => $repo->search($search),
            
        ]);
    }
    

    #[Route('/new', name: 'app_projet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($projet);
            $entityManager->flush();

            return $this->redirectToRoute('app_projet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('projet/new.html.twig', [
            'projet' => $projet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_projet_show', methods: ['GET'])]
    public function show(Projet $projet): Response
    {
        return $this->render('projet/show.html.twig', [
            'projet' => $projet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_projet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Projet $projet, EntityManagerInterface $entityManager): Response
    {
        $current_image = $projet->getImage(); // Récupérez l'image actuelle du projet
        $imagesDirectory = $_ENV['IMAGES_DIRECTORY'];

        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
         
            $entityManager->flush();

            return $this->redirectToRoute('app_projet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('projet/edit.html.twig', [
            'projet' => $projet,
            'form' => $form,
            
        ]);
    }

    #[Route('/{id}', name: 'app_projet_delete', methods: ['POST'])]
    public function delete(Request $request, Projet $projet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projet->getIdProjet(), $request->request->get('_token'))) {
            $entityManager->remove($projet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_projet_index', [], Response::HTTP_SEE_OTHER);
    }
    
}

    



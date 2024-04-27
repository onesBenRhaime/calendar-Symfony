<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Tache;
use App\Form\TacheType;
use App\Repository\TacheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tache')]
class TacheController extends AbstractController
{
    #[Route('/', name: 'app_tache_index', methods: ['GET'])]
    public function index(TacheRepository $tacheRepository,): Response
    {
        return $this->render('tache/index.html.twig', [
            'taches' => $tacheRepository->findAll(),
           // 'idP'=>$projeat->getIdProjet(),
        ]);
    }


    
   

   //#[Route('/Search/{id}', name: 'app_search_tache', methods: ['GET','POST'])]
    //public function search(Request $request,TacheRepository $tacheRepository,Projet $projet): Response
    //{
      //  $search=$request->request->get('search');
        //return $this->render('tache/index.html.twig', [
          //  'taches' => $tacheRepository->search($search,$projet->getIdProjet()),
            //'idP'=>$projet->getIdProjet(),
        //]);
    //}



    #[Route('/front', name: 'app_tache_index_front', methods: ['GET'])]
    public function indexFront(TacheRepository $tacheRepository): Response
    {
        return $this->render('tache/indexFront.html.twig', [
            'taches' => $tacheRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tache_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tache = new Tache();
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tache);
            $entityManager->flush();

            return $this->redirectToRoute('app_tache_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tache/new.html.twig', [
            'tache' => $tache,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tache_show', methods: ['GET'])]
    public function show(Tache $tache): Response
    {
        return $this->render('tache/show.html.twig', [
            'tache' => $tache,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tache_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tache $tache, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tache_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tache/edit.html.twig', [
            'tache' => $tache,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tache_delete', methods: ['POST'])]
    public function delete(Request $request, Tache $tache, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tache->getid_tache(), $request->request->get('_token'))) {
            $entityManager->remove($tache);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tache_index', [], Response::HTTP_SEE_OTHER);
    }
   
    
}


<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Doctrine\Persistence\ManagerRegistry;



#[Route('/voiture')]
class VoitureController extends AbstractController
{
    #[Route('/', name: 'voiture_index', methods: ['GET'])]
    public function index(VoitureRepository $voitureRepository): Response
    {
        return $this->render('voiture/index.html.twig', [
            'voitures' => $voitureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'voiture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SluggerInterface $slugger, ManagerRegistry $doctrine)
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file =$form->get('photo')->getData();
            if($file){
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
           
                try{
                    $file->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                );
               }catch (FileException $e){

               } 
               $entityManager =$doctrine->getManager();
               $voiture->setPhoto($newFilename);
               $entityManager->persist($voiture);
               $entityManager->flush();
                    
            return $this->redirectToRoute('voiture_index', [], Response::HTTP_SEE_OTHER);
        }
    }

        return $this->renderForm('voiture/new.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    
    }


    #[Route('/{id}', name: 'voiture_show', methods: ['GET'])]
    public function show(Voiture $voiture): Response
    {
        return $this->render('voiture/show.html.twig', [
            'voiture' => $voiture,
        ]);
    }

    #[Route('/{id}/edit', name: 'voiture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Voiture $voiture, EntityManagerInterface $entityManager,SluggerInterface $slugger, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file =$form->get('photo')->getData();
            if($file){
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
           
                try{
                    $file->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                );
               }catch (FileException $e){

               } 
               $entityManager =$doctrine->getManager();
               $voiture->setPhoto($newFilename);
               $entityManager->persist($voiture);
               $entityManager->flush();
                    
            return $this->redirectToRoute('voiture_index', [], Response::HTTP_SEE_OTHER);
        }
    }

        return $this->renderForm('voiture/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'voiture_delete', methods: ['POST'])]
    public function delete(Request $request, Voiture $voiture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiture->getId(), $request->request->get('_token'))) {
            $entityManager->remove($voiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('voiture_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}', name: 'voiture_disponible' ,methods: ['GET','POST'])]
    public function disponible(int $id,VoitureRepository $voitureRepository,EntityManagerInterface $entityManager)
    {
        $voiture = $voitureRepository->find($id);

        $voiture->setDisponibilite(1);
        $entityManager->flush();

        return $this->render('voiture/index.html.twig', [
            'voiture' => $voiture,
        ]);    }

    #[Route('/{id}', name: 'voiture_indisponible' ,methods: ['GET','POST'])]
    public function indisponible(int $id,VoitureRepository $voitureRepository,EntityManagerInterface $entityManager)
    {
        $voiture = $voitureRepository->find($id);

        $voiture->setDisponibilite(2);
        $entityManager->flush();

        return $this->render('voiture/index.html.twig', [
            'voiture' => $voiture,
        ]);
    }
       
}

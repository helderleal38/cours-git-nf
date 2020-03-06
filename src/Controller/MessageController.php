<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Message;
use App\Form\MessageType;

/**
* @Route("/message")
*/
class MessageController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"}, name="message")
     */
    public function index(MessageRepository $messageRepository)
    {
        return $this->render('message/index.html.twig', 
        [
            'title' => 'Mes messages',
            'messages' => $messageRepository->findall(),
        ]);
    }

    /**
     * @Route("/new", name="new_message", methods={"GET","POST"})
     */
     public function new(Request $request)
    {
        // creates a new message dans un formulaire
        $message = new Message();
        $message->setDate(new \DateTime());//genere date automatiquement  
        
        $form = $this->createForm(MessageType::class, $message);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();
            return $this->redirectToRoute('message');
        }
        return $this->render('message/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     

    /**
     * @Route("/{id}", name="message_show", methods={"GET"})
     */
    public function show(MessageRepository $messageRepository, $id)
    {
        return $this->render('message/show.html.twig', [
            'message' => $messageRepository->find($id),
        ]);
    }

    /**
     * @Route("/{id}", name="message_edit", methods={"GET","POST"})
     */
     public function edit(Request $request)
    {
        
        $form = $this->createForm(MessageType::class, $message);
        
        $form->handleRequest($request);//recupere les donnes

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);//prepare pour la bd 
            $entityManager->flush();// envoi vers la base de donnes
            return $this->redirectToRoute('message');
        }
        return $this->render('message/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     
}

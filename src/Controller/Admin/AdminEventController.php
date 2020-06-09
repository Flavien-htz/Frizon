<?php

namespace App\Controller\Admin;

use App\Entity\Evenements;
use App\Entity\Utilisateur;
use App\Repository\EvenementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EventType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AdminEventController extends AbstractController
{

    private $repoEvent;
    private $em;

    public function __construct(EvenementsRepository $repoEvent, EntityManagerInterface $em)
    {
        $this->repoEvent = $repoEvent;
        $this->em = $em;
    }


    /**
     * @Route ("/admin", name="admin.event.index")
     */
    public function index()
    {
        $events = $this->repoEvent->findAll();


        return $this->render('admin/index.html.twig',[
            'events' => $events
        ]);
    }


    /**
     * @Route ("/admin/create", name="admin.evenements.create")
     */
    public function create(Request $request)
    {
        $event = new Evenements();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($event);
            $this->em->flush();
            $this->addFlash('success', 'Évènement ajouté');
            return $this->redirectToRoute('admin.evenement.index');
        }

        return $this->render('admin/evenements/create.html.twig',[
            "formEvent" => $form->createView()
        ]);
    }

}


?>
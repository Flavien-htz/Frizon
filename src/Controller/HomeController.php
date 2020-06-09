<?php

namespace App\Controller;

use App\Entity\Evenements;
use App\Form\ContactType;
use App\Repository\EvenementsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private $em;
    private $eventRepo;

    public function __construct(EntityManagerInterface $em, EvenementsRepository $eventRepo)
    {
        $this->em = $em;
        $this->eventRepo = $eventRepo;
    }

    /**
     * @Route ("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('accueil.html.twig',[
            "current_menu" => "accueil"
        ]);
    }

    /**
     * @Route ("/event", name="event")
     */
    public function event(): Response
    {
        $events = $this->eventRepo->findAll();
        return $this->render('event.html.twig',[
            "current_menu" => "event",
            "events"=>$events
        ]);
    }

    /**
     * @Route ("/mairie", name="mairie")
     */
    public function mairie(): Response
    {
        return $this->render('mairie.html.twig',[
            "current_menu" => "mairie"
        ]);
    }

    /**
     * @Route ("/contact", name="contact")
     */
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            // Ici nous enverrons l'e-mail

            $message = (new \Swift_Message('Nouveau contact'))
            //On attribue l'expéditeur
                ->setFrom($contact['email'])
            //On attribue le destinataire
                ->setTo('flavien.htz@gmail.com')
            //On créé le message avec la vue twig
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig', compact('contact')
                    ),
                    'text/html'
                )
            ;

            //On envoie le message
            $mailer->send($message);

            $this->addFlash('Envoyé', 'Le message a bien été envoyé');
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig',[
            'contactForm' => $form->createView()]);
    }

    /**
     *@Route ("/connexion", name="connexion") 
     */
    public function connexion()
    {
        return $this->render('connexion.html.twig',[
            "current_menu" => "connexion"
        ]);
    }

    /**
     * @Route ("/musee", name="musee")
     */
    public function musee()
    {
        return $this->render('musee.html.twig',[
            "current_menu" => "musee"
        ]);
    }

    /**
     * @Route ("/boulangerie", name="boulangerie")
     */
    public function boulangerie()
    {
        return $this->render('boulangerie.html.twig', [
            "current_menu" => "commerce"
        ]);
    }

    /**
     * @Route ("/restaurant", name="restaurant")
     */
    public function restaurant()
    {
        return $this->render('restaurant/index.html.twig', [
            "current_menu" => "commerce"
        ]);
    }

    /**
     * @Route ("/annonces", name="annonces")
     */
    public function annonces()
    {
        return $this->render('annonces/index.html.twig', [
            "current_menu" => "annonces"
        ]);
    }

    
}
?>
<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Client;

class DefaultControler extends AbstractController
{
    /**
    * @Route("/", name = "homepage")
    */
    public function index(Request $request)
    {
        $client = new Client();

        $client->setCode("+420");
        $client->setMinutesCalled(0);

        $form = $this->createForm(\App\Form\Client::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $client = $form->getData();
            $client->save();
            $this->addFlash(
                'success',
                'Klient byl uložen!'
            );
            return $this->redirectToRoute('homepage');
        }

        return $this->render('base.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

?>
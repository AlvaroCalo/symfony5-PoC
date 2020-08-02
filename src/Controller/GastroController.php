<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\PlatosRepository;
use App\Repository\BebidasRepository;
use App\Repository\NoticiasRepository;

class GastroController extends AbstractController
{
    /**
     * @Route("/", name="inicio")
     */
    public function index()
    {
        return $this->render('gastro/index.html.twig', [
            'controller_name' => 'GastroController',
        ]);
    }

    /**
     * @Route("/tipical_dishes", name="tipicaldishes")
     */
    public function tipical(PlatosRepository $nr)
    {
        $platos = $nr->findAll();

        return $this->render('gastro/tipical_dishes.html.twig', [
            'controller_name' => 'GastroController',
            'platos' => $platos
        ]);
    }

    /**
     * @Route("/mostrarP/{id}", name="mostrarP")
     */
    public function mostrarP($id, PlatosRepository $nr)
    {
        $plato = $nr->find($id);

        return $this->render('gastro/mostrarP.html.twig', [
            'controller_name' => 'GastroController',
            'plato' => $plato
        ]);
    }

    /**
     * @Route("/tipical_drinks", name="tipicaldrinks")
     */
    public function tipicalDrinks(BebidasRepository $nr)
    {
        $bebidas = $nr->findAll();

        return $this->render('gastro/tipical_drinks.html.twig', [
            'controller_name' => 'GastroController',
            'bebidas' => $bebidas
        ]);
    }

    /**
     * @Route("/mostrarB/{id}", name="mostrarB")
     */
    public function mostrarB($id, BebidasRepository $nr)
    {
        $bebida = $nr->find($id);

        return $this->render('gastro/mostrarB.html.twig', [
            'controller_name' => 'GastroController',
            'bebida' => $bebida
        ]);
    }

    /**
     * @Route("/news", name="news")
     */
    public function news(NoticiasRepository $nr)
    {
        $noticias = $nr->findAll();

        return $this->render('gastro/news.html.twig', [
            'controller_name' => 'GastroController',
            'noticias' => $noticias
        ]);
    }

    /**
     * @Route("/mostrarN/{id}", name="mostrarN")
     */
    public function mostrarN($id, NoticiasRepository $nr)
    {
        $noticia = $nr->find($id);

        return $this->render('gastro/mostrarN.html.twig', [
            'controller_name' => 'GastroController',
            'noticia' => $noticia
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function touch()
    {
        return $this->render('gastro/contact.html.twig', [
            'controller_name' => 'GastroController',
        ]);
        
    }
}

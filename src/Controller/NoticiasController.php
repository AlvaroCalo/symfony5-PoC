<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Noticias;
use App\Repository\NoticiasRepository;



/**
 * @Route("/noticias", name="noticias.")
 */
class NoticiasController extends AbstractController
{
    /**
     * @Route("/anadir", name="anadir")
     */
    public function anadir(NoticiasRepository $nr)
    {
        return $this->render('noticias/add_news.html.twig', [
            'controller_name' => 'NoticiasController'
        ]);
    }

     /**
     * @Route("/crear", name="crear")
     */
    public function crear(Request $r)
    {
        $noticia = new Noticias(); // crear nuevo objeto
        $noticia->setTitulo($r->get('txtName'));
        $noticia->setDescripcion($r->get("txtDesc"));
        $noticia->setImagen($r->get("txtPic"));

        $em = $this->getDoctrine()->getManager();
        $em->persist($noticia);
        $em->flush();

        return $this->redirect($this->generateUrl('news'));
    }

    /**
     * @Route("/borrar/{id}", name="borrar")
     */
    public function borrar($id, NoticiasRepository $nr)
    {

        $bebida = $nr->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($bebida);
        $em->flush();

        $this->addFlash("exito","The news was removed");

        return $this->redirect($this->generateUrl('news'));
        
    }

    /**
     * @Route("/modificarM/{id}", name="modificarM")
     */
    public function modificarM($id, NoticiasRepository $nr)
    {
        $noticia = $nr->find($id);

        return $this->render('noticias/update_news.html.twig', [
            'controller_name' => 'NoticiasController',
            'noticia' => $noticia
        ]);
    }

    /**
     * @Route("/modificar", name="modificar")
     */
    public function modificar(Request $r, NoticiasRepository $nr)
    {

        $id = $r->get('txtId');
        $nombre = $r->get('txtName');
        $descripcion = $r->get('txtDesc');
        $imagen = $r->get('txtPic');

        $noticia = $nr->find($id);
        $noticia->setTitulo($nombre);
        $noticia->setDescripcion($descripcion);
        $noticia->setImagen($imagen);

        $em = $this->getDoctrine()->getManager();
        $em->persist($noticia);
        $em->flush();

        return $this->redirect($this->generateUrl('news'));
    } 
}

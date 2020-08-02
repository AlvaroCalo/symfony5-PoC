<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Bebidas;
use App\Repository\BebidasRepository;


/**
 * @Route("/bebidas", name="bebidas.")
 */
class BebidasController extends AbstractController
{
    /**
     * @Route("/anadir", name="anadir")
     */
    public function anadir(BebidasRepository $nr)
    {
        return $this->render('bebidas/add_drinks.html.twig', [
            'controller_name' => 'BebidasController'
        ]);
    }

    /**
     * @Route("/crear", name="crear")
     */
    public function crear(Request $r)
    {
        // no funciona
        $bebida = new Bebidas(); // crear nuevo objeto
        $bebida->setNombre($r->get('txtName'));
        $bebida->setDescripcion($r->get("txtDesc"));
        $bebida->setPrecio($r->get("txtPri"));
        $bebida->setImagen($r->get("txtPic"));

        $em = $this->getDoctrine()->getManager();
        $em->persist($bebida);
        $em->flush();

        return $this->redirect($this->generateUrl('tipicaldrinks'));
    }

    /**
     * @Route("/borrar/{id}", name="borrar")
     */
    public function borrar($id, BebidasRepository $nr)
    {

        $bebida = $nr->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($bebida);
        $em->flush();

        $this->addFlash("exito","The drink was removed");

        return $this->redirect($this->generateUrl('tipicaldrinks'));
        
    }

    /**
     * @Route("/modificarM/{id}", name="modificarM")
     */
    public function modificarM($id, BebidasRepository $nr)
    {
        $bebida = $nr->find($id);

        return $this->render('bebidas/update_drinks.html.twig', [
            'controller_name' => 'BebidasController',
            'bebida' => $bebida
        ]);
    }

    /**
     * @Route("/modificar", name="modificar")
     */
    public function modificar(Request $r, BebidasRepository $nr)
    {

        $id = $r->get('txtId');
        $nombre = $r->get('txtName');
        $descripcion = $r->get('txtDesc');
        $precio = $r->get('txtPri');
        $imagen = $r->get('txtPic');

        $bebida = $nr->find($id);
        $bebida->setNombre($nombre);
        $bebida->setDescripcion($descripcion);
        $bebida->setPrecio($precio);
        $bebida->setImagen($imagen);

        $em = $this->getDoctrine()->getManager();
        $em->persist($bebida);
        $em->flush();

        return $this->redirect($this->generateUrl('tipicaldrinks'));
    } 
}

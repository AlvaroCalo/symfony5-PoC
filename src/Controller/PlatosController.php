<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Platos; // se importa desde entity
use App\Repository\PlatosRepository;


/**
 * @Route("/platos", name="platos.")
 */
class PlatosController extends AbstractController
{
    /**
     * @Route("/anadir", name="anadir")
     */
    public function anadir(PlatosRepository $nr)
    {
        return $this->render('platos/add_dishes.html.twig', [
            'controller_name' => 'PlatosController'
        ]);
    }

    /**
     * @Route("/crear", name="crear")
     */
    public function crear(Request $r)
    {

        $platillo = new Platos(); // crear nuevo objeto
        $platillo->setNombre($r->get('txtName'));
        $platillo->setDescripcion($r->get("txtDesc"));
        $platillo->setPrecio($r->get("txtPri"));
        $platillo->setImagen( $r->get("txtPic"));

        $em = $this->getDoctrine()->getManager();
        $em->persist($platillo);
        $em->flush();

        return $this->redirect($this->generateUrl('tipicaldishes'));
    }

    /**
     * @Route("/borrar/{id}", name="borrar")
     */
    public function borrar($id, PlatosRepository $nr)
    {

        $plato = $nr->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($plato);
        $em->flush();

        $this->addFlash("exito","The dish was removed");

        return $this->redirect($this->generateUrl('tipicaldishes'));
        
    }

    /**
     * @Route("/modificarM/{id}", name="modificarM")
     */
    public function modificarM($id, PlatosRepository $nr)
    {
        $plato = $nr->find($id);

        return $this->render('platos/update_dishes.html.twig', [
            'controller_name' => 'PlatosController',
            'plato' => $plato
        ]);
    }

    /**
     * @Route("/modificar", name="modificar")
     */
    public function modificar(Request $r, PlatosRepository $nr)
    {

        $id = $r->get('txtId');
        $nombre = $r->get('txtName');
        $descripcion = $r->get('txtDesc');
        $precio = $r->get('txtPri');
        $imagen = $r->get('txtPic');

        $plato = $nr->find($id);
        $plato->setNombre($nombre);
        $plato->setDescripcion($descripcion);
        $plato->setPrecio($precio);
        $plato->setImagen($imagen);

        $em = $this->getDoctrine()->getManager();
        $em->persist($plato);
        $em->flush();

        return $this->redirect($this->generateUrl('tipicaldishes'));
    } 
 
    
}

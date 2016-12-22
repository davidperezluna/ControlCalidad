<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Accion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Accion controller.
 *
 * @Route("accion")
 */
class AccionController extends Controller
{
    /**
     * Lists all accion entities.
     *
     * @Route("/", name="accion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $accions = $em->getRepository('AppBundle:Accion')->findAll();

        return $this->render('AppBundle:accion:index.html.twig', array(
            'accions' => $accions,
        ));
    }

    /**
     * Creates a new accion entity.
     *
     * @Route("/new", name="accion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $accion = new Accion();
        $form = $this->createForm('AppBundle\Form\AccionType', $accion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $hallazgo = $em->getRepository('AppBundle:Hallazgo')->find($request->query->get('idHallazgo'));

            $meses = $hallazgo->getTipohallazgo()->getPlazo();

            $intervalo = new \DateInterval('P'.$meses.'M');
            $fechaMaxima = $hallazgo->getFechaHallazgo();
            $fechaMaxima = $fechaMaxima->add($intervalo); 

            $accion->setHallazgo($hallazgo);
            $accion->setFechaMaxima($fechaMaxima);
            $em = $this->getDoctrine()->getManager();
            $em->persist($accion);
            $em->flush($accion);

            return $this->redirectToRoute('hallazgo_show', array('id' => $hallazgo->getId()));
        }

        return $this->render('AppBundle:accion:new.html.twig', array(
            'accion' => $accion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a accion entity.
     *
     * @Route("/{id}", name="accion_show")
     * @Method("GET")
     */
    public function showAction(Accion $accion)
    {
        $deleteForm = $this->createDeleteForm($accion);

        return $this->render('AppBundle:accion:show.html.twig', array(
            'accion' => $accion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing accion entity.
     *
     * @Route("/{id}/edit", name="accion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Accion $accion)
    {
        $deleteForm = $this->createDeleteForm($accion);
        $editForm = $this->createForm('AppBundle\Form\AccionType', $accion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accion_edit', array('id' => $accion->getId()));
        }

        return $this->render('AppBundle:accion:edit.html.twig', array(
            'accion' => $accion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a accion entity.
     *
     * @Route("/{id}", name="accion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Accion $accion)
    {
        $form = $this->createDeleteForm($accion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($accion);
            $em->flush($accion);
        }

        return $this->redirectToRoute('accion_index');
    }

    /**
     * Creates a form to delete a accion entity.
     *
     * @param Accion $accion The accion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Accion $accion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('accion_delete', array('id' => $accion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

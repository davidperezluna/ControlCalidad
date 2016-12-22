<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TipoHallazgo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tipohallazgo controller.
 *
 * @Route("tipohallazgo")
 */
class TipoHallazgoController extends Controller
{
    /**
     * Lists all tipoHallazgo entities.
     *
     * @Route("/", name="tipohallazgo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tipoHallazgos = $em->getRepository('AppBundle:TipoHallazgo')->findAll();

        return $this->render('AppBundle:tipohallazgo:index.html.twig', array(
            'tipoHallazgos' => $tipoHallazgos,
        ));
    }

    /**
     * Creates a new tipoHallazgo entity.
     *
     * @Route("/new", name="tipohallazgo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tipoHallazgo = new Tipohallazgo();
        $form = $this->createForm('AppBundle\Form\TipoHallazgoType', $tipoHallazgo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoHallazgo);
            $em->flush($tipoHallazgo);

            return $this->redirectToRoute('tipohallazgo_show', array('id' => $tipoHallazgo->getId()));
        }

        return $this->render('AppBundle:tipohallazgo:new.html.twig', array(
            'tipoHallazgo' => $tipoHallazgo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tipoHallazgo entity.
     *
     * @Route("/{id}", name="tipohallazgo_show")
     * @Method("GET")
     */
    public function showAction(TipoHallazgo $tipoHallazgo)
    {
        $deleteForm = $this->createDeleteForm($tipoHallazgo);

        return $this->render('AppBundle:tipohallazgo:show.html.twig', array(
            'tipoHallazgo' => $tipoHallazgo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tipoHallazgo entity.
     *
     * @Route("/{id}/edit", name="tipohallazgo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TipoHallazgo $tipoHallazgo)
    {
        $deleteForm = $this->createDeleteForm($tipoHallazgo);
        $editForm = $this->createForm('AppBundle\Form\TipoHallazgoType', $tipoHallazgo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipohallazgo_edit', array('id' => $tipoHallazgo->getId()));
        }

        return $this->render('AppBundle:tipohallazgo:edit.html.twig', array(
            'tipoHallazgo' => $tipoHallazgo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tipoHallazgo entity.
     *
     * @Route("/{id}", name="tipohallazgo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TipoHallazgo $tipoHallazgo)
    {
        $form = $this->createDeleteForm($tipoHallazgo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipoHallazgo);
            $em->flush($tipoHallazgo);
        }

        return $this->redirectToRoute('tipohallazgo_index');
    }

    /**
     * Creates a form to delete a tipoHallazgo entity.
     *
     * @param TipoHallazgo $tipoHallazgo The tipoHallazgo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TipoHallazgo $tipoHallazgo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipohallazgo_delete', array('id' => $tipoHallazgo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

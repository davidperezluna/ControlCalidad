<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Riesgo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Riesgo controller.
 *
 * @Route("riesgo")
 */
class RiesgoController extends Controller
{
    /**
     * Lists all riesgo entities.
     *
     * @Route("/", name="riesgo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $riesgos = $em->getRepository('AppBundle:Riesgo')->findAll();

        return $this->render('riesgo/index.html.twig', array(
            'riesgos' => $riesgos,
        ));
    }

    /**
     * Creates a new riesgo entity.
     *
     * @Route("/new", name="riesgo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $riesgo = new Riesgo();
        $form = $this->createForm('AppBundle\Form\RiesgoType', $riesgo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($riesgo);
            $em->flush($riesgo);

            return $this->redirectToRoute('riesgo_show', array('id' => $riesgo->getId()));
        }

        return $this->render('riesgo/new.html.twig', array(
            'riesgo' => $riesgo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a riesgo entity.
     *
     * @Route("/{id}", name="riesgo_show")
     * @Method("GET")
     */
    public function showAction(Riesgo $riesgo)
    {
        $deleteForm = $this->createDeleteForm($riesgo);

        return $this->render('riesgo/show.html.twig', array(
            'riesgo' => $riesgo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing riesgo entity.
     *
     * @Route("/{id}/edit", name="riesgo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Riesgo $riesgo)
    {
        $deleteForm = $this->createDeleteForm($riesgo);
        $editForm = $this->createForm('AppBundle\Form\RiesgoType', $riesgo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('riesgo_edit', array('id' => $riesgo->getId()));
        }

        return $this->render('riesgo/edit.html.twig', array(
            'riesgo' => $riesgo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a riesgo entity.
     *
     * @Route("/{id}", name="riesgo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Riesgo $riesgo)
    {
        $form = $this->createDeleteForm($riesgo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($riesgo);
            $em->flush($riesgo);
        }

        return $this->redirectToRoute('riesgo_index');
    }

    /**
     * Creates a form to delete a riesgo entity.
     *
     * @param Riesgo $riesgo The riesgo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Riesgo $riesgo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('riesgo_delete', array('id' => $riesgo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

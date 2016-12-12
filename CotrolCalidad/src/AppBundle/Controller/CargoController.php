<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CArgo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Cargo controller.
 *
 * @Route("cargo")
 */
class CargoController extends Controller
{
    /**
     * Lists all cArgo entities.
     *
     * @Route("/", name="cargo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cargos = $em->getRepository('AppBundle:Cargo')->findAll();

        return $this->render('AppBundle:cargo:index.html.twig', array(
            'cargos' => $cargos,
        ));
    }

    /**
     * Creates a new cArgo entity.
     *
     * @Route("/new", name="cargo_new")
     
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cArgo = new Cargo();
        $form = $this->createForm('AppBundle\Form\CargoType', $cArgo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cArgo);
            $em->flush($cArgo);

            return $this->redirectToRoute('cargo_show', array('id' => $cArgo->getId()));
        }

        return $this->render('AppBundle:cargo:new.html.twig', array(
            'cArgo' => $cArgo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cArgo entity.
     *
     * @Route("/{id}", name="cargo_show")
     * @Method("GET")
     */
    public function showAction(CArgo $cArgo)
    {
        $deleteForm = $this->createDeleteForm($cArgo);

        return $this->render('AppBundle:cargo:show.html.twig', array(
            'cArgo' => $cArgo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cArgo entity.
     *
     * @Route("/{id}/edit", name="cargo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CArgo $cArgo)
    {
        $deleteForm = $this->createDeleteForm($cArgo);
        $editForm = $this->createForm('AppBundle\Form\CargoType', $cArgo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cargo_edit', array('id' => $cArgo->getId()));
        }

        return $this->render('AppBundle:cargo:edit.html.twig', array(
            'cArgo' => $cArgo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cArgo entity.
     *
     * @Route("/{id}", name="cargo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CArgo $cArgo)
    {
        $form = $this->createDeleteForm($cArgo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cArgo);
            $em->flush($cArgo);
        }

        return $this->redirectToRoute('cargo_index');
    }

    /**
     * Creates a form to delete a cArgo entity.
     *
     * @param CArgo $cArgo The cArgo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CArgo $cArgo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cargo_delete', array('id' => $cArgo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MacroProceso;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Macroproceso controller.
 *
 * @Route("macroproceso")
 */
class MacroProcesoController extends Controller
{
    /**
     * Lists all macroProceso entities.
     *
     * @Route("/", name="macroproceso_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $macroProcesos = $em->getRepository('AppBundle:MacroProceso')->findAll();

        return $this->render('AppBundle:macroproceso:index.html.twig', array(
            'macroProcesos' => $macroProcesos,
        ));
    }

    /**
     * Creates a new macroProceso entity.
     *
     * @Route("/new", name="macroproceso_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $macroProceso = new Macroproceso();
        $form = $this->createForm('AppBundle\Form\MacroProcesoType', $macroProceso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($macroProceso);
            $em->flush($macroProceso);

            return $this->redirectToRoute('macroproceso_show', array('id' => $macroProceso->getId()));
        }

        return $this->render('AppBundle:macroproceso:new.html.twig', array(
            'macroProceso' => $macroProceso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a macroProceso entity.
     *
     * @Route("/{id}", name="macroproceso_show")
     * @Method("GET")
     */
    public function showAction(MacroProceso $macroProceso)
    {
        $deleteForm = $this->createDeleteForm($macroProceso);

        return $this->render('AppBundle:macroproceso:show.html.twig', array(
            'macroProceso' => $macroProceso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing macroProceso entity.
     *
     * @Route("/{id}/edit", name="macroproceso_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MacroProceso $macroProceso)
    {
        $deleteForm = $this->createDeleteForm($macroProceso);
        $editForm = $this->createForm('AppBundle\Form\MacroProcesoType', $macroProceso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('macroproceso_edit', array('id' => $macroProceso->getId()));
        }

        return $this->render('AppBundle:macroproceso:edit.html.twig', array(
            'macroProceso' => $macroProceso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a macroProceso entity.
     *
     * @Route("/{id}", name="macroproceso_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MacroProceso $macroProceso)
    {
        $form = $this->createDeleteForm($macroProceso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($macroProceso);
            $em->flush($macroProceso);
        }

        return $this->redirectToRoute('macroproceso_index');
    }

    /**
     * Creates a form to delete a macroProceso entity.
     *
     * @param MacroProceso $macroProceso The macroProceso entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MacroProceso $macroProceso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('macroproceso_delete', array('id' => $macroProceso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

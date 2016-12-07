<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProcedimientoDocumento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Procedimientodocumento controller.
 *
 * @Route("procedimientodocumento")
 */
class ProcedimientoDocumentoController extends Controller
{
    /**
     * Lists all procedimientoDocumento entities.
     *
     * @Route("/", name="procedimientodocumento_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $procedimientoDocumentos = $em->getRepository('AppBundle:ProcedimientoDocumento')->findAll();

        return $this->render('AppBundle:procedimientodocumento:index.html.twig', array(
            'procedimientoDocumentos' => $procedimientoDocumentos,
        ));
    }

    /**
     * Creates a new procedimientoDocumento entity.
     *
     * @Route("/new", name="procedimientodocumento_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $procedimientoDocumento = new Procedimientodocumento();
        $form = $this->createForm('AppBundle\Form\ProcedimientoDocumentoType', $procedimientoDocumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($procedimientoDocumento);
            $em->flush($procedimientoDocumento);

            return $this->redirectToRoute('procedimientodocumento_show', array('id' => $procedimientoDocumento->getId()));
        }

        return $this->render('AppBundle:procedimientodocumento:new.html.twig', array(
            'procedimientoDocumento' => $procedimientoDocumento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a procedimientoDocumento entity.
     *
     * @Route("/{id}", name="procedimientodocumento_show")
     * @Method("GET")
     */
    public function showAction(ProcedimientoDocumento $procedimientoDocumento)
    {
        $deleteForm = $this->createDeleteForm($procedimientoDocumento);

        return $this->render('AppBundle:procedimientodocumento:show.html.twig', array(
            'procedimientoDocumento' => $procedimientoDocumento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing procedimientoDocumento entity.
     *
     * @Route("/{id}/edit", name="procedimientodocumento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProcedimientoDocumento $procedimientoDocumento)
    {
        $deleteForm = $this->createDeleteForm($procedimientoDocumento);
        $editForm = $this->createForm('AppBundle\Form\ProcedimientoDocumentoType', $procedimientoDocumento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('procedimientodocumento_edit', array('id' => $procedimientoDocumento->getId()));
        }

        return $this->render('AppBundle:procedimientodocumento:edit.html.twig', array(
            'procedimientoDocumento' => $procedimientoDocumento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a procedimientoDocumento entity.
     *
     * @Route("/{id}", name="procedimientodocumento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProcedimientoDocumento $procedimientoDocumento)
    {
        $form = $this->createDeleteForm($procedimientoDocumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($procedimientoDocumento);
            $em->flush($procedimientoDocumento);
        }

        return $this->redirectToRoute('procedimientodocumento_index');
    }

    /**
     * Creates a form to delete a procedimientoDocumento entity.
     *
     * @param ProcedimientoDocumento $procedimientoDocumento The procedimientoDocumento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProcedimientoDocumento $procedimientoDocumento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('procedimientodocumento_delete', array('id' => $procedimientoDocumento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

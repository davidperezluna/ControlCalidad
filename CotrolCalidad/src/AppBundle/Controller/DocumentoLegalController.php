<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DocumentoLegal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Documentolegal controller.
 *
 * @Route("documentolegal")
 */
class DocumentoLegalController extends Controller
{
    /**
     * Lists all documentoLegal entities.
     *
     * @Route("/", name="documentolegal_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $documentoLegals = $em->getRepository('AppBundle:DocumentoLegal')->findAll();

        return $this->render('AppBundle:documentolegal:index.html.twig', array(
            'documentoLegals' => $documentoLegals,
        ));
    }

    /**
     * Creates a new documentoLegal entity.
     *
     * @Route("/new", name="documentolegal_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $documentoLegal = new Documentolegal();
        $form = $this->createForm('AppBundle\Form\DocumentoLegalType', $documentoLegal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($documentoLegal);
            $em->flush($documentoLegal);

            return $this->redirectToRoute('documentolegal_show', array('id' => $documentoLegal->getId()));
        }

        return $this->render('AppBundle:documentolegal:new.html.twig', array(
            'documentoLegal' => $documentoLegal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a documentoLegal entity.
     *
     * @Route("/{id}", name="documentolegal_show")
     * @Method("GET")
     */
    public function showAction(DocumentoLegal $documentoLegal)
    {
        $deleteForm = $this->createDeleteForm($documentoLegal);

        return $this->render('AppBundle:documentolegal:show.html.twig', array(
            'documentoLegal' => $documentoLegal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing documentoLegal entity.
     *
     * @Route("/{id}/edit", name="documentolegal_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, DocumentoLegal $documentoLegal)
    {
        $deleteForm = $this->createDeleteForm($documentoLegal);
        $editForm = $this->createForm('AppBundle\Form\DocumentoLegalType', $documentoLegal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('documentolegal_edit', array('id' => $documentoLegal->getId()));
        }

        return $this->render('AppBundle:documentolegal:edit.html.twig', array(
            'documentoLegal' => $documentoLegal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a documentoLegal entity.
     *
     * @Route("/{id}", name="documentolegal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, DocumentoLegal $documentoLegal)
    {
        $form = $this->createDeleteForm($documentoLegal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($documentoLegal);
            $em->flush($documentoLegal);
        }

        return $this->redirectToRoute('documentolegal_index');
    }

    /**
     * Creates a form to delete a documentoLegal entity.
     *
     * @param DocumentoLegal $documentoLegal The documentoLegal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DocumentoLegal $documentoLegal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('documentolegal_delete', array('id' => $documentoLegal->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

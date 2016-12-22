<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Hallazgo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Hallazgo controller.
 *
 * @Route("hallazgo")
 */
class HallazgoController extends Controller
{
    /**
     * Lists all hallazgo entities.
     *
     * @Route("/", name="hallazgo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager(); 

        $hallazgos = $em->getRepository('AppBundle:Hallazgo')->findAll();

        return $this->render('AppBundle:hallazgo:index.html.twig', array(
            'hallazgos' => $hallazgos,
        ));
    }

    /**
     * Creates a new hallazgo entity.
     *
     * @Route("/new", name="hallazgo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $hallazgo = new Hallazgo();
        $form = $this->createForm('AppBundle\Form\HallazgoType', $hallazgo);
        $form->handleRequest($request);
        $idAuditoria = $request->query->get('idAuditoria');

        if ($form->isSubmitted() && $form->isValid()) {

            $auditoria = $em->getRepository('AppBundle:Auditoria')->find($request->query->get('idAuditoria'));
            
            $hallazgo->setAuditoria($auditoria);


            $hallazgo->setFechaHallazgo(new  \Datetime('now'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($hallazgo);
            $em->flush($hallazgo);

            return $this->redirectToRoute('auditoria_show', array('id' => $auditoria->getId()));
        }

        return $this->render('AppBundle:hallazgo:new.html.twig', array(
            'idAuditoria' => $idAuditoria,
            'hallazgo' => $hallazgo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a hallazgo entity.
     *
     * @Route("/{id}", name="hallazgo_show")
     * @Method("GET")
     */
    public function showAction(Hallazgo $hallazgo)
    {
        $deleteForm = $this->createDeleteForm($hallazgo);

        return $this->render('AppBundle:hallazgo:show.html.twig', array(
            'hallazgo' => $hallazgo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing hallazgo entity.
     *
     * @Route("/{id}/edit", name="hallazgo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Hallazgo $hallazgo)
    {
        $deleteForm = $this->createDeleteForm($hallazgo);
        $editForm = $this->createForm('AppBundle\Form\HallazgoType', $hallazgo);
        $editForm->handleRequest($request);

         $idAuditoria = $hallazgo->getId();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hallazgo_edit', array('id' => $hallazgo->getId()));
        }

        return $this->render('AppBundle:hallazgo:edit.html.twig', array(
            'idAuditoria' => $idAuditoria,
            'hallazgo' => $hallazgo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a hallazgo entity.
     *
     * @Route("/{id}", name="hallazgo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Hallazgo $hallazgo)
    {
        $form = $this->createDeleteForm($hallazgo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hallazgo);
            $em->flush($hallazgo);
        }

        return $this->redirectToRoute('hallazgo_index');
    }

    /**
     * Creates a form to delete a hallazgo entity.
     *
     * @param Hallazgo $hallazgo The hallazgo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Hallazgo $hallazgo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('hallazgo_delete', array('id' => $hallazgo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

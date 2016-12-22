<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AuditoriaUsuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Auditoriausuario controller.
 *
 * @Route("auditoriausuario")
 */
class AuditoriaUsuarioController extends Controller
{
    /**
     * Lists all auditoriaUsuario entities.
     *
     * @Route("/", name="auditoriausuario_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $auditoriaUsuarios = $em->getRepository('AppBundle:AuditoriaUsuario')->findAll();

        return $this->render('AppBundle:auditoriausuario:index.html.twig', array(
            'auditoriaUsuarios' => $auditoriaUsuarios,
        ));
    }

    /**
     * Creates a new auditoriaUsuario entity.
     *
     * @Route("/new", name="auditoriausuario_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $auditoriaUsuario = new Auditoriausuario();
        $form = $this->createForm('AppBundle\Form\AuditoriaUsuarioType', $auditoriaUsuario);
        $form->handleRequest($request);
        $idAuditoria = $request->query->get('idAuditoria');

        if ($form->isSubmitted() && $form->isValid()) {

            $auditoria = $em->getRepository('AppBundle:Auditoria')->find($request->query->get('idAuditoria'));
            
            $auditoriaUsuario->setAuditoria($auditoria);
            $em = $this->getDoctrine()->getManager();
            $em->persist($auditoriaUsuario);
            $em->flush($auditoriaUsuario);

            return $this->redirectToRoute('auditoria_show', array('id' => $auditoria->getId()));
        }

        return $this->render('AppBundle:auditoriausuario:new.html.twig', array(
            'idAuditoria' => $idAuditoria,
            'auditoriaUsuario' => $auditoriaUsuario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a auditoriaUsuario entity.
     *
     * @Route("/{id}", name="auditoriausuario_show")
     * @Method("GET")
     */
    public function showAction(AuditoriaUsuario $auditoriaUsuario)
    {
        $deleteForm = $this->createDeleteForm($auditoriaUsuario);

        return $this->render('AppBundle:auditoriausuario:show.html.twig', array(
            'auditoriaUsuario' => $auditoriaUsuario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing auditoriaUsuario entity.
     *
     * @Route("/{id}/edit", name="auditoriausuario_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AuditoriaUsuario $auditoriaUsuario)
    {
        $deleteForm = $this->createDeleteForm($auditoriaUsuario);
        $editForm = $this->createForm('AppBundle\Form\AuditoriaUsuarioType', $auditoriaUsuario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('auditoriausuario_edit', array('id' => $auditoriaUsuario->getId()));
        }

        return $this->render('AppBundle:auditoriausuario:edit.html.twig', array(
            'auditoriaUsuario' => $auditoriaUsuario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a auditoriaUsuario entity.
     *
     * @Route("/{id}", name="auditoriausuario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AuditoriaUsuario $auditoriaUsuario)
    {
        $form = $this->createDeleteForm($auditoriaUsuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($auditoriaUsuario);
            $em->flush($auditoriaUsuario);
        }

        return $this->redirectToRoute('auditoriausuario_index');
    }

    /**
     * Creates a form to delete a auditoriaUsuario entity.
     *
     * @param AuditoriaUsuario $auditoriaUsuario The auditoriaUsuario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AuditoriaUsuario $auditoriaUsuario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('auditoriausuario_delete', array('id' => $auditoriaUsuario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Auditoria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Auditoria controller.
 *
 * @Route("auditoria")
 */
class AuditoriaController extends Controller
{
    /**
     * Lists all auditorium entities.
     *
     * @Route("/", name="auditoria_index")
     * @Method("GET") 
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $proceso = $em->getRepository('AppBundle:Proceso')->find($request->query->get('idProceso'));

        $auditorias = $em->getRepository('AppBundle:Auditoria')->findBy(
            array('proceso' => $proceso->getId())
        );

        return $this->render('AppBundle:auditoria:index.html.twig', array(
            'proceso' => $proceso,
            'auditorias' => $auditorias,
        ));
    }

    /**
     * Creates a new auditorium entity.
     *
     * @Route("/new", name="auditoria_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
         $em = $this->getDoctrine()->getManager();
        $auditorium = new Auditoria();
        $form = $this->createForm('AppBundle\Form\AuditoriaNewType', $auditorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $proceso = $em->getRepository('AppBundle:Proceso')->find($request->query->get('idProceso'));

            $auditorium->setProceso($proceso);

            $auditorium->setFechaInicio(new \DateTime('now'));
            $auditorium->setFechaFind(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($auditorium);
            $em->flush($auditorium);

            return $this->redirectToRoute('auditoria_index', array('idProceso' => $proceso->getId()));
        }

        return $this->render('AppBundle:auditoria:new.html.twig', array(
            'auditorium' => $auditorium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a auditorium entity.
     *
     * @Route("/{id}", name="auditoria_show")
     * @Method("GET")
     */
    public function showAction(Auditoria $auditorium)
    {
        $deleteForm = $this->createDeleteForm($auditorium);

        return $this->render('AppBundle:auditoria:show.html.twig', array(
            'auditorium' => $auditorium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing auditorium entity.
     *
     * @Route("/{id}/edit", name="auditoria_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Auditoria $auditorium)
    {
        $deleteForm = $this->createDeleteForm($auditorium);
        $editForm = $this->createForm('AppBundle\Form\AuditoriaType', $auditorium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('auditoria_edit', array('id' => $auditorium->getId()));
        }

        return $this->render('AppBundle:auditoria:edit.html.twig', array(
            'auditorium' => $auditorium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a auditorium entity.
     *
     * @Route("/{id}", name="auditoria_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Auditoria $auditorium)
    {
        $form = $this->createDeleteForm($auditorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($auditorium);
            $em->flush($auditorium);
        }

        return $this->redirectToRoute('auditoria_index');
    }

    /**
     * Creates a form to delete a auditorium entity.
     *
     * @param Auditoria $auditorium The auditorium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Auditoria $auditorium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('auditoria_delete', array('id' => $auditorium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

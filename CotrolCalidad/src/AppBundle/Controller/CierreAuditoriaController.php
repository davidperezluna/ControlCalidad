<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CierreAuditoria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * CierreAuditoria controller.
 *
 * @Route("cierreauditoria")
 */
class CierreAuditoriaController extends Controller
{
    /**
     * Lists all cierreAuditorium entities.
     *
     * @Route("/", name="cierreauditoria_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cierreAuditorias = $em->getRepository('AppBundle:CierreAuditoria')->findAll();

        return $this->render('AppBundle:cierreauditoria:index.html.twig', array(
            'cierreAuditorias' => $cierreAuditorias,
        ));
    }

    /**
     * Creates a new cierreAuditorium entity.
     *
     * @Route("/new", name="cierreauditoria_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cierreAuditorium = new CierreAuditoria();
        $form = $this->createForm('AppBundle\Form\CierreAuditoriaType', $cierreAuditorium);
        $form->handleRequest($request);
        $accion = $em->getRepository('AppBundle:Accion')->find($request->query->get('idAccion'));
        $idHallazgo = $accion->getHallazgo()->getId();

        if ($form->isSubmitted() && $form->isValid()) {

            $accion = $em->getRepository('AppBundle:Accion')->find($request->query->get('idAccion'));

            $fecha = new \DateTime($request->query->get('fechaCierre'));
            $em = $this->getDoctrine()->getManager();
            $cierreAuditorium->setFecha($fecha);
            $cierreAuditorium->setEstado('Cerrada');
            $em->persist($cierreAuditorium);
            $em->flush($cierreAuditorium);

            $accion->setCierreAuditoria($cierreAuditorium);
            $em->persist($accion);
            $em->flush($accion);



            return $this->redirectToRoute('hallazgo_show', array('id' => $idHallazgo));
        }

        return $this->render('AppBundle:cierreauditoria:new.html.twig', array(
            'idHallazgo' => $idHallazgo,
            'cierreAuditorium' => $cierreAuditorium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cierreAuditorium entity.
     *
     * @Route("/{id}", name="cierreauditoria_show")
     * @Method("GET")
     */
    public function showAction(CierreAuditoria $cierreAuditorium)
    {
        $deleteForm = $this->createDeleteForm($cierreAuditorium);

        return $this->render('AppBundle:cierreauditoria:show.html.twig', array(
            'cierreAuditorium' => $cierreAuditorium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cierreAuditorium entity.
     *
     * @Route("/{id}/edit", name="cierreauditoria_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CierreAuditoria $cierreAuditorium)
    {
        $deleteForm = $this->createDeleteForm($cierreAuditorium);
        $editForm = $this->createForm('AppBundle\Form\CierreAuditoriaType', $cierreAuditorium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cierreauditoria_edit', array('id' => $cierreAuditorium->getId()));
        }

        return $this->render('AppBundle:cierreauditoria:edit.html.twig', array(
            'cierreAuditorium' => $cierreAuditorium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cierreAuditorium entity.
     *
     * @Route("/{id}", name="cierreauditoria_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CierreAuditoria $cierreAuditorium)
    {
        $form = $this->createDeleteForm($cierreAuditorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cierreAuditorium);
            $em->flush($cierreAuditorium);
        }

        return $this->redirectToRoute('cierreauditoria_index');
    }

    /**
     * Creates a form to delete a cierreAuditorium entity.
     *
     * @param CierreAuditoria $cierreAuditorium The cierreAuditorium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CierreAuditoria $cierreAuditorium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cierreauditoria_delete', array('id' => $cierreAuditorium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

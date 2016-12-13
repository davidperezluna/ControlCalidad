<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProcedimientoUsuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Procedimientousuario controller.
 *
 * @Route("procedimientousuario")
 */
class ProcedimientoUsuarioController extends Controller
{
    /**
     * Lists all procedimientoUsuario entities.
     *
     * @Route("/", name="procedimientousuario_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $procedimientoUsuarios = $em->getRepository('AppBundle:ProcedimientoUsuario')->findAll();

        return $this->render('AppBundle:procedimientousuario:index.html.twig', array(
            'procedimientoUsuarios' => $procedimientoUsuarios,
        ));
    }

    /**
     * Creates a new procedimientoUsuario entity.
     *
     * @Route("/new", name="procedimientousuario_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $procedimientoUsuario = new Procedimientousuario();
        $form = $this->createForm('AppBundle\Form\ProcedimientoUsuarioType', $procedimientoUsuario);
        $form->handleRequest($request);
        $idProcedimiento = $request->query->get('idProcedimiento');
        $em = $this->getDoctrine()->getManager();
        $procedimiento = $em->getRepository('AppBundle:Procedimiento')->find($idProcedimiento);

        if ($form->isSubmitted() && $form->isValid()) {

        $idProcedimiento = $request->query->get('idProcedimiento');
        $em = $this->getDoctrine()->getManager();
        $procedimiento = $em->getRepository('AppBundle:Procedimiento')->find($idProcedimiento);

            $procedimientoUsuario->setProcedimiento($procedimiento );
            $em = $this->getDoctrine()->getManager();
            $em->persist($procedimientoUsuario);
            $em->flush($procedimientoUsuario);

            return $this->redirectToRoute('procedimientousuario_show', array('id' => $procedimientoUsuario->getId()));
        }

        return $this->render('AppBundle:procedimientousuario:new.html.twig', array(
            'procedimiento'=>$procedimiento,
            'procedimientoUsuario' => $procedimientoUsuario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a procedimientoUsuario entity.
     *
     * @Route("/{id}", name="procedimientousuario_show")
     * @Method("GET")
     */
    public function showAction(ProcedimientoUsuario $procedimientoUsuario)
    {
        $deleteForm = $this->createDeleteForm($procedimientoUsuario);

        return $this->render('AppBundle:procedimientousuario:show.html.twig', array(
            'procedimientoUsuario' => $procedimientoUsuario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing procedimientoUsuario entity.
     *
     * @Route("/{id}/edit", name="procedimientousuario_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProcedimientoUsuario $procedimientoUsuario)
    {
        $deleteForm = $this->createDeleteForm($procedimientoUsuario);
        $editForm = $this->createForm('AppBundle\Form\ProcedimientoUsuarioType', $procedimientoUsuario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('procedimientousuario_edit', array('id' => $procedimientoUsuario->getId()));
        }

        return $this->render('AppBundle:procedimientousuario:edit.html.twig', array(
            'procedimientoUsuario' => $procedimientoUsuario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a procedimientoUsuario entity.
     *
     * @Route("/{id}", name="procedimientousuario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProcedimientoUsuario $procedimientoUsuario)
    {
        $form = $this->createDeleteForm($procedimientoUsuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($procedimientoUsuario);
            $em->flush($procedimientoUsuario);
        }

        return $this->redirectToRoute('procedimientousuario_index');
    }

    /**
     * Creates a form to delete a procedimientoUsuario entity.
     *
     * @param ProcedimientoUsuario $procedimientoUsuario The procedimientoUsuario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProcedimientoUsuario $procedimientoUsuario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('procedimientousuario_delete', array('id' => $procedimientoUsuario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

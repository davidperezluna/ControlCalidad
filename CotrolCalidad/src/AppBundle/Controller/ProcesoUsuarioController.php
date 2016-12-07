<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProcesoUsuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Procesousuario controller.
 *
 * @Route("procesousuario")
 */
class ProcesoUsuarioController extends Controller
{
    /**
     * Lists all procesoUsuario entities.
     *
     * @Route("/", name="procesousuario_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $procesoUsuarios = $em->getRepository('AppBundle:ProcesoUsuario')->findAll();

        return $this->render('AppBundle:procesousuario:index.html.twig', array(
            'procesoUsuarios' => $procesoUsuarios,
        ));
    }

    /**
     * Creates a new procesoUsuario entity.
     *
     * @Route("/new", name="procesousuario_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $procesoUsuario = new Procesousuario();
        $form = $this->createForm('AppBundle\Form\ProcesoUsuarioType', $procesoUsuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($procesoUsuario);
            $em->flush($procesoUsuario);

            return $this->redirectToRoute('procesousuario_show', array('id' => $procesoUsuario->getId()));
        }

        return $this->render('AppBundle:procesousuario:new.html.twig', array(
            'procesoUsuario' => $procesoUsuario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a procesoUsuario entity.
     *
     * @Route("/{id}", name="procesousuario_show")
     * @Method("GET")
     */
    public function showAction(ProcesoUsuario $procesoUsuario)
    {
        $deleteForm = $this->createDeleteForm($procesoUsuario);

        return $this->render('AppBundle:procesousuario:show.html.twig', array(
            'procesoUsuario' => $procesoUsuario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing procesoUsuario entity.
     *
     * @Route("/{id}/edit", name="procesousuario_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProcesoUsuario $procesoUsuario)
    {
        $deleteForm = $this->createDeleteForm($procesoUsuario);
        $editForm = $this->createForm('AppBundle\Form\ProcesoUsuarioType', $procesoUsuario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('procesousuario_edit', array('id' => $procesoUsuario->getId()));
        }

        return $this->render('AppBundle:procesousuario:edit.html.twig', array(
            'procesoUsuario' => $procesoUsuario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a procesoUsuario entity.
     *
     * @Route("/{id}", name="procesousuario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProcesoUsuario $procesoUsuario)
    {
        $form = $this->createDeleteForm($procesoUsuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($procesoUsuario);
            $em->flush($procesoUsuario);
        }

        return $this->redirectToRoute('procesousuario_index');
    }

    /**
     * Creates a form to delete a procesoUsuario entity.
     *
     * @param ProcesoUsuario $procesoUsuario The procesoUsuario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProcesoUsuario $procesoUsuario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('procesousuario_delete', array('id' => $procesoUsuario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

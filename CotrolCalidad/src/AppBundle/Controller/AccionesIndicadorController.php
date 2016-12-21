<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AccionesIndicador;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Accionesindicador controller.
 *
 * @Route("accionesindicador")
 */
class AccionesIndicadorController extends Controller
{
    /**
     * Lists all accionesIndicador entities.
     *
     * @Route("/", name="accionesindicador_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $accionesIndicadors = $em->getRepository('AppBundle:AccionesIndicador')->findAll();

        return $this->render('AppBundle:accionesindicador:index.html.twig', array(
            'accionesIndicadors' => $accionesIndicadors,
        ));
    }

    /**
     * Creates a new accionesIndicador entity.
     *
     * @Route("/new", name="accionesindicador_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $accionesIndicador = new Accionesindicador();
        $form = $this->createForm('AppBundle\Form\AccionesIndicadorType', $accionesIndicador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $idSeguimiento = $request->query->get('idSeguimiento');

            $fechaCierre = new \DateTime($request->query->get('fechaCierre'));

            $em = $this->getDoctrine()->getManager();

            $seguimiento = $em->getRepository('AppBundle:SeguimientoIndicador')->find($idSeguimiento);

            $accionesIndicador->setFechaCierre($fechaCierre);
            $accionesIndicador->setSeguimientoIndicador($seguimiento);
            $em = $this->getDoctrine()->getManager();
            $em->persist($accionesIndicador);
            $em->flush($accionesIndicador);

            return $this->redirectToRoute('seguimientoindicador_show', array('id' => $seguimiento->getId()));
        }

        return $this->render('AppBundle:accionesindicador:new.html.twig', array(
            'accionesIndicador' => $accionesIndicador,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a accionesIndicador entity.
     *
     * @Route("/{id}", name="accionesindicador_show")
     * @Method("GET")
     */
    public function showAction(AccionesIndicador $accionesIndicador)
    {
        $deleteForm = $this->createDeleteForm($accionesIndicador);

        return $this->render('AppBundle:accionesindicador:show.html.twig', array(
            'accionesIndicador' => $accionesIndicador,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing accionesIndicador entity.
     *
     * @Route("/{id}/edit", name="accionesindicador_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AccionesIndicador $accionesIndicador)
    {
        $deleteForm = $this->createDeleteForm($accionesIndicador);
        $editForm = $this->createForm('AppBundle\Form\AccionesIndicadorType', $accionesIndicador);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accionesindicador_edit', array('id' => $accionesIndicador->getId()));
        }

        return $this->render('AppBundle:accionesindicador:accionesindicador/edit.html.twig', array(
            'accionesIndicador' => $accionesIndicador,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a accionesIndicador entity.
     *
     * @Route("/{id}", name="accionesindicador_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AccionesIndicador $accionesIndicador)
    {
        $form = $this->createDeleteForm($accionesIndicador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($accionesIndicador);
            $em->flush($accionesIndicador);
        }

        return $this->redirectToRoute('accionesindicador_index');
    }

    /**
     * Creates a form to delete a accionesIndicador entity.
     *
     * @param AccionesIndicador $accionesIndicador The accionesIndicador entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AccionesIndicador $accionesIndicador)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('accionesindicador_delete', array('id' => $accionesIndicador->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Indicador;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Indicador controller.
 *
 * @Route("indicador")
 */
class IndicadorController extends Controller
{
    /**
     * Lists all indicador entities.
     *
     * @Route("/", name="indicador_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $indicadors = $em->getRepository('AppBundle:Indicador')->findAll();

        return $this->render('AppBundle:indicador:index.html.twig', array(
            'indicadors' => $indicadors,
        ));
    }

    /**
     * Creates a new indicador entity.
     *
     * @Route("/new", name="indicador_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $indicador = new Indicador();
        $form = $this->createForm('AppBundle\Form\IndicadorType', $indicador);
        $form->handleRequest($request);
        $idProceso = $request->query->get('idProceso');
        

        if ($form->isSubmitted() && $form->isValid()) {

            $idProceso = $request->query->get('idProceso');
            $proceso = $em->getRepository('AppBundle:Proceso')->find($idProceso);

            $indicador->setProceso($proceso);
            $em = $this->getDoctrine()->getManager();
            $em->persist($indicador);
            $em->flush($indicador);

            return $this->redirectToRoute('proceso_show', array('id' => $proceso->getId()));
        }

        return $this->render('AppBundle:indicador:new.html.twig', array(
            'idProceso'=>$idProceso,
            'indicador' => $indicador,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a indicador entity.
     *
     * @Route("/{id}", name="indicador_show")
     * @Method("GET")
     */
    public function showAction(Indicador $indicador)
    {
        $deleteForm = $this->createDeleteForm($indicador);

        return $this->render('AppBundle:indicador:show.html.twig', array(
            'indicador' => $indicador,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing indicador entity.
     *
     * @Route("/{id}/edit", name="indicador_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Indicador $indicador)
    {
        $deleteForm = $this->createDeleteForm($indicador);
        $editForm = $this->createForm('AppBundle\Form\IndicadorType', $indicador);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('indicador_show', array('id' => $indicador->getId()));
        }

        return $this->render('AppBundle:indicador:edit.html.twig', array(
            'indicador' => $indicador,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a indicador entity.
     *
     * @Route("/{id}", name="indicador_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Indicador $indicador)
    {
        $form = $this->createDeleteForm($indicador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($indicador);
            $em->flush($indicador);
        }

        return $this->redirectToRoute('indicador_index');
    }

    /**
     * Creates a form to delete a indicador entity.
     *
     * @param Indicador $indicador The indicador entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Indicador $indicador)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('indicador_delete', array('id' => $indicador->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

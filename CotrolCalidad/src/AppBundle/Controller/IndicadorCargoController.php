<?php

namespace AppBundle\Controller;

use AppBundle\Entity\IndicadorCargo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Indicadorcargo controller.
 *
 * @Route("indicadorcargo")
 */
class IndicadorCargoController extends Controller
{
    /**
     * Lists all indicadorCargo entities.
     *
     * @Route("/", name="indicadorcargo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $indicadorCargos = $em->getRepository('AppBundle:IndicadorCargo')->findAll();

        return $this->render('AppBundle:indicadorcargo:index.html.twig', array(
            'indicadorCargos' => $indicadorCargos,
        ));
    }

    /**
     * Creates a new indicadorCargo entity.
     *
     * @Route("/new", name="indicadorcargo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $indicadorCargo = new Indicadorcargo();
        $form = $this->createForm('AppBundle\Form\IndicadorCargoType', $indicadorCargo);
        $form->handleRequest($request);
        $idIndicador = $request->query->get('idIndicador');

        if ($form->isSubmitted() && $form->isValid()) {

            $idIndicador = $request->query->get('idIndicador');
            $em = $this->getDoctrine()->getManager();
            $indicador = $em->getRepository('AppBundle:Indicador')->find($idIndicador);

            $indicadorCargo->setIndicador($indicador);
            $em = $this->getDoctrine()->getManager();
            $em->persist($indicadorCargo);
            $em->flush($indicadorCargo);

            return $this->redirectToRoute('indicador_show', array('id' => $indicador->getId()));
        }

        return $this->render('AppBundle:indicadorcargo:new.html.twig', array(
            'idIndicador'=>$idIndicador,
            'indicadorCargo' => $indicadorCargo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a indicadorCargo entity.
     *
     * @Route("/{id}", name="indicadorcargo_show")
     * @Method("GET")
     */
    public function showAction(IndicadorCargo $indicadorCargo)
    {
        $deleteForm = $this->createDeleteForm($indicadorCargo);

        return $this->render('AppBundle:indicadorcargo:show.html.twig', array(
            'indicadorCargo' => $indicadorCargo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing indicadorCargo entity.
     *
     * @Route("/{id}/edit", name="indicadorcargo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, IndicadorCargo $indicadorCargo)
    {
        $deleteForm = $this->createDeleteForm($indicadorCargo);
        $editForm = $this->createForm('AppBundle\Form\IndicadorCargoType', $indicadorCargo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('indicadorcargo_edit', array('id' => $indicadorCargo->getId()));
        }

        return $this->render('AppBundle:indicadorcargo:edit.html.twig', array(
            'indicadorCargo' => $indicadorCargo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a indicadorCargo entity.
     *
     * @Route("delete/{id}", name="indicadorcargo_delete")
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, IndicadorCargo $indicadorCargo)
    {
      
        $em = $this->getDoctrine()->getManager();
        $em->remove($indicadorCargo);
        $em->flush($indicadorCargo);
        return $this->redirectToRoute('indicador_show', array('id' => $request->query->get('idIndicador')));
    }

    /**
     * Creates a form to delete a indicadorCargo entity.
     *
     * @param IndicadorCargo $indicadorCargo The indicadorCargo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(IndicadorCargo $indicadorCargo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('indicadorcargo_delete', array('id' => $indicadorCargo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

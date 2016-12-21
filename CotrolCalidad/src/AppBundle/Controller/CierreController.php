<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cierre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Cierre controller.
 *
 * @Route("cierre")
 */
class CierreController extends Controller
{
    /**
     * Lists all cierre entities.
     *
     * @Route("/", name="cierre_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cierres = $em->getRepository('AppBundle:Cierre')->findAll();

        return $this->render('AppBundle:cierre:index.html.twig', array(
            'cierres' => $cierres,
        ));
    }

    /**
     * Creates a new cierre entity.
     *
     * @Route("/new", name="cierre_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cierre = new Cierre();
        $form = $this->createForm('AppBundle\Form\CierreType', $cierre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          

            $em = $this->getDoctrine()->getManager();
            $em->persist($cierre);
            $em->flush($cierre);

            $accionIndicador = $em->getRepository('AppBundle:AccionesIndicador')->find($request->query->get('idAccionesIndicador'));

            $accionIndicador->setCierre($cierre);
            $em->persist($accionIndicador);
            $em->flush($accionIndicador);



            return $this->redirectToRoute('seguimientoindicador_show', array('id' => $accionIndicador->getSeguimientoIndicador()->getId()));
        }

        return $this->render('AppBundle:cierre:new.html.twig', array(
            'cierre' => $cierre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cierre entity.
     *
     * @Route("/{id}", name="cierre_show")
     * @Method("GET")
     */
    public function showAction(Cierre $cierre)
    {
        $deleteForm = $this->createDeleteForm($cierre);

        return $this->render('AppBundle:cierre:show.html.twig', array(
            'cierre' => $cierre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cierre entity.
     *
     * @Route("/{id}/edit", name="cierre_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cierre $cierre)
    {
        $deleteForm = $this->createDeleteForm($cierre);
        $editForm = $this->createForm('AppBundle\Form\CierreType', $cierre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seguimientoindicador_show', array('id' => $cierre->getAccionIndicador()->getSeguimientoIndicador()->getId()));
        }

        return $this->render('AppBundle:cierre:edit.html.twig', array(
            'cierre' => $cierre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cierre entity.
     *
     * @Route("/{id}", name="cierre_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Cierre $cierre)
    {
        $form = $this->createDeleteForm($cierre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cierre);
            $em->flush($cierre);
        }

        return $this->redirectToRoute('cierre_index');
    }

    /**
     * Creates a form to delete a cierre entity.
     *
     * @param Cierre $cierre The cierre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cierre $cierre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cierre_delete', array('id' => $cierre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

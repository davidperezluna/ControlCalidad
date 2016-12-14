<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Procedimiento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Procedimiento controller.
 *
 * @Route("procedimiento")
 */
class ProcedimientoController extends Controller
{

    /**
     * Lists all procedimiento entities.
     *
     * @Route("/", name="procedimiento_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $procedimientos = $em->getRepository('AppBundle:Procedimiento')->findAll();

        return $this->render('AppBundle:procedimiento:index.html.twig', array(
            'procedimientos' => $procedimientos,
        ));
    }

    /**
     * Creates a new procedimiento entity.
     *
     * @Route("/new", name="procedimiento_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $procedimiento = new Procedimiento();
        $form = $this->createForm('AppBundle\Form\ProcedimientoType', $procedimiento);
        $form->handleRequest($request);

            $em = $this->getDoctrine()->getManager();
            $idProceso=$request->query->get('idProceso');
            $proceso = $em->getRepository('AppBundle:Proceso')->find($idProceso);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $idProceso=$request->query->get('idProceso');
            $proceso = $em->getRepository('AppBundle:Proceso')->find($idProceso);

            $vigencia = $procedimiento->getVigencia();


            // $fechaVigencia = new \DateTime($vigencia);
            // $procedimiento->setVigencia($fechaVigencia);
            $procedimiento->setProceso($proceso);           
            $em->persist($procedimiento);
            $em->flush($procedimiento);

            return $this->redirectToRoute('proceso_show', array('id' => $proceso->getId()));
        }

        return $this->render('AppBundle:procedimiento:new.html.twig', array(
            'proceso'=>$proceso,
            'procedimiento' => $procedimiento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a procedimiento entity.
     *
     * @Route("/{id}", name="procedimiento_show")
     * @Method("GET")
     */
    public function showAction(Procedimiento $procedimiento)
    {
        $deleteForm = $this->createDeleteForm($procedimiento);

        return $this->render('AppBundle:procedimiento:show.html.twig', array(
            'procedimiento' => $procedimiento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing procedimiento entity.
     *
     * @Route("/{id}/edit", name="procedimiento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Procedimiento $procedimiento)
    {
        $deleteForm = $this->createDeleteForm($procedimiento);
        $editForm = $this->createForm('AppBundle\Form\ProcedimientoType', $procedimiento);
        $editForm->handleRequest($request);

       


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('procedimiento_show', array('id' => $procedimiento->getId()));
        }

     
        return $this->render('AppBundle:procedimiento:edit.html.twig', array(
            'procedimiento' => $procedimiento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a procedimiento entity.
     *
     * @Route("/{id}", name="procedimiento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Procedimiento $procedimiento)
    {
        $form = $this->createDeleteForm($procedimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($procedimiento);
            $em->flush($procedimiento);
        }

        return $this->redirectToRoute('procedimiento_index');
    }

    /**
     * Creates a form to delete a procedimiento entity.
     *
     * @param Procedimiento $procedimiento The procedimiento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Procedimiento $procedimiento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('procedimiento_delete', array('id' => $procedimiento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Normograma;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Normograma controller.
 *
 * @Route("normograma")
 */
class NormogramaController extends Controller
{
    /**
     * Lists all normograma entities.
     *
     * @Route("/", name="normograma_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $normogramas = $em->getRepository('AppBundle:Normograma')->findAll();

        return $this->render('AppBundle:normograma:index.html.twig', array(
            'normogramas' => $normogramas,
        ));
    }

    /**
     * Creates a new normograma entity.
     *
     * @Route("/new", name="normograma_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $normograma = new Normograma();
        $form = $this->createForm('AppBundle\Form\NormogramaType', $normograma);
        $form->handleRequest($request);

        $idProcedimiento = $request->query->get('idProcedimiento');
        $em = $this->getDoctrine()->getManager();
        $procedimiento = $em->getRepository('AppBundle:Procedimiento')->find($idProcedimiento);

        if ($form->isSubmitted() && $form->isValid()) {
            $idProcedimiento = $request->query->get('idProcedimiento');
            $em = $this->getDoctrine()->getManager();
            $procedimiento = $em->getRepository('AppBundle:Procedimiento')->find($idProcedimiento);

            $normograma->setProcedimiento($procedimiento);
            $em = $this->getDoctrine()->getManager();
            $em->persist($normograma);
            $em->flush($normograma);

            return $this->redirectToRoute('procedimiento_show', array('id' => $procedimiento->getId()));
        }

        return $this->render('AppBundle:normograma:new.html.twig', array(
            'procedimiento'=>$procedimiento,
            'normograma' => $normograma,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a normograma entity.
     *
     * @Route("/{id}", name="normograma_show")
     * @Method("GET")
     */
    public function showAction(Normograma $normograma)
    {
        $deleteForm = $this->createDeleteForm($normograma);

        return $this->render('AppBundle:normograma:show.html.twig', array(
            'normograma' => $normograma,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing normograma entity.
     *
     * @Route("/{id}/edit", name="normograma_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Normograma $normograma)
    {
        $deleteForm = $this->createDeleteForm($normograma);
        $editForm = $this->createForm('AppBundle\Form\NormogramaType', $normograma);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('normograma_edit', array('id' => $normograma->getId()));
        }

        return $this->render('AppBundle:normograma:edit.html.twig', array(
            'normograma' => $normograma,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a normograma entity.
     *
     * @Route("/{id}", name="normograma_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Normograma $normograma)
    {
        $form = $this->createDeleteForm($normograma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($normograma);
            $em->flush($normograma);
        }

        return $this->redirectToRoute('normograma_index');
    }

    /**
     * Creates a form to delete a normograma entity.
     *
     * @param Normograma $normograma The normograma entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Normograma $normograma)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('normograma_delete', array('id' => $normograma->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

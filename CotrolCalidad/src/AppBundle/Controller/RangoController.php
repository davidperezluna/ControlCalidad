<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Rango;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Rango controller.
 *
 * @Route("rango")
 */
class RangoController extends Controller
{
    /**
     * Lists all rango entities.
     *
     * @Route("/", name="rango_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rangos = $em->getRepository('AppBundle:Rango')->findAll();

        return $this->render('AppBundle:rango:index.html.twig', array(
            'rangos' => $rangos,
        ));
    }

    /**
     * Creates a new rango entity.
     *
     * @Route("/new", name="rango_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rango = new Rango();
        $form = $this->createForm('AppBundle\Form\RangoType', $rango);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rango);
            $em->flush($rango);

            return $this->redirectToRoute('rango_show', array('id' => $rango->getId()));
        }

        return $this->render('AppBundle:rango:new.html.twig', array(
            'rango' => $rango,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a rango entity.
     *
     * @Route("/{id}", name="rango_show")
     * @Method("GET")
     */
    public function showAction(Rango $rango)
    {
        $deleteForm = $this->createDeleteForm($rango);

        return $this->render('AppBundle:rango:show.html.twig', array(
            'rango' => $rango,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing rango entity.
     *
     * @Route("/{id}/edit", name="rango_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Rango $rango)
    {
        $deleteForm = $this->createDeleteForm($rango);
        $editForm = $this->createForm('AppBundle\Form\RangoType', $rango);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rango_edit', array('id' => $rango->getId()));
        }

        return $this->render('AppBundle:rango:edit.html.twig', array(
            'rango' => $rango,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a rango entity.
     *
     * @Route("/{id}", name="rango_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Rango $rango)
    {
        $form = $this->createDeleteForm($rango);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rango);
            $em->flush($rango);
        }

        return $this->redirectToRoute('rango_index');
    }

    /**
     * Creates a form to delete a rango entity.
     *
     * @param Rango $rango The rango entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Rango $rango)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rango_delete', array('id' => $rango->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

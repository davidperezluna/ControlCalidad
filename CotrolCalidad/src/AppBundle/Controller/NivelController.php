<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Nivel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Nivel controller.
 *
 * @Route("nivel")
 */
class NivelController extends Controller
{
    /**
     * Lists all nivel entities.
     *
     * @Route("/", name="nivel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $nivels = $em->getRepository('AppBundle:Nivel')->findAll();
        

        return $this->render('nivel/index.html.twig', array(
            'nivels' => $nivels,
        ));
    }

    /**
     * Creates a new nivel entity.
     *
     * @Route("/new", name="nivel_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $nivel = new Nivel();
        $form = $this->createForm('AppBundle\Form\NivelType', $nivel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $rango = $em->getRepository('AppBundle:Rango')->find($request->query->get('idRango'));
            $nivel->setRango($rango);
            $em->persist($nivel);
            $em->flush($nivel);

            return $this->redirectToRoute('rango_index');
        }


        return $this->render('AppBundle:nivel:new.html.twig', array(
            'nivel' => $nivel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a nivel entity.
     *
     * @Route("/{id}", name="nivel_show")
     * @Method("GET")
     */
    public function showAction(Nivel $nivel)
    {
        $deleteForm = $this->createDeleteForm($nivel);

        return $this->render('AppBundle:nivel:show.html.twig', array(
            'nivel' => $nivel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing nivel entity.
     *
     * @Route("/{id}/edit", name="nivel_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Nivel $nivel)
    {
        $deleteForm = $this->createDeleteForm($nivel);
        $editForm = $this->createForm('AppBundle\Form\NivelType', $nivel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nivel_edit', array('id' => $nivel->getId()));
        }

        return $this->render('AppBundle:nivel:edit.html.twig', array(
            'nivel' => $nivel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a nivel entity.
     *
     * @Route("/{id}", name="nivel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Nivel $nivel)
    {
        $form = $this->createDeleteForm($nivel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($nivel);
            $em->flush($nivel);
        }

        return $this->redirectToRoute('nivel_index');
    }

    /**
     * Creates a form to delete a nivel entity.
     *
     * @param Nivel $nivel The nivel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Nivel $nivel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nivel_delete', array('id' => $nivel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

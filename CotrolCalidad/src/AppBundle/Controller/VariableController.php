<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Variable;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Variable controller.
 *
 * @Route("variable")
 */
class VariableController extends Controller
{
    /**
     * Lists all variable entities.
     *
     * @Route("/", name="variable_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $variables = $em->getRepository('AppBundle:Variable')->findAll();

        return $this->render('AppBundle:variable:index.html.twig', array(
            'variables' => $variables,
        ));
    }

    /**
     * Creates a new variable entity.
     *
     * @Route("/new", name="variable_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $variable = new Variable();
        $form = $this->createForm('AppBundle\Form\VariableType', $variable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $indicador = $em->getRepository('AppBundle:Indicador')->find($request->query->get('idIndicador'));

            $variable->setIndicador($indicador);
            $em = $this->getDoctrine()->getManager();
            $em->persist($variable);
            $em->flush($variable);

            return $this->redirectToRoute('indicador_show', array('id' => $indicador->getId()));
        }

        return $this->render('AppBundle:variable:new.html.twig', array(
            'variable' => $variable,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a variable entity.
     *
     * @Route("/{id}", name="variable_show")
     * @Method("GET")
     */
    public function showAction(Variable $variable)
    {
        $deleteForm = $this->createDeleteForm($variable);

        return $this->render('AppBundle:variable:show.html.twig', array(
            'variable' => $variable,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing variable entity.
     *
     * @Route("/{id}/edit", name="variable_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Variable $variable)
    {
        $deleteForm = $this->createDeleteForm($variable);
        $editForm = $this->createForm('AppBundle\Form\VariableType', $variable);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('variable_edit', array('id' => $variable->getId()));
        }

        return $this->render('AppBundle:variable:edit.html.twig', array(
            'variable' => $variable,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a variable entity.
     *
     * @Route("delete/{id}", name="variable_delete")
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, Variable $variable)
    {
       
            $em = $this->getDoctrine()->getManager();
            $em->remove($variable);
            $em->flush($variable);


          return $this->redirectToRoute('indicador_show', array('id' => $variable->getIndicador()->getId()));
    }

    /**
     * Creates a form to delete a variable entity.
     *
     * @param Variable $variable The variable entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Variable $variable)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('variable_delete', array('id' => $variable->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

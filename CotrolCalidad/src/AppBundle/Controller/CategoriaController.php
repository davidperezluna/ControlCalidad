<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Categoria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Categoria controller.
 *
 * @Route("categoria")
 */
class CategoriaController extends Controller
{
    /**
     * Lists all categorium entities.
     *
     * @Route("/", name="categoria_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorias = $em->getRepository('AppBundle:Categoria')->findAll();

        return $this->render('AppBundle:categoria:index.html.twig', array(
            'categorias' => $categorias,
        ));
    }

    /**
     * Creates a new categorium entity.
     *
     * @Route("/new", name="categoria_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $categorium = new Categoria();
        $form = $this->createForm('AppBundle\Form\CategoriaType', $categorium);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            if ($this->getUser()->getRole() != "ROLE_SUPER_ADMIN") {
              $categorium->setDependencia($this->getUser()->getDependencia()); 
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorium);
            $em->flush($categorium);

            return $this->redirectToRoute('categoria_index');
        }

        return $this->render('AppBundle:categoria:new.html.twig', array(
            'categorium' => $categorium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categorium entity.
     *
     * @Route("/{id}", name="categoria_show")
     * @Method("GET")
     */
    public function showAction(Categoria $categorium)
    {
        $deleteForm = $this->createDeleteForm($categorium);

        return $this->render('AppBundle:categoria:show.html.twig', array(
            'categorium' => $categorium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categorium entity.
     *
     * @Route("/{id}/edit", name="categoria_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Categoria $categorium)
    {
        $deleteForm = $this->createDeleteForm($categorium);
        $editForm = $this->createForm('AppBundle\Form\CategoriaType', $categorium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categoria_edit', array('id' => $categorium->getId()));
        }

        return $this->render('AppBundle:categoria:edit.html.twig', array(
            'categorium' => $categorium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categorium entity.
     *
     * @Route("/{id}", name="categoria_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Categoria $categorium)
    {
        $form = $this->createDeleteForm($categorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorium);
            $em->flush($categorium);
        }

        return $this->redirectToRoute('categoria_index');
    }

    /**
     * Creates a form to delete a categorium entity.
     *
     * @param Categoria $categorium The categorium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categoria $categorium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categoria_delete', array('id' => $categorium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

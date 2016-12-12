<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Dependencia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Dependencia controller.
 *
 * @Route("dependencia")
 */
class DependenciaController extends Controller
{
    /**
     * Lists all dependencium entities.
     *
     * @Route("/", name="dependencia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dependencias = $em->getRepository('AppBundle:Dependencia')->findAll();

        return $this->render('AppBundle:dependencia:index.html.twig', array(
            'dependencias' => $dependencias,
        ));
    }

    /**
     * Creates a new dependencium entity.
     *
     * @Route("/new", name="dependencia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $empresas = $em->getRepository('AppBundle:Empresa')->findAll();
        $dependencium = new Dependencia();
        $form = $this->createForm('AppBundle\Form\DependenciaType', $dependencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $empresaId=$request->request->get('empresaId');
            $empresa = $em->getRepository('AppBundle:Empresa')->find($empresaId);
            $dependencium->setEmpresa($empresa);
            $em->persist($dependencium);
            $em->flush($dependencium);

            return $this->redirectToRoute('dependencia_show', array('id' => $dependencium->getId()));
        }

        return $this->render('AppBundle:dependencia:new.html.twig', array(
            'empresas' => $empresas,
            'dependencium' => $dependencium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a dependencium entity.
     *
     * @Route("/{id}", name="dependencia_show")
     * @Method("GET")
     */
    public function showAction(Dependencia $dependencium)
    {
        $em = $this->getDoctrine()->getManager();

        $categorias = $em->getRepository('AppBundle:Categoria')->findAll();

        $deleteForm = $this->createDeleteForm($dependencium);



        return $this->render('AppBundle:dependencia:show.html.twig', array(
            'categorias' => $categorias,
            'dependencium' => $dependencium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing dependencium entity.
     *
     * @Route("/{id}/edit", name="dependencia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Dependencia $dependencium)
    {
        $em = $this->getDoctrine()->getManager();
        $empresas = $em->getRepository('AppBundle:Empresa')->findAll();

        $deleteForm = $this->createDeleteForm($dependencium);
        $editForm = $this->createForm('AppBundle\Form\DependenciaType', $dependencium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) 
        {
            $empresaId=$request->request->get('empresaId');
            $empresa = $em->getRepository('AppBundle:Empresa')->find($empresaId);
            $dependencium->setEmpresa($empresa);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dependencia_edit', array('id' => $dependencium->getId()));
        }

        return $this->render('AppBundle:dependencia:edit.html.twig', array(
            'empresas' => $empresas,
            'dependencium' => $dependencium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a dependencium entity.
     *
     * @Route("/{id}", name="dependencia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Dependencia $dependencium)
    {
        $form = $this->createDeleteForm($dependencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dependencium);
            $em->flush($dependencium);
        }

        return $this->redirectToRoute('dependencia_index');
    }

    /**
     * Creates a form to delete a dependencium entity.
     *
     * @param Dependencia $dependencium The dependencium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Dependencia $dependencium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dependencia_delete', array('id' => $dependencium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

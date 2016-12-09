<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Documento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Documento controller.
 * 
 * @Route("documento")
 */
class DocumentoController extends Controller
{

    /**
      * Download file
      * @Route("/download/{id}", name="catalogo_marca_download")
      * @Method("GET")
      */
     public function downloadDocumentAction($id)
     {
        $em = $this->getDoctrine()->getManager();
        $document = $em->getRepository('AppBundle:Documento')->find($id);

        if ( ! $document) {
        throw $this->createNotFoundException('Unable to find Document
        entity.');
        }
        $path = $this->get('kernel')->getRootDir() .
        "/../web/uploads/documentos/" . $document->geturlDocumento();
        $content = file_get_contents($path);

        $response = new Response();

        $response->headers->set('Content-Type', "'". $document->getNombre() .
        "'");
        $response->headers->set('Content-Disposition',
        'attachment;filename="'.$document->geturlDocumento());

        $response->setContent($content);

             return $response;
     }
    /**
     * Lists all documento entities.
     *
     * @Route("/", name="documento_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $documentos = $em->getRepository('AppBundle:Documento')->findAll();

        return $this->render('AppBundle:documento:index.html.twig', array(
            'documentos' => $documentos,
        ));
    }

    /**
     * Creates a new documento entity.
     *
     * @Route("/new", name="documento_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $documento = new Documento();
        $form = $this->createForm('AppBundle\Form\DocumentoType', $documento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $documento->getUrlDocumento();

            $fileName = md5(uniqid()).$documento->getNombre().'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('documentos_directory'),
                $fileName
            );


            $documento->seturlDocumento($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($documento);
            $em->flush($documento);

            return $this->redirectToRoute('documento_show', array('id' => $documento->getId()));
        }

        return $this->render('AppBundle:documento:new.html.twig', array(
            'documento' => $documento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a documento entity.
     *
     * @Route("/{id}", name="documento_show")
     * @Method("GET")
     */
    public function showAction(Documento $documento)
    {
        $deleteForm = $this->createDeleteForm($documento);

        return $this->render('AppBundle:documento:show.html.twig', array(
            'documento' => $documento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing documento entity.
     *
     * @Route("/{id}/edit", name="documento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Documento $documento)
    {
        $deleteForm = $this->createDeleteForm($documento);
        $editForm = $this->createForm('AppBundle\Form\DocumentoType', $documento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('documento_edit', array('id' => $documento->getId()));
        }

        return $this->render('AppBundle:documento:edit.html.twig', array(
            'documento' => $documento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a documento entity.
     *
     * @Route("/{id}", name="documento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Documento $documento)
    {
        $form = $this->createDeleteForm($documento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($documento);
            $em->flush($documento);
        }

        return $this->redirectToRoute('documento_index');
    }

    /**
     * Creates a form to delete a documento entity.
     *
     * @param Documento $documento The documento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Documento $documento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('documento_delete', array('id' => $documento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

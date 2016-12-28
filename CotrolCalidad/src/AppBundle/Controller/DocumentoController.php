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
     * Lists all documento entities.
     *
     * @Route("/documentos/index", name="documentos_index")
     * @Method("GET")
     */
    public function DocumentosIndexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $documentos = $em->getRepository('AppBundle:ProcedimientoDocumento')->findAll();
        return $this->render('AppBundle:documento:documentosMaestros.html.twig', array(
            'procedimientosDocumentos' => $documentos,
        ));
    }

    /**
     * Creates a new documento entity.
     *
     * @Route("/new/documento", name="documento_index_new")
     * @Method({"GET", "POST"})
     */
    public function newDocumentoAction(Request $request)
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


            if ($instrictivo = $documento->geturlInstructivo() != null) {

                $instrictivo = $documento->geturlInstructivo();
                $instrictivoName = md5(uniqid()).$documento->getNombre().'.'.$instrictivo->guessExtension();
                $instrictivo->move(
                    $this->getParameter('documentos_directory'),
                    $instrictivoName
                );
                $documento->seturlInstructivo($instrictivoName);
            }
           


            $documento->seturlDocumento($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($documento);
            $em->flush($documento);


            return $this->redirectToRoute('documento_index');
        }

        return $this->render('AppBundle:documento:documentoNew.html.twig', array(
            'documento' => $documento,
            'form' => $form->createView(),
        ));
    }

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
      * Download file
      * @Route("/download/instructivo/{id}", name="instructivo_download")
      * @Method("GET")
      */
     public function downloadInstructivoAction($id)
     {
        $em = $this->getDoctrine()->getManager();
        $document = $em->getRepository('AppBundle:Documento')->find($id);

        if ( ! $document) {
        throw $this->createNotFoundException('Unable to find Document
        entity.');
        }
        $path = $this->get('kernel')->getRootDir() .
        "/../web/uploads/documentos/" . $document->geturlInstructivo();
        $content = file_get_contents($path);

        $response = new Response();

        $response->headers->set('Content-Type', "'". $document->getNombre() .
        "'");
        $response->headers->set('Content-Disposition',
        'attachment;filename="'.$document->geturlInstructivo());

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
        $idProcedimiento = $request->query->get('idProcedmiento');

        if ($form->isSubmitted() && $form->isValid()) {

            $idProcedimiento = $request->query->get('idProcedmiento');

            $file = $documento->getUrlDocumento();

            $fileName = md5(uniqid()).$documento->getNombre().'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('documentos_directory'),
                $fileName
            );

            if ($instrictivo = $documento->geturlInstructivo() != null) {
            $instrictivo = $documento->geturlInstructivo();

            $instrictivoName = md5(uniqid()).$documento->getNombre().'.'.$instrictivo->guessExtension();


            $instrictivo->move(
                $this->getParameter('documentos_directory'),
                $instrictivoName
            );
             $documento->seturlInstructivo($instrictivoName);
            }
            $documento->seturlDocumento($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($documento);
            $em->flush($documento);


            return $this->redirectToRoute('procedimientodocumento_new', array('idProcedimiento' => $idProcedimiento));
        }

        return $this->render('AppBundle:documento:new.html.twig', array(
            'idProcedimiento'=>$idProcedimiento,
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
     * @Route("/{id}/edit/inicio", name="documento_edit_inicio")
     * @Method({"GET", "POST"})
     */
    public function editActionInicio(Request $request, Documento $documento)
    {
        $deleteForm = $this->createDeleteForm($documento);
        $editForm = $this->createForm('AppBundle\Form\DocumentoType', $documento);
        $editForm->handleRequest($request);
        $idProcedimiento = $request->query->get('idProcedmiento');

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $idProcedimiento = $request->query->get('idProcedmiento');

            $file = $documento->getUrlDocumento();

            $fileName = md5(uniqid()).$documento->getNombre().'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('documentos_directory'),
                $fileName
            );

            $instrictivo = $documento->geturlInstructivo();

            $instrictivoName = md5(uniqid()).$documento->getNombre().'.'.$instrictivo->guessExtension();


            $instrictivo->move(
                $this->getParameter('documentos_directory'),
                $instrictivoName
            );

            $documento->seturlInstructivo($instrictivoName);
            $documento->seturlDocumento($fileName);

            return $this->redirectToRoute('procedimiento_show', array('id' => $idProcedimiento));
        }

        return $this->render('AppBundle:documento:edit_inicio.html.twig', array(
            'idProcedimiento'=>$idProcedimiento,
            'documento' => $documento,
            'edit_form' => $editForm->createView(),
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

            $idProcedimiento = $request->query->get('idProcedmiento');

            $file = $documento->getUrlDocumento();

            $fileName = md5(uniqid()).$documento->getNombre().'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('documentos_directory'),
                $fileName
            );

            $instrictivo = $documento->geturlInstructivo();

            $instrictivoName = md5(uniqid()).$documento->getNombre().'.'.$instrictivo->guessExtension();


            $instrictivo->move(
                $this->getParameter('documentos_directory'),
                $instrictivoName
            );

            $documento->seturlInstructivo($instrictivoName);
            $documento->seturlDocumento($fileName);

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
     * @Route("/delete/inicio/{id}", name="documento_delete_id_inicio")
     * @Method({"GET", "POST"})
     */
    public function deleteIdInicioAction(Request $request, Documento $documento)
    {
       
            $em = $this->getDoctrine()->getManager();
            $em->remove($documento);
            $em->flush($documento);
     
        return $this->redirectToRoute('documento_index');
    }

     /**
     * Deletes a documento entity.
     *
     * @Route("/delete/{id}", name="documento_delete_id")
     * @Method({"GET", "POST"})
     */
    public function deleteIdAction(Request $request, Documento $documento)
    {
       
            $em = $this->getDoctrine()->getManager();
            $em->remove($documento);
            $em->flush($documento);
     
        return $this->redirectToRoute('documento_index');
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

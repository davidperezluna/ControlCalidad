<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Archivo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Archivo controller.
 *
 * @Route("archivo")
 */
class ArchivoController extends Controller
{

     /**
      * Download file
      * @Route("/download/{id}", name="documento_archivo_download")
      * @Method("GET")
      */
     public function downloadDocumentAction($id)
     {
        $em = $this->getDoctrine()->getManager();
        $archivo = $em->getRepository('AppBundle:Archivo')->find($id);

        if ( ! $archivo) {
        throw $this->createNotFoundException('Unable to find Document
        entity.');
        }
        $path = $this->get('kernel')->getRootDir() .
        "/../web/uploads/documentos/" . $archivo->geturlDocumento();
        $content = file_get_contents($path);

        $response = new Response();

        $response->headers->set('Content-Type', "'". $archivo->getVersion() .
        "'");
        $response->headers->set('Content-Disposition',
        'attachment;filename="'.$archivo->geturlDocumento());

        $response->setContent($content);

             return $response;
     }

     /**
      * Download file
      * @Route("/pdf/download/{id}", name="documento_pdf_archivo_download")
      * @Method("GET")
      */
     public function downloadDocumentPdfAction($id)
     {

        $em = $this->getDoctrine()->getManager();
        $archivo = $em->getRepository('AppBundle:Archivo')->find($id);

        if ( ! $archivo) {
        throw $this->createNotFoundException('Unable to find Document
        entity.');
        }
        $path = $this->get('kernel')->getRootDir() .
        "/../web/uploads/documentos/" . $archivo->geturlDocumentoPdf();
        $content = file_get_contents($path);

        $response = new Response();

        $response->headers->set('Content-Type', "'". $archivo->getVersion() .
        "'");
        $response->headers->set('Content-Disposition',
        'attachment;filename="'.$archivo->geturlDocumentoPdf());

        $response->setContent($content);

             return $response;
     }
    /**
     * Lists all archivo entities.
     *
     * @Route("/", name="archivo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $archivos = $em->getRepository('AppBundle:Archivo')->findAll();

        return $this->render('AppBundle:archivo:index.html.twig', array(
            'archivos' => $archivos,
        ));
    }

    /**
     * Creates a new archivo entity.
     *
     * @Route("/new", name="archivo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $archivo = new Archivo();
        $form = $this->createForm('AppBundle\Form\ArchivoType', $archivo);
        $form->handleRequest($request);

        $preocesoId=$request->query->get('idProceso');
            if ($preocesoId != null) {
                $preoceso = $em->getRepository('AppBundle:Proceso')->find($preocesoId);
            }else{
                $preoceso = null;
            }

            $procedimientoId=$request->query->get('idProcedimiento');
            if ($procedimientoId != null) {
                $procedimiento = $em->getRepository('AppBundle:Procedimiento')->find($procedimientoId);
            }else{
                $procedimiento = null;
            }

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $archivo->getUrlDocumento();
            $filePdf = $archivo->getUrlDocumentoPdf();
            $fileName = md5(uniqid()).$archivo->getVersion().'.'.$file->guessExtension();
            $filePdfName = md5(uniqid()).$archivo->getVersion().'.'.$filePdf->guessExtension();
            $file->move(
                $this->getParameter('documentos_directory'),
                $fileName
            );
            $filePdf->move(
                $this->getParameter('documentos_directory'),
                $filePdfName
            );

            $preocesoId=$request->query->get('idProceso');
            // var_dump($preocesoId);
            // die();
            if ($preocesoId != null) {
                $preoceso = $em->getRepository('AppBundle:Proceso')->find($preocesoId);

                 $archivos = $em->getRepository('AppBundle:Archivo')->findBy(array('proceso' => $preoceso->getId()));

                foreach ($archivos as $archivoC ) {
                    $archivoC->setEstado(0);
                    $em->persist($archivoC);
                    $em->flush($archivoC);
                }
            }else{
                $preoceso = null;
            }

            $procedimientoId=$request->query->get('idProcedimiento');
            if ($procedimientoId != null) {
                $procedimiento = $em->getRepository('AppBundle:Procedimiento')->find($procedimientoId);

                $archivos = $em->getRepository('AppBundle:Archivo')->findBy(array('procedimiento' => $procedimiento->getId()));
                foreach ($archivos as $archivoP ) {
                $archivoP->setEstado(0);
                $em->persist($archivoP);
                $em->flush($archivoP);
                }
            }else{
                $procedimiento = null;
            }


           
            $archivo->setEstado(1);
            $archivo->seturlDocumentoPdf($filePdfName);
            $archivo->setProcedimiento($procedimiento);
            $archivo->setProceso($preoceso);
            $archivo->seturlDocumento($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($archivo);
            $em->flush($archivo);

            // $archivos = $em->getRepository('AppBundle:Archivo')->findBy(array('proceso' => $preoceso->getId()));


            if ($preoceso==null) {
                return $this->redirectToRoute('procedimiento_show', array('id' => $procedimiento->getId()));
            }else{
               return $this->redirectToRoute('proceso_show', array('id' => $preoceso->getId())); 
            }
           
        }

        return $this->render('AppBundle:archivo:new.html.twig', array(
            'proceso'=>$preoceso,
            'preocedimiento'=>$procedimiento,
            'archivo' => $archivo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a archivo entity.
     *
     * @Route("/{id}", name="archivo_show")
     * @Method("GET")
     */
    public function showAction(Archivo $archivo)
    {
        $deleteForm = $this->createDeleteForm($archivo);

        return $this->render('AppBundle:archivo:show.html.twig', array(
            'archivo' => $archivo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing archivo entity.
     *
     * @Route("/{id}/edit", name="archivo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Archivo $archivo)
    {
        $deleteForm = $this->createDeleteForm($archivo);
        $editForm = $this->createForm('AppBundle\Form\ArchivoType', $archivo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('archivo_edit', array('id' => $archivo->getId()));
        }

        return $this->render('AppBundle:archivo:edit.html.twig', array(
            'archivo' => $archivo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a archivo entity.
     *
     * @Route("/{id}", name="archivo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Archivo $archivo)
    {
        $form = $this->createDeleteForm($archivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($archivo);
            $em->flush($archivo);
        }

        return $this->redirectToRoute('archivo_index');
    }

    /**
     * Creates a form to delete a archivo entity.
     *
     * @param Archivo $archivo The archivo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Archivo $archivo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('archivo_delete', array('id' => $archivo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

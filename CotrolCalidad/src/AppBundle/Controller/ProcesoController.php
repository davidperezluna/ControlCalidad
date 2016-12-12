<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Proceso;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Proceso controller.
 *
 * @Route("proceso")
 */
class ProcesoController extends Controller
{

    /**
      * Download file
      * @Route("/download/{id}", name="documento_proceso_download")
      * @Method("GET")
      */
     public function downloadDocumentAction($id)
     {
        $em = $this->getDoctrine()->getManager();
        $proceso = $em->getRepository('AppBundle:Proceso')->find($id);

        if ( ! $proceso) {
        throw $this->createNotFoundException('Unable to find Document
        entity.');
        }
        $path = $this->get('kernel')->getRootDir() .
        "/../web/uploads/documentos/" . $proceso->geturlDocumento();
        $content = file_get_contents($path);

        $response = new Response();

        $response->headers->set('Content-Type', "'". $proceso->getNombre() .
        "'");
        $response->headers->set('Content-Disposition',
        'attachment;filename="'.$proceso->geturlDocumento());

        $response->setContent($content);

             return $response;
     }

     /**
      * Download file
      * @Route("/pdf/download/{id}", name="documento_pdf_proceso_download")
      * @Method("GET")
      */
     public function downloadDocumentPdfAction($id)
     {

        $em = $this->getDoctrine()->getManager();
        $proceso = $em->getRepository('AppBundle:Proceso')->find($id);

        if ( ! $proceso) {
        throw $this->createNotFoundException('Unable to find Document
        entity.');
        }
        $path = $this->get('kernel')->getRootDir() .
        "/../web/uploads/documentos/" . $proceso->geturlDocumentoPdf();
        $content = file_get_contents($path);

        $response = new Response();

        $response->headers->set('Content-Type', "'". $proceso->getNombre() .
        "'");
        $response->headers->set('Content-Disposition',
        'attachment;filename="'.$proceso->geturlDocumentoPdf());

        $response->setContent($content);

             return $response;
     }
    /**
     * Lists all proceso entities.
     *
     * @Route("/", name="proceso_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $procesos = $em->getRepository('AppBundle:Proceso')->findAll();

        return $this->render('AppBundle:proceso:index.html.twig', array(
            'procesos' => $procesos,
        ));
    }

    /**
     * Creates a new proceso entity.
     *
     * @Route("/new", name="proceso_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $proceso = new Proceso();
        $form = $this->createForm('AppBundle\Form\ProcesoType', $proceso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $idMacroProceso=$request->query->get('idMacroProceso');
            $macroProceso = $em->getRepository('AppBundle:MacroProceso')->find($idMacroProceso);
          

            $file = $proceso->getUrlDocumento();
            $filePdf = $proceso->getUrlDocumentoPdf();


            $fileName = md5(uniqid()).$proceso->getNombre().'.'.$file->guessExtension();
            $filePdfName = md5(uniqid()).$proceso->getNombre().'.'.$filePdf->guessExtension();

        

            $file->move(
                $this->getParameter('documentos_directory'),
                $fileName
            );

            $filePdf->move(
                $this->getParameter('documentos_directory'),
                $filePdfName
            );

            $proceso->setMacroProceso($macroProceso);
            $proceso->seturlDocumentoPdf($filePdfName);
            $proceso->seturlDocumento($fileName);
            
            $em->persist($proceso);
            $em->flush($proceso);

            return $this->redirectToRoute('dependencia_show', array('id' => $macroProceso->getDependencia()->getId()));
        }

        return $this->render('AppBundle:proceso:new.html.twig', array(
            'proceso' => $proceso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a proceso entity.
     *
     * @Route("/{id}", name="proceso_show")
     * @Method("GET")
     */
    public function showAction(Proceso $proceso)
    {
        $deleteForm = $this->createDeleteForm($proceso);

        return $this->render('AppBundle:proceso:show.html.twig', array(
            'proceso' => $proceso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing proceso entity.
     *
     * @Route("/{id}/edit", name="proceso_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Proceso $proceso)
    {
        $deleteForm = $this->createDeleteForm($proceso);
        $editForm = $this->createForm('AppBundle\Form\ProcesoType', $proceso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('proceso_edit', array('id' => $proceso->getId()));
        }

        return $this->render('AppBundle:proceso:edit.html.twig', array(
            'proceso' => $proceso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

   
    // public function deleteAction(Request $request, Proceso $proceso)
    // {
    //     $form = $this->createDeleteForm($proceso);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $em = $this->getDoctrine()->getManager();
    //         $em->remove($proceso);
    //         $em->flush($proceso);
    //     }

    //     return $this->redirectToRoute('proceso_index');
    // }

    /**
     * Deletes a proceso entity.
     *
     * @Route("delete/{id}", name="proceso_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Proceso $proceso)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($proceso);
            $em->flush($proceso);
            return $this->redirectToRoute('proceso_index');
    }


    /**
     * Creates a form to delete a proceso entity.
     *
     * @param Proceso $proceso The proceso entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Proceso $proceso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('proceso_delete', array('id' => $proceso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

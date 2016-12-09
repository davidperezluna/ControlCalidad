<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Procedimiento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Procedimiento controller.
 *
 * @Route("procedimiento")
 */
class ProcedimientoController extends Controller
{

     /**
      * Download file
      * @Route("/download/{id}", name="documento_procedimiento_download")
      * @Method("GET")
      */
     public function downloadDocumentAction($id)
     {
        $em = $this->getDoctrine()->getManager();
        $procedimiento = $em->getRepository('AppBundle:Procedimiento')->find($id);

        if ( ! $procedimiento) {
        throw $this->createNotFoundException('Unable to find Document
        entity.');
        }
        $path = $this->get('kernel')->getRootDir() .
        "/../web/uploads/documentos/" . $procedimiento->geturlDocumento();
        $content = file_get_contents($path);

        $response = new Response();

        $response->headers->set('Content-Type', "'". $procedimiento->getNombre() .
        "'");
        $response->headers->set('Content-Disposition',
        'attachment;filename="'.$procedimiento->geturlDocumento());

        $response->setContent($content);

             return $response;
     }

     /**
      * Download file
      * @Route("/pdf/download/{id}", name="documento_pdf_procedimiento_download")
      * @Method("GET")
      */
     public function downloadDocumentPdfAction($id)
     {

        $em = $this->getDoctrine()->getManager();
        $procedimiento = $em->getRepository('AppBundle:Procedimiento')->find($id);

        if ( ! $procedimiento) {
        throw $this->createNotFoundException('Unable to find Document
        entity.');
        }
        $path = $this->get('kernel')->getRootDir() .
        "/../web/uploads/documentos/" . $procedimiento->geturlDocumentoPdf();
        $content = file_get_contents($path);

        $response = new Response();

        $response->headers->set('Content-Type', "'". $procedimiento->getNombre() .
        "'");
        $response->headers->set('Content-Disposition',
        'attachment;filename="'.$procedimiento->geturlDocumentoPdf());

        $response->setContent($content);

             return $response;
     }
    /**
     * Lists all procedimiento entities.
     *
     * @Route("/", name="procedimiento_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $procedimientos = $em->getRepository('AppBundle:Procedimiento')->findAll();

        return $this->render('AppBundle:procedimiento:index.html.twig', array(
            'procedimientos' => $procedimientos,
        ));
    }

    /**
     * Creates a new procedimiento entity.
     *
     * @Route("/new", name="procedimiento_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $procedimiento = new Procedimiento();
        $form = $this->createForm('AppBundle\Form\ProcedimientoType', $procedimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $procedimiento->getUrlDocumento();
            $filePdf = $procedimiento->getUrlDocumentoPdf();


            $fileName = md5(uniqid()).$procedimiento->getNombre().'.'.$file->guessExtension();
            $filePdfName = md5(uniqid()).$procedimiento->getNombre().'.'.$filePdf->guessExtension();

        

            $file->move(
                $this->getParameter('documentos_directory'),
                $fileName
            );

            $filePdf->move(
                $this->getParameter('documentos_directory'),
                $filePdfName
            );

            $procedimiento->seturlDocumentoPdf($filePdfName);
            $procedimiento->seturlDocumento($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($procedimiento);
            $em->flush($procedimiento);

            return $this->redirectToRoute('procedimiento_show', array('id' => $procedimiento->getId()));
        }

        return $this->render('AppBundle:procedimiento:new.html.twig', array(
            'procedimiento' => $procedimiento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a procedimiento entity.
     *
     * @Route("/{id}", name="procedimiento_show")
     * @Method("GET")
     */
    public function showAction(Procedimiento $procedimiento)
    {
        $deleteForm = $this->createDeleteForm($procedimiento);

        return $this->render('AppBundle:procedimiento:show.html.twig', array(
            'procedimiento' => $procedimiento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing procedimiento entity.
     *
     * @Route("/{id}/edit", name="procedimiento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Procedimiento $procedimiento)
    {
        $deleteForm = $this->createDeleteForm($procedimiento);
        $editForm = $this->createForm('AppBundle\Form\ProcedimientoType', $procedimiento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('procedimiento_edit', array('id' => $procedimiento->getId()));
        }

        return $this->render('AppBundle:procedimiento:edit.html.twig', array(
            'procedimiento' => $procedimiento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a procedimiento entity.
     *
     * @Route("/{id}", name="procedimiento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Procedimiento $procedimiento)
    {
        $form = $this->createDeleteForm($procedimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($procedimiento);
            $em->flush($procedimiento);
        }

        return $this->redirectToRoute('procedimiento_index');
    }

    /**
     * Creates a form to delete a procedimiento entity.
     *
     * @param Procedimiento $procedimiento The procedimiento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Procedimiento $procedimiento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('procedimiento_delete', array('id' => $procedimiento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SeguimientoIndicador;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Seguimientoindicador controller.
 *
 * @Route("seguimientoindicador")
 */
class SeguimientoIndicadorController extends Controller
{
    /**
     * Lists all seguimientoIndicador entities.
     *
     * @Route("/", name="seguimientoindicador_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $seguimientoIndicadors = $em->getRepository('AppBundle:SeguimientoIndicador')->findAll();

        return $this->render('AppBundle:seguimientoindicador:index.html.twig', array(
            'seguimientoIndicadors' => $seguimientoIndicadors,
        ));
    }

    /**
     * Creates a new seguimientoIndicador entity.
     *
     * @Route("/new", name="seguimientoindicador_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        $seguimientoIndicador = new Seguimientoindicador();
        $form = $this->createForm('AppBundle\Form\SeguimientoIndicadorType', $seguimientoIndicador);
        $form->handleRequest($request);

        $indicador = $em->getRepository('AppBundle:Indicador')->find($request->query->get('idIndicador'));

        if ($form->isSubmitted() && $form->isValid()) {

            $indicador = $em->getRepository('AppBundle:Indicador')->find($request->query->get('idIndicador'));

            if ($indicador->getUnidadMedida()=="PORCENTAJE") {
               $numerador = $request->request->get('numerador');
               $denominador = $request->request->get('denominador');
                $resultado = ($numerador / $denominador)*100;
            }

             if ($indicador->getUnidadMedida()=="NUMERO") {
               $minuendo = $request->request->get('operador1');
               $sustraendo = $request->request->get('operador2');
                $resultado = $minuendo - $sustraendo;
            }

            if ($indicador->getUnidadMedida()=="NOVEDAD") {
               $resultado = $request->request->get('operador1');
            }


            if ($indicador->getUnidadMedida()=="INDICE") {
               $ope1 = $request->request->get('operador1');
               $ope2 = $request->request->get('operador2');
                $resultado = ($ope1 - $ope2)/$ope2;
            }

            if ($indicador->getUnidadMedida()=="DIAS") {
               $ope1 =  $request->request->get('fechaAprobacion');
               $ope2 =  $request->request->get('fechaInicio');

               $fechaAprobacion = new \DateTime($ope1);
               $fechaInicio = new \DateTime($ope2);

               $resultado = $fechaAprobacion->diff($fechaInicio)->days;
            }


             if ($indicador->getUnidadMedida()=="DIAS AMPLIADO") {
               $ope1 =  $request->request->get('fechaAprobacion');
               $ope2 =  $request->request->get('fechaSolicitud');

               $fechaAprobacion = new \DateTime($ope1);
               $fechaInicio = new \DateTime($ope2);

               $ope3 = $fechaAprobacion->diff($fechaInicio)->days;

               $resultado = $ope3 * $request->request->get('novedades');

            }

            $FechaSeguimiento = new \DateTime('now');



            if ($indicador->getPeriodicidad() == "MENSUAL") {

                $proxima = new \DateTime('now');
                $intervalo = new \DateInterval('P1M');
                $proximaFecha = $proxima->add($intervalo);
            }

            if ($indicador->getPeriodicidad() == "BIMENSUAL") {
                $proxima = new \DateTime('now');
                $intervalo = new \DateInterval('P2M');
                $proximaFecha = $proxima->add($intervalo);
            }
            if ($indicador->getPeriodicidad() == "TRIMESTRAL") {
                $proxima = new \DateTime('now');
                $intervalo = new \DateInterval('P3M');
                $proximaFecha = $proxima->add($intervalo);
            }
            if ($indicador->getPeriodicidad() == "SEMESTRAL") {
                $proxima = new \DateTime('now');
                $intervalo = new \DateInterval('P6M');
                $proximaFecha = $proxima->add($intervalo);
            }
            if ($indicador->getPeriodicidad() == "ANUAL") {
                $proxima = new \DateTime('now');
                $intervalo = new \DateInterval('P12M');
                $proximaFecha = $proxima->add($intervalo);
            }

            $seguimientoIndicador->setResultado($resultado);
            $seguimientoIndicador->setIndicador($indicador);


            $seguimientoIndicador->setFechaSeguimiento($FechaSeguimiento );
            $seguimientoIndicador->setProximaFecha($proximaFecha);
            $seguimientoIndicador->setNotificacion(true);


            $em = $this->getDoctrine()->getManager();
            $em->persist($seguimientoIndicador);
            $em->flush($seguimientoIndicador);

            return $this->redirectToRoute('indicador_show', array('id' => $indicador->getId()));
        }

        return $this->render('AppBundle:seguimientoindicador:new.html.twig', array(
            'indicador'=>$indicador,
            'seguimientoIndicador' => $seguimientoIndicador,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a seguimientoIndicador entity.
     *
     * @Route("/{id}", name="seguimientoindicador_show")
     * @Method("GET")
     */
    public function showAction(SeguimientoIndicador $seguimientoIndicador)
    {
        $deleteForm = $this->createDeleteForm($seguimientoIndicador);

        return $this->render('AppBundle:seguimientoindicador:show.html.twig', array(
            'seguimientoIndicador' => $seguimientoIndicador,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing seguimientoIndicador entity.
     *
     * @Route("/{id}/edit", name="seguimientoindicador_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SeguimientoIndicador $seguimientoIndicador)
    {
        $deleteForm = $this->createDeleteForm($seguimientoIndicador);
        $editForm = $this->createForm('AppBundle\Form\SeguimientoIndicadorType', $seguimientoIndicador);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seguimientoindicador_edit', array('id' => $seguimientoIndicador->getId()));
        }

        return $this->render('AppBundle:seguimientoindicador:edit.html.twig', array(
            'seguimientoIndicador' => $seguimientoIndicador,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a seguimientoIndicador entity.
     *
     * @Route("/{id}", name="seguimientoindicador_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SeguimientoIndicador $seguimientoIndicador)
    {
        $form = $this->createDeleteForm($seguimientoIndicador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($seguimientoIndicador);
            $em->flush($seguimientoIndicador);
        }

        return $this->redirectToRoute('seguimientoindicador_index');
    }

    /**
     * Creates a form to delete a seguimientoIndicador entity.
     *
     * @param SeguimientoIndicador $seguimientoIndicador The seguimientoIndicador entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SeguimientoIndicador $seguimientoIndicador)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seguimientoindicador_delete', array('id' => $seguimientoIndicador->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

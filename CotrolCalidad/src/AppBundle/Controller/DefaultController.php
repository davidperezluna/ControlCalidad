<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager(); 

        $user = $this->getUser();
          
        if (($user->getRole()!="ROLE_SUPER_ADMIN")) {
           return $this->redirectToRoute('dependencia_show', array('id' => $user->getDependencia()->getId()));
        }else{
            $empresas = $em->getRepository('AppBundle:Empresa')->findAll();
             return $this->render('AppBundle:default:default.html.twig', array(
                'empresas' => $empresas,
            ));
        }
        
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Victima;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Telefono;

/**
 * Victima controller.
 *
 * @Route("victima")
 */
class VictimaController extends Controller
{
    /**
     * Lists all victima entities.
     *
     * @Route("/", name="victima_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $victimas = $em->getRepository('AppBundle:Victima')->findAll();

        return $this->render('victima/index.html.twig', array(
            'victimas' => $victimas,
        ));
    }

    /**
     * Creates a new victima entity.
     *
     * @Route("/new", name="victima_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request){
        // $victima = new Victima();
        
        // /*$orignalExp = new ArrayCollection();
        // foreach ($victima->getTelefonos() as $exp) {
        //     $orignalExp->add($exp);
        // }*/
        // //var_dump($request);
        // $form = $this->createForm('AppBundle\Form\VictimaType', $victima);
        // //var_dump($victima);
        // //var_dump($request['parameters']['appbundle_victima']['telefonos']);
        // $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {
        //     $em = $this->getDoctrine()->getManager();
        //     $em->persist($victima);
        //     //$em->flush();

        //     return $this->redirectToRoute('victima_show', array('id' => $victima->getId()));
        // }

        // return $this->render('victima/new.html.twig', array(
        //     'victima' => $victima,
        //     'form' => $form->createView(),
        // ));

        $victima = new Victima();
        $form = $this->createForm('AppBundle\Form\VictimaType', $victima);
        echo "string---   ";
        
        $form->handleRequest($request);
        echo "string2---   ";
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($victima);
            $em->flush();
            return $this->redirectToRoute('victima_show', array('id' => $victima->getId()));
        }
        return $this->render('victima/new.html.twig', array(
            'victima' => $victima,
            'form' => $form->createView(),
        ));
        

//         $victima = new Victima();
//         $form = $this->createForm('AppBundle\Form\VictimaType', $victima);
//         echo "string---   ";
//         //var_dump($_POST);
// //        var_dump($request->request->get('appbundle_victima'));
//         $telefonos=($request->request->get('appbundle_victima'))['telefonos'];
//         var_dump($telefonos);
//         $form->handleRequest($request);
//         echo "string2---   ";
//         if ($form->isSubmitted() && $form->isValid()) {
//             $em = $this->getDoctrine()->getManager();
//             $em->persist($victima);
//             for ($i=0; $i < count($telefonos); $i++) { 
//                 $tmp= (new Telefono)->setNumero($telefonos[$i]);
//                 $em->persist($tmp);

//             }
//             $em->flush();
//             return $this->redirectToRoute('victima_show', array('id' => $victima->getId()));
//         }
//         return $this->render('victima/new.html.twig', array(
//             'victima' => $victima,
//             'form' => $form->createView(),
//         ));

        /*
                $em = $this->getDoctrine()->getManager();
        $victima = $em->getRepository('AppBundle:Victima')->findOneBy(['id' => 1]);
        $orignalExp = new ArrayCollection();
        foreach ($victima->getTelefonos() as $exp) {
            $orignalExp->addTelefono($exp);
        }
        
        //$victima = new Victima();
        $form = $this->createForm('AppBundle\Form\VictimaType', $victima);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($orignalExp as $exp) {
                // check if the exp is in the $user->getExp()
    //                dump($user->getExp()->contains($exp));
                if ($victima->getTelefonos()->contains($exp) === false) {
                    $em->remove($exp);
                }
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($victima);
            //$em->flush();
            return $this->redirectToRoute('victima_show', array('id' => $victima->getId()));
        }
        return $this->render('victima/new.html.twig', array(
            'victima' => $victima,
            'form' => $form->createView(),
        ));
        */
    }

    /**
     * Finds and displays a victima entity.
     *
     * @Route("/{id}", name="victima_show")
     * @Method("GET")
     */
    public function showAction(Victima $victima)
    {
        $deleteForm = $this->createDeleteForm($victima);

        return $this->render('victima/show.html.twig', array(
            'victima' => $victima,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing victima entity.
     *
     * @Route("/{id}/edit", name="victima_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Victima $victima)
    {
        $deleteForm = $this->createDeleteForm($victima);
        $editForm = $this->createForm('AppBundle\Form\VictimaType', $victima);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('victima_edit', array('id' => $victima->getId()));
        }

        return $this->render('victima/edit.html.twig', array(
            'victima' => $victima,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a victima entity.
     *
     * @Route("/{id}", name="victima_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Victima $victima)
    {
        $form = $this->createDeleteForm($victima);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($victima);
            $em->flush();
        }

        return $this->redirectToRoute('victima_index');
    }

    /**
     * Creates a form to delete a victima entity.
     *
     * @param Victima $victima The victima entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Victima $victima)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('victima_delete', array('id' => $victima->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

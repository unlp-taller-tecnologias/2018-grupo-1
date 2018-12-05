<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use AppBundle\Entity\Profesion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use FOS\UserBundle\Util\UserManipulator;

/**
 * Usuario controller.
 *
 * @Route("usuario")
 */
class UsuarioController extends Controller
{
    /**
     * Lists all usuario entities.
     *
     * @Route("/", name="usuario_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usuarios = $em->getRepository('AppBundle:Usuario')->findAll();

        return $this->render('usuario/index.html.twig', array(
            'usuarios' => $usuarios,
        ));
    }

    /**
     * Creates a new usuario entity.
     *
     * @Route("/new", name="usuario_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $usuario = new Usuario();
        $form = $this->createForm('AppBundle\Form\UsuarioType', $usuario);
        $form->add('valor',NumberType::class, array('label' => 'Cantidad de días','attr' => array('class' => 'form-control','min'=>'1', 'max'=>'90', 'required')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            return $this->redirectToRoute('usuario_show', array('id' => $usuario->getId()));
        }

        return $this->render('usuario/new.html.twig', array(
            'usuario' => $usuario,
            'form' => $form->createView(),
        ));
    }


    /**
     *
     * @Route("/changePass", name="usuario_change_pass")
     * @Method({"GET", "POST"})
     */
    public function changePassAction(Request $request)
    {
        $usuario=$this->getUser();
        $editForm = $this->createForm('AppBundle\Form\CambiarPassType', $usuario);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $userManager = $this->container->get('fos_user.user_manager');
            $userManager->updatePassword($usuario);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('notice', 'La contraseña ha sido cambiada');
            // return $this->redirectToRoute('usuario_change_pass', array('id' => $usuario->getId()));
        }
        return $this->render('usuario/changePass.html.twig', array(
            'usuario' => $usuario,
            'form' => $editForm->createView(),
        ));
    }


    /**
     * Finds and displays a usuario entity.
     *
     * @Route("/{id}", name="usuario_show")
     * @Method("GET")
     */
    public function showAction(Usuario $usuario)
    {
        $deleteForm = $this->createDeleteForm($usuario);

        return $this->render('usuario/show.html.twig', array(
            'usuario' => $usuario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing usuario entity.
     *
     * @Route("/{id}/edit", name="usuario_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Usuario $usuario)
    {
        $deleteForm = $this->createDeleteForm($usuario);
        $editForm = $this->createForm('AppBundle\Form\EditarType', $usuario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('notice', 'Los datos se cambiaron exitosamente');
            return $this->redirectToRoute('usuario_edit', array('id' => $usuario->getId()));
        }

        return $this->render('usuario/edit.html.twig', array(
            'usuario' => $usuario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a usuario entity.
     *
     * @Route("/{id}/delete", name="usuario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Usuario $usuario)
    {
            $em = $this->getDoctrine()->getManager();
            $userManager = $this->container->get('fos_user.user_manager');
            if($usuario->isEnabled()){
              $usuario->setEnabled(false);
              $this->addFlash('notice', 'El usuario '.$usuario->getNombre().' ha sido desactivado y no podrá iniciar sesión.');
            }else {
              $usuario->setEnabled(true);
              $this->addFlash('notice', 'El usuario '.$usuario->getNombre().' ha sido activado.');
            }
            $userManager->updateUser($usuario);
            $em->flush();
        return $this->redirectToRoute('usuario_index');
    }

    /**
     *
     * @Route("/{id}/reset", name="usuario_reset")
     * @Method({"GET", "POST"})
     */
    public function resetPassAction(Request $request, Usuario $usuario)
    {
        $editForm = $this->createForm('AppBundle\Form\ResetearType', $usuario);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $userManager = $this->container->get('fos_user.user_manager');
            $userManager->updatePassword($usuario);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('notice', 'La contraseña se restauró exitosamente');
            return $this->redirectToRoute('usuario_edit', array('id' => $usuario->getId()));
        }
        return $this->render('usuario/reset.html.twig', array(
            'usuario' => $usuario,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a usuario entity.
     *
     * @param Usuario $usuario The usuario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Usuario $usuario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usuario_delete', array('id' => $usuario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

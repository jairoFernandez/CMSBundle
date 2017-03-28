<?php

namespace Tucompu\CmsBundle\Controller;

use Tucompu\CmsBundle\Entity\SubMenu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Submenu controller.
 *
 * @Route("admin/submenu")
 */
class SubMenuController extends Controller
{
    /**
     * Lists all subMenu entities.
     *
     * @Route("/", name="submenu_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subMenus = $em->getRepository('CmsBundle:SubMenu')->findAll();

        return $this->render('CmsBundle:submenu:index.html.twig', array(
            'subMenus' => $subMenus,
        ));
    }

    /**
     * Creates a new subMenu entity.
     *
     * @Route("/new", name="submenu_new")
     * @Method({"GET", "POST"})
     * @Template("CmsBundle:submenu:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $subMenu = new Submenu();
        $form = $this->createForm('Tucompu\CmsBundle\Form\SubMenuType', $subMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subMenu);
            $em->flush($subMenu);

            return $this->redirectToRoute('submenu_show', array('id' => $subMenu->getId()));
        }

        return array(
            'subMenu' => $subMenu,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a subMenu entity.
     *
     * @Route("/{id}", name="submenu_show")
     * @Method("GET")
     */
    public function showAction(SubMenu $subMenu)
    {
        $deleteForm = $this->createDeleteForm($subMenu);

        return $this->render('CmsBundle:submenu:show.html.twig', array(
            'subMenu' => $subMenu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing subMenu entity.
     *
     * @Route("/{id}/edit", name="submenu_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SubMenu $subMenu)
    {
        $deleteForm = $this->createDeleteForm($subMenu);
        $editForm = $this->createForm('Tucompu\CmsBundle\Form\SubMenuType', $subMenu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('submenu_edit', array('id' => $subMenu->getId()));
        }

        return $this->render('CmsBundle:submenu:edit.html.twig', array(
            'subMenu' => $subMenu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a subMenu entity.
     *
     * @Route("/{id}", name="submenu_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SubMenu $subMenu)
    {
        $form = $this->createDeleteForm($subMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subMenu);
            $em->flush($subMenu);
        }

        return $this->redirectToRoute('submenu_index');
    }

    /**
     * Creates a form to delete a subMenu entity.
     *
     * @param SubMenu $subMenu The subMenu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SubMenu $subMenu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('submenu_delete', array('id' => $subMenu->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

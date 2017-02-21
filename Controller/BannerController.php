<?php

namespace Tucompu\CmsBundle\Controller;

use AppBundle\Entity\BannerImages;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Banner;
use AppBundle\Form\BannerType;

/**
 * Banner controller.
 *
 * @Route("/admin/banner")
 */
class BannerController extends Controller
{

    /**
     * Lists all Banner entities.
     *
     * @Route("/", name="admin_banner")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Banner')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Banner entity.
     *
     * @Route("/", name="admin_banner_create")
     * @Method("POST")
     * @Template("CmsBundle:Banner:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Banner();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Bien hecho!');
            return $this->redirect($this->generateUrl('admin_banner_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Banner entity.
     *
     * @param Banner $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Banner $entity)
    {
        $form = $this->createForm(new BannerType(), $entity, array(
            'action' => $this->generateUrl('admin_banner_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Banner entity.
     *
     * @Route("/new", name="admin_banner_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Banner();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Banner entity.
     *
     * @Route("/{id}", name="admin_banner_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Banner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Banner entity.');
        }

        $images = $em->getRepository(BannerImages::class)->findByBanner($id);

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'images'      => $images,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Banner entity.
     *
     * @Route("/{id}/edit", name="admin_banner_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Banner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Banner entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Banner entity.
    *
    * @param Banner $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Banner $entity)
    {
        $form = $this->createForm(new BannerType(), $entity, array(
            'action' => $this->generateUrl('admin_banner_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Banner entity.
     *
     * @Route("/{id}", name="admin_banner_update")
     * @Method("PUT")
     * @Template("CmsBundle:Banner:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Banner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Banner entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'notice',
                'Bien hecho!');
            return $this->redirect($this->generateUrl('admin_banner_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Banner entity.
     *
     * @Route("/{id}", name="admin_banner_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Banner')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Banner entity.');
            }

            try {
                $em->remove($entity);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Bien hecho!');
            } catch (\Doctrine\ORM\ORMException $e) {
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Ha habido un error, no se puede eliminar!');
                return $this->redirect($this->getRequest()->headers->get('referer'));
                //return $this->redirect($this->generateUrl('estudiante_show', array('id' => $entity->getId())));
            } catch (\Exception $e) {
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Ha habido un error, no se puede eliminar!');
                return $this->redirect($this->getRequest()->headers->get('referer'));
                //return $this->redirect($this->generateUrl('estudiante_show', array('id' => $entity->getId())));
            }
        }

        return $this->redirect($this->generateUrl('admin_banner'));
    }

    /**
     * Creates a form to delete a Banner entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_banner_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

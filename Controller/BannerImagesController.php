<?php

namespace Tucompu\CmsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tucompu\CmsBundle\Entity\BannerImages;
use Tucompu\CmsBundle\Form\BannerImagesType;

/**
 * BannerImages controller.
 *
 * @Route("/admin/bannerimages")
 */
class BannerImagesController extends Controller
{

    /**
     * Lists all BannerImages entities.
     *
     * @Route("/", name="admin_bannerimages")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository(BannerImages::class)->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new BannerImages entity.
     *
     * @Route("/", name="admin_bannerimages_create")
     * @Method("POST")
     * @Template("CmsBundle:BannerImages:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new BannerImages();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Bien hecho!');
            return $this->redirect($this->generateUrl('admin_banner_show', array('id' => $entity->getBanner()->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a BannerImages entity.
     *
     * @param BannerImages $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(BannerImages $entity)
    {
        $form = $this->createForm(new BannerImagesType(), $entity, array(
            'action' => $this->generateUrl('admin_bannerimages_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BannerImages entity.
     *
     * @Route("/new", name="admin_bannerimages_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new BannerImages();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a BannerImages entity.
     *
     * @Route("/{id}", name="admin_bannerimages_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(BannerImages::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BannerImages entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing BannerImages entity.
     *
     * @Route("/{id}/edit", name="admin_bannerimages_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(BannerImages::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BannerImages entity.');
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
    * Creates a form to edit a BannerImages entity.
    *
    * @param BannerImages $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BannerImages $entity)
    {
        $form = $this->createForm(new BannerImagesType(), $entity, array(
            'action' => $this->generateUrl('admin_bannerimages_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BannerImages entity.
     *
     * @Route("/{id}", name="admin_bannerimages_update")
     * @Method("PUT")
     * @Template("CmsBundle:BannerImages:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(BannerImages::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BannerImages entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Bien hecho!');
            return $this->redirect($this->generateUrl('admin_bannerimages_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a BannerImages entity.
     *
     * @Route("/{id}", name="admin_bannerimages_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository(BannerImages::class)->find($id);
            $banner = $entity->getBanner();
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BannerImages entity.');
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

        return $this->redirect($this->generateUrl('admin_banner_show', array('id' => $banner->getId())));
    }

    /**
     * Creates a form to delete a BannerImages entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_bannerimages_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

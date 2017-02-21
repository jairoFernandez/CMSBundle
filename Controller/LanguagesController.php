<?php

namespace Tucompu\CmsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tucompu\CmsBundle\Entity\Languages;
use Tucompu\CmsBundle\Form\LanguagesType;

/**
 * Languages controller.
 *
 * @Route("/admin/languages")
 */
class LanguagesController extends Controller
{

    /**
     * Lists all Languages entities.
     *
     * @Route("/", name="admin_languages")
     * @Method("GET")
     * @Template("CmsBundle:Languages:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository(Languages::class)->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Languages entity.
     *
     * @Route("/", name="admin_languages_create")
     * @Method("POST")
     * @Template("CmsBundle:Languages:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Languages();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Bien hecho!');
            return $this->redirect($this->generateUrl('admin_languages_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Languages entity.
     *
     * @param Languages $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Languages $entity)
    {
        $form = $this->createForm(new LanguagesType(), $entity, array(
            'action' => $this->generateUrl('admin_languages_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Languages entity.
     *
     * @Route("/new", name="admin_languages_new")
     * @Method("GET")
     * @Template("CmsBundle:Languages:new.html.twig")
     */
    public function newAction()
    {
        $entity = new Languages();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Languages entity.
     *
     * @Route("/{id}", name="admin_languages_show")
     * @Method("GET")
     * @Template("CmsBundle:Languages:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Languages::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Languages entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Languages entity.
     *
     * @Route("/{id}/edit", name="admin_languages_edit")
     * @Method("GET")
     * @Template("CmsBundle:Languages:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Languages::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Languages entity.');
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
    * Creates a form to edit a Languages entity.
    *
    * @param Languages $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Languages $entity)
    {
        $form = $this->createForm(new LanguagesType(), $entity, array(
            'action' => $this->generateUrl('admin_languages_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

       // $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Languages entity.
     *
     * @Route("/{id}", name="admin_languages_update")
     * @Method("PUT")
     * @Template("CmsBundle:Languages:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Languages::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Languages entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Bien hecho!');
            return $this->redirect($this->generateUrl('admin_languages_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Languages entity.
     *
     * @Route("/{id}", name="admin_languages_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository(Languages::class)->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Languages entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Bien hecho!');
        }

        return $this->redirect($this->generateUrl('admin_languages'));
    }

    /**
     * Creates a form to delete a Languages entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_languages_delete', array('id' => $id)))
            ->setMethod('DELETE')
           // ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

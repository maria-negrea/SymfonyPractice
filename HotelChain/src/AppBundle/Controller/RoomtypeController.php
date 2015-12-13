<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Roomtype;
use AppBundle\Form\RoomtypeType;

/**
 * Roomtype controller.
 *
 * @Route("/roomtype")
 */
class RoomtypeController extends Controller
{

    /**
     * Lists all Roomtype entities.
     *
     * @Route("/", name="roomtype")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Roomtype')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Roomtype entity.
     *
     * @Route("/", name="roomtype_create")
     * @Method("POST")
     * @Template("AppBundle:Roomtype:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Roomtype();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('roomtype_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Roomtype entity.
     *
     * @param Roomtype $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Roomtype $entity)
    {
        $form = $this->createForm(new RoomtypeType(), $entity, array(
            'action' => $this->generateUrl('roomtype_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Roomtype entity.
     *
     * @Route("/new", name="roomtype_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Roomtype();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Roomtype entity.
     *
     * @Route("/{id}", name="roomtype_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Roomtype')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roomtype entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Roomtype entity.
     *
     * @Route("/{id}/edit", name="roomtype_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Roomtype')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roomtype entity.');
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
    * Creates a form to edit a Roomtype entity.
    *
    * @param Roomtype $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Roomtype $entity)
    {
        $form = $this->createForm(new RoomtypeType(), $entity, array(
            'action' => $this->generateUrl('roomtype_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Roomtype entity.
     *
     * @Route("/{id}", name="roomtype_update")
     * @Method("PUT")
     * @Template("AppBundle:Roomtype:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Roomtype')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roomtype entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('roomtype_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Roomtype entity.
     *
     * @Route("/{id}", name="roomtype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Roomtype')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Roomtype entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('roomtype'));
    }

    /**
     * Creates a form to delete a Roomtype entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('roomtype_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\ReservationStatus;
use AppBundle\Form\ReservationStatusType;

/**
 * ReservationStatus controller.
 *
 * @Route("/reservationstatus")
 */
class ReservationStatusController extends Controller
{

    /**
     * Lists all ReservationStatus entities.
     *
     * @Route("/", name="reservationstatus")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:ReservationStatus')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ReservationStatus entity.
     *
     * @Route("/", name="reservationstatus_create")
     * @Method("POST")
     * @Template("AppBundle:ReservationStatus:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ReservationStatus();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('reservationstatus_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a ReservationStatus entity.
     *
     * @param ReservationStatus $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ReservationStatus $entity)
    {
        $form = $this->createForm(new ReservationStatusType(), $entity, array(
            'action' => $this->generateUrl('reservationstatus_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ReservationStatus entity.
     *
     * @Route("/new", name="reservationstatus_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ReservationStatus();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ReservationStatus entity.
     *
     * @Route("/{id}", name="reservationstatus_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:ReservationStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ReservationStatus entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ReservationStatus entity.
     *
     * @Route("/{id}/edit", name="reservationstatus_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:ReservationStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ReservationStatus entity.');
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
    * Creates a form to edit a ReservationStatus entity.
    *
    * @param ReservationStatus $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ReservationStatus $entity)
    {
        $form = $this->createForm(new ReservationStatusType(), $entity, array(
            'action' => $this->generateUrl('reservationstatus_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ReservationStatus entity.
     *
     * @Route("/{id}", name="reservationstatus_update")
     * @Method("PUT")
     * @Template("AppBundle:ReservationStatus:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:ReservationStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ReservationStatus entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('reservationstatus_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ReservationStatus entity.
     *
     * @Route("/{id}", name="reservationstatus_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:ReservationStatus')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ReservationStatus entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('reservationstatus'));
    }

    /**
     * Creates a form to delete a ReservationStatus entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservationstatus_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

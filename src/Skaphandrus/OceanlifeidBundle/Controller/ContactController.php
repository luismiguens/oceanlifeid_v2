<?php

namespace Skaphandrus\OceanlifeidBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\OceanlifeidBundle\Entity\Contact;
use Skaphandrus\OceanlifeidBundle\Form\ContactType;

/**
 * Contact controller.
 *
 */
class ContactController extends Controller {

    /**
     * Lists all Contact entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusOceanlifeidBundle:Contact')->findAll();

        return $this->render('SkaphandrusOceanlifeidBundle:Contact:index.html.twig', array(
                    'entities' => $entities,
                ));
    }

    /**
     * Creates a new Contact entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Contact();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();


            $message = \Swift_Message::newInstance()
                    ->setSubject('contact')
                    ->setFrom($entity->getEmail())
                    ->setTo('contact@oceanlifeid.com')
                    ->setBody($entity->getName() . ' said: ' . $entity->getMessage());

            $this->get('mailer')->send($message);

            $this->get('session')->getFlashBag()->add('success', 'true');

            
            $url = $this->generateUrl("homepage");
            
            
//            return $this->render('SkaphandrusOceanlifeidBundle:Default:index.html.twig', array(
//                        'entity' => $entity,
//                        'form' => $form->createView(),
//                    ));

            return $this->redirect($this->generateUrl($url.'#contact', array(
                        'entity' => $entity,
                        'form' => $form->createView())));
        }

//        return $this->render('SkaphandrusOceanlifeidBundle:Default:index.html.twig', array(
//                    'entity' => $entity,
//                    'form' => $form->createView(),
//                ));

//        return $this->render('SkaphandrusOceanlifeidBundle:Contact:new.html.twig', array(
//                    'entity' => $entity,
//                    'form' => $form->createView(),
//                ));
    }

    /**
     * Creates a form to create a Contact entity.
     *
     * @param Contact $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Contact $entity) {
        $form = $this->createForm(new ContactType(), $entity, array(
            'action' => $this->generateUrl('contact_create'),
            'method' => 'POST',
                ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Contact entity.
     *
     */
//    public function newAction() {
//        $entity = new Contact();
//        $form = $this->createCreateForm($entity);
//
//        return $this->render('SkaphandrusOceanlifeidBundle:Contact:new.html.twig', array(
//                    'entity' => $entity,
//                    'form' => $form->createView(),
//                ));
//    }

    /**
     * Finds and displays a Contact entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusOceanlifeidBundle:Contact')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusOceanlifeidBundle:Contact:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing Contact entity.
     *
     */
//    public function editAction($id) {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SkaphandrusOceanlifeidBundle:Contact')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Contact entity.');
//        }
//
//        $editForm = $this->createEditForm($entity);
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('SkaphandrusOceanlifeidBundle:Contact:edit.html.twig', array(
//                    'entity' => $entity,
//                    'edit_form' => $editForm->createView(),
//                    'delete_form' => $deleteForm->createView(),
//                ));
//    }

    /**
     * Creates a form to edit a Contact entity.
     *
     * @param Contact $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
//    private function createEditForm(Contact $entity) {
//        $form = $this->createForm(new ContactType(), $entity, array(
//            'action' => $this->generateUrl('contact_update', array('id' => $entity->getId())),
//            'method' => 'PUT',
//                ));
//
//        $form->add('submit', 'submit', array('label' => 'Update'));
//
//        return $form;
//    }

    /**
     * Edits an existing Contact entity.
     *
     */
//    public function updateAction(Request $request, $id) {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SkaphandrusOceanlifeidBundle:Contact')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Contact entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//        $editForm = $this->createEditForm($entity);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isValid()) {
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('contact_edit', array('id' => $id)));
//        }
//
//        return $this->render('SkaphandrusOceanlifeidBundle:Contact:edit.html.twig', array(
//                    'entity' => $entity,
//                    'edit_form' => $editForm->createView(),
//                    'delete_form' => $deleteForm->createView(),
//                ));
//    }

    /**
     * Deletes a Contact entity.
     *
     */
//    public function deleteAction(Request $request, $id) {
//        $form = $this->createDeleteForm($id);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $entity = $em->getRepository('SkaphandrusOceanlifeidBundle:Contact')->find($id);
//
//            if (!$entity) {
//                throw $this->createNotFoundException('Unable to find Contact entity.');
//            }
//
//            $em->remove($entity);
//            $em->flush();
//        }
//
//        return $this->redirect($this->generateUrl('contact'));
//    }

    /**
     * Creates a form to delete a Contact entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
//    private function createDeleteForm($id) {
//        return $this->createFormBuilder()
//                        ->setAction($this->generateUrl('contact_delete', array('id' => $id)))
//                        ->setMethod('DELETE')
//                        ->add('submit', 'submit', array('label' => 'Delete'))
//                        ->getForm()
//        ;
//    }
}

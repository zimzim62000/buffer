<?php

namespace ZIMZIM\Bundles\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ZIMZIM\Controller\ZimzimController;

use ZIMZIM\Bundles\AppBundle\Entity\UserTournament;
use ZIMZIM\Bundles\AppBundle\Form\UserTournamentType;

/**
 * UserTournament controller.
 *
 */
class UserTournamentController extends ZimzimController
{
    /**
     * Lists all UserTournament entities.
     *
     */
    public function indexAction()
    {
        $data = array(
            'entity' => 'ZIMZIMBundlesAppBundle:UserTournament',
            'show' => 'zimzim_bundles_app_usertournament_show',
            'edit' => 'zimzim_bundles_app_usertournament_edit'
        );

        $this->gridList($data);


        return $this->grid->getGridResponse('ZIMZIMBundlesAppBundle:UserTournament:index.html.twig');
    }


    /**
     * Creates a new UserTournament entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new UserTournament();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                $this->generateUrl('zimzim_bundles_app_usertournament_show', array('id' => $entity->getId()))
            );
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:UserTournament:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to create a UserTournament entity.
     *
     * @param UserTournament $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserTournament $entity)
    {
        $form = $this->createForm(
            new UserTournamentType(),
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_bundles_app_usertournament_create'),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserTournament entity.
     *
     */
    public function newAction()
    {
        $entity = new UserTournament();
        $form = $this->createCreateForm($entity);

        return $this->render(
            'ZIMZIMBundlesAppBundle:UserTournament:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a UserTournament entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:UserTournament')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserTournament entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMBundlesAppBundle:UserTournament:show.html.twig',
            array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing UserTournament entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:UserTournament')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserTournament entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMBundlesAppBundle:UserTournament:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Creates a form to edit a UserTournament entity.
     *
     * @param UserTournament $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(UserTournament $entity)
    {
        $form = $this->createForm(
            new UserTournamentType(),
            $entity,
            array(
                'action' => $this->generateUrl(
                        'zimzim_bundles_app_usertournament_update',
                        array('id' => $entity->getId())
                    ),
                'method' => 'PUT',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }

    /**
     * Edits an existing UserTournament entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:UserTournament')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserTournament entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $this->updateSuccess();
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_bundles_app_usertournament_edit', array('id' => $id)));
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:UserTournament:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Deletes a UserTournament entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZIMZIMBundlesAppBundle:UserTournament')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserTournament entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_bundles_app_usertournament'));
    }

    /**
     * Creates a form to delete a UserTournament entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_bundles_app_usertournament_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm();
    }


    /**
     * Finds and displays a UserTournament entity.
     *
     */
    public function gameAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:UserTournament')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserTournament entity.');
        }


        return $this->render(
            'ZIMZIMBundlesAppBundle:UserTournament:show.html.twig',
            array(
                'entity' => $entity,
            )
        );
    }


}

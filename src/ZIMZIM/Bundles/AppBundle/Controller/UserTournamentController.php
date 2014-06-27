<?php

namespace ZIMZIM\Bundles\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use ZIMZIM\Bundles\AppBundle\ZIMZIMAppEvents;
use ZIMZIM\Controller\ZimzimController;
use ZIMZIM\Bundles\AppBundle\Entity\UserTournament;


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
        $em = $this->getDoctrine()->getManager();

        $security = $this->container->get('security.context');
        $user = $security->getToken()->getUser();

        $entities = $em->getRepository('ZIMZIMBundlesAppBundle:UserTournament')->findBy(
            array('user' => $user)
        );

        $tournaments = $em->getRepository('ZIMZIMBundlesAppBundle:Tournament')->getListTournamentActive(
            new \DateTime('now')
        );

        return $this->render(
            'ZIMZIMBundlesAppBundle:UserTournament:index.html.twig',
            array('entities' => $entities, 'Tournaments' => $tournaments)
        );
    }


    /**
     * Lists all UserTournament entities.
     *
     */
    public function listAction()
    {
        $data = array(
            'entity' => 'ZIMZIMBundlesAppBundle:UserTournament',
            'show' => 'zimzim_bundles_app_adminusertournament_show',
            'edit' => 'zimzim_bundles_app_adminusertournament_edit'
        );

        $this->gridList($data);


        return $this->grid->getGridResponse('ZIMZIMBundlesAppBundle:UserTournament:list.html.twig');
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
                $this->generateUrl('zimzim_bundles_app_adminusertournament_show', array('id' => $entity->getId()))
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
            'zimzim_bundles_appbundle_usertournamenttype',
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_bundles_app_adminusertournament_create'),
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
            'zimzim_bundles_appbundle_usertournamenttype',
            $entity,
            array(
                'action' => $this->generateUrl(
                        'zimzim_bundles_app_adminusertournament_update',
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

            return $this->redirect(
                $this->generateUrl('zimzim_bundles_app_adminusertournament_edit', array('id' => $id))
            );
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

        return $this->redirect($this->generateUrl('zimzim_bundles_app_adminusertournament'));
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
            ->setAction($this->generateUrl('zimzim_bundles_app_adminusertournament_delete', array('id' => $id)))
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

    /**
     * Displays a form to create a new UserTournament entity.
     *
     */
    public function newUserAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $Tournament = $em->getRepository('ZIMZIMBundlesAppBundle:Tournament')->find($id);

        if (!$Tournament) {
            throw $this->createNotFoundException('Unable to find Tournament entity.');
        }

        $user = $this->container->get('security.context')->getToken()->getUser();

        $userTournament = new UserTournament();
        $userTournament->setUser($user);
        $userTournament->setTournament($Tournament);
        $userTournament->setEnabled(true);

        $form = $this->createUserForm($userTournament);

        if ($request->getMethod() === 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {

                $this->createSuccess();

                $em->persist($userTournament);
                $em->flush();

                /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
                $dispatcher = $this->container->get('event_dispatcher');
                $Event = $this->container->get('zimzim_bundles_app.event.usertournamentevent');
                $Event->setUserTournament($userTournament);
                $dispatcher->dispatch(ZIMZIMAppEvents::CREATE_USERTOURNAMENT, $Event);

                return $this->redirect(
                    $this->generateUrl(
                        'zimzim_bundles_app_usertournament_showuser',
                        array('id' => $userTournament->getId())
                    )
                );
            }
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:UserTournament:newuser.html.twig',
            array(
                'new' => true,
                'Tournament' => $Tournament,
                'entity' => $userTournament,
                'form' => $form->createView(),
            )
        );
    }


    /**
     * Displays a form to create a new UserTournament entity.
     *
     */
    public function updateUserAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $UserTournament = $em->getRepository('ZIMZIMBundlesAppBundle:UserTournament')->find($id);

        if (!$UserTournament) {
            throw $this->createNotFoundException('Unable to find UserTournament entity.');
        }

        $security = $this->container->get('security.context');

        if (false === $security->isGranted('accessadmin', $UserTournament)) {
            throw new AccessDeniedHttpException('User Tournament is not your\'s');
        }

        $form = $this->createUserUpdateForm($UserTournament);

        if ($request->getMethod() === 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {

                $this->updateSuccess();

                $em->flush();

                return $this->redirect(
                    $this->generateUrl(
                        'zimzim_bundles_app_usertournament_showuser',
                        array('id' => $UserTournament->getId())
                    )
                );
            }
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:UserTournament:newuser.html.twig',
            array(
                'new' => false,
                'Tournament' => $UserTournament->getTournament(),
                'entity' => $UserTournament,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to create a UserTournament entity by user
     *
     * @param UserTournament $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createUserForm(UserTournament $entity)
    {
        $form = $this->createForm(
            'zimzim_bundles_appbundle_usertournamenttype',
            $entity,
            array(
                'action' => $this->generateUrl(
                        'zimzim_bundles_app_usertournament_newuser',
                        array('id' => $entity->getTournament()->getId())
                    ),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Creates a form to create a UserTournament entity by user
     *
     * @param UserTournament $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createUserUpdateForm(UserTournament $entity)
    {
        $form = $this->createForm(
            'zimzim_bundles_appbundle_usertournamenttype',
            $entity,
            array(
                'action' => $this->generateUrl(
                        'zimzim_bundles_app_usertournament_updateuser',
                        array('id' => $entity->getId())
                    ),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }

    /**
     * Finds and displays a UserTournament entity.
     *
     */
    public function showUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:UserTournament')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserTournament entity.');
        }

        $security = $this->container->get('security.context');

        if (false === $security->isGranted('accessadmin', $entity)) {
            throw new AccessDeniedHttpException('User Tournament is not your\'s');
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:UserTournament:showuser.html.twig',
            array(
                'entity' => $entity,
            )
        );
    }

}

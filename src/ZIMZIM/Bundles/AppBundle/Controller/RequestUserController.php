<?php

namespace ZIMZIM\Bundles\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use ZIMZIM\Controller\ZimzimController;

use ZIMZIM\Bundles\AppBundle\Entity\RequestUser;
use ZIMZIM\Bundles\AppBundle\Form\RequestUserType;

/**
 * RequestUser controller.
 *
 */
class RequestUserController extends ZimzimController
{
    /**
     * Lists all UserTournament entities.
     *
     */
    public function indexAction()
    {
        $em = $this->container->get('doctrine')->getManager();

        $security = $this->container->get('security.context');

        $user = $security->getToken()->getUser();

        $entities = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUser')->findBy(
            array(
                'user' => $user
            )
        );

        return $this->render(
            'ZIMZIMBundlesAppBundle:RequestUser:index.html.twig',
            array(
                'entities' => $entities
            )
        );
    }


    /**
     * Lists all RequestUser entities.
     *
     */
    public function listAction()
    {
        $data = array(
            'entity' => 'ZIMZIMBundlesAppBundle:RequestUser',
            'show' => 'zimzim_bundles_app_adminrequestuser_show',
            'edit' => 'zimzim_bundles_app_adminrequestuser_edit'
        );

        $this->gridList($data);


        return $this->grid->getGridResponse('ZIMZIMBundlesAppBundle:RequestUser:list.html.twig');
    }

    /**
     * Creates a new RequestUser entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new RequestUser();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                $this->generateUrl('zimzim_bundles_app_adminrequestuser_show', array('id' => $entity->getId()))
            );
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:RequestUser:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to create a RequestUser entity.
     *
     * @param RequestUser $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(RequestUser $entity)
    {
        $form = $this->createForm(
            'zimzim_bundles_appbundle_requestusertype',
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_bundles_app_adminrequestuser_create'),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new RequestUser entity.
     *
     */
    public function newAction()
    {
        $entity = new RequestUser();
        $form = $this->createCreateForm($entity);

        return $this->render(
            'ZIMZIMBundlesAppBundle:RequestUser:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a RequestUser entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RequestUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMBundlesAppBundle:RequestUser:show.html.twig',
            array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing RequestUser entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RequestUser entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMBundlesAppBundle:RequestUser:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Creates a form to edit a RequestUser entity.
     *
     * @param RequestUser $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(RequestUser $entity)
    {
        $form = $this->createForm(
            'zimzim_bundles_appbundle_requestusertype',
            $entity,
            array(
                'action' => $this->generateUrl(
                        'zimzim_bundles_app_adminrequestuser_update',
                        array('id' => $entity->getId())
                    ),
                'method' => 'PUT',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }

    /**
     * Edits an existing RequestUser entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RequestUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $this->updateSuccess();
            $em->flush();

            $security = $this->container->get('security.context');
            $link = 'zimzim_bundles_app_requestuser_edit';
            if ($security->isGranted('ROLE_ADMIN')) {
                $link = 'zimzim_bundles_app_adminrequestuser_edit';
            }

            return $this->redirect($this->generateUrl($link, array('id' => $id)));
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:RequestUser:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Deletes a RequestUser entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUser')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find RequestUser entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }
        $security = $this->container->get('security.context');
        $link = 'zimzim_bundles_app_requestuser';
        if ($security->isGranted('ROLE_ADMIN')) {
            $link = 'zimzim_bundles_app_adminrequestuser';
        }

        return $this->redirect($this->generateUrl($link));
    }

    /**
     * Creates a form to delete a RequestUser entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_bundles_app_requestuser_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm();
    }

    /**
     * Join UserTournament
     */
    public function joinAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $context = $this->container->get('security.context');
        $user = $context->getToken()->getUser();

        $userTournament = $em->getRepository('ZIMZIMBundlesAppBundle:UserTournament')->find($id);

        if (!$userTournament) {
            throw $this->createNotFoundException('Unable to find RequestUser entity.');
        }

        $requestUser = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUser')->findOneBy(
            array(
                'user' => $user,
                'userTournament' => $userTournament
            )
        );

        if ($requestUser) {
            $this->displayErorException('views.bundles.app.requestuser.join.errorjoin');

            return $this->redirect(
                $this->generateUrl('zimzim_bundles_app_home')
            );
        }

        if ($context->isGranted('ROLE_USER')) {
            $requestUser = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUser')->findOneBy(
                array(
                    'email' => $user->getEmail(),
                    'userTournament' => $userTournament
                )
            );
        }

        if ($requestUser) {

            $requestUser->setUser($user);
            $em->flush();
            $this->displayMessage('views.bundles.app.requestuser.join.successjoin');

            return $this->redirect(
                $this->generateUrl('zimzim_bundles_app_home')
            );
        }


        $requestUser = new RequestUser();
        $requestUser->setUserTournament($userTournament);

        if ($context->isGranted('ROLE_USER')) {
            $requestUser->setUser($user);
        }

        $form = $this->createJoinForm($requestUser);

        if ($request->getMethod() === 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {

                $requestUser->setEnabled(true);
                $requestUser->setValidate(false);
                $em->persist($requestUser);
                $em->flush();

                $this->displayMessage('views.bundles.app.requestuser.join.successjoinwait');

                return $this->redirect(
                    $this->generateUrl('zimzim_bundles_app_home')
                );

            }
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:RequestUser:join.html.twig',
            array(
                'entity' => $requestUser,
                'form' => $form->createView(),
                'userTournament' => $userTournament
            )
        );
    }

    /**
     * Creates a form to create a RequestUser entity.
     *
     * @param RequestUser $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createJoinForm(RequestUser $entity)
    {
        $form = $this->createForm(
            'zimzim_bundles_appbundle_requestusertype',
            $entity,
            array(
                'action' => $this->generateUrl(
                        'zimzim_bundles_app_requestuser_join',
                        array('id' => $entity->getUserTournament()->getId())
                    ),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.join'));

        return $form;
    }


    public function enabledValidateAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $security = $this->container->get('security.context');

        $requestUser = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUser')->find($id);

        if (!$requestUser) {
            throw $this->createNotFoundException('Unable to find RequestUser entity.');
        }

        if (false === $security->isGranted('access',  $requestUser->getUserTournament())){
            throw new AccessDeniedHttpException('User Tournament is not your\'s');
        }

        $form = $this->createUserUpdateForm($requestUser);

        if($request->getMethod() === 'POST'){

            $form->handleRequest($request);

            if($form->isValid()){



                $this->updateSuccess();
                $em->flush();

                $this->redirect($this->generateUrl('zimzim_bundles_app_requestuser'));
            }
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:RequestUser:update.html.twig',
            array(
                'entity' => $requestUser,
                'form' => $form->createView(),
                'userTournament' => $requestUser->getUserTournament()
            )
        );
    }

    /**
     * Creates a form to create a RequestUser entity.
     *
     * @param RequestUser $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createUserUpdateForm(RequestUser $entity)
    {
        $form = $this->createForm(
            'zimzim_bundles_appbundle_requestuserupdateusertype',
            $entity,
            array(
                'action' => $this->generateUrl(
                        'zimzimz_bundles_app_requestuser_enabledvalidate',
                        array('id' => $entity->getId())
                    ),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }
}

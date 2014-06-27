<?php

namespace ZIMZIM\Bundles\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ZIMZIM\Bundles\AppBundle\ZIMZIMAppEvents;
use ZIMZIM\Controller\ZimzimController;

use ZIMZIM\Bundles\AppBundle\Entity\RequestUserBet;
use ZIMZIM\Bundles\AppBundle\Form\RequestUserBetType;

/**
 * RequestUserBet controller.
 *
 */
class RequestUserBetController extends ZimzimController
{

    /**
     * Lists all RequestUserBet entities.
     *
     */
    public function indexAction()
    {
        $data = array(
            'entity' => 'ZIMZIMBundlesAppBundle:RequestUserBet',
            'show' => 'zimzim_bundles_app_adminrequestuserbet_show',
            'edit' => 'zimzim_bundles_app_adminrequestuserbet_edit'
        );

        $this->gridList($data);


        return $this->grid->getGridResponse('ZIMZIMBundlesAppBundle:RequestUserBet:index.html.twig');
    }

    /**
     * Creates a new RequestUserBet entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new RequestUserBet();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                $this->generateUrl('zimzim_bundles_app_adminrequestuserbet_show', array('id' => $entity->getId()))
            );
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:RequestUserBet:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to create a RequestUserBet entity.
     *
     * @param RequestUserBet $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(RequestUserBet $entity)
    {
        $form = $this->createForm(
            new RequestUserBetType(),
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_bundles_app_adminrequestuserbet_create'),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new RequestUserBet entity.
     *
     */
    public function newAction()
    {
        $entity = new RequestUserBet();
        $form = $this->createCreateForm($entity);

        return $this->render(
            'ZIMZIMBundlesAppBundle:RequestUserBet:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a RequestUserBet entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUserBet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RequestUserBet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMBundlesAppBundle:RequestUserBet:show.html.twig',
            array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing RequestUserBet entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUserBet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RequestUserBet entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMBundlesAppBundle:RequestUserBet:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Creates a form to edit a RequestUserBet entity.
     *
     * @param RequestUserBet $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(RequestUserBet $entity)
    {
        $form = $this->createForm(
            new RequestUserBetType(),
            $entity,
            array(
                'action' => $this->generateUrl(
                        'zimzim_bundles_app_adminrequestuserbet_update',
                        array('id' => $entity->getId())
                    ),
                'method' => 'PUT',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }

    /**
     * Edits an existing RequestUserBet entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUserBet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RequestUserBet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $this->updateSuccess();
            $em->flush();

            return $this->redirect(
                $this->generateUrl('zimzim_bundles_app_adminrequestuserbet_edit', array('id' => $id))
            );
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:RequestUserBet:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Deletes a RequestUserBet entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUserBet')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find RequestUserBet entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_bundles_app_adminrequestuserbet'));
    }

    /**
     * Creates a form to delete a RequestUserBet entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_bundles_app_adminrequestuserbet_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm();
    }


    public function betAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $security = $this->container->get('security.context');

        $game = $em->getRepository('ZIMZIMBundlesAppBundle:Game')->find($id);

        if (!$game) {
            throw $this->createNotFoundException('Unable to find Game entity.');
        }

        if ($game->getDate() <= new \DateTime('now')) {
            $this->displayErorException('flashbag.bundles.app.requestuserbet.notime');

            return $this->redirect($this->generateUrl('zimzim_bundles_app_game_show', array('id' => $id)));
        }

        $userTournaments = $em->getRepository('ZIMZIMBundlesAppBundle:UserTournament')->findByUserAndTournament(
            $security,
            $game->getTournament()
        );

        $error = false;

        if (!count($userTournaments)) {
            $this->displayErorException('flashbag.errors.noaccess');
            $error = true;
        }

        foreach ($userTournaments as $userTournament) {

            if (false === $security->isGranted('access', $userTournament)) {
                $this->displayErorException('flashbag.errors.noaccess');
                $error = true;
            }
        }

        if ($error) {
            return $this->redirect($this->generateUrl('zimzim_bundles_app_home'));
        }


        $requestsUserBet = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUserBet')->findByGameandUser(
            $game,
            $security->getToken()->getUser()
        );

        if (count($requestsUserBet)) {
            $requestUserBet = $requestsUserBet[0];
        } else {
            $requestUserBet = new RequestUserBet();
            $requestUserBet->setGame($game);

            $requestsUser = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUser')->findBy(
                array('user' => $security->getToken()->getUser())
            );

            foreach ($requestsUser as $requestUser) {
                if ($requestUser->getUserTournament()->getTournament()->getId() === $game->getTournament()->getId()) {
                    $requestUserBet->setRequestUser($requestUser);
                    break;
                }
            }

        }

        $form = $this->createBetForm($requestUserBet);

        if ($request->getMethod() === 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {

                $this->displaySuccess('flashbag.bundles.app.requestuserbet.betsuccess');
                $em->persist($requestUserBet);
                $em->flush();

                /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
                $dispatcher = $this->container->get('event_dispatcher');
                $Event = $this->container->get('zimzim_bundles_app.event.requestuserbetevent');
                $Event->setRequestUserBet($requestUserBet);
                $dispatcher->dispatch(ZIMZIMAppEvents::BET_ALL_GAME, $Event);

                return $this->redirect($this->generateUrl('zimzim_bundles_app_game_show', array('id' => $id)));
            }
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:RequestUserBet:bet.html.twig',
            array(
                'game' => $game,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to edit a RequestUserBet entity.
     *
     * @param RequestUserBet $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createBetForm(RequestUserBet $entity)
    {
        $form = $this->createForm(
            'zimzim_bundles_appbundle_requestuserbet_bettype',
            $entity,
            array(
                'action' => $this->generateUrl(
                        'zimzim_bundles_app_requestuserbet_bet',
                        array('id' => $entity->getGame()->getId())
                    ),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.bet'));

        return $form;
    }
}

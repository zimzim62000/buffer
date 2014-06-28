<?php

namespace ZIMZIM\Bundles\AppBundle\Controller;

use APY\DataGridBundle\Grid\Column\TextColumn;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ZIMZIM\Bundles\AppBundle\ZIMZIMAppEvents;
use ZIMZIM\Controller\ZimzimController;

use ZIMZIM\Bundles\AppBundle\Entity\Game;
use ZIMZIM\Bundles\AppBundle\Form\GameType;

/**
 * Game controller.
 *
 */
class GameController extends ZimzimController
{

    /**
     * Lists all Game entities.
     *
     */
    public function indexAction()
    {

        $data = array(
            'entity' => 'ZIMZIMBundlesAppBundle:Game',
            'show' => 'zimzim_bundles_app_admingame_show',
            'edit' => 'zimzim_bundles_app_admingame_edit',
            'type' => 'admin'
        );

        $this->gridList($data);

        /** @var $this ->grid \APY\DataGridBundle\Grid\Grid */
        $columns = $this->grid->getColumns();

        $columns->setColumnsOrder(
            array(
                'tournament.name',
                'tournamentDay.name',
                'teamHome.name',
                'score',
                'teamOuter.name',
                'date'
            )
        );

        return $this->grid->getGridResponse('ZIMZIMBundlesAppBundle:Game:index.html.twig');
    }

    /**
     * Creates a new Game entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Game();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                $this->generateUrl('zimzim_bundles_app_admingame_show', array('id' => $entity->getId()))
            );
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:Game:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to create a Game entity.
     *
     * @param Game $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Game $entity)
    {
        $form = $this->createForm(
            new GameType(),
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_bundles_app_admingame_create'),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Game entity.
     *
     */
    public function newAction()
    {
        $entity = new Game();
        $form = $this->createCreateForm($entity);

        return $this->render(
            'ZIMZIMBundlesAppBundle:Game:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a Game entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Game')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Game entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMBundlesAppBundle:Game:show.html.twig',
            array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing Game entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Game')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Game entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMBundlesAppBundle:Game:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Creates a form to edit a Game entity.
     *
     * @param Game $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Game $entity)
    {
        $form = $this->createForm(
            new GameType(),
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_bundles_app_admingame_update', array('id' => $entity->getId())),
                'method' => 'PUT',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }

    /**
     * Edits an existing Game entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Game')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Game entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $this->updateSuccess();
            $em->flush();

            /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
            $dispatcher = $this->container->get('event_dispatcher');
            $Event = $this->container->get('zimzim_bundles_app.event.gameevent');
            $Event->setGame($entity);
            $dispatcher->dispatch(ZIMZIMAppEvents::UPDATE_SCORE_GAME, $Event);


            return $this->redirect($this->generateUrl('zimzim_bundles_app_admingame_edit', array('id' => $id)));
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:Game:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Deletes a Game entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Game')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Game entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_bundles_app_admingame'));
    }

    /**
     * Creates a form to delete a Game entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_bundles_app_admingame_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm();
    }

    /**
     * Lists all Game entities.
     *
     */
    public function indexUserAction($id)
    {
        $data = array(
            'entity' => 'ZIMZIMBundlesAppBundle:Game',
            'show' => 'zimzim_bundles_app_game_show',
            'type' => 'user'
        );

        $security = $this->container->get('security.context');

        if ($security->isGranted('ROLE_ADMIN') === true) {
            $data['score'] = 'zimzim_bundles_app_game_score';
        }

        $source = $this->gridList($data, false);

        $em = $this->container->get('doctrine')->getManager();

        $tournament = $em->getRepository('ZIMZIMBundlesAppBundle:Tournament')->find($id);

        if (!$tournament) {
            throw new NotFoundHttpException('No tournament find, try again');
        }

        $userTournaments = $em->getRepository('ZIMZIMBundlesAppBundle:UserTournament')->findByUserAndTournament(
            $security,
            $tournament
        );


        $error = false;

        if (!count($userTournaments)) {
            $this->displayErorException('flashbag.errors.noaccess');
            $error = true;
        }
        $access = false;
        foreach ($userTournaments as $userTournament) {
            if (true === $security->isGranted('access', $userTournament)) {
                $access = true;
            }
        }
        if ($access === false) {
            $this->displayErorException('flashbag.errors.noaccess');
            $error = true;
        }

        if ($error) {
            return $this->redirect($this->generateUrl('zimzim_bundles_app_home'));
        }

        $em->getRepository('ZIMZIMBundlesAppBundle:Game')->getList(
            $source,
            $this->container->get('security.context'),
            $id
        );

        $MyTypedColumn = new TextColumn(array(
            'id' => 'myscore',
            'title' => 'entity.app.game.myscore',
            'source' => false,
            'filterable' => false,
            'sortable' => false
        ));
        $this->grid->addColumn($MyTypedColumn);

        $user = $security->getToken()->getUser();
        $source->manipulateRow(
            function ($row) use ($em, $user) {
                $requestsUserBet = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUserBet')->findByGameAndUser(
                    $em->getRepository('ZIMZIMBundlesAppBundle:Game')->find($row->getField('id')),
                    $user
                );

                $tmpString = '';
                foreach ($requestsUserBet as $key => $requestUserBet) {

                    if ($key !== 0) {
                        $tmpString .= ' / ';
                    }
                    $tmpString .= $requestUserBet->getScoreTeamHome() . ' - ' . $requestUserBet->getScoreTeamOuter();
                }

                $row->setField('myscore', $tmpString);

                return $row;
            }
        );

        $this->grid->setSource($source);

        /** @var $this ->grid \APY\DataGridBundle\Grid\Grid */
        $columns = $this->grid->getColumns();

        $columns->setColumnsOrder(
            array(
                'teamHome.name',
                'score',
                'teamOuter.name',
                'myscore',
                'date'
            )
        );

        return $this->grid->getGridResponse(
            'ZIMZIMBundlesAppBundle:Game:indexuser.html.twig',
            array('tournament' => $tournament)
        );
    }


    public function showUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $security = $this->container->get('security.context');

        $game = $em->getRepository('ZIMZIMBundlesAppBundle:Game')->find($id);

        if (!$game) {
            throw $this->createNotFoundException('Unable to find Game entity.');
        }

        $userTournaments = $em->getRepository('ZIMZIMBundlesAppBundle:UserTournament')->findByUserAndTournament(
            $security,
            $game->getTournament(),
            true
        );

        $error = false;

        if (!count($userTournaments)) {
            $this->displayErorException('flashbag.errors.noaccess');
            $error = true;
        }
        $access = false;
        foreach ($userTournaments as $userTournament) {

            if (true === $security->isGranted('access', $userTournament)) {
                $access = true;
                $userTournament->setRequestsUser(
                    $userTournament->getRequestsUser()->filter(
                        function ($object) {
                            return $object->getEnabled() && $object->getValidate();
                        }
                    )
                );

                foreach ($userTournament->getRequestsUser() as $requestUser) {

                    $requestUser->setRequestsUserBet(
                        $requestUser->getRequestsUserBet()->filter(
                            function ($object) use ($game, $security) {
                                return $object->getGame()->getId() === $game->getId();
                            }
                        )
                    );
                }
            }

        }
        if ($access === false) {
            $this->displayErorException('flashbag.errors.noaccess');
            $error = true;
        }

        if ($error) {
            return $this->redirect($this->generateUrl('zimzim_bundles_app_home'));
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:Game:showuser.html.twig',
            array(
                'entity' => $game,
                'userTournaments' => $userTournaments
            )
        );
    }

    public function scoreUserAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $security = $this->container->get('security.context');

        $game = $em->getRepository('ZIMZIMBundlesAppBundle:Game')->find($id);

        if (!$game) {
            throw $this->createNotFoundException('Unable to find Game entity.');
        }

        $form = $this->createScoreForm($game);

        if ($request->getMethod() === 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {

                $this->updateSuccess();
                $em->flush();

                /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
                $dispatcher = $this->container->get('event_dispatcher');
                $Event = $this->container->get('zimzim_bundles_app.event.gameevent');
                $Event->setGame($game);
                $dispatcher->dispatch(ZIMZIMAppEvents::UPDATE_SCORE_GAME, $Event);

                return $this->redirect(
                    $this->generateUrl('zimzim_bundles_app_game', array('id' => $game->getTournament()->getId()))
                );
            }
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:Game:score.html.twig',
            array(
                'game' => $game,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to edit a Game entity.
     *
     * @param Game $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createScoreForm(Game $entity)
    {
        $form = $this->createForm(
            'zimzim_bundles_appbundle_gamescoretype',
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_bundles_app_game_score', array('id' => $entity->getId())),
                'method' => 'POST',
                'validation_groups' => array('score')
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }

}

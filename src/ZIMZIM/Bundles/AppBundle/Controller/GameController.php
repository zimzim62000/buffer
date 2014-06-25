<?php

namespace ZIMZIM\Bundles\AppBundle\Controller;

use APY\DataGridBundle\Grid\Source\Entity;
use Symfony\Component\HttpFoundation\Request;
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
                'scoreTeamHome',
                'scoreTeamOuter',
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

        $source = $this->gridList($data, true);

        $em = $this->container->get('doctrine')->getManager();

        $em->getRepository('ZIMZIMBundlesAppBundle:Game')->getList(
            $source,
            $this->container->get('security.context'),
            $id
        );

        /** @var $this ->grid \APY\DataGridBundle\Grid\Grid */
        $columns = $this->grid->getColumns();

        $columns->setColumnsOrder(
            array(
                'tournamentDay.name',
                'teamHome.name',
                'teamOuter.name',
                'date'
            )
        );

        return $this->grid->getGridResponse('ZIMZIMBundlesAppBundle:Game:indexuser.html.twig');
    }


    public function showUserAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Game')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Game entity.');
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:Game:showuser.html.twig',
            array(
                'entity' => $entity,
            )
        );
    }

    public function scoreUserAction($id)
    {

    }

}

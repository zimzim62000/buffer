<?php

namespace ZIMZIM\Bundles\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ZIMZIM\Controller\ZimzimController;

use ZIMZIM\Bundles\AppBundle\Entity\Tournament;
use ZIMZIM\Bundles\AppBundle\Form\TournamentType;

/**
 * Tournament controller.
 *
 */
class TournamentController extends ZimzimController
{

    /**
     * Lists all Tournament entities.
     *
     */
    public function indexAction()
    {
    $data = array(
        'entity'     => 'ZIMZIMBundlesAppBundle:Tournament',
        'show'       => 'zimzim_bundles_app_tournament_show',
        'edit'       => 'zimzim_bundles_app_tournament_edit'
    );

    $this->gridList($data);


   return $this->grid->getGridResponse('ZIMZIMBundlesAppBundle:Tournament:index.html.twig');
    }
    /**
     * Creates a new Tournament entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Tournament();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_bundles_app_tournament_show', array('id' => $entity->getId())));
        }

        return $this->render('ZIMZIMBundlesAppBundle:Tournament:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Tournament entity.
    *
    * @param Tournament $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Tournament $entity)
    {
        $form = $this->createForm(new TournamentType(), $entity, array(
            'action' => $this->generateUrl('zimzim_bundles_app_tournament_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Tournament entity.
     *
     */
    public function newAction()
    {
        $entity = new Tournament();
        $form   = $this->createCreateForm($entity);

        return $this->render('ZIMZIMBundlesAppBundle:Tournament:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tournament entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Tournament')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tournament entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZIMZIMBundlesAppBundle:Tournament:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Tournament entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Tournament')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tournament entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZIMZIMBundlesAppBundle:Tournament:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tournament entity.
    *
    * @param Tournament $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tournament $entity)
    {
        $form = $this->createForm(new TournamentType(), $entity, array(
            'action' => $this->generateUrl('zimzim_bundles_app_tournament_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }
    /**
     * Edits an existing Tournament entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Tournament')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tournament entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
			$this->updateSuccess();
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_bundles_app_tournament_edit', array('id' => $id)));
        }

        return $this->render('ZIMZIMBundlesAppBundle:Tournament:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tournament entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Tournament')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tournament entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_bundles_app_tournament'));
    }

    /**
     * Creates a form to delete a Tournament entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_bundles_app_tournament_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm()
        ;
    }
}

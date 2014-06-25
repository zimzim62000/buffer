<?php

namespace ZIMZIM\Bundles\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ZIMZIM\Controller\ZimzimController;

use ZIMZIM\Bundles\AppBundle\Entity\TournamentDay;
use ZIMZIM\Bundles\AppBundle\Form\TournamentDayType;

/**
 * TournamentDay controller.
 *
 */
class TournamentDayController extends ZimzimController
{

    /**
     * Lists all TournamentDay entities.
     *
     */
    public function indexAction()
    {
    $data = array(
        'entity'     => 'ZIMZIMBundlesAppBundle:TournamentDay',
        'show'       => 'zimzim_bundles_app_tournamentday_show',
        'edit'       => 'zimzim_bundles_app_tournamentday_edit'
    );

    $this->gridList($data);


   return $this->grid->getGridResponse('ZIMZIMBundlesAppBundle:TournamentDay:index.html.twig');
    }
    /**
     * Creates a new TournamentDay entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TournamentDay();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_bundles_app_tournamentday_show', array('id' => $entity->getId())));
        }

        return $this->render('ZIMZIMBundlesAppBundle:TournamentDay:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a TournamentDay entity.
    *
    * @param TournamentDay $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(TournamentDay $entity)
    {
        $form = $this->createForm(new TournamentDayType(), $entity, array(
            'action' => $this->generateUrl('zimzim_bundles_app_tournamentday_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new TournamentDay entity.
     *
     */
    public function newAction()
    {
        $entity = new TournamentDay();
        $form   = $this->createCreateForm($entity);

        return $this->render('ZIMZIMBundlesAppBundle:TournamentDay:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TournamentDay entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:TournamentDay')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TournamentDay entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZIMZIMBundlesAppBundle:TournamentDay:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TournamentDay entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:TournamentDay')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TournamentDay entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZIMZIMBundlesAppBundle:TournamentDay:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TournamentDay entity.
    *
    * @param TournamentDay $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TournamentDay $entity)
    {
        $form = $this->createForm(new TournamentDayType(), $entity, array(
            'action' => $this->generateUrl('zimzim_bundles_app_tournamentday_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }
    /**
     * Edits an existing TournamentDay entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:TournamentDay')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TournamentDay entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
			$this->updateSuccess();
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_bundles_app_tournamentday_edit', array('id' => $id)));
        }

        return $this->render('ZIMZIMBundlesAppBundle:TournamentDay:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TournamentDay entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZIMZIMBundlesAppBundle:TournamentDay')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TournamentDay entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_bundles_app_tournamentday'));
    }

    /**
     * Creates a form to delete a TournamentDay entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_bundles_app_tournamentday_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm()
        ;
    }
}

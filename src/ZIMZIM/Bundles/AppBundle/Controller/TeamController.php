<?php

namespace ZIMZIM\Bundles\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ZIMZIM\Controller\ZimzimController;

use ZIMZIM\Bundles\AppBundle\Entity\Team;
use ZIMZIM\Bundles\AppBundle\Form\TeamType;

/**
 * Team controller.
 *
 */
class TeamController extends ZimzimController
{

    /**
     * Lists all Team entities.
     *
     */
    public function indexAction()
    {
    $data = array(
        'entity'     => 'ZIMZIMBundlesAppBundle:Team',
        'show'       => 'zimzim_bundles_app_adminteam_show',
        'edit'       => 'zimzim_bundles_app_adminteam_edit'
    );

    $this->gridList($data);


   return $this->grid->getGridResponse('ZIMZIMBundlesAppBundle:Team:index.html.twig');
    }
    /**
     * Creates a new Team entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Team();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_bundles_app_adminteam_show', array('id' => $entity->getId())));
        }

        return $this->render('ZIMZIMBundlesAppBundle:Team:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Team entity.
    *
    * @param Team $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Team $entity)
    {
        $form = $this->createForm(new TeamType(), $entity, array(
            'action' => $this->generateUrl('zimzim_bundles_app_adminteam_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Team entity.
     *
     */
    public function newAction()
    {
        $entity = new Team();
        $form   = $this->createCreateForm($entity);

        return $this->render('ZIMZIMBundlesAppBundle:Team:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Team entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Team')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Team entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZIMZIMBundlesAppBundle:Team:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Team entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Team')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Team entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZIMZIMBundlesAppBundle:Team:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Team entity.
    *
    * @param Team $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Team $entity)
    {
        $form = $this->createForm(new TeamType(), $entity, array(
            'action' => $this->generateUrl('zimzim_bundles_app_adminteam_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }
    /**
     * Edits an existing Team entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Team')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Team entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
			$this->updateSuccess();
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_bundles_app_adminteam_edit', array('id' => $id)));
        }

        return $this->render('ZIMZIMBundlesAppBundle:Team:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Team entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Team')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Team entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_bundles_app_adminteam'));
    }

    /**
     * Creates a form to delete a Team entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_bundles_app_adminteam_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm()
        ;
    }
}

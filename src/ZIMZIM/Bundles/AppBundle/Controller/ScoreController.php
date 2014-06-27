<?php

namespace ZIMZIM\Bundles\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ZIMZIM\Controller\ZimzimController;

use ZIMZIM\Bundles\AppBundle\Entity\Score;
use ZIMZIM\Bundles\AppBundle\Form\ScoreType;

/**
 * Score controller.
 *
 */
class ScoreController extends ZimzimController
{
    /**
     * Lists all Score entities.
     *
     */
    public function indexAction()
    {
    $data = array(
        'entity'     => 'ZIMZIMBundlesAppBundle:Score',
        'show'       => 'zimzim_bundles_app_adminscore_show',
        'edit'       => 'zimzim_bundles_app_adminscore_edit',
        'type'       => 'admin'
    );

    $this->gridList($data);


   return $this->grid->getGridResponse('ZIMZIMBundlesAppBundle:Score:index.html.twig');
    }
    /**
     * Creates a new Score entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Score();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_bundles_app_adminscore_show', array('id' => $entity->getId())));
        }

        return $this->render('ZIMZIMBundlesAppBundle:Score:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Score entity.
    *
    * @param Score $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Score $entity)
    {
        $form = $this->createForm(new ScoreType(), $entity, array(
            'action' => $this->generateUrl('zimzim_bundles_app_adminscore_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Score entity.
     *
     */
    public function newAction()
    {
        $entity = new Score();
        $form   = $this->createCreateForm($entity);

        return $this->render('ZIMZIMBundlesAppBundle:Score:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Score entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Score')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Score entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZIMZIMBundlesAppBundle:Score:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Score entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Score')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Score entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZIMZIMBundlesAppBundle:Score:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Score entity.
    *
    * @param Score $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Score $entity)
    {
        $form = $this->createForm(new ScoreType(), $entity, array(
            'action' => $this->generateUrl('zimzim_bundles_app_adminscore_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }
    /**
     * Edits an existing Score entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Score')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Score entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
			$this->updateSuccess();
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_bundles_app_adminscore_edit', array('id' => $id)));
        }

        return $this->render('ZIMZIMBundlesAppBundle:Score:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Score entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZIMZIMBundlesAppBundle:Score')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Score entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_bundles_app_adminscore'));
    }

    /**
     * Creates a form to delete a Score entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_bundles_app_adminscore_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm()
        ;
    }
}

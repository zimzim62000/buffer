<?php

namespace ZIMZIM\Bundles\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ZIMZIM\Controller\ZimzimController;

use ZIMZIM\Bundles\AppBundle\Entity\RequestUserRanking;
use ZIMZIM\Bundles\AppBundle\Form\RequestUserRankingType;

/**
 * RequestUserRanking controller.
 *
 */
class RequestUserRankingController extends ZimzimController
{

    /**
     * Lists all RequestUserRanking entities.
     *
     */
    public function indexAction()
    {
    $data = array(
        'entity'     => 'ZIMZIMBundlesAppBundle:RequestUserRanking',
        'show'       => 'zimzim_bundles_app_adminrequestuserranking_show',
        'edit'       => 'zimzim_bundles_app_adminrequestuserranking_edit'
    );

    $this->gridList($data);


   return $this->grid->getGridResponse('ZIMZIMBundlesAppBundle:RequestUserRanking:index.html.twig');
    }
    /**
     * Creates a new RequestUserRanking entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new RequestUserRanking();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_bundles_app_adminrequestuserranking_show', array('id' => $entity->getId())));
        }

        return $this->render('ZIMZIMBundlesAppBundle:RequestUserRanking:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a RequestUserRanking entity.
    *
    * @param RequestUserRanking $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(RequestUserRanking $entity)
    {
        $form = $this->createForm(new RequestUserRankingType(), $entity, array(
            'action' => $this->generateUrl('zimzim_bundles_app_adminrequestuserranking_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new RequestUserRanking entity.
     *
     */
    public function newAction()
    {
        $entity = new RequestUserRanking();
        $form   = $this->createCreateForm($entity);

        return $this->render('ZIMZIMBundlesAppBundle:RequestUserRanking:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a RequestUserRanking entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUserRanking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RequestUserRanking entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZIMZIMBundlesAppBundle:RequestUserRanking:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing RequestUserRanking entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUserRanking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RequestUserRanking entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZIMZIMBundlesAppBundle:RequestUserRanking:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a RequestUserRanking entity.
    *
    * @param RequestUserRanking $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(RequestUserRanking $entity)
    {
        $form = $this->createForm(new RequestUserRankingType(), $entity, array(
            'action' => $this->generateUrl('zimzim_bundles_app_adminrequestuserranking_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }
    /**
     * Edits an existing RequestUserRanking entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUserRanking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RequestUserRanking entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
			$this->updateSuccess();
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_bundles_app_adminrequestuserranking_edit', array('id' => $id)));
        }

        return $this->render('ZIMZIMBundlesAppBundle:RequestUserRanking:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a RequestUserRanking entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUserRanking')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find RequestUserRanking entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_bundles_app_adminrequestuserranking'));
    }

    /**
     * Creates a form to delete a RequestUserRanking entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_bundles_app_adminrequestuserranking_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm()
        ;
    }



    public function indexUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAppBundle:UserTournament')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UsertTournament entity.');
        }

        $security = $this->container->get('security.context');
        if (false === $security->isGranted('access', $entity)) {
            $this->displayErorException('flashbag.errors.noaccess');
            return $this->redirect($this->generateUrl('zimzim_bundles_app_home'));
        }

        $entities = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUserRanking')->getRankingByUserTournament($entity);

        return $this->render('ZIMZIMBundlesAppBundle:RequestUserRanking:indexuser.html.twig', array(
                'entity'      => $entity,
                'entities' => $entities
            ));
    }

}

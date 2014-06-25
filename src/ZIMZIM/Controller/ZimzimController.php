<?php

namespace ZIMZIM\Controller;


use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Source\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ZimzimController extends Controller{

    protected $grid;

    protected function gridList($data, $setSource = true)
    {

        $grid = $this->get('grid');

        $type = 'default';
        if (isset($data['type'])) {
            $type = $data['type'];
        }

        $source = new Entity($data['entity'], $type);

        if (isset($data['show'])) {
            $rowAction = new RowAction("button.show", $data['show']);
            $grid->addRowAction($rowAction);
        }

        if (isset($data['edit'])) {
            $rowAction = new RowAction("button.update", $data['edit']);
            $grid->addRowAction($rowAction);
        }

        if (isset($data['score'])) {
            $rowAction = new RowAction("button.score", $data['score']);
            $grid->addRowAction($rowAction);
        }

        if (isset($data['deletemass'])) {
            $massAction = new MassAction('button.delete', $data['deletemass']);
            $grid->addMassAction($massAction);
        }

        if($setSource){
            $grid->setSource($source);
        }

        $this->grid = $grid;

        return $source;
    }

    protected function displayMessage($message)
    {
        $this->addFlashMessage(
            array(
                'type' => 'success',
                'message' => $message
            )
        );
    }

    protected function createSuccess()
    {
        $this->addFlashMessage(
            array(
                'type' => 'success',
                'message' => 'flashbag.success.create'
            )
        );
    }

    protected function updateSuccess()
    {
        $this->addFlashMessage(
            array(
                'type' => 'success',
                'message' => 'flashbag.success.update'
            )
        );
    }

    protected function deleteSuccess()
    {
        $this->addFlashMessage(
            array(
                'type' => 'success',
                'message' => 'flashbag.success.delete'
            )
        );
    }

    private function addFlashMessage($data)
    {

        $this->get('session')->getFlashBag()->add(
            $data['type'],
            $data['message']
        );
    }

    protected function displayErorException($message)
    {
        $this->addFlashMessage(
            array(
                'type' => 'errors',
                'message' => $message
            )
        );
    }
}
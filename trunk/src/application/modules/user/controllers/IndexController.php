<?php


class User_IndexController
        extends Mtt_Controller_Action
    {


    public function indexAction()
        {
        $url = Zend_Controller_Front::getInstance()
                ->getRequest()->getRequestUri();
        }


    }
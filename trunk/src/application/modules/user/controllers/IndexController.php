<?php


class User_IndexController
        extends Mtt_Controller_Action
    {


    public function indexAction()
        {
        $this->view->assign( 'auth' , $this->authData );
        }


    }
<?php

class Admin_EquipoController extends Mtt_Controller_Action {

    protected $_equipo;

    public function init() {
        parent::init();
        $this->_equipo = new Mtt_Models_Catalog_Equipo();
    }

    public function indexAction() {
        $this->view->assign(
                'equipos', $this->_equipo->listEquip()
        );
    }

    public function detalleAction() {
        $this->view->jQuery()
                /*  ->addStylesheet(
                  '"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css'
                  ) */
                /* ->addJavascriptFile(
                  'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js'
                  ) */
                ->addOnLoad(
                        ' $(document).ready(function() {
                            $("#tabs").tabs();
                          });'
                )
        ;

        //$this->_equipo->get
    }

    public function activaequiposAction() {
        $form = new Mtt_Form_ActivarEquipo();
        $this->view->assign('frmActivarEquipo', $form);

        if ($this->_request->isPost()
                &&
                $form->isValid($this->_request->getPost())) {

            $equipos = $form->getValues();
            $ids = $equipos['equipos'];

            foreach ($ids as $item) {
                $this->_equipo->publicarEquipo($item);
            }

            $this->_redirect($this->URL);
        }
    }

    public function questionAction() {
        
    }

    public function addtopofersAction() {
        $id = intval($this->_getParam('id', null));
        $this->_equipo->addTopOfers($id);
        $this->_helper->FlashMessenger(
                $this->_translate->translate ('se agrego como top ofers  ') . $id);
        $this->_redirect($_SERVER['HTTP_REFERER']);
    }

    public function quittopofersAction() {
        $id = intval($this->_getParam('id', null));
        $this->_equipo->quitTopOfers($id);
        $this->_helper->FlashMessenger(
                $this->_translate->translate ('se a quitado de top ofers  ') 
                . $id);
        $this->_redirect($_SERVER['HTTP_REFERER']);
    }

    public function stadisticsequipoAction() {
        $this->view->headScript()->appendFile(
                $this->view->
                        baseUrl() . "/js/estadistica/fgCharting.jQuery.js");
        $this->view->headScript()->appendFile(
                $this->view->
                        baseUrl() . "/js/estadistica/excanvas-compressed.js");
        $this->view->jQuery()
                ->addOnLoad(
                        '$(document).ready(function() {
                            if($.browser.msie) { 
                                setTimeout(function(){$.fgCharting();}, 2000);
                            } else {
                                $.fgCharting();
                            }	
                        });'
        );
        $this->view->assign('equipos', 
                $this->_equipo->listEquipMoreVisited(10));
    }

    public function verAction() {
        $id = intval($this->_getParam('id', null));
        $stmt = $this->_equipo->getCategoria($id);
        $this->view->assign('categoria', $stmt);
    }

    public function nuevoAction() {
        $form = new Mtt_Form_Equipo();
        if ($this->_request->isPost()
                &&
                $form->isValid($this->_request->getPost())
        ) {

            $equipo = $form->getValues();
            $equipo_new = array(
                'usuario_id' => $this->authData['usuario']->id
            );
            $equipo = array_merge($equipo, $equipo_new);

            $this->_equipo->saveEquipo($equipo);

            $this->_helper->FlashMessenger(
                    $this->_translate->translate('se registro el equipo')
            );
            $this->_redirect($this->URL);
        }
        $this->view->assign('frmRegistrar', $form);
    }

    public function editarAction() {

        $id = intval($this->_getParam('id'));

        $form = new Mtt_EditForm_Equipo();

        $equipo = $this->_equipo->getFindId($id);

        if (!is_null($equipo)) {
            if ($this->_request->isPost() && $form->isValid(
                            $this->_request->getPost())
            ) {
                $this->_equipo->updateEquipo($form->getValues(), $id);
                $this->_helper->FlashMessenger(
                        $this->_translate->translate('se modifico el equipo')
                );
                $this->_redirect($this->URL);
            }
            $form->setDefaults($equipo->toArray());
            $this->view->assign('form', $form);
        } else {
            $this->_helper->FlashMessenger(
                    $this->_translate->translate('no existe el equipo')
            );
            $this->_redirect($this->URL);
        }
    }

    public function borrarAction() {
        $id = intval($this->_request->getParam('id'));
        $this->_equipo->desactivarEquipo($id);
        $this->_helper->FlashMessenger(
                $this->_translate->translate('equipo borrado')
        );
        $this->_redirect($this->URL);
    }

    public function activarAction() {
        $id = intval($this->_request->getParam('id'));
        $this->_equipo->activarEquipo($id);
        $this->_helper->FlashMessenger(
                $this->_translate->translate('equipo activado')
        );
        $this->_redirect($this->URL);
    }

    public function desactivarAction() {
        $id = intval($this->_request->getParam('id'));
        $this->_equipo->desactivarEquipo($id);
        $this->_helper->FlashMessenger(
                $this->_translate->translate('equipo desactivado')
        );
        $this->_redirect($this->URL);
    }

}


<?php

class User_PreguntaController extends Mtt_Controller_Action {

    protected $_pregunta;

    public function init() {
        parent::init();
        $this->_pregunta = new Mtt_Models_Bussines_Pregunta();
    }

    public function indexAction() {
//        $this->view->jQuery()
//                ->addStylesheet(
//                        $this->view->baseUrl() . '/css/reserva.css'
//        );
        //$this->_helper->layout->setLayout('layoutListado');
        $preguntas = $this->_pregunta->pagListByUser(
                $this->authData['usuario']->id);
        $preguntas->setCurrentPageNumber(
                $this->_getParam('page', 1));
        $this->view->assign(
            'preguntas', $preguntas
        );
    }

    public function nuevoAction() {
        $this->view->jQuery()
                ->addJavascriptFile(
                        '/js/jwysiwyg/jquery.wysiwyg.js'
                )
                ->addJavascriptFile(
                        '/js/pregunta.js'
                )
                ->addStylesheet(
                        '/js/jwysiwyg/jquery.wysiwyg.css'
        );

        $idEquipo = (int) ( $this->_getParam('id', null) );

        $form = new Mtt_Form_Pregunta();

        $form->removeElement('respuesta');

        if ($this->_request->isPost()
                &&
                $form->isValid($this->_request->getPost())
        ) {

            $pregunta = $form->getValues();

            //Cambiar fecha formulacion, sincronizar con server.

            $pregunta_new = array(
                'usuario_id' => $this->authData['usuario']->id,
                'categoriapregunta_id' => 1,
                'equipo_id' => $idEquipo,
                'fechaFormulacion' => date("Ymd G:i:s")
            );

            $pregunta = array_merge($pregunta, $pregunta_new);

            $this->_pregunta->savePregunta($pregunta);

            $this->_helper->FlashMessenger(
                    $this->_translate->translate(
                            'Se Registro la pregunta'
                    )
            );
            $this->_redirect($this->URL);
        }

        $this->view->assign('frmRegistrar', $form);
    }

    public function borrarAction() {
        $id = intval($this->_request->getParam('id'));
        $this->_pregunta->desactivaPregunta($id);
        $this->_helper->FlashMessenger(
                $this->_translate->translate('Pregunta Borrado')
        );
        $this->_redirect($this->URL);
    }

}


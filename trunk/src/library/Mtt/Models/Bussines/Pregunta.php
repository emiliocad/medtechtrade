<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Mtt_Models_Bussines_Pregunta 
    extends Mtt_Models_Table_Pregunta {

    public function __construct($config = array()) {
        parent::__construct($config);
    }

    public function getFindId($id) {
//        $db = $this->getAdapter();
//        $query = $db->select()
//                ->from( $this->_name )
//                ->where( 'id = ?' , $id )
//                ->where( 'active = ?' , '1' )
//                ->query()
//        ;
        return $this->fetchRow('id = ' . $id);
    }

    public function listar() {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from($this->_name)
                ->where('active = ?', '1')
                ->order( 'fechaFormulacion DESC')
                ->query()
        ;

        return $query->fetchAll(Zend_Db::FETCH_OBJ);
    }

    public function listByEquip($idEquipo) {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from($this->_name, array('id',
                    'equipo_id',
                    'usuario_id',
                    'asunto',
                    'formulacion',
                    'fechaFormulacion',
                    'fechaRespuesta',
                    'respuesta',
                    'estado')
                )
                ->where('active = ?', '1')
                ->where('equipo_id = ?', $idEquipo)
                ->query()
        ;

        return $query->fetchAll(Zend_Db::FETCH_OBJ);
    }

    public function listByEquipUser($idEquipo, $idUser) {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from($this->_name, array('id',
                    'equipo_id',
                    'usuario_id',
                    'asunto',
                    'formulacion',
                    'fechaFormulacion',
                    'fechaRespuesta',
                    'respuesta',
                    'estado')
                )
                ->where('active = ?', '1')
                ->where('equipo_id = ?', $idEquipo)
                ->where('usuario_id = ?', $idUser)
                ->query()
        ;

        return $query->fetchAll(Zend_Db::FETCH_OBJ);
    }

    public function listByUser($idUser) {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from($this->_name, array('id',
                    'equipo_id',
                    'usuario_id',
                    'asunto',
                    'formulacion',
                    'fechaformulacion',
                    'fecharespuesta',
                    'respuesta',
                    'estado',
                    'active')
                )
                ->joinInner('equipo', 
                    'pregunta.equipo_id = equipo.id', array(
                    'equipo' => 'nombre',
                    'slug',
                        )
                )
                ->joinLeft('imagen', 
                        'equipo.id = imagen.equipo_id', 
                        'imagen')
                ->where('pregunta.active = ?', self::ACTIVE)
                ->where('pregunta.usuario_id = ?', $idUser)
                ->group('equipo.id')
                ->query()
        ;

        return $query->fetchAll(Zend_Db::FETCH_OBJ);
    }

    public function listByEquipUnresolved($idEquipo) {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from($this->_name, array('id',
                    'equipo_id',
                    'usuario_id',
                    'asunto',
                    'formulacion',
                    'fechaFormulacion',
                    'fechaRespuesta',
                    'respuesta',
                    'estado')
                )
                ->where('active = ?', self::ACTIVE)
                ->where('equipo_id = ?', $idEquipo)
                ->where('usuario_id = ?', $idUser)
                ->where('estado = ?', 
                        Mtt_Models_Table_Pregunta::PreguntaNoResulta)
                ->query()
        ;

        return $query->fetchAll(Zend_Db::FETCH_OBJ);
    }

    public function listQuestionUnresolved() {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from($this->_name, array('id',
                    'equipo_id',
                    'usuario_id',
                    'asunto',
                    'formulacion',
                    'fechaFormulacion',
                    'fechaRespuesta',
                    'respuesta',
                    'estado',
                    'active')
                )
                ->where('active = ?', self::ACTIVE)
                ->where('estado = ?', 
                        Mtt_Models_Table_Pregunta::PreguntaNoResulta)
                ->query()
        ;

        return $query->fetchAll(Zend_Db::FETCH_OBJ);
    }

    
    public function pagListQuestionUnresolved() {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfigUser.ini',
                        'paginator'
        );
        $data = $_conf->toArray();

        $object = Zend_Paginator::factory($this->listQuestionUnresolved());
        $object->setItemCountPerPage(
                $data['ItemCountPerPage']
        );
        return $object;
    }
    
    

    public function pagListQuestion() {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfigAdmin.ini',
                        'questions'
        );
        $data = $_conf->toArray();

        $object = Zend_Paginator::factory($this->listar());
        $object->setItemCountPerPage(
                $data['ItemCountPerPage']
        );
        return $object;
    }    
    
    
        public function pagListByUser( $idUser) {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfigUser.ini',
                        'pregunta'
        );
        $data = $_conf->toArray();

        $object = Zend_Paginator::factory($this->listByUser( $idUser));
        $object->setItemCountPerPage(
                $data['ItemCountPerPage']
        );
        return $object;
    }    
    
    
    public function responderPregunta(array $data, $id) {
        $data['fechaRespuesta'] = date('Y-m-d H:m:s');
        $data['estado'] = Mtt_Models_Table_Pregunta::PreguntaResulta;
        $this->update($data, 'id = ' . $id);
    }

    public function updatePregunta(array $data, $id) {
        
        $this->update($data, 'id = ' . $id);
    }

    public function savePregunta(array $data) {

        $this->insert($data);
    }

    public function deletePregunta($id) {

        $this->delete('id = ?', $id);
    }

    public function activarPregunta($id) {

        $this->update(array("active" => self::ACTIVE), 'id = ' . $id);
    }

    public function desactivarPregunta($id) {

        $this->update(array("active" => self::DESACTIVATE), 'id = ' . $id);
    }

}

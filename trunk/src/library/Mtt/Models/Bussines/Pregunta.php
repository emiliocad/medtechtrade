<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_Moneda
        extends Mtt_Models_Table_Moneda
    {

    
    public function __construct( $config = array( ) )
        {
        parent::__construct( $config );
        }



    public function getFindId( $id )
        {
//        $db = $this->getAdapter();
//        $query = $db->select()
//                ->from( $this->_name )
//                ->where( 'id = ?' , $id )
//                ->where( 'active = ?' , '1' )
//                ->query()
//        ;
        return $this->fetchRow( 'id = ' . $id );
        }


    public function listar()
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active = ?' , '1' )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }



    public function listByEquip($idEquipo)
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name ,
                        array( 'id' ,
                        'equipo_id',
                        'usuario_id',
                        'asunto',
                        'formulacion', 
                        'fechaFormulacion',
                        'fechaRespuesta', 
                        'respuesta',
                        'estado')
                )
                ->where( 'active = ?' , '1' )
                ->where( 'equipo_id = ?' , $idEquipo )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }        


    public function listByEquipUser($idEquipo, $idUser)
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name ,
                        array( 'id' ,
                        'equipo_id',
                        'usuario_id',
                        'asunto',
                        'formulacion', 
                        'fechaFormulacion',
                        'fechaRespuesta', 
                        'respuesta',
                        'estado')
                )
                ->where( 'active = ?' , '1' )
                ->where( 'equipo_id = ?' , $idEquipo )
                ->where( 'usuario_id = ?' , $idUser )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }        



    public function listByEquipUnresolved($idEquipo)
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name ,
                        array( 'id' ,
                        'equipo_id',
                        'usuario_id',
                        'asunto',
                        'formulacion', 
                        'fechaFormulacion',
                        'fechaRespuesta', 
                        'respuesta',
                        'estado')
                )
                ->where( 'active = ?' , self::ACTIVE )
                ->where( 'equipo_id = ?' , $idEquipo )
                ->where( 'usuario_id = ?' , $idUser )
                ->where( 'estado = ?' , 
                        Mtt_Models_Table_Pregunta::PreguntaNoResulta )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }        
        
        

    public function updatePregunta( array $data , $id )
        {

        $this->update( $data , 'id = ' . $id );
        }


    public function savePregunta( array $data )
        {

        $this->insert( $data );
        }


    public function deletePregunta( $id )
        {

        $this->delete( 'id = ?' , $id );
        }


    public function activarPregunta( $id )
        {

        $this->update( array( "active" => self::ACTIVE ) , 'id = ' . $id );
        }


    public function desactivarPregunta( $id )
        {

        $this->update( array( "active" => self::DESACTIVATE ) , 'id = ' . $id );
        }


    }

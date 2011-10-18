<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_Alerta
        extends Mtt_Models_Table_Alerta
    {


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

        
    public function getAlertas($idUsuario)
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active = ?' , '1' )
                ->where( 'usuario_id = ?', $idUsuario)
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }

    public function updateAlerta( array $data , $id )
        {

        $this->update( $data , 'id = ' . $id );
        }
        
        
    public function updateConfigAlerta(array $data){
        
    }

    public function saveAlerta( array $data)
        {
        //categorias como string
        $ids = $data['categorias'];
        $listadoCategorias = implode(',', $ids);
        
        //alerta 1
        $data1['tipo'] = 1;
        $data1['usuario_id'] = $data['usuario_id'];
        $data1['fecharegistro'] = date( 'Y-m-d h:m:s');
        $data1['active'] = ($data['alerta1']==1)? 1 : 0;
        $this->insert( $data1 );
        
        //alerta 2
        $data2['tipo'] = 2;
        $data2['usuario_id'] = $data['usuario_id'];
        $data2['fecharegistro'] = date( 'Y-m-d h:m:s');
        $data2['active'] = ($data['alerta2']==1)? 1 : 0;
        $data2['detalle'] = $listadoCategorias;
        $this->insert( $data2 );
        
        //alerta 3
        $data3['tipo'] = 3;
        $data3['usuario_id'] = $data['usuario_id'];
        $data3['fecharegistro'] = date( 'Y-m-d h:m:s');
        $data3['active'] = ($data['alerta3']==1)? 1 : 0;
        $this->insert( $data3 );
        }


    public function deleteAlerta( $id )
        {

        $this->delete( 'id = ?' , $id );
        }


    public function activarAlerta( $id )
        {

        $this->update( array( "active" => self::ACTIVE ) , 'id = ' . $id );
        }


    public function desactivarAlerta( $id )
        {

        $this->update( array( "active" => self::DESACTIVATE ) , 'id = ' . $id );
        }


    }

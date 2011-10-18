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


    public function getAlertaByUser( $idUser )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name ,
                        array( 'id' ,
                    'tipo' ,
                    'detalle' ,
                    'active' ) )
                ->where( 'usuario_id = ?' , $idUser )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function saveAlerta( array $data )
        {
        for ( $i = 1; $i <= Mtt_Models_Table_Alerta::NAlertas; $i++ )
            {

            $obj = "alerta" . $i;

            $registro['usuario_id'] = $data['usuario_id'];
            $registro['tipo'] = $i;
            $registro['active'] = $data[$obj];
            $registro['fecharegistro'] = date( 'Y-m-d H:i:s' );

            $registro['detalle'] = ($i == 2) ?
                    implode( ',' , $data['categorias'] ) : null;
            $this->insert( $registro );
            }
        }


    public function updateAlerta( array $data , array $dataUsuario )
        {
        foreach ( $dataUsuario as $fila )
            {
            $alerta[$fila->tipo] = $fila;
            }
        for ( $i = 1; $i <= Mtt_Models_Table_Alerta::NAlertas; $i++ )
            {

            $obj = "alerta" . $i;
            $registro['active'] = $data[$obj];
            $registro['fechamodificacion'] = date( 'Y-m-d H:i:s' );

            if ( isset( $data['categorias'] ) )
                {
                $registro['detalle'] = ($i == 2) ?
                        implode( ',' , $data['categorias'] ) : null;
                }
            $this->update( $registro , 'id = ' . $alerta[$i]->id );
            }
        }


    public function comprobarActivoAlerta( array $dataUsuario )
        {
        $alerta = array( );
        $alerta['categorias']= null;
        
        foreach ( $dataUsuario as $fila )
            {
            $alerta[$fila->tipo] = $fila->active;
            $alerta['categorias'] = ($fila->tipo == 2) ? $fila->detalle : $alerta['categorias'];
            }
        return $alerta;
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

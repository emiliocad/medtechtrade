<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_CuotasPago
        extends Mtt_Models_Table_CuotasPago
    {


    public function getComboValues()
        {
        $filas = $this->fetchAll( 'active=1' )->toArray();
        $values = array( );
        foreach ( $filas as $fila )
            {
            $values[$fila['id']] = $fila['nombre'];
            }
        return $values;
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


    public function listByOperation( $idOperacion)
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from($name, $this->_name ,
                        array( 'id' ,
                        'nrocuota' ,
                        'pago' ,
                        'cuotaspago.fechapago as fpagocuota' ,
                        'mora' ,
                        'estado')
                )
                ->joinInner( 'operacion_has_equipo' , 
                        'cuotaspago.operacion_has_equipo_id = 
                            operacion_has_equipo.id ' 
                )
                ->joinInner( 'estadocuenta' , 
                        'cuotaspago.estadocuota_id = estadocuota.id' ,
                        array ('estadocuota.nombre as estadocuota')
                )
                ->where( 'operacion_has_equipo.operacion_id  = ?' , 
                        $idOperacion 
                )
                ->query()
        ;
        /*
         * FROM  
cuotaspago 
INNER  JOIN operacion_has_equipo ON cuotaspago.operacion_has_equipo_id = operacion_has_equipo.id
INNER JOIN estadocuota ON cuotaspago.estadocuota_id = estadocuota.id
WHERE operacion_has_equipo.id = 4
         *
         */

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }        
        

    public function updateCuotasPago( array $data , $id )
        {

        $this->update( $data , 'id = ' . $id );
        }


    public function saveCuotasPago( array $data )
        {

        $this->insert( $data );
        }


    public function deleteCuotasPago( $id )
        {

        $this->delete( 'id = ?' , $id );
        }


    public function activarCuotasPago( $id )
        {

        $this->update( array( "active" => self::ACTIVE ) , 'id = ' . $id );
        }


    public function desactivarCuotasPago( $id )
        {

        $this->update( array( "active" => self::DESACTIVATE ) , 'id = ' . $id );
        }


    }

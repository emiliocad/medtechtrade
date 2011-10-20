<?php

class Mtt_Models_Bussines_EquipoFormaPago
        extends Mtt_Models_Table_EquipoFormaPago
    {


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


    public function listByEquipo( $idEquipo )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array( 'equipo_id' ,
                    'formapago_id' ,
                    'nrocuotas' ,
                    'id' ,
                    'pago' ,
                    'dias' ,
                    'totalpago' ,
                    'moraxdia' )
                )
                ->joinInner( 'formapago' ,
                             'equipo_has_formapago.formapago_id = formapago.id' ,
                             array( 'nombre' )
                )
                ->where( 'active = ?' , self::ACTIVE )
                ->where( 'equipo_id = ?' , $idEquipo )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function updateEquipoFormaPago( array $data , $id )
        {

        $this->update( $data , 'id = ' . $id );
        }


    public function saveEquipoFormaPago( array $data )
        {

        $this->insert( $data );
        }


    public function deleteEquipoFormaPago( $id )
        {

        $this->delete( 'id = ?' , $id );
        }


    public function activarEquipoFormaPago( $id )
        {

        $this->update( array( "active" => self::ACTIVE ) , 'id = ' . $id );
        }


    public function desactivarEquipoFormaPago( $id )
        {

        $this->update( array( "active" => self::DESACTIVATE ) , 'id = ' . $id );
        }


    }

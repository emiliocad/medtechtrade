<?php


class Mtt_Models_Bussines_FormaPago
        extends Mtt_Models_Table_FormaPago
    {

    public function __construct()
        {
        parent::__construct();
        }


    public function getComboValues()
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active = ?' , self::ACTIVE )
                ->order( 'nombre' )
                ->query()
        ;
        $filas = $query->fetchAll( Zend_Db::FETCH_ASSOC );
        $values = array( );
        foreach ( $filas as $fila )
            {
            $values[$fila['id']] = $fila['nombre'];
            }
        return $values;
        }


    public function listFormaPago()
        {

        $db = $this->getAdapter();

        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active IN (?)' , self::ACTIVE )
                ->query();

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function getFormaPago( $id )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'id IN (?)' , $id )
                ->where( 'active = ?' , '1' )
                ->query()
        ;
        return $query->fetchObject();
        }


    public function updateFormaPago( array $data , $id )
        {

        $this->update( $data , 'id = ' . $id );
        }


    public function saveFormaPago( array $data )
        {

        $slug = new Mtt_Filter_Slug( array(
                    'field' => 'slug' ,
                    'model' => $this
                        ) );

        $dataNew = array(
            'slug' => $slug->filter( $data['title'] )
        );

        $data = array_merge( $dataNew , $data );
        $this->insert( $data );
        }


    public function deleteFormaPago( $id )
        {
        $this->delete( 'id = ?' , $id );
        }


    public function activarFormaPago( $id )
        {
        $this->update( array(
            "active" => self::ACTIVE )
                , 'id = ' . $id );
        }


    public function desactivarFormaPago( $id )
        {
        $this->update( array(
            "active" => self::DESACTIVATE )
                , 'id = ' . $id );
        }


    }

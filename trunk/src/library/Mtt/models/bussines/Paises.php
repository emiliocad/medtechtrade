<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_Paises
        extends Mtt_Models_Table_Paises
    {


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


    public function getComboValuesIntegrate()
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active = ?' , self::ACTIVE )
                ->where( 'integrate =?' , self::ACTIVE )
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


    public function getPaginator()
        {
        $p = Zend_Paginator::factory( $this->fetchAll() );
        $p->setItemCountPerPage( 3 );
        return $p;
        }


    public function listar( $active = null )
        {
        $value = ($active == null) ? array(0, 1) : 1;
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active IN (?)' , $value )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }

               
    public function pagListar( $active = null) {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfigAdmin.ini'
                        , 'categoria'
        );
        $data = $_conf->toArray();

        $object = Zend_Paginator::factory($this->listar($active));
        $object->setItemCountPerPage(
                $data['ItemCountPerPage']
        );
        return $object;
    }

    public function getFindId( $id )
        {

        return $this->fetchRow( 'id = ' . $id );
        }


    public function updatePais( array $data , $id )
        {

        $this->update( $data , 'id = ' . $id );
        }


    public function savePais( array $data )
        {
        $slug = new Mtt_Filter_Slug( array(
                    'field' => 'slug' ,
                    'model' => $this
                        ) );

        $dataNew = array(
            'slug' => $slug->filter( $data['nombre'] )
        );

        $data = array_merge( $dataNew , $data );

        $this->insert( $data );
        }


    public function deletePais( $id )
        {

        $this->delete('id =' . (int) $id);
        }


    public function activarPais( $id )
        {

        $this->update( array(
            "active" => self::ACTIVE )
                , 'id = ' . $id );
        }


    public function desactivarPais( $id )
        {

        $this->update( array(
            "active" => self::DESACTIVATE )
                , 'id = ' . $id );
        }


    }

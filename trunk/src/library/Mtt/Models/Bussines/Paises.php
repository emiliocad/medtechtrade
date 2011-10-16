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
        $filas = $this->fetchAll( "active=1" )->toArray();
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

        $this->delete( 'id = ?' , $id );
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

<<<<<<< HEAD
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria
 *
 */
class Mtt_Models_Bussines_Imagen extends Mtt_Models_Table_Imagen
    {


    }
=======
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Mtt_Models_Bussines_Imagen
        extends Mtt_Models_Table_Imagen
    {
    
    public function getFindId( $id )
        {

        return $this->fetchRow( 'id = ' . $id );
        }

    public function listByEquip( $idEquipo )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active = ?' , self::ACTIVE )
                ->where( 'equipo_id = ?' , $idEquipo )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }

        

    public function updateImagen( array $data , $id )
        {

        $this->update( $data , 'id = ' . $id );
        }


    public function saveImagen( array $data )
        {

        $this->insert( $data );
        }


    public function deleteImagen( $id )
        {

        $this->delete( 'id = ?' , $id );
        }


    public function activarImagen( $id )
        {

        $this->update( array( "active" => self::ACTIVE ) , 'id = ' . $id );
        }


    public function desactivarImagen( $id )
        {

        $this->update( array( "active" => self::DESACTIVATE ) , 'id = ' . $id );
        }        

    }
>>>>>>> 8861fd912a5142bf0c39994ea16481ceb1b91d19

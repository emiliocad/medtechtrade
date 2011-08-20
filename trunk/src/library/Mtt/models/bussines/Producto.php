<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria
 *
 */
class Mtt_Models_Bussines_Producto extends Mtt_Models_Table_Producto {
    
    public function listar() {
        $db = $this->getAdapter();
        $filas = $db->select()
            ->from($this->_name)
            ->join(
                'categoria',
                'producto.id_categoria=categoria.id',
                array('categoria'=>'nombre')
            )
            ->join(
                'fabricante',
                'producto.id_fabricante=fabricante.id',
                array('fabricante'=>'nombre')
            )
            ->query();
        return $filas;
    }

    public function listarPorCategoria(){
        $_categoria = new Application_Model_Categoria();
        $categorias = $_categoria->fetchAll('activo=1');
        $listado = array();
        foreach($categorias as $categoria){
            $productos = $_categoria->listarProductos($categoria['id']);
            if(count($productos)){
                $listado[] = array(
                    'id' => $categoria['id'],
                    'nombre' => $categoria['nombre'],
                    'Productos' => $productos
                );
            }
        }
        return $listado;
    }

    public function getComboValues(){
        $_categoria = new Application_Model_Categoria();
        $categorias = $_categoria->fetchAll('activo=1');
        $listado = array();
        foreach($categorias as $categoria){
            $productos = $_categoria->listarProductos($categoria['id']);
            $productos2 = array();
            foreach($productos as $producto){
                $productos2[$producto['id']] = $producto['nombre'];
            }
            if(count($productos)){
                $listado[$categoria['nombre']] = $productos2;
            }
        }
        return $listado;
    }

    public function getComboValidValues(){
        $_categoria = new Application_Model_Categoria();
        $categorias = $_categoria->fetchAll('activo=1');
        $listado = array();
        foreach($categorias as $categoria){
            $productos = $_categoria->listarProductos($categoria['id']);
            $productos2 = array();
            foreach($productos as $producto){
                $productos2[] = $producto['id'];
            }
            if(count($productos)){
                foreach($productos2 as $productoId){
                    $listado[] = $productoId;
                }
            }
        }
        return $listado;
    }

    public function getDetalles(Array $producto_ids){
        $db = $this->getAdapter();
        $query = $db->select()
            ->from(
                $this->_name,
                array(
                    'id_producto'=>'id',
                    'producto'=>'nombre',
                    'precio'
                )
            )
            ->joinLeft(
                'categoria',
                'producto.id_categoria=categoria.id',
                array(
                    'categoria' => 'nombre'
                )
            )
            ->joinLeft(
                'fabricante',
                'producto.id_fabricante=fabricante.id',
                array(
                    'fabricante' => 'nombre'
                )
            )
            ->where('producto.id IN (?) ',$producto_ids)
        ;

        return $db->fetchAll($query);

    }

    public function getDetalle($producto_id){
        $db = $this->getAdapter();
        $query = $db->select()
            ->from(
                $this->_name,
                array(
                    'id_producto'=>'id',
                    'producto'=>'nombre',
                    'precio'
                )
            )
            ->joinLeft(
                'categoria',
                'producto.id_categoria=categoria.id',
                array(
                    'categoria' => 'nombre'
                )
            )
            ->joinLeft(
                'fabricante',
                'producto.id_fabricante=fabricante.id',
                array(
                    'fabricante' => 'nombre'
                )
            )
            ->where('producto.id = ? ',$producto_id)
        ;

        return $db->fetchRow($query);

    }

}

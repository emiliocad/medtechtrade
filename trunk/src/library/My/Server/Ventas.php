<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Application_Server_Json
 * sample class to expose via JSON-RPC
 *
 */
class My_Server_Ventas {

    /**
     * Suma de 2 variables
     *
     * @param  int $x
     * @param  int $y
     * @return int
     */
    public function suma($x, $y)
    {
        return $x + $y;
    }

    /**
     * Producto de 2 variables
     *
     * @param  int $x
     * @param  int $y
     * @return int
     */
    public function multiplica($x, $y)
    {
        return $x * $y;
    }


    /**
     * catalogo de productos
     *
     * @return array
     */
    public function catalogo(){
        $_producto = new Application_Model_Producto();
        return $_producto->listarPorCategoria();
    }

    /**
     * Repite el texto n veces
     *
     * @param  string $texto
     * @param  int $y
     * @return string
     */
    public function repite($texto,$veces){
        $s = "";
        for($i=0;$i<$veces;$i++){
            $s .= $texto. " ";
        }
        return $s;
    }

    /**
     * Valida
     *
     * @param  string $nombre
     * @return boolean
     */
    public function valida($nombre){
        $v = new Zend_Validate_Db_NoRecordExists(array(
            'table' => 'categoria',
            'field' => 'nombre',
        ));
        return $v->isValid($nombre)?"OK":"ERROR";
    }

    /**
     * Venta
     *
     * @param  int $producto_id
     * @param  int $cantidad
     * @return boolean
     */
    public function venta($producto_id,$cantidad){
        $_ventas = new Application_Model_VentaDetalle();
        $_producto = new Application_Model_Producto();
        $producto = $_producto->fetchRow('id='.$producto_id);
        $venta = array(
            'id_producto' => $producto_id,
            'cantidad' => $cantidad,
            'precio_venta' => $producto['precio'],
            'id_venta' => 0
        );
        if($_ventas->insert($venta)){
            $r = true;
        }else{
            $r = false;
        }
        return $r;
    }



}
?>
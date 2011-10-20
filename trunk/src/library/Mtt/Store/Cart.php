<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Cart
 *
 * @author User
 */
class Mtt_Cart
    {

    protected $id;
    protected $precio;
    protected $cantidad;
    protected $equipo_has_formaPago;
    protected $_equipo;
    protected $equipo;


    function __construct( Mtt_Models_Bussines_Equipo $equipo )
        {
        $this->equipo = $equipo;
        
        $this->_equipo = new Mtt_Models_Bussines_Equipo();
        $this->_addData();
        }


    protected function _addData()
        {
        $this->id = $this->equipo->id;
        $this->precio = $this->equipo->precioventa;
        $this->cantidad = 1;
        $this->equipo_has_formaPago = 0;
        
        }


    public function getId()
        {
        return $this->id;
        }


    public function setId( $id )
        {
        $this->id = $id;
        }


    public function getPrecio()
        {
        return $this->precio;
        }


    public function setPrecio( $precio )
        {
        $this->precio = $precio;
        }


    public function getCantidad()
        {
        return $this->cantidad;
        }


    public function setCantidad( $cantidad )
        {
        $this->cantidad = $cantidad;
        }


    public function getEquipo_has_formaPago()
        {
        return $this->equipo_has_formaPago;
        }


    public function setEquipo_has_formaPago( $equipo_has_formaPago )
        {
        $this->equipo_has_formaPago = $equipo_has_formaPago;
        }


    //put your code here

    }

?>

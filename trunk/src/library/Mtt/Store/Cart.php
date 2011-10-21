<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Store_Cart
    {

    protected $id;
    protected $nombre;
    protected $precio;
    protected $cantidad;
    protected $equipo_has_formaPago;
    private $_equipo;
    private $equipo;


    public function __construct( $equipo )
        {
        $this->equipo = $equipo;
        $this->_equipo = new Mtt_Models_Bussines_Equipo();
        $this->_addData();
        }


    private function _addData()
        {
        $this->id = $this->equipo->id;
        $this->precio = $this->equipo->precioventa;
        $this->nombre = $this->equipo->nombre;
        $this->cantidad = 1;
        $this->equipo_has_formaPago = 0;
        }


    public function setNombre( $nombre )
        {
        $this->nombre = $nombre;
        }


    public function getNombre()
        {
        return $this->nombre;
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


    }

?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_OperationEquipo
        extends Mtt_Models_Table_OperationEquipo
    {


    public function __construct()
        {
        parent::__construct();
        }

        
    public function getEquipmentsByOperation( $idOperacion )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name , array( 'id' , 'precio'  ) )
                ->joinInner( 'equipo' ,
                             'operacion_has_equipo.equipo_id = equipo.id' ,
                             array( 
                                 'idequipo' => 'equipo.id',
                                 'modelo',
                                 'equipo' => 'nombre',
                                 'fechafabricacion'
                                )
                )
                ->joinInner( 'fabricantes' ,
                             'equipo.fabricantes_id = fabricantes.id' ,
                             array( 'fabricantes.nombre as fabricante' )
                )
                
                ->joinInner( 'equipo_has_formapago', 
                        'equipo.id = equipo_has_formapago.equipo_id', 
                            array('nrocuotas',
                                'pago',
                                'dias',
                                'totalpago',
                                'moraxdia')
                )
                ->joinInner( 'formapago' , 
                        'equipo_has_formapago.formapago_id = formapago.id', 
                            array('formapago' => 'nombre')
                )
                ->joinLeft( 'imagen' , 
                        'imagen.equipo_id = equipo.id' ,
                            array( 'imagen.imagen as imagen' )
                )
                ->where( 'equipo.publicacionEquipo_id  <> ?' ,
                         Mtt_Models_Table_PublicacionEquipo::Activada )       
                ->where( 'operacion_id', $idOperacion )              
                ->group( 'equipo.id' )
                ->query();

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }        

    }

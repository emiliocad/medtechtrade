<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_Alerta
        extends Mtt_Models_Table_Alerta
    {


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

        
    public function getAlertas($idUsuario)
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active = ?' , '1' )
                ->where( 'usuario_id = ?', $idUsuario)
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }

    public function getAlertaByUser( $idUser )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name ,
                        array( 'id' ,
                    'tipo' ,
                    'detalle' ,
                    'active' ) )
                ->where( 'usuario_id = ?' , $idUser )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }
        
        
    public function updateConfigAlerta(array $data){
        
    }

    public function saveAlerta( array $data)
        {

        for ( $i = 1; $i <= Mtt_Models_Table_Alerta::NAlertas; $i++ )
            {

            $obj = "alerta" . $i;

            $registro['usuario_id'] = $data['usuario_id'];
            $registro['tipo'] = $i;
            $registro['active'] = $data[$obj];
            $registro['fecharegistro'] = date( 'Y-m-d H:i:s' );

            $registro['detalle'] = ($i == 2) ?
                    implode( ',' , $data['categorias'] ) : null;
            $this->insert( $registro );
            }
        }


    public function updateAlerta( array $data , array $dataUsuario )
        {
        foreach ( $dataUsuario as $fila )
            {
            $alerta[$fila->tipo] = $fila;
            }
        for ( $i = 1; $i <= Mtt_Models_Table_Alerta::NAlertas; $i++ )
            {

            $obj = "alerta" . $i;
            $registro['active'] = $data[$obj];
            $registro['fechamodificacion'] = date( 'Y-m-d H:i:s' );

            if ( isset( $data['categorias'] ) )
                {
                $registro['detalle'] = ($i == 2) ?
                        implode( ',' , $data['categorias'] ) : null;
                }
            $this->update( $registro , 'id = ' . $alerta[$i]->id );
            }
        }


    public function comprobarActivoAlerta( array $dataUsuario )
        {
        $alerta = array( );
        $alerta['categorias']= null;
        
        foreach ( $dataUsuario as $fila )
            {
            $alerta[$fila->tipo] = $fila->active;
            $alerta['categorias'] = ($fila->tipo == 2) ? 
                    $fila->detalle : $alerta['categorias'];
            }
        return $alerta;

        }
        
        
    /**
     * para enviar correo de autorizacion
     * @param array $data
     * @param string $subject
     */
    public function sendMailToRequest( array $data , $subject )
        {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/mail.ini'
        );


        $confMail = $_conf->toArray();

        $config = array(
            'auth' => $confMail['auth'] ,
            'username' => $confMail['username'] ,
            'password' => $confMail['password'] ,
            'port' => $confMail['port'] );

        $mailTransport = new Zend_Mail_Transport_Smtp(
                        $confMail['smtp'] ,
                        $config
        );

        //Mtt_Html_Mail_Mailer::setDefaultFrom();
        Zend_Mail::setDefaultFrom(
                $confMail['username'] , $confMail['data']
        );
        Zend_Mail::setDefaultTransport( $mailTransport );
//        Zend_Mail::setDefaultFrom(
//                $confMail['username'] , $confMail['data']
//        );
        Zend_Mail::setDefaultReplyTo(
                $confMail['username'] , $confMail['data']
        );
        $m = new Mtt_Html_Mail_Mailer();
        $m->setSubject( $data['asunto'] );

        $m->addTo( 'tj.chunga@gmail.com' );

        $m->setViewParam( 'usuario' , $data['nombre'] )
                ->setViewParam( 'equipo' , $data['equipo'] )

        ;

        $m->sendHtmlTemplate( "request.phtml" );
        }

        
    public function getAlertsToEmails( array $data)
        {
        $db = $this->getAdapter();
        $query = '
            SELECT 
                usuario_id
            FROM 
                alerta 
            WHERE 
                active = 1 AND tipo = 3
            UNION 
            SELECT usuario_id
            FROM alerta 
            WHERE detalle IN (SELECT categoria_id FROM equipo WHERE id = '.
                $data['id'].')
            UNION 
            SELECT usuario_id
            FROM busqueda 
            WHERE '.
            $data['nombre']. ' LIKE 
                CONCAT("%", busqueda.palabras_busqueda, "%") AND
            ' . $data['modelo']. ' LIKE CONCAT("%", busqueda.modelo,"%") AND
            ' .$data['fabricante']. ' LIKE CONCAT("%", busqueda.fabricante,"%")
            AND CASE busqueda.categoria_id 
                WHEN -1 THEN busqueda.categoria_id LIKE "%%" ELSE ' . 
                $data['categoria_id']. ' = busqueda.categoria_id END 
            AND ' . $data['fechaFabricacion']. ' > busqueda.anio_inicio AND 
            CASE busqueda.anio_fin WHEN -1 THEN busqueda.anio_fin LIKE "%%" 
                ELSE ' .$data['fechaFabricacion']. '< busqueda.anio_fin END AND 
            CASE busqueda.precio_inicio WHEN -1 THEN busqueda.precio_inicio 
                LIKE "%%" ELSE busqueda.precio_inicio < ' . 
                $data['precioventa']. ' END 
            AND CASE busqueda.precio_fin WHEN -1 THEN busqueda.precio_fin 
                LIKE "%%" ELSE busqueda.precio_fin > ' . $data['precioventa']. 
                ' END 
            AND
                active = 1
            ';

        return $db->query($query)->fetchAll(Zend_Db::FETCH_OBJ);
        
        }

    public function deleteAlerta( $id )
        {

        $this->delete( 'id = ?' , $id );
        }


    public function activarAlerta( $id )
        {

        $this->update( array( "active" => self::ACTIVE ) , 'id = ' . $id );
        }


    public function desactivarAlerta( $id )
        {

        $this->update( array( "active" => self::DESACTIVATE ) , 'id = ' . $id );
        }
        


    }

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_Contactus
        
    {


    public function __construct()
        {
       
        }


    /**
     * para enviar correo de autorizacion
     * @param array $data
     * @param string $subject
     */
    public function sendMail( array $data , $subject )
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
        $m->setSubject( $subject );

        $m->addTo( $confMail['username']  );

        $m->setViewParam( 'usuario' , $data['nombre'] )
                ->setViewParam( 'direccion' , $data['direccion'] )
                ->setViewParam( 'email' , $data['email'] )
                ->setViewParam( 'codpostal' , $data['codpostal'] )
                ->setViewParam( 'ciudad' , $data['ciudad'] )
                ->setViewParam( 'pais' , $data['pais'] )
                ->setViewParam( 'telefono' , $data['telefono'] )
                ->setViewParam( 'comentario' , $data['comentario'] )
        ;
        $m->sendHtmlTemplate( "contactus.phtml" );
        }

    }

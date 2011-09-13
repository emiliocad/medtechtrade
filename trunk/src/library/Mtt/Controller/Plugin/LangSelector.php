<?php


class Mtt_Controller_Plugin_LangSelector
        extends Zend_Controller_Plugin_Abstract
    {


    public function preDispatch( Zend_Controller_Request_Abstract $request )
        {
        parent::preDispatch( $request );

        $mtt = new Zend_Session_Namespace( 'MTT' );



        if ( !isset( $mtt->lang ) && $mtt->lang === NULL )
            {
            $zl = new Zend_Locale();
            $mtt->lang = $zl->getLanguage();
            }

        if ( $mtt->lang !== 'en' && $mtt->lang !== 'de' && $mtt->lang !== 'es' )
            {
            $mtt->lang = 'en';
            }


        $translate = new Zend_Translate(
                        Zend_Translate::AN_GETTEXT ,
                        APPLICATION_PATH . '/configs/locale/' ,
                        $mtt->lang ,
                        array( 'scan' => Zend_Translate::LOCALE_FILENAME ) ,
                        $mtt->lang );

        Zend_Registry::set( 'Zend_Translate' , $translate );
        }


    }
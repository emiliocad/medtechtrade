<?php

class Mtt_Controller_Plugin_LangSelector
        extends Zend_Controller_Plugin_Abstract
    {


    public function preDispatch( Zend_Controller_Request_Abstract $request )
        {
        $zl = new Zend_Locale();

        $lang = $zl->getLanguage();
        
        if( $lang !== 'en' && $lang !== 'de' && $lang !== 'es' )
               $lang = 'en';

//        //$lang = $request->getParam( 'lang' );
//        if( $lang == 'en' ) $locale = 'en';
//        else $locale = 'fr';


        $zl->setLocale( $lang );
        
        Zend_Registry::set( 'Zend_Locale' , $zl );

        $translate = new Zend_Translate(
                        Zend_Translate::AN_GETTEXT ,
                        APPLICATION_PATH . '/configs/locale/' ,
                        null ,
                        array( 'scan' => Zend_Translate::LOCALE_FILENAME ) ,
                        $lang );
        
        Zend_Registry::set( 'Zend_Translate' , $translate );

        }


    }
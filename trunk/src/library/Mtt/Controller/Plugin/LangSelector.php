<?php


class Mtt_Controller_Plugin_LangSelector
        extends Zend_Controller_Plugin_Abstract
    {


    public function preDispatch( Zend_Controller_Request_Abstract $request )
        {
        parent::preDispatch( $request );
        
        $mtt = new Zend_Session_Namespace( 'MTT' );

        if ( !isset( $mtt->config->lang ) && $mtt->config->lang === NULL )
            {
            $zl = new Zend_Locale();
            $mtt->config->lang = $zl->getLanguage();
            }

        if ( $mtt->config->lang !== 'en' && $mtt->config->lang !== 'de' &&
                $mtt->config->lang !== 'es' && $mtt->config->lang !== 'pl' )
            {
            $mtt->config->lang = 'en';
            }


        $translate = new Zend_Translate(
                        Zend_Translate::AN_GETTEXT ,
                        APPLICATION_PATH . '/configs/locale/' ,
                        $mtt->config->lang ,
                        array( 'scan' => Zend_Translate::LOCALE_FILENAME ) ,
                        $mtt->config->lang );

        Zend_Registry::set( 'Zend_Translate' , $translate );

        /* formulario idioma */
        /* fixme formulario idiomapais */

        $data = array( );
        if ( isset( $mtt->config->lang ) )
            {
            if ( isset( $mtt->config->idlang ) )
                {
                $data['idioma'] = $mtt->config->idlang;
                }
            if ( isset( $mtt->config->idpais ) )
                {
                $data['pais'] = $mtt->config->idpais;
                }
            }



        /**/
        /* formulario idioma */
        }


    }
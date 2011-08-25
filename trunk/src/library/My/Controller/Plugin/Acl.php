<?php

/**
 * Description of Acl
 *
 * @author eanaya
 */
class My_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        $acl = new Zend_Acl();
        $acl->addRole('admin');
        $acl->addRole('ventas');
        $acl->addRole('supervisor_ventas','ventas');
        $acl->addRole('logistica');
        $acl->addResource('productos');
        $acl->addResource('categorias');
        $acl->addResource('fabricantes');
        $acl->addResource('reportes');
        $acl->allow('ventas','productos','vender');
        $acl->allow('logistica','reportes','ultimos10');
        $acl->allow('supervisor_ventas','reportes','ultimos10');
        $acl->allow('admin');
        // guardamos la ACL en sesión
        $regAcl = Zend_Registry::get('acl');
        $regAcl->acl = $acl;
        parent::preDispatch($request);
    }
}
?>

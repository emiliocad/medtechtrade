<?php

/**
 * Description of AutoCache
 *
 *  USO:
 *   protected $_cacheMap = array('myFetchAll' => "categoria_list");
 *   public function myFetchAllCached(){return $this->fetchAll();}
 *
 * @author eanaya
 */
class My_Db_Table_AutoCache extends Zend_Db_Table_Abstract
{

    protected $SUFFIX = "Cache";
    protected $_cacheMap = array();

    /**
     * Magic method __call para atrapar llamadas a métodos no existentes.
     * @param <type> $name Nombre del método invocado
     * @param <type> $arguments Argumentos de la llamada al método
     * @return mixed
     */
    public function  __call($name, $arguments) {
        
        $cacheId = '';
        if (array_key_exists($name, $this->_cacheMap)) {
            $cacheId = $this->_cacheMap[$name]['cache-id'];
            $lt = $this->_cacheMap[$name]['lifetime'];
        } else {
            throw new Zend_Exception('No se encontró este Método en el mapa');
        }

        if (is_callable(array($this, $name. $this->SUFFIX ))) {
            $m = $name.$this->SUFFIX;
            $t = $this;
            return $this->c(
                $cacheId,
                function() use ($t,$m,$arguments){
                    return $t->$m($arguments);
                },
                $lt
            );
        }
    }

    /**
     * Funcion generica para usar Zend_cache
     * @param string $cacheId
     * @param clousure $function
     * @return mixed
     */
    protected function c($cacheId,$function, $lt=7200)
    {
        $cache = Zend_Registry::get('cache');
        if ($cache->test($cacheId)) {
            return $cache->load($cacheId);
        }
        $data = $function();
        $cache->save($data, $cacheId, array(), $lt);
        return $data;
    }

    
}

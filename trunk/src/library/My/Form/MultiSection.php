<?php


/**
 * Description of MultiSection
 *
 * @author eanaya
 */
class My_Form_MultiSection extends Zend_Form {
    
    /**
     * Array key de la cantidad de veces que se repite el form
     */
    const N = 'n';
    
    /**
     * Array key del formulario
     */
    const FORM = 'form';

    /**
     * 
     * @var type array
     */
    protected $_multiSections = array();

    /**
     *
     * @param array $ms Contiene los formularios y la cantidad de veces que se 
     * muestra cada uno
     */
    public function setMultiSections(array $ms){
        $this->_multiSections = $ms;
    }
    
    /**
     *
     * @param string $key Obtiene el formulario solicitado
     */
    public function getSectionForm($key){
        return $this->_multiSections[$key][self::FORM];
    }
    
    /**
     * Sobre escribiendo la validación para previamente agregar los elementos
     * necesarios al formulario
     * @param type $data 
     */
    public function isValid($data) {
        //var_dump($data);
        foreach($this->_multiSections as $ms => $options){
            if($options[self::N]){
                foreach(range(1,$options[self::N]) as $i){
                    foreach($options[self::FORM]->getElements() as $e){
                        $class = get_class($e);
                        $name = $ms."_".$e->getName()."_".$i;
                        $this->addElement(new $class($name));
                    }
                }
            }
        }
        //var_dump($data);
        parent::isValid($data);
    }
    
    
}

?>

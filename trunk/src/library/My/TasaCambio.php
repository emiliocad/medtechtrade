<?php
class My_TasaCambio implements Zend_Currency_CurrencyInterface
{

    const USD2PEN = 2.84;

    public function getRate($from, $to)
    {
        if ($from !== "USD" && $from !== "PEN"  ) {
            throw new Exception('Solo se cambia USD, PEN');
        }
        switch ($from) {
            case 'USD':
                switch ($to) {
                    case 'PEN':
                        return self::USD2PEN;
               }
            case 'PEN':
                switch ($to) {
                    case 'USD':
                        return 1/self::USD2PEN;
               }
       }
       
       throw new Exception("No se cambia a $to");
    }


}

?>

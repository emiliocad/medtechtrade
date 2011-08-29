<?php

/* * *******************************************************

 * DO NOT REMOVE *

  Project: PHPWeby ip2country software version 1.0.2
  Url: http://phpweby.com/
  Copyright: (C) 2008 Blagoj Janevski - bl@blagoj.com
  Project Manager: Blagoj Janevski

  More info, sample code and code implementation can be found here:
  http://phpweby.com/software/ip2country

  This software uses GeoLite data created by MaxMind, available from
  http://maxmind.com

  This file is part of i2pcountry module for PHP.

  For help, comments, feedback, discussion ... please join our
  Webmaster forums - http://forums.phpweby.com

 * *************************************************************************
 *  If you like this software please link to us!                          *
 *  Use this code:						         *
 *  <a href="http://phpweby.com/software/ip2country">ip to country</a>    *
 *  More info can be found at http://phpweby.com/link                     *
 * *************************************************************************

  License:
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License along
  with this program; if not, write to the Free Software Foundation, Inc.,
  51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.

 * ******************************************************* */

class My_Geoip_IpCountry extends Zend_Db_Table_Abstract
    {

    protected $_name = 'geoipcountry';
    private $ip_num = 0;
    private $ip = '';
    private $country_code = '';
    private $country_name = '';

    public function __construct( $config = array( ) )
        {
        parent::__construct( $config );
        $this->setIp();
        }

    public function getIpNum()
        {
        return $this->ip_num;
        }

    public function setIp( $newip='' )
        {
        if ( $newip == '' )
            $newip = $this->getClientIp();

        $this->ip = $newip;
        $this->calculateIpNum();
        $this->country_code = '';
        $this->country_name = '';
        }

    public function calculateIpNum()
        {
        if ( $this->ip == '' )
            $this->ip = $this->getClientIp();

        $this->ip_num = sprintf( "%u" , ip2long( $this->ip ) );
        }

    public function getCountryCode( $ip_addr='' )
        {
        if ( $ip_addr != '' && $ip_addr != $this->ip )
            $this->setIp( $ip_addr );

        if ( $ip_addr == '' )
            {
            if ( $this->ip != $this->getClientIp() )
                $this->setIp();
            }

        if ( $this->country_code != '' )
            return $this->country_code;
//
//        $db = $this->getAdapter();
//        $query = $db->select()
//                ->from( $this->_name , array( 'country' , 'name' ) )
//                ->where($this->ip_num)
//                $this->where('MyDate > ?', '2008-04-03')->where('MyDate < ?', '2009-01-02');
//                ->where( $this->ip_num , 'BETWEEN begin_ip_num AND end_ip_num' );
//


        $sq = "SELECT country_code,
                    country_name 
                    FROM " .
                $this->table_name .
                " WHERE " .
                $this->ip_num . "
                        BETWEEN begin_ip_num AND end_ip_num";
        $r = @mysql_query( $sq , $this->con );

        if ( !$r )
            return '';

        $row = @mysql_fetch_assoc( $r );
        $this->close();
        $this->country_name = $row['country_name'];
        $this->country_code = $row['country_code'];
        return $row['country_code'];
        }

    public function getCountryName( $ip_addr='' )
        {
        $this->getCountryCode( $ip_addr );
        return $this->country_name;
        }

    public function getClientIp()
        {
        $v = '';
        $v = (!empty( $_SERVER['REMOTE_ADDR'] )) ? $_SERVER['REMOTE_ADDR'] : ((!empty( $_SERVER['HTTP_X_FORWARDED_FOR'] )) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : @getenv( 'REMOTE_ADDR' ));
        if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) )
            $v = $_SERVER['HTTP_CLIENT_IP'];
        return htmlspecialchars( $v , ENT_QUOTES );
        }

    }

?>

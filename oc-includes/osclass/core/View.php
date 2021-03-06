<?php

    /*
     *      OSCLass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2010 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

    class View
    {
        private $aExported ;
        private $aCurrent ;
        private static $instance ;

        public static function newInstance() {
            if(!self::$instance instanceof self) {
                self::$instance = new self ;
            }
            return self::$instance ;
        }

        function __construct() {
            $this->aExported = array() ;
        }

        //to export variables at the business layer
        function _exportVariableToView($key, $value) {
            $this->aExported[$key] = $value ;
        }

        //to get the exported variables for the view
        function _get($key) {
            if ($this->_exists($key)) {
                return($this->aExported[$key]) ;
            } else {
                return '' ;
            }
        }

        //only for debug
        function _view($key = null) {
            if ($key) {
                print_r($this->aExported[$key]) ;
            } else {
                print_r($this->aExported) ;
            }
        }

        function _next($key) {
            if (is_array($this->aExported[$key])) {
                $this->aCurrent[$key] = current( $this->aExported[$key] ) ;
                if ( $this->aCurrent[$key] ) {
                    next( $this->aExported[$key] ) ;
                    return true ;
                }
            }
            return false ;
        }

        function _current($key) {
            if ( isset($this->aCurrent[$key]) && is_array($this->aCurrent[$key]) ) {
                return $this->aCurrent[$key] ;
            } elseif ( is_array($this->aExported[$key]) ) {
                $this->aCurrent[$key] = current( $this->aExported[$key] ) ;
                return $this->aCurrent[$key] ;
            }
            return '' ;
        }

        function _reset($key) {
            if (is_array($this->aExported[$key])) {
                return reset($this->aExported[$key]) ;
            }
            return array();
        }

        function _exists($key) {
            return ( isset($this->aExported[$key]) ? true : false ) ;
        }

        function _count($key) {
            if (is_array($this->aExported[$key])) {
                return count($this->aExported[$key]) ;
            }
            return -1 ;
        }

        function _erase($key) {
            unset($this->aExported[$key]) ;
            unset($this->aCurrent[$key]) ;
        }
    }

?>

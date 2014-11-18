<?php

/**
 * File:        phppagination.class.php
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 * @package phpPagination
 * @author  Anatoly Ruchyev <agr@infosite.ru>
 * @author  Andrew Puzyrev <andrew@infosite.ru>
 * @author  Leonid Morozov <leonid@infosite.ru>
 * @copyright 2005-2007 InfoCentre Ltd.
 * @version 1.0b
 *
 */

class phpPagination {

   /**
    * class variable for number of total items
    * @var number $_nTotalItems
    */
    var $_nTotalItems = 0;

   /**
    * class variable for number of items per page
    * @var number $_nItemsPerPage
    */
    var $_nItemsPerPage = 10;

   /**
    * class variable for number of total pages
    * @var number $_nTotalPages
    */
    var $_nTotalPages = 1;

   /**
    * class variable for number of current page
    * @var number $_nCurrentPage
    */
    var $_nCurrentPage = 1;

   /**
    * class variable for string of pagination code  
    * @var string $_sPaginationCode
    */
    var $_sPaginationCode;

   /**
    * class variable for output HTML string
    * @var string $_sHTML
    */
    var $_sHTML;

    /**
    * class variable for template for header of pagination (default '')
    * @var string $_prefix
    */
    var $_prefix = '';

   /**
    * class variable for template for footer of pagination (default '')
    * @var string $_suffix
    */
    var $_suffix = '';

   /**
    * class variable for template for "first page" output (default '<<')
    * @var string $_first
    */
    var $_first = '<a href="__PHP_SELF__?mn=log_login&page=__PAGE_NUMBER__">&laquo;</a>';

   /**
    * class variable for template for "last page" (default '>>')
    * @var string $_last
    */
    var $_last = '<a href="__PHP_SELF__?mn=log_login&page=__PAGE_NUMBER__">&raquo;</a>';

   /**
    * class variable for template for "previous page" (default '<')
    * @var string $_prev
    */
    var $_prev = '<a href="__PHP_SELF__?mn=log_login&page=__PAGE_NUMBER__">&lt;</a>';

   /**
    * class variable for template for "next page" (default '>')
    * @var string $_next
    */
    var $_next = '<a href="__PHP_SELF__?mn=log_login&page=__PAGE_NUMBER__">&gt;</a>';

   /**
    * class variable for separator between page numbers (default ' ')
    * @var string $_separator
    */
    var $_separator = '&nbsp;';

   /**
    * class variable for delimiter between pagination parts (default ' ... ')
    * @var string $_delimiter
    */
    var $_delimiter = '&nbsp;&hellip;&nbsp;';

   /**
    * class variable for template for output current page number
    * @var string $_current_page
    */
    var $_current_page = '__PAGE_NUMBER__';

   /**
    * class variable for template for other page numbers
    * @var string $_page
    */
    var $_page = '<a href="__PHP_SELF__?mn=log_login&page=__PAGE_NUMBER__">__PAGE_NUMBER__</a>';

   /**
    * class variable for pagination type (in current version 'phpBB' only)
    * @var string $_type
    */
    var $_type = 'phpBB';

    /**
     * Constructor
     * @access public
     * @param number total items
     * @param number items per page (default = 10)
     * @param array options array (default = NULL)
     *
     */
    function  phpPagination ($nTotalItems, $nItemsPerPage = 10, $options = NULL)
    {
        $this->_nItemsPerPage = $nItemsPerPage;
        $this->SetTotalItems ($nTotalItems);

        $available_options = array(
            'prefix', 'suffix',
            'first', 'last', 'prev', 'next',
            'separator', 'delimiter',
            'current_page', 'page',
            'type'
            );
        if (is_array($options)) {
            foreach ($options as $key => $value) {
                if (in_array($key, $available_options) ) {
                    $property = '_'.$key;
                    $this->$property = $value;
                } else {
                    trigger_error("ERROR: phpPagination constructor: '$key' is not a valid option", E_USER_ERROR);
                }
            }
        }
    }

    /**
     * html generator for current pagination type
     * @access public
     * @param number current page number
     * @return string ready to output html code
     * 
     */
    function GetHtml ($nCurrentPage = 1)
    {
        // get pagination code (old version by leonid)
        $old_code = $this->ic_GeneratePagination($nCurrentPage);
        // convert old code to new version
        $this->ic_ConvertPaginationCode($old_code);
        // generate html string from pagination code
        $this->ic_GeneratePaginationHTML();

        return $this->_sHTML;
    }

    /**
     * Get current value of total pages
     * @access public
     * @return number of total pages
     *
     */
    function GetTotalPages ()
    {
        return $this->_nTotalPages;
    }

    /**
     * Set new value for total items
     * @access public
     * @param number new value of total items
     *
     */
    function SetTotalItems ($nTotalItems)
    {
        $this->_nTotalItems = $nTotalItems;
        $this->_nTotalPages = ceil($this->_nTotalItems/$this->_nItemsPerPage);
    }

    /**
     * internal function ic_GeneratePagination
     * generate pagination code for phpBB-like output
     * (c) 2005 leonid
     * 
     * @access private
     * @param number ñurrent page
     * @return string pagination code string ("p1p2dp4p5a6p7p8dp16p17")
     */
    function ic_GeneratePagination ($iCurrentPage)
    {
        $iPaginationLenght      = 11;
        $iLenghtAroundActive    = 2;
        $iLenghtLeftPart        = 2;
        $iLenghtRightPart       = 2;
        $sSeparator             = '';

        $iTotalPages = $this->_nTotalPages;
        $this->_nCurrentPage = $iCurrentPage;

        if ($iTotalPages<=$iPaginationLenght) 
        {
            // simple variant - all numbers w/o "..."
            for ($i=1; $i<=$iTotalPages; $i++) {
                if ($i!=$iCurrentPage) $aTmp[] = 'p'.$i;
                else $aTmp[] = 'a'.$i;
            }
        } else {
            // output with "..."
            $iActiveRightLimit = $iCurrentPage+$iLenghtAroundActive;
            $iActiveLeftLimit  = $iCurrentPage-$iLenghtAroundActive;
            $iActiveRightMax   = $iPaginationLenght-$iLenghtRightPart-1;
            $iActiveLeftMin    = $iTotalPages-$iPaginationLenght+$iLenghtLeftPart+1;

            // looking for center
            $iDotsPlace = intval(($iPaginationLenght-1)/2)+1;

            if ($iActiveRightLimit<$iDotsPlace
                or $iActiveLeftLimit>($iTotalPages-$iPaginationLenght+$iDotsPlace)) 
            {
                // variant 1, one item "..." placed in center
                for ($i=1; $i<$iDotsPlace; $i++) {
                    if ($i!=$iCurrentPage) $aTmp[] = 'p'.$i;
                    else $aTmp[] = 'a'.$i;
                }
                $aTmp[] = 'd';
                for ($i=$iTotalPages-$iPaginationLenght+$iDotsPlace+1; $i<=$iTotalPages; $i++) {
                    if ($i!=$iCurrentPage) $aTmp[] = 'p'.$i;
                    else $aTmp[] = 'a'.$i;
                }
            } 
            elseif ($iActiveRightLimit>=$iDotsPlace
                    and $iActiveRightLimit<($iPaginationLenght-$iLenghtRightPart)) 
            {
                // variant 2, one item "..." placed on the right from center
                for ($i=1; $i<=$iActiveRightLimit; $i++) {
                    if ($i!=$iCurrentPage) $aTmp[] = 'p'.$i;
                    else $aTmp[] = 'a'.$i;
                }
                $aTmp[] = 'd';
                for ($i=$iTotalPages-$iPaginationLenght+$iActiveRightLimit+2; $i<=$iTotalPages; $i++) {
                    if ($i!=$iCurrentPage) $aTmp[] = 'p'.$i;
                    else $aTmp[] = 'a'.$i;
                }
            } 
            elseif (($iTotalPages+$iDotsPlace-$iPaginationLenght-2)<=$iActiveLeftLimit
                    and $iActiveLeftLimit>=($iTotalPages+$iLenghtLeftPart-$iPaginationLenght)) 
            {
                // variant 3, one item "..." placed on the left from center
                for ($i=1; $i<($iPaginationLenght-$iTotalPages+$iActiveLeftLimit-1); $i++) {
                    if ($i!=$iCurrentPage) $aTmp[] = 'p'.$i;
                    else $aTmp[] = 'a'.$i;
                }
                $aTmp[] = 'd';
                for ($i=$iActiveLeftLimit; $i<=$iTotalPages; $i++) {
                    if ($i!=$iCurrentPage) $aTmp[] = 'p'.$i;
                    else $aTmp[] = 'a'.$i;
                }
            }
            else 
            {
                // variant 4, two "..." items
                for ($i=1; $i<=$iLenghtLeftPart; $i++) {
                    if ($i!=$iCurrentPage) $aTmp[] = 'p'.$i;
                    else $aTmp[] = 'a'.$i;
                }
                $aTmp[] = 'd';
                for ($i=$iActiveLeftLimit; $i<=$iActiveRightLimit; $i++) {
                    if ($i!=$iCurrentPage) $aTmp[] = 'p'.$i;
                    else $aTmp[] = 'a'.$i;
                }
                $aTmp[] = 'd';
                for ($i=($iTotalPages-$iLenghtRightPart+1); $i<=$iTotalPages; $i++) {
                    if ($i!=$iCurrentPage) $aTmp[] = 'p'.$i;
                    else $aTmp[] = 'a'.$i;
                }
            }
        }
        return implode($sSeparator, $aTmp);
    }

    /**
     * internal function ic_ConvertPaginationCode
     * convert old version of pagination code (by leonid)
     * "p1p2dp4p5a6p7p8dp16p17"
     * to new version:
     * prefix,suffix,first=NNN,prev=NNN,next=NNN,last=NNN
     * current_page=NNN,page=NNN,separator,delimiter
     * 
     * @access private
     * @param string pagination code in old format
     * @return void
     */
    function ic_ConvertPaginationCode ($sPaginationCode)
    {
        $sOut = $sPaginationCode;
        $sOut = str_replace('a', '__a__', $sOut);
        $sOut = str_replace('p', '__p__', $sOut);
        $sOut = str_replace('d', '__d__', $sOut);
        $sOut = str_replace('__a__', ';separator;current_page=', $sOut);
        $sOut = str_replace('__p__', ';separator;page=', $sOut);
        $sOut = str_replace('__d__', ';delimiter', $sOut);
        $sOut = str_replace('delimiter;separator;', 'delimiter;', $sOut);

        $nPrev = ( $this->_nCurrentPage > 1 ? $this->_nCurrentPage - 1 : $this->_nCurrentPage );
        $nNext = ( $this->_nCurrentPage < $this->_nTotalPages ? $this->_nCurrentPage + 1 : $this->_nCurrentPage );
        $sOut = "prefix;first=1;separator;prev=$nPrev"
            .$sOut
            .";separator;next=$nNext;separator;last=$this->_nTotalPages;suffix";

        $this->_sPaginationCode = $sOut;
    }
    
    /**
     * internal function ic_GeneratePaginationHTML
     * convert pagination code to html string
     * (templates with macro substitution)
     *
     * @access private
     * @return void
     */
    function ic_GeneratePaginationHTML ()
    {
        $this->_sHTML = '';
        $sPhpSelf = htmlspecialchars($_SERVER['PHP_SELF']);

        $aOutput = explode(';', $this->_sPaginationCode);
        foreach($aOutput as $key=>$val)
        {
            $sTemplateName = $val;
            $nPageNumber ='';
            if (strpos($val, '=') !== false) {
                list($sTemplateName, $nPageNumber) = explode("=", $val);
            }
            $property = '_'.$sTemplateName;
            $sOut = $this->$property;
            $sOut = str_replace('__PHP_SELF__', $sPhpSelf, $sOut);
            $sOut = str_replace('__PAGE_NUMBER__', $nPageNumber, $sOut);
            $sOut = str_replace('__CURRENT_PAGE__', $this->_nCurrentPage, $sOut);
            $sOut = str_replace('__TOTAL_PAGES__', $this->_nTotalPages, $sOut);
            $sOut = str_replace('__TOTAL_ITEMS__', $this->_nTotalItems, $sOut);

            $this->_sHTML .= $sOut;
        }
    }

} // end of class phpPagination

?>

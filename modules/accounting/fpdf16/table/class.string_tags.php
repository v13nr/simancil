<?php

/****************************************************************************
 * Software:    Tag Extraction Class
 *              extracts the tags and corresponding text from a string
 * Version:	    1.1
 * Date:        2005/12/08
 * Author:	    Bintintan Andrei, <andy@interpid.eu>
 *
 * Last Modification: 2007/12/07
 * 
 * License: Free for Non Commercial use. 
 *          You may not sell or use this class in a Commercial Project without written permission from the Author. 
 * 
 * If you like my work please DONATE!!! **** paypal@interpid.eu ***** 
 * 
 * For more classes visit ***** www.interpid.eu ***** 
 * 
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR "AS IS" AND ANY EXPRESSED OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, 
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL THE 
 * AUTHOR OR ITS CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES 
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING 
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF 
 * SUCH DAMAGE.
 * 
 * PLEASE REPORT ANY BUGS TO THE AUTHOR. 
 * 
 * THANK YOU. 
 * 
 */

/**
 * Extracts the tags and corresponding text from a string
 * 
 * @name 	string_tags
 * @author 	Bintintan Andrei <andy@interpid.eu>
 * @version 1.1
 */
class string_tags{

/**
 * Contains the Tag/String Correspondence
 *
 * @access 	protected
 * @var		struct(array)
 */
protected $aTAGS = array();

/**
 * Contains the links for the tags that have specified this parameter
 * 
 * @access 	protected
 * @var		struct(array)
 */
protected $aHREF;

/**
 * The maximum number of chars for a tag
 *
 * @access 	protected
 * @var		integer
 */
protected $iTagMaxElem;
	
	/**
	 * Constructor
	 *
	 * @access 	public
	 * @param	numeric $p_tagmax - the number of characters allowed in a tag
	 * @return	void
	 */
	public function __construct($p_tagmax = 10){
		$this->aTAGS = array();
		$this->aHREF = array();
		$this->iTagMaxElem = $p_tagmax;
	}

	/**
	 * Returns TRUE if the specified tag name is an "<open tag>", (it is not already opened)
	 *
	 * @access 	protected
	 * @param	string $p_tag - tag name
	 * @param	array $p_array - tag arrays
	 * @return	boolean
	 */
    protected function OpenTag($p_tag, $p_array){

        $aTAGS = & $this->aTAGS;
        $aHREF = & $this->aHREF;
        $maxElem = & $this->iTagMaxElem;
      
        if (!eregi("^<([a-zA-Z1-9]{1,$maxElem}) *(.*)>$", $p_tag, $reg)) return false;

        $p_tag = $reg[1];

        $sHREF = array();
        if (isset($reg[2])) {
            preg_match_all("|([^ ]*)=[\"'](.*)[\"']|U", $reg[2], $out, PREG_PATTERN_ORDER);
            for ($i=0; $i<count($out[0]); $i++){
                $out[2][$i] = eregi_replace("(\"|')", "", $out[2][$i]);
                array_push($sHREF, array($out[1][$i], $out[2][$i]));
            }           
        }

        if (in_array($p_tag, $aTAGS)) return false;//tag already opened

        if (in_array("</$p_tag>", $p_array)) {
        	array_push($aTAGS, $p_tag);
        	array_push($aHREF, $sHREF);
            return true;
        }
        return false;
    }//OpenTag

	/** returnes true if $p_tag is a "<close tag>"
		@param 	$p_tag - tag string
                $p_array - tag array;
        @return true/false
	*/
	/**
	 * Returns true if $p_tag is a "<close tag>"
	 *
	 * @access 	protected
	 * @param	sting $p_tag - tag name
	 * @param	array $p_array - tag array
	 * @return	boolean
	 */
	protected function CloseTag($p_tag, $p_array){

	    $aTAGS = & $this->aTAGS;
	    $aHREF = & $this->aHREF;
	    $maxElem = & $this->iTagMaxElem;

	    if (!ereg("^</([a-zA-Z1-9]{1,$maxElem})>$", $p_tag, $reg)) return false;

	    $p_tag = $reg[1];

	    if (in_array("$p_tag", $aTAGS)) {
	    	array_pop($aTAGS);
	    	array_pop($aHREF);
	    	return true;
		}
	    return false;
	}// CloseTag
    
    /**
    * Expands the paramteres that are kept in Href field
    * 
    * @access 	protected
    * @param        array of parameters
    * @return       string with concatenated results
    */
    
    /**
     * Expands the paramteres that are kept in Href field
     *
     * @access 	protected
     * @param	struct $pResult
     * @return	string
     */
    protected function expand_parameters($pResult){
        $aTmp = $pResult['params'];
        if ($aTmp <> '')
            for ($i=0; $i<count($aTmp); $i++){
                $pResult[$aTmp[$i][0]] = $aTmp[$i][1];
            }
            
        unset($pResult['params']);
        
        return $pResult;
    }//expand_parameters
    
    
	/**
	 * Optimizes the result of the tag result array
	 * In the result array there can be strings that are consecutive and have the same tag, they
	 * are concatenated.
	 *
	 * @access 	protected
	 * @param	array $result - the array that has to be optimized
	 * @return	array - optimized result
	 */
	protected function optimize_tags($result){

		if (count($result) == 0) return $result;

		$res_result = array();
    	$current = $result[0];
    	$i = 1;

    	while ($i < count($result)){

    		//if they have the same tag then we concatenate them
			if (($current['tag'] == $result[$i]['tag']) && ($current['params'] == $result[$i]['params'])){
				$current['text'] .= $result[$i]['text'];
			}else{
                $current = $this->expand_parameters($current);
				array_push($res_result, $current);
				$current = $result[$i];
			}

			$i++;
    	}

        $current = $this->expand_parameters($current);
    	array_push($res_result, $current);
        
    	return $res_result;
    }//optimize_tags

    
    
   	/** Parses a string and returnes the result
		@param 	$p_str - string
        @return array (
        			array (string1, tag1),
        			array (string2, tag2)
        		)
	*/
   	/**
   	 * Parses a string and returnes an array of TAG - SRTING correspondent array
   	 * The result has the following structure:
   	 * 		array(
   	 * 			array (string1, tag1),
   	 * 			array (string2, tag2),
   	 * 			... etc
   	 * 		)
   	 * 
   	 * @access 	public
   	 * @param	string $p_str - the Input String
   	 * @return	array - the result array
   	 */
	public function get_tags($p_str){

	    $aTAGS = & $this->aTAGS;
	    $aHREF = & $this->aHREF;
	    $aTAGS = array();
	    $result = array();

		$reg = preg_split('/(<.*>)/U', $p_str, -1, PREG_SPLIT_DELIM_CAPTURE);

	    $sTAG = "";
	    $sHREF = "";

        while (list($key, $val) = each($reg)) {
	    	if ($val == "") continue;

	        if ($this->OpenTag($val,$reg)){
	            $sTAG = (($temp = end($aTAGS)) != NULL) ? $temp : "";
	            $sHREF = (($temp = end($aHREF)) != NULL) ? $temp : "";
	        }elseif($this->CloseTag($val, $reg)){
	            $sTAG = (($temp = end($aTAGS)) != NULL) ? $temp : "";
	            $sHREF = (($temp = end($aHREF)) != NULL) ? $temp : "";
	        }else {
	        	if ($val != "")
	        		array_push($result, array('text'=>$val, 'tag'=>$sTAG, 'params'=>$sHREF));
	        }
	    }//while

	    return $this->optimize_tags($result);
	}//get_tags

}//class string_tags

?>
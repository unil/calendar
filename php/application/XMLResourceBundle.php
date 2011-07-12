<?php
require_once('application/SerializableDomDocument.php');

/**
 * 
 * @author pizar
 * @copyright Copyright &copy; 2008, pizar
 * 
 * version 1.0
 * Required PHP 5.0
 * 
 * The class is build to read from the xml structure define from the sun.
 * 
 * <!DOCTYPE properties SYSTEM "http://java.sun.com/dtd/properties.dtd">
 * <?xml version="1.0" encoding="iso-8859-1"?>
 * <properties> 
 *     ...
 *     <entry key="invio"><![CDATA[invio]]></entry>
 *     ...
 * </properties>
 *  
 */
class XMLResourceBoundle{

    /**
     * A private variable, who maintain the reference on the xml file
     * @access private
     * @var string
     */
	private $doc="";
	
	
	
    /**
     * Constructor sets up the source file xml to read, and the language from where read.
     * The structure bust be: ${path}/${language}/{$filename}
     * @param string $path
     * @param string $filename
     * @param string $languageCode, the default is ""
     */
	public function XMLResourceBoundle($path, $languageCode=""){
		$complete_path="";
		
		$this->doc = new SerializableDomDocument();
		$this->doc->preserveWhiteSpace = false;
		
		if ($languageCode!=""){
			$complete_path=$path . "/lang_" . $languageCode. ".xml";
		}else{
			$complete_path=$path . "/lang.xml";
		}
		$this->doc->load($complete_path);
	}
	
	/**
     * Constructor sets up the source file xml to read, and the language from where read.
     * The structure must be: ${path}/${language}/{$filename}
     * @param string the id of the key to get
     * @return string the value of the key in the xml node, if the key is not found, 
     * return the key with ??? before and after. 
     */
	public function get($keyId){
		$query = "//entry[@key='".$keyId."']";

		$xpath = new DOMXPath($this->doc);
		$entries = $xpath->evaluate($query);
		
		if ($entries->length > 0){
			return($entries->item(0)->nodeValue);
		}else{
			return("???".$keyId."???");
		}
	}
}
?>
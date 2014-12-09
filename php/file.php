<?
/*
Source: ipt/file.php
Créer le: 2014-036-01
Par: Mathieu Tremblay

Tous droits réservés.

*/




class iptFile {

    var $iptBaseDir;

    function iptFile($pBaseDir="") {

		if($pBaseDir=="") {
			$this->iptBaseDir=getcwd()."/";
		} else {
                        $this->iptBaseDir=$pBaseDir;
		}

    }

    function IncludeFilesInDir($pDir="",$pFileExt=".php",$pExlusions=null) {

		if($pDir=="") {
			$pDir = $this->iptBaseDir;
		}

		if ($handle = opendir($pDir)) {
		    while (false !== ($entry = readdir($handle))) {

		        if ($entry != "." && $entry != ".."  && substr($entry,strlen($entry)-strlen($pFileExt),strlen($pFileExt))==$pFileExt) {

                            $bOk = true;
			    foreach($pExlusions as  $item) {
				if($entry== $item) {
					$bOk = false;
				}
			    }
			    if($bOk) {
			            include_once($pDir.$entry);
			    }
		        }
		    }
		    closedir($handle);
		}




    }







}


?>

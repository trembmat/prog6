<?php
/*
Source: ipt/file.php
Created: 2014-03-01
By: Mathieu Tremblay

All rights reserved.
*/

class iptFile {

    private $iptBaseDir;

    public function __construct($pBaseDir = "") {
        $this->iptBaseDir = $pBaseDir === "" ? getcwd() . "/" : $pBaseDir;
    }

    public function IncludeFilesInDir($pDir = "", $pFileExt = ".php", $pExclusions = null) {
        $pDir = $pDir === "" ? $this->iptBaseDir : $pDir;

        if (($handle = opendir($pDir)) === false) {
            throw new Exception("Unable to open directory: " . $pDir);
        }

        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != ".." && substr($entry, -strlen($pFileExt)) == $pFileExt) {
                if ($pExclusions === null || !in_array($entry, $pExclusions)) {
                    include_once($pDir . $entry);
                }
            }
        }
        closedir($handle);
    }
}

?>
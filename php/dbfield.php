<?php

include_once($_SESSION['IPT_VARS_DIR'] . "_vars.php");
include_once($_SESSION['IPT_VARS_DIR'] . "dbtable.php");

/*
Source: ipt/dbstructure.php
Created: 2013-06-26
By: Mathieu Tremblay

All rights reserved.
*/

class iptDbField {

    private $ipt_DBF_table;
    private $ipt_DBF_name;
    private $ipt_DBF_type;
    private $ipt_DBF_length;
    private $ipt_DBF_default;

    public function __construct($p_db_fieldtype, $p_db_fieldname = "", $p_db_table = null, $p_length = null, $p_default = null) {
      $this->ipt_DBF_type = $p_db_fieldtype;
      $this->ipt_DBF_name = $p_db_fieldname;
      $this->ipt_DBF_table = $p_db_table;
      $this->ipt_DBF_length = $p_length;
      $this->ipt_DBF_default = $p_default;
  
      // Here, you can add additional logic to handle cases where $p_db_fieldtype 
      // should be treated as a required parameter, 
      // and throw an exception or handle it as needed if it's not provided.
  
      if ($p_db_table) {
          $p_db_table->AddField($this);
      }
  }

    public function GetName() {
        return $this->ipt_DBF_name;
    }

    public function GetLength() {
        return $this->ipt_DBF_length;
    }

    public function GetType() {
        return $this->ipt_DBF_type;
    }

    public function SetTable($p_table) {
        $this->ipt_DBF_table = $p_table;
        return true;
    }

    public function GetTable() {
        return $this->ipt_DBF_table->GetName();
    }

    // Rest of the GetDbFieldType method and CreateField method...
}
?>
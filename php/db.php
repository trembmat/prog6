<?php

include_once($_SESSION['IPT_VARS_DIR'] . "_vars.php");
include_once($_SESSION['IPT_VARS_DIR'] . "dbtable.php");
include_once($_SESSION['IPT_VARS_DIR'] . "dbfield.php");
include_once($_SESSION['IPT_VARS_DIR'] . "dblink.php");

/*
Source: ipt/db.php
Created: 2013-06-26
By: Mathieu Tremblay

All rights reserved.
*/

class iptDb {
    private $ipt_DB_link;
    private $ipt_DB_name;
    private $ipt_DB_tables = [];

    public function __construct($p_dblink = null, $p_dbname = "") {
        $this->ipt_DB_name = $p_dbname;
        $this->ipt_DB_link = $p_dblink;
        if ($p_dbname != "") {
            $this->Connect();
        }
    }          

    public function AddTable($p_table) {
        $this->ipt_DB_tables[] = $p_table;
    }
  
    public function ListTables() {
        // Logic to list tables in the database
        // ...
    }
  
    public function Create($p_dbname = "") {
        if ($p_dbname != "") {
            $this->ipt_DB_name = $p_dbname;
        }
        $this->CreateDb();
    }
  
    private function CreateDb() {
        if ($this->ipt_DB_name == "") {
            echo "#1300005 Error... Database name not specified!";
            return;
        } elseif (!$this->DbObject()) {
            echo "#1300006 Error... Database link is inactive!";
            return;
        }

        // Create database logic using mysqli
        // Example (you may need to adjust this based on your dblink object structure):
        if ($this->ipt_DB_link->ipt_DBF_type == IPT_DB_TYPE_MYSQL) {
            if (!$this->Connect()) {
                $query = "CREATE DATABASE " . $this->ipt_DB_name;
                if (mysqli_query($this->DbObject(), $query)) {
                    // Database created successfully
                } else {
                    echo "Error creating database: " . mysqli_error($this->DbObject());
                }
            }
            $this->ipt_DB_link->SetDbName($this->ipt_DB_name);
            return true;
        } else {
            echo "#1300008 Database format not supported.";
            return;
        }
    }
  
    public function DbObject() {
        return $this->ipt_DB_link->DbObject(); // Ensure this method returns a mysqli object
    }
  
    public function Connect($p_dbname = "") {
        if ($p_dbname != "") {
            $this->ipt_DB_name = $p_dbname;
        }
        return mysqli_select_db($this->DbObject(), $this->ipt_DB_name);
    } 

    public function SwitchDb($p_dbname) {
        $this->ipt_DB_name = $p_dbname;
        return mysqli_select_db($this->DbObject(), $this->ipt_DB_name);
    }

    public function CreateDatabase($pName) {
        $this->ipt_DB_name = $pName;
        return $this->CreateDb();
    }  
}

?>
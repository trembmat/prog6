<?php

include_once($_SESSION['IPT_VARS_DIR']."_vars.php");

/*
Source: ipt/dbstructure.php
Created: 2013-06-26
By: Mathieu Tremblay

All rights reserved.
*/

class iptDbLink {
    private $ipt_DBL_db;
    private $ipt_DBF_location;
    private $ipt_DBF_username;
    private $ipt_DBF_dbname;
    private $ipt_DBF_password;
    private $ipt_DBF_type;

    public function __construct($p_location = null, $p_username = "", $p_password = "", $p_dbname = "", $p_type = IPT_DB_TYPE_MYSQL) {
        $this->ipt_DBF_location = $p_location;
        $this->ipt_DBF_username = $p_username;
        $this->ipt_DBF_password = $p_password;
        $this->ipt_DBF_dbname = $p_dbname;
        $this->ipt_DBF_type = $p_type;
        $this->TestDbLink();
    }

    public function GetDbName() {
        return $this->ipt_DBF_dbname;
    }   

    public function SetDbName($p_name) {
        $this->ipt_DBF_dbname = $p_name;
    } 

    public function GetType() {
        return $this->ipt_DBF_type;
    }  

    public function TestDbLink() {
        if (!$this->ipt_DBL_db) {
            $this->Connect(); 
        }   
        return $this->ipt_DBL_db ? true : false;
    }

    public function Connect() {
        if (!$this->ipt_DBL_db) {
            if ($this->ipt_DBF_type == IPT_DB_TYPE_MYSQL) {
                $this->ipt_DBL_db = mysqli_connect($this->ipt_DBF_location, $this->ipt_DBF_username, $this->ipt_DBF_password, $this->ipt_DBF_dbname);
                if (!$this->ipt_DBL_db) {
                    echo "#1300012 Connection impossible: " . mysqli_connect_error();
                }
            } else {
                echo "#1300013 Sorry, this database type is not currently recognized.";
            }
        }
    }

    public function Close() {
        if ($this->ipt_DBL_db) {
            mysqli_close($this->ipt_DBL_db);
        }
    }

    public function DbObject() {
        return $this->ipt_DBL_db;
    }

    public function CreateDatabase($pName) {
        $sql = "CREATE DATABASE " . $pName;
        if (mysqli_query($this->ipt_DBL_db, $sql)) {
            return true;
        } else {
            echo "Error creating database: " . mysqli_error($this->ipt_DBL_db);
            return false;
        }
    }
}

?>
<?php
    class Connect extends PDO
    {
        public function __construct()
        {
            /*
            $username="u21434558";
            $host = "https://wheatley.cs.up.ac.za";
            $password = "FDTLBW5E5AFRTWNBOT4PZBHIJWY2Y4KT";
            parent::__construct("mysql:host=localhost;dbname=u21434558",$username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);*/
            $host = "wheatley.cs.up.ac.za";
            parent::__construct("mysql:host=$host;dbname=u21434558", 'u21434558', 'FDTLBW5E5AFRTWNBOT4PZBHIJWY2Y4KT', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
    }
?>
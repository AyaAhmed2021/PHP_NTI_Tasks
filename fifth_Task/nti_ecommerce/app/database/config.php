<?php

class config
{
    private $hostname = 'localhost';
    private $username = 'root';
    private $password = '';
    private $databasename = 'nti_ecommerce';

    private $con;

    public function __construct()
    {
        $this->con = new mysqli($this->hostname , $this->username, $this->password, $this->databasename);

        // if ($this->con->connect_error) {
        //     die("Connection failed: " . $this->con->connect_error);
        //   }
        //   echo "Connected successfully";
    }

    public function runDML(string $query) :bool
    {
        $result = $this->con->query($query);
        if($result){
            return true;
        }
        else {
            return false;
        }
    }

    public function runDQL(string $query)
    {
        $result = $this->con->query($query);
        // echo $result;die;
        if($result){
            return $result;
        } else {
            return [];
        }
    }
}

// $obj = new config;



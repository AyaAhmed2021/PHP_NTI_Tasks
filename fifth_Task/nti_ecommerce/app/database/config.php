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

        // if ($con->connect_error) {
        //     die("Connection failed: " . $mysqli->connect_error);
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

    public function runDQL(string $query) :array|object
    {
        $result = $this->con->query($query);
        if($result->num_rows > 0){
            return $result;
        } else {
            return [];
        }
    }
}

// $obj = new config;



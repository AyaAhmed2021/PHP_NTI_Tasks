<?php
include_once __DIR__."\..\database\config.php";
class Validation{
    private $errors= [];
    private $name;
    private $value;

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }
    public function required():string 
    {
        if(empty($this->value)){
            $this->errors['Required'.$this->name] = '<div class="alert alert-danger">'.$this->name . ' is Required'.'</div>';
            return $this->errors['Required'.$this->name];
        }
        else {
            $this->errors['Required'.$this->name] = '';
            return $this->errors['Required'.$this->name];
        }
    }

    public function pattern($pattern){

        return (preg_match($pattern, $this->value)? "":$this->name." is invalid");
    }

    public function unique($table){
        $query = "SELECT * FROM `$table` WHERE `$this->name` = `$this->value`";
        $config = new config;
        $result = $config -> runDQL($query);

        return (empty($result)? "" : "this $this->name is already exist");
    }

    public function confirmation($valueConfirmation){
        return ($this->value == $valueConfirmation) ? "" : $this->name . " not confirmed";
    }
}
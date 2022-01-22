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
        if(preg_match($pattern, $this->value)){
            $this->errors['Regex'.$this->name] = '';
            return $this->errors['Regex'.$this->name];
            
        }
        else {
           $this->errors['Regex'.$this->name] = '<div class="alert alert-danger">'.$this->name . ' is Invalid'.'</div>';
            return $this->errors['Regex'.$this->name];
        }
    }

    public function unique($table){
        $query = "SELECT * FROM `$table` WHERE `$this->name` = '$this->value'";
    //    print_r($query) ;die;
        $config = new config;
        $result = $config -> runDQL($query);
        // print_r($result) ;die;
        if(empty($result)){
            $this->errors['Unique'.$this->name] = '';
            return $this->errors['Unique'.$this->name];
        }
        else {
            $this->errors['Unique'.$this->name] = '<div class="alert alert-danger">'.$this->name . ' is already exists'.'</div>';
            return $this->errors['Unique'.$this->name];
        }
    }

    public function confirmation($valueConfirmation){
        return ($this->value == $valueConfirmation) ? "" : $this->name . " not confirmed";
    }
}
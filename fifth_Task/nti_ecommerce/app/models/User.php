<?php
include_once __DIR__ . "\..\database\config.php";
include_once __DIR__ . "\..\database\operations.php";

class User extends config implements operations
{
    private $id;
    private $first_name;
    private $last_name;
    private $gender;
    private $email;
    private $password;
    private $phone;
    private $code;
    private $email_verified_at;
    private $status;
    private $image;
    private $created_at;
    private $updated_at;


    /**
     * Get & Set the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get & set the value of first_name
     */
    public function getFirst_name()
    {
        return $this->first_name;
    }
    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get & set the value of last_name
     */
    public function getLast_name()
    {
        return $this->last_name;
    }
    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = sha1($password);

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of email_verfied_at
     */
    public function getEmail_verfied_at()
    {
        return $this->email_verfied_at;
    }

    /**
     * Set the value of email_verfied_at
     *
     * @return  self
     */
    public function setEmail_verfied_at($email_verfied_at)
    {
        $this->email_verfied_at = $email_verfied_at;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function create()
    {
        // echo 'hello from create';
        $query = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `phone`, `password`,`gender`, `code`) 
        VALUES ('$this->first_name', '$this->last_name', '$this->email', '$this->phone' , 
        '$this->password', '$this->gender', $this->code)";

        // var_dump($this->runDML($query));

        return $this->runDML($query);
    }

    public function read()
    {
    }

    public function update()
    {
        $image = NULL;
        if ($this->image) {
            $image = ", $this->image";
        }
        $query = "UPDATE users SET first_name='$this->first_name', last_name='$this->last_name',
         phone='$this->phone', gender='$this->gender' $image WHERE email='$this->email'";

         return $this->runDML($query);
    }

    public function delete()
    {
    }

    public function checkcode()
    {
        // echo "Hello from checkcode";
        $query = "SELECT * FROM `users` WHERE email = '$this->email' AND code = '$this->code'";

        // print_r($this->runDQL($query)) ;
        return $this->runDQL($query);
    }

    public function makeuserverified()
    {
        // echo "Hello from makeuserverified";
        $query = "UPDATE `users` SET email_verfied_at = '$this->email_verified_at', status ='$this->status' WHERE email='$this->email' ";

        // var_dump($this->runDML($query));
        return $this->runDML($query);
    }

    public function login()
    {
        $query = "SELECT * FROM users WHERE email='$this->email' AND password = '$this->password'";

        return $this->runDQL($query);
    }

    public function getUserByEmail()
    {
        $query = "SELECT * FROM users WHERE email='$this->email'";

        return $this->runDQL($query);
    }

    public function updateCodeByEmail()
    {
        $query = "UPDATE users SET code ='$this->code' WHERE email='$this->email'";

        return $this->runDML($query);
    }

    public function updatePasswordByEmail()
    {
        $query = "UPDATE users SET password ='$this->password' WHERE email='$this->email'";

        return $this->runDML($query);
    }
}

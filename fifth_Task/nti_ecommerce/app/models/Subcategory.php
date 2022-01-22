<?php
include_once __DIR__ . "\..\database\config.php";
include_once __DIR__ . "\..\database\operations.php";

class Subcategory extends config implements operations
{
    private $name_en;
    private $name_ar;
    private $status;
    private $image;

    private $Category_id;
    private $created_at;
    private $update_at;

    /**
     * Get the value of name_en
     */
    public function getName_en()
    {
        return $this->name_en;
    }

    /**
     * Set the value of name_en
     *
     * @return  self
     */
    public function setName_en($name_en)
    {
        $this->name_en = $name_en;

        return $this;
    }

    /**
     * Get the value of name_ar
     */
    public function getName_ar()
    {
        return $this->name_ar;
    }

    /**
     * Set the value of name_ar
     *
     * @return  self
     */
    public function setName_ar($name_ar)
    {
        $this->name_ar = $name_ar;

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
     * Get the value of update_at
     */
    public function getUpdate_at()
    {
        return $this->update_at;
    }

    /**
     * Set the value of update_at
     *
     * @return  self
     */
    public function setUpdate_at($update_at)
    {
        $this->update_at = $update_at;

        return $this;
    }

    /**
     * Get the value of Category_id
     */
    public function getCategory_id()
    {
        return $this->Category_id;
    }

    /**
     * Set the value of Category_id
     *
     * @return  self
     */
    public function setCategory_id($Category_id)
    {
        $this->Category_id = $Category_id;

        return $this;
    }
    public function create()
    {
    }
    public function read()
    {
    }
    public function update()
    {
    }
    public function delete()
    {
    }

    public function getSubsByCats()
    {
        $query = "SELECT id,name_en FROM `subcategories` WHERE `Category_id`='$this->Category_id' AND `status`='$this->status' ORDER BY `name_en`";

        // print_r($this->runDQL($query));die;
        return $this->runDQL($query);
    }
}

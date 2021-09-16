<?php


namespace App\Services\Settings\dto;


use App\Services\DTO\BaseDTO;

class ConfigDTO extends BaseDTO
{
    private $id;
    private $title;
    private $code;
    private $description;
    private $values;
    private $type;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return ConfigDTO
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return ConfigDTO
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     * @return ConfigDTO
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return ConfigDTO
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param mixed $values
     * @return ConfigDTO
     */
    public function setValues($values)
    {
        $this->values[] = $values;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return ConfigDTO
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * enable model write to json
     * @return string
     */
    public function __toString(){
        return $this->jsonfy(get_object_vars($this));
    }



}

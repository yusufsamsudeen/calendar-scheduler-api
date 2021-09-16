<?php


namespace App\Services\Settings\dto;


use App\Services\DTO\BaseDTO;

class ConfigValue extends BaseDTO
{
    private $id;
    private $value;
    private $code;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return ConfigValue
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return ConfigValue
     */
    public function setValue($value)
    {
        $this->value = $value;
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
     * @return ConfigValue
     */
    public function setCode($code)
    {
        $this->code = $code;
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

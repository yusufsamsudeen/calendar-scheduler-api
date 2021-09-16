<?php


namespace App\Services\Settings\dto;


use App\Services\DTO\BaseDTO;

class SettingDTO extends BaseDTO
{
    private $module;
    private $details;

    /**
     * @return mixed
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param mixed $module
     * @return SettingDTO
     */
    public function setModule($module)
    {
        $this->module = $module;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param mixed $details
     * @return SettingDTO
     */
    public function setDetails($details)
    {
        $this->details = $details;
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

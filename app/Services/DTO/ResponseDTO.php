<?php


namespace App\Services\DTO;


class ResponseDTO extends BaseDTO
{
    private $code;
    private $body;
    private $description;
    private $hasError = false;
    private $errorMessages;

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;
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
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function hasError()
    {
        return $this->hasError;
    }

    /**
     * @param mixed $hasError
     * @return ResponseDTO
     */
    public function setHasError($hasError)
    {
        $this->hasError = $hasError;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorMessages()
    {
        return $this->errorMessages;
    }

    /**
     * @param mixed $errorMessages
     * @return ResponseDTO
     */
    public function setErrorMessages($errorMessages)
    {
        $this->errorMessages = $errorMessages;
        return $this;
    }




    public function morphToJSON(){
        $var = get_object_vars($this);
        foreach($var as &$value){
            if(is_object($value) && method_exists($value,'morphToJSON')){
                $value = $value->morphToJSON();
            }
        }
        return $var;
    }

    /**
     * enable model write to json
     * @return string
     */
    public function __toString(){
        return $this->jsonfy(get_object_vars($this));
    }
}

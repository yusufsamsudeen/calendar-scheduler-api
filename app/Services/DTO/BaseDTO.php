<?php


namespace App\Services\DTO;


use App\Services\HelperClass;

class BaseDTO
{
    public function jsonfy($objList){
        foreach($objList as $i=>$obj){
            if(is_object($obj)){
                $o = $obj->__toString();
                if(HelperClass::isJson($o)){
                    $o = json_decode($o);
                }
                $objList[$i] = $o;
            }
            elseif(is_array($obj)){
                $o = $this->jsonfy($obj);
                if(HelperClass::isJson($o)){
                    $o = json_decode($o);
                }
                $objList[$i] = $o;
            }

        }
        return json_encode($objList, JSON_PRETTY_PRINT);
    }

    /**
     * enable model write to json
     * @return string
     */
    public function __toString(){
        return $this->jsonfy(get_object_vars($this));
    }

}

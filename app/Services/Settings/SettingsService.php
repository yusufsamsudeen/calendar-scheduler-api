<?php


namespace App\Services\Settings;


use App\Models\Config;
use App\Models\Module;
use App\Services\DTO\ResponseDTO;
use App\Services\Settings\dto\ConfigDTO;
use App\Services\Settings\dto\SettingDTO;
use Illuminate\Support\Facades\DB;

class SettingsService
{
    private $responseDTO;

    /**
     * SettingsService constructor.
     * @param $responseDTO
     */
    public function __construct(ResponseDTO $responseDTO)
    {
        $this->responseDTO = $responseDTO;
    }

    public function createSettings(SettingDTO $settingDTO){

    }

    public function getSettings($module){
        $module = Module::where("key", "=", $module)->first();
        if ($module===null)
            return;

        $configs = DB::table("configs AS config")
            ->select(["config.*","config_value.*",DB::raw("config.key as config_key"),
                DB::raw("config_value.code as config_value_key"), DB::raw("config_value.id as value_id")])
            ->join("config_values AS config_value", "config.id", "=", "config_value.config_id")
            ->where("config.module_id", "=", $module->id)->get();
        $values = [];
        $list = [];
        $configDTO = null;
        $available = [];
        foreach ($configs as $config){
            $value = ["code" => $config->config_value_key, "value" => $config->value, "id" => $config->value_id,
                "selected" => $config->selected];
            if (!array_key_exists($config->config_id, $values)){
                if ($configDTO!=null)
                    $list[] = $configDTO;

                $configDTO = new ConfigDTO();
                $available[] = $config->config_id;
                $configDTO->setId($config->config_id)
                    ->setCode($config->key)
                    ->setDescription($config->description)
                    ->setTitle($config->title)
                    ->setType($config->type)
                    ->setValues($value);
            }else{
                $configDTO->setValues($value);
            }

            $values[$config->config_id][] = $value;

        }
        $list[] = $configDTO;

        $configs = Config::whereNotIn("id", $available)->get();
        foreach ($configs as $config){
            $configDTO = new ConfigDTO();

            $configDTO->setId($config->id)
                ->setCode($config->key)
                ->setDescription($config->description)
                ->setTitle($config->title)
                ->setType($config->type);

            $list[] = $configDTO;
        }

        $settings = new SettingDTO();
        $settings->setModule($module->name)
            ->setDetails($list);


        return$this->responseDTO->setDescription("Settings query successful")
            ->setBody($settings)
            ->setCode(200);
    }


}

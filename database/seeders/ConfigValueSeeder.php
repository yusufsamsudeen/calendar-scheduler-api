<?php

namespace Database\Seeders;

use App\Models\Config;
use App\Models\ConfigValue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ConfigValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config_values = [
            "default_view" => [
                ["code" => "month", "name" => "Month", "selected" => false],
                ["code" => "week", "name" => "Week", "selected" => false],
                ["code" => "day", "name" => "Day", "selected" => true],
            ],
            "events_color_by" => [
                ["code" => "teacher", "name" => "Teacher", "selected" => true],
                ["code" => "location", "name" => "Location", "selected" => false],
                ["code" => "student", "name" => "Student", "selected" => false],
                ["code" => "service", "name" => "Service", "selected" => false],
            ],
            "time_slot" => [
                ["code" => "60min", "name" => "60 Minutes", "selected" => true],
                ["code" => "45min", "name" => "45 Minutes", "selected" => false],
                ["code" => "30min", "name" => "30 Minutes", "selected" => false],
            ],
            "snap_minutes" => [
                ["code" => "60min", "name" => "60 Minutes", "selected" => true],
                ["code" => "45min", "name" => "45 Minutes", "selected" => false],
                ["code" => "30min", "name" => "30 Minutes", "selected" => false],
            ],
            "time_picker_step" => [
                ["code" => "5min", "name" => "5 Minutes", "selected" => true],
                ["code" => "10min", "name" => "10 Minutes", "selected" => false],
                ["code" => "15min", "name" => "15 Minutes", "selected" => false],
                ["code" => "30min", "name" => "30 Minutes", "selected" => false],
            ],
            "first_hour" => [],
            "resource_view_minimum" => [],
            "resource_view_maximum" => [],
            "max_allowed_duration" => [],
            "first_day" => [
                ["code" => "sunday", "name" => "Sunday", "selected" => true],
                ["code" => "monday", "name" => "Monday", "selected" => false],
            ],
            "title_auto_fill" => [
                ["code" => "on", "name" => "On", "selected" => true],
                ["code" => "off", "name" => "Off", "selected" => false],
            ],
            "require_student" => [
                ["code" => "on", "name" => "On", "selected" => true],
                ["code" => "off", "name" => "Off", "selected" => false],
            ],
            "include_prospective_student" => [
                ["code" => "on", "name" => "On", "selected" => true],
                ["code" => "off", "name" => "Off", "selected" => false],
            ],
            "copy_lesson" => [
                ["code" => "on", "name" => "On", "selected" => true],
                ["code" => "off", "name" => "Off", "selected" => false],
            ],
            "manual_reminder" => [
                ["code" => "on", "name" => "On", "selected" => true],
                ["code" => "off", "name" => "Off", "selected" => false],
            ],
        ];

        try{
            DB::beginTransaction();
            foreach ($config_values as $key => $config_value) {
                $config = Config::where("key", "=", $key)->first();
                if ($config === null)
                    continue;

                switch ($key) {
                    case "first_hour":
                    case "resource_view_minimum":
                    case "resource_view_maximum":
                        $this->setTime($config->id);
                        break;
                    case "max_allowed_duration":
                        $this->setDuration($config->id);
                        break;
                    default:
                        foreach ($config_value as $value)
                            $this->setValue($config->id, $value);
                        break;
                }



            }
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error($exception);
            echo $exception;
        }

    }

    function setTime($config_id)
    {
        foreach (range(1, 12) as $v) {
            $details = ["code" => "$v" . "am", "name" => "$v AM", "selected" => $v == 1];
            $this->setValue($config_id, $details);
        }

        foreach (range(1, 12) as $v) {
            $details = ["code" => "$v" . "pm", "name" => "$v PM", "selected" => $v == 1];
            $this->setValue($config_id, $details);
        }
    }

    function setDuration($config_id)
    {
        foreach (range(1, 24) as $v) {
            $details = ["code" => "$v", "name" => "$v", "selected" => $v == 1];
            $this->setValue($config_id, $details);
        }
    }

    function setValue($config_id, $value)
    {
        $valueModel = new ConfigValue();
        $valueModel->config_id = $config_id;
        $valueModel->value = $value["name"];
        $valueModel->code = $value["code"];
        $valueModel->selected = $value["selected"];
        $valueModel->save();
    }
}

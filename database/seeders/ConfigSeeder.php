<?php

namespace Database\Seeders;

use App\Models\Config;
use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleConfig = [
            "calendar" => [
                "default_view" => ["title" => "Default View", "type" => "radio", "description" => ""],
                "events_color_by" => ["title" => "Events Color By", "type" => "radio", "description" => ""],
                "time_slot" => ["title" => "Time Slot Minutes", "type" => "dropdown", "description" => "The duration of time slots on the week and day view"],
                "snap_minutes" => ["title" => "Snap Minutes", "type" => "dropdown", "description" => "Time Increment used when selecting start and end times of an event on week and day views"],
                "time_picker_step" => ["title" => "Timepicker Minutes Step", "type" => "dropdown", "description" => "Minute increment on timepicker. Minutes can also be set manually on the timepicker to override this settings"],
                "first_hour" => ["title" => "First Hour", "type" => "dropdown", "description" => "The hour the calendar is scrolled to when the page loads"],
                "first_day" => ["title" => "First Day", "type" => "dropdown", "description" => "The first day of the week"],
                "resource_view_minimum" => ["title" => "Resource View Minimum", "type" => "dropdown", "description" => "Earliest hour visible in a day view of Location and Tutor Calendars"],
                "resource_view_maximum" => ["title" => "Resource View Maximum", "type" => "dropdown", "description" => "Latest hour visible in day view of Location and Tutor View"],
                "title_auto_fill" => ["title" => "Auto fill Lesson Title", "type" => "radio", "description" => "Auto fill student's name as lesson title"],
                "max_allowed_duration" => ["title" => "Maximum Allowed Lesson Duration (Hours)", "type" => "dropdown", "description" => "Avoid accidentally scheduling a lesson that is too long by specifying the maximum allowed duration in hours"],
                "require_student" => ["title" => "Require Student", "type" => "radio", "description" => "Required that at least one student should be selected to schedule a lesson"],
                "include_prospective_student" => ["title" => "Include Prospective Students", "type" => "radio", "description" => "Allow prospective students to be scheduled. By default only active students can be scheduled"],
                "copy_lesson" => ["title" => "Include Prospective Students", "type" => "radio", "description" => "Adds the option to copy a lesson to create a new one"],
                "manual_reminder" => ["title" => "Manual Lesson Reminder", "type" => "radio", "description" => "Allows you to manually send reminders"],
                "internal_note" => ["title" => "Internal Note Template", "type" => "text", "description" => "Internal notes template"],
                "shared_note" => ["title" => "Shared Note Template", "type" => "text", "description" => "Shared notes template"],

            ]
        ];

        try {
            DB::beginTransaction();
            Config::truncate();
            foreach ($moduleConfig as $key => $module) {
                $moduleObject = Module::where("key", "=", $key)->first();
                if ($moduleObject === null)
                    throw new \Exception("Module $key does not exist");

                $module_id = $moduleObject->id;

                foreach ($module as $name => $value) {
                    $config = new Config();
                    $config->title = $value["title"];
                    $config->description = $value["description"];
                    $config->key = $name;
                    $config->type = $value["type"];
                    $config->module_id = $module_id;
                    $config->save();
                }

            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            echo $exception;
            Log::error($exception);
        }
    }
}

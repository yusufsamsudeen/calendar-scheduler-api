<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleNames = ["calendar" =>"Calendar", "invoice" =>"Invoice"];
        try{
            DB::beginTransaction();
            Module::truncate();
            foreach ($moduleNames as $key =>$moduleName){
                $module = new Module();
                $module->name = $moduleName;
                $module->key = $key;
                $module->save();
            }
            DB::commit();
        }catch (\Exception $ex){
            Log::error($ex);
            echo $ex;
            DB::rollBack();
        }

    }
}

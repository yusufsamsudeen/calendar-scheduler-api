<?php

namespace Database\Seeders;

use App\Models\SeedCheck;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seeded = SeedCheck::where("seeded", "=", true)->first();
        if ($seeded!==null)
            return;

        $this->call([
            ModuleSeeder::class,
            ConfigSeeder::class,
            ConfigValueSeeder::class
        ]);

        try{
            DB::beginTransaction();
            $seedCheck = new SeedCheck();
            $seedCheck->seeded = true;
            $seedCheck->save();
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error($exception);
            echo $exception;
        }
    }
}

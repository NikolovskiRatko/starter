<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataMigrationSeeder extends Seeder
{
    /**
     * All the custom migration config classes we create should go here
     * IMPORTANT: The order of seeders in this array is important
     *
     * @var array
     */
    protected $tables = array(
//        TaxonomiesTable::class,
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        $time_start = $this->getStartTime();

        foreach ($this->tables as $table) {
            $this->command->info('Migrating data for ' . $table);

            $message = (new $table())->run();

            $this->command->info($message);
        }

        $this->printEndTime($time_start);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * @return mixed
     */
    private function getStartTime()
    {
        $time_start = microtime(true);

        return $time_start;
    }

    /**
     * @param $time_start
     */
    private function printEndTime($time_start)
    {
        $time_end = microtime(true);
        $time = $time_end - $time_start;

        $this->command->info('Migrated everything in: ' . $time . ' seconds'); 
    }
}

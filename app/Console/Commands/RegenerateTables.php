<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use DB;
use Illuminate\Support\Facades\Schema;
use Artisan;

class RegenerateTables extends Command
{
    use ConfirmableTrait;

    /**
     * Current database name (from env)
     *
     * @var string
     */
    protected $db;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:regenerate {--force : Force the operation to run in production environment.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop and re-create all tables, migrate and seed in current DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->db = env('DB_DATABASE');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // If in production environment, confirm before proceeding
        if (!$this->confirmToProceed()) {
            return;
        }

        if ($this->confirm('Drop and re-create all tables, migrate and seed ?')) {

            Schema::dropAllTables();

            // DB::beginTransaction();

            // // Remove foreign key checking
            // DB::statement('SET FOREIGN_KEY_CHECKS = 0');

            // // Get an array of all table names in project database
            // $tables = DB::select('SHOW TABLES');

            // foreach($tables as $table) {
            //     $table_array = get_object_vars($table);
            //     $table_name = $table_array[key($table_array)];

            //     // Log action to terminal
            //     $this->comment("Dropping {$table_name} table");

            //     // Drop the table
            //     DB::unprepared("DROP TABLE {$table_name}");
            // }

            // // Reset foreign key checks back to 1
            // DB::statement('SET FOREIGN_KEY_CHECKS = 1');

            // // Commit changes into database
            // DB::commit();

            $this->warn("Tables Dropped successfully. Starting from blank database....." . PHP_EOL);

            Artisan::call('migrate', ['--seed' => true]);

            $this->warn("Migration and Seeding completed successfully.");

        } else{
            exit(PHP_EOL . 'Drop Tables command aborted');
        }

    }
}
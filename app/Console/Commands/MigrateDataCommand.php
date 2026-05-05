<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class MigrateDataCommand extends Command
{
    protected $signature = 'db:migrate-sqlite-to-mysql';
    protected $description = 'Migrate data from sqlite to mysql';

    public function handle()
    {
        // Define sqlite connection manually
        Config::set('database.connections.sqlite_temp', [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => database_path('database.sqlite'),
            'prefix' => '',
            'foreign_key_constraints' => false,
        ]);

        // Get all tables from sqlite
        $tables = DB::connection('sqlite_temp')->select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");

        // Disable foreign key checks on mysql
        DB::connection('mysql')->statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach ($tables as $tableInfo) {
            $table = $tableInfo->name;
            
            // Skip migrations table to avoid conflicts with what we just ran
            if ($table === 'migrations') {
                continue;
            }

            $this->info("Migrating table: {$table}");
            
            // Clear existing data in mysql table just in case
            try {
                DB::connection('mysql')->table($table)->truncate();
            } catch (\Exception $e) {
                $this->error("Could not truncate {$table}. Skipping truncation. " . $e->getMessage());
            }
            
            // Fetch data from sqlite
            $data = DB::connection('sqlite_temp')->table($table)->get()->map(function($item) {
                return (array) $item;
            })->toArray();
            
            if (count($data) > 0) {
                $chunks = array_chunk($data, 500);
                foreach ($chunks as $chunk) {
                    try {
                        DB::connection('mysql')->table($table)->insert($chunk);
                    } catch (\Exception $e) {
                        $this->error("Error inserting into {$table}: " . $e->getMessage());
                    }
                }
                $this->info("Inserted " . count($data) . " rows into {$table}");
            } else {
                $this->info("Table {$table} is empty.");
            }
        }

        // Enable foreign key checks on mysql
        DB::connection('mysql')->statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info("Data migration completed successfully!");
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncServerData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:server-data';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data from remote server and insert into local database, then delete from server';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $tableNames = ['sell', 'sell_items']; // Add your tables

        foreach ($tableNames as $table) {
            // Fetch data from remote database
            $serverData = DB::connection('remote')->table($table)->get();

            if ($serverData->isEmpty()) {
                $this->info("No records found in $table.");
                continue;
            }

            // Insert data into local database
            foreach ($serverData as $row) {
                $rowArray = (array) $row; // Convert object to array
                DB::connection('mysql')->table($table)->insert($rowArray);
            }

            // Delete records from the remote database
            DB::connection('remote')->table($table)->delete();

            $this->info("Data from $table synced successfully!");
        }

        return Command::SUCCESS; // Return success code
    }
}

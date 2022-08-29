<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $schemaName = config("database.connections.mysql.database");

            $query = "DROP DATABASE $schemaName;";
            DB::statement($query);

            config(["database.connections.mysql.database" => null]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}

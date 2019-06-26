<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class ImportStates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:states_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is use to import default states data';

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
     * @return mixed
     */
    public function handle()
    {
        //
        DB::unprepared(file_get_contents('database/states.sql'));
    }
}

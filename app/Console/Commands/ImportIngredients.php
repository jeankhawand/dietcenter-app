<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportIngredients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:ingredientsimport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the .sql file with the area codes of the ingredients.';

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
        if(DB::table('Ingredient')->exists()){
            print_r("table already exist \n");
        }else{
            DB::unprepared(file_get_contents('database/migrations/ingredient.sql'));
        }

    }
}

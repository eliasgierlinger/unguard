<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PDO;

class CreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
        $host = config('app.mariadbHost', '10.107.252.229:3306');
        $rootuser = config('app.mariadbUser', 'root');
        $password = config('app.mariadbPassword', 'no t');

        Log::notice(phpinfo());

        Log::notice('Passwordcheck: ' . $password);
        Log::notice('Addresscheck:' . config('app.mariadbAddress'));

        $connection = new PDO("mysql:host=$host", $rootuser, $password);
        try{
            //$connection->exec('CREATE DATABASE likeDb');
        }catch(PDOException $e){
            Log::notice('Exception');
        }


    }
}

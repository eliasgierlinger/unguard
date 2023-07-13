<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PDO;
use PDOException;

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
        $host = getenv('UNGUARD_MARIADB_SERVICE_HOST', false) . ':' . getenv('UNGUARD_MARIADB_SERVICE_PORT_MYSQL', false);
        $port = getenv('UNGUARD_MARIADB_SERVICE_PORT_MYSQL', false);

        $rootuser = 'root';
        $password = getenv('MARIADB_PASSWORD', false);

        apache_setenv('DB_HOST', $host);
        apache_setenv('DB_USERNAME', $rootuser);

        Log::notice('Addresscheck:' . $host);
        Log::notice(phpinfo());

        $connection = new PDO("mysql:host=$host", $rootuser, $password);
        try{
            $connection->exec('CREATE DATABASE likeDb');
        }catch(PDOException $e){
            Log::notice('Exception, probably due to database "likeDb" already existing');
        }


    }
}

<?php

namespace App\Http\Controllers;

use Spatie\DbDumper\Databases\MySql;
//use Spatie\DbDumper\Databases\Sqlite;

class DownloadController
{
    public function index()
    {
        MySql::create()
//            ->setDbName(config('database.connections.sqlite.database'))
            ->setDbName(config('database.connections.mysql.database'))
            ->setUserName(config('database.connections.mysql.username'))
            ->setPassword(config('database.connections.mysql.password'))
            ->excludeTables(['migrations', 'failed_jobs'])
            ->dumpToFile('dump.sql');

        $headers = array(
         'Content-Type: application/sql',
     );
        return response()->download(file: public_path('dump.sql'), headers: $headers);
    }
}

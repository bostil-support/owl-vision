<?php

namespace App\Helpers\Install;

use App\Models\User;
use Exception;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\BufferedOutput;

class DatabaseManager
{

    /**
     * @param  bool  $withSeeder
     *
     * @return array
     */
    public function runDBActions(bool $withSeeder = false)
    {
        $outputLog = new BufferedOutput;

        try {
            if (DB::connection() instanceof SQLiteConnection) {
                $database = DB::connection()->getDatabaseName();

                if ( ! file_exists($database)) {
                    touch($database);
                    DB::reconnect(Config::get('database.default'));
                }
                $outputLog->write('Using SqlLite database: '.$database, 1);
            }

            Artisan::call('migrate', ["--force" => true], $outputLog);

            if ($withSeeder) {
                Artisan::call('db:seed', ['--force' => true], $outputLog);
            }

            if (session('sampleData')) {
                Artisan::call('db:seed',  [
                    '--force' => true,
                    '--class' => 'CategoriesTableSeeder'
                ], $outputLog);

                session()->forget('sampleData');
            }

            if (session()->has('adminData')) {
                User::query()->create(session('adminData'));

                session()->forget('adminData');
            }
        } catch (Exception $e) {
            session()->forget(['sampleData', 'adminData']);

            return [
                'status'      => $e->getMessage(),
                'message'     => 'error',
                'dbOutputLog' => $outputLog->fetch(),
            ];
        }

        return [
            'status'      => trans('installer_messages.final.finished'),
            'message'     => 'success',
            'dbOutputLog' => $outputLog->fetch(),
        ];
    }

}

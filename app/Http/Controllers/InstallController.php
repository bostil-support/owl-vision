<?php

namespace App\Http\Controllers;

use App\Helpers\Config;
use App\Http\Requests\InstallRequest;
use App\User;
use Illuminate\Support\Facades\Artisan;

class InstallController extends Controller
{

    public function index(InstallRequest $request)
    {
        try {
            \DB::connection()->getPdo();

            return redirect('/');
        } catch (\Exception $e) {
            if ($request->isMethod('post')) {
                try {
                    // Check database connection
                    $db = new \PDO("mysql:host={$request->db_host};dbname={$request->db_name}",
                        $request->db_user, ($request->db_password ?? ''));
                    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                    // Create .env file
                    Config::setEnv('DB_HOST', $request->db_host);
                    Config::setEnv('DB_DATABASE', $request->db_name);
                    Config::setEnv('DB_USERNAME', $request->db_user);
                    Config::setEnv('DB_PASSWORD', $request->db_password);
                    Config::setEnv('APP_URL', '.'.$request->server('REQUEST_SCHEME').'://'.$request->server('HTTP_HOST'));
                    Config::setEnv('SESSION_DOMAIN', '.'.$request->server('HTTP_HOST'));
                    Config::setEnv('AIRLOCK_STATEFUL_DOMAINS', $request->server('HTTP_HOST'));
                    Artisan::call('cache:clear');

                    if ($request->sample_data) {
                        Artisan::call('db:seed --class=CategoriesTableSeeder');
                    }

                    User::query()->create([
                        'name'     => $request->admin_name,
                        'email'    => $request->admin_email,
                        'password' => bcrypt($request->password)
                    ]);
                } catch (\Throwable $exception) {
                    $request->flash();
                    session()->flash('exception', $exception->getMessage());
                    session()->flash('exception2', 'ok');

                    return back();
                }
            }

            return view('install');
        }
    }

}

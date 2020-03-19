<?php

namespace App\Http\Controllers\Install;

use Illuminate\Routing\Controller;
use App\Helpers\Install\InstalledFileManager;
use App\Helpers\Install\DatabaseManager;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{

    /**
     * @return string|string[]
     */
    public function getMigrations()
    {
        $migrations = glob(database_path().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR.'*.php');

        return str_replace('.php', '', $migrations);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getExecutedMigrations()
    {
        return DB::table('migrations')->get()->pluck('migration');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome()
    {
        return view('install.update.welcome');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function overview()
    {
        $migrations = $this->getMigrations();
        $dbMigrations = $this->getExecutedMigrations();

        return view('install.update.overview', ['numberOfUpdatesPending' => count($migrations) - count($dbMigrations)]);
    }

    /**
     * @param  \App\Helpers\Install\DatabaseManager  $manager
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function database(DatabaseManager $manager)
    {
        $response = $manager->runDBActions();

        return redirect()->route('update.final')
            ->with(['message' => $response]);
    }

    /**
     * @param  \App\Helpers\Install\InstalledFileManager  $manager
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(InstalledFileManager $manager)
    {
        $manager->update();

        return view('install.update.finished');
    }
}

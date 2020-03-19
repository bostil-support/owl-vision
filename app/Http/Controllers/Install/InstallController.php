<?php

namespace App\Http\Controllers\Install;

use App\Events\EnvironmentSaved;
use App\Events\InstallerFinished;
use App\Helpers\Install\DatabaseManager;
use App\Helpers\Install\EnvironmentManager;
use App\Helpers\Install\InstalledFileManager;
use App\Helpers\Install\PermissionsChecker;
use App\Helpers\Install\RequirementsChecker;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

class InstallController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome()
    {
        return view('install.welcome');
    }

    /**
     * @param  \App\Helpers\Install\RequirementsChecker  $checker
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function requirements(RequirementsChecker $checker)
    {
        $phpInfo      = $checker->checkPHP(config('installer.core.minPhpVersion'));
        $requirements = $checker->check(config('installer.requirements'));

        return view('install.requirements', compact('requirements', 'phpInfo'));
    }

    /**
     * @param  \App\Helpers\Install\PermissionsChecker  $checker
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function permissions(PermissionsChecker $checker)
    {
        $permissions = $checker->check(config('installer.permissions'));

        return view('install.permissions', compact('permissions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function environment()
    {
        return view('install.environment');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Helpers\Install\EnvironmentManager  $manager
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function saveEnvironment(
        Request $request,
        EnvironmentManager $manager
    ) {
        $rules = config('installer.environment.form.rules');

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $request->flash();

            return view('install.environment', compact('errors'));
        }

        $results = $manager->saveFile($request);

        event(new EnvironmentSaved());

        $adminData = [
            'name'     => $request->admin_name,
            'email'    => $request->admin_email,
            'password' => bcrypt($request->admin_password),
        ];

        return redirect()->route('install.database')
            ->with([
                'results' => $results,
                'adminData' => $adminData,
                'sampleData' => $request->has('sample_data')
            ]);
    }

    /**
     * @param  \App\Helpers\Install\DatabaseManager  $manager
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function database(DatabaseManager $manager, Redirector $redirector)
    {
        $response = $manager->runDBActions(true);

        return $redirector->route('install.final')
            ->with(['message' => $response]);
    }

    /**
     * @param  \App\Helpers\Install\InstalledFileManager  $fileManager
     * @param  \App\Helpers\Install\EnvironmentManager  $environment
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(
        InstalledFileManager $fileManager,
        EnvironmentManager $environment
    ) {
        $finalStatusMessage = $fileManager->update();

        event(new InstallerFinished);

        return view('install.finished', compact('finalStatusMessage'));
    }

}

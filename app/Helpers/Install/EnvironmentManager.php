<?php

namespace App\Helpers\Install;

use Exception;
use Illuminate\Http\Request;

class EnvironmentManager
{

    /**
     * @var string
     */
    private $envPath;

    /**
     * @var string
     */
    private $envExamplePath;

    /**
     * EnvironmentManager constructor.
     */
    public function __construct()
    {
        $this->envPath        = base_path('.env');
        $this->envExamplePath = base_path('.env.example');
    }

    /**
     * @return false|string
     */
    public function getEnvContent()
    {
        if ( ! file_exists($this->envPath)) {
            if (file_exists($this->envExamplePath)) {
                copy($this->envExamplePath, $this->envPath);
            } else {
                touch($this->envPath);
            }
        }

        return file_get_contents($this->envPath);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function saveFile(Request $request)
    {
        try {
            $this->setEnv('APP_DEBUG', "false");
            $this->setEnv('APP_NAME', "\"{$request->app_name}\"");
            $this->setEnv('APP_URL', $request->app_url);
            $this->setEnv('MIX_APP_URL', $request->app_url);
            $this->setEnv('DB_CONNECTION', $request->database_connection);
            $this->setEnv('DB_HOST', $request->database_hostname);
            $this->setEnv('DB_PORT', $request->database_port);
            $this->setEnv('DB_DATABASE', $request->database_name);
            $this->setEnv('DB_USERNAME', $request->database_username);
            $this->setEnv('DB_PASSWORD', $request->database_password);

            $results = trans('installer_messages.environment.success');
        } catch (Exception $e) {
            $results = trans('installer_messages.environment.errors');
        }

        return $results;
    }


    /**
     * @param  string  $key
     * @param  string|null  $value
     *
     * @return bool
     */
    public function setEnv(string $key, ?string $value = null): bool
    {
        $path = app()->environmentFilePath();
        $escaped = preg_quote('='.env($key), '/');

        return file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path)
        ));
    }

}

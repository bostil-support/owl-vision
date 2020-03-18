<?php

namespace App\Helpers;

class Config
{

    /**
     * @param  string  $key
     * @param  string|null  $value
     *
     * @return bool
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function setEnv(string $key, ?string $value = null): bool
    {
        $envContent = \File::get(base_path('.env'));

        if (preg_match("/$key.+\\n/", $envContent)) {
            $envContent = preg_replace("/$key.+\\n/", "$key=$value\n",
                $envContent);

            return \File::put(base_path('.env'), $envContent) !== false;
        } else {
            return file_put_contents(base_path('.env'), "$key=$value\n",FILE_APPEND);
        }
    }

}
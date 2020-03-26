<?php

namespace App\Helpers\Install;

class PermissionsChecker
{

    /**
     * @var array
     */
    protected $results;

    /**
     * PermissionsChecker constructor.
     */
    public function __construct()
    {
        $this->results = [
            'permissions' => [],
            'errors' => null
        ];
    }

    /**
     * @param  array  $folders
     *
     * @return array
     */
    public function check(array $folders)
    {
        foreach($folders as $folder => $permission) {
            if(!($this->getPermission($folder) >= $permission)) {
                $this->addFileAndSetErrors($folder, $permission, false);
            } else {
                $this->addFile($folder, $permission, true);
            }
        }

        return $this->results;
    }

    /**
     * @param $folder
     *
     * @return false|string
     */
    private function getPermission($folder)
    {
        return substr(sprintf('%o', fileperms(base_path($folder))), -4);
    }

    /**
     * @param $folder
     * @param $permission
     * @param $isSet
     */
    private function addFile($folder, $permission, $isSet)
    {
        array_push($this->results['permissions'], [
            'folder' => $folder,
            'permission' => $permission,
            'isSet' => $isSet
        ]);
    }

    /**
     * @param $folder
     * @param $permission
     * @param $isSet
     */
    private function addFileAndSetErrors($folder, $permission, $isSet)
    {
        $this->addFile($folder, $permission, $isSet);

        $this->results['errors'] = true;
    }
}
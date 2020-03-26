<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'recipe/common.php';

inventory('hosts.yml');

$releaseDate = date('Y_m_d_H_i_s');
set('release_name', function () use ($releaseDate) {
    return $releaseDate;
});
set('use_relative_symlinks', false);
// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

after('deploy:update_code', 'upload:env');
after('deploy:failed', 'deploy:unlock');
after('success', 'php-fpm:restart');



task('upload:env', function () {
    if (input()->hasArgument('stage') && input()->getArgument('stage') == 'prod') {
        upload('../.env.prod', '{{deploy_path}}/shared/.env');
    } elseif (input()->hasArgument('stage') && input()->getArgument('stage') == 'dev') {
        upload('../.env.dev', '{{deploy_path}}/shared/.env');
    }
});

// The user must have rights for restart service
// /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
//desc('Restart PHP-FPM service if set php_version');
task('php-fpm:restart', function () {
    if(has('php_version')){
        run('sudo systemctl restart php{{php_version}}-fpm.service');
    }
});

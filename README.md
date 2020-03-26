# Owl Vision e-Commerce Platform

## Installation

- clone project from repository into your `project-directory`, example `git clone git@github.com:bostil-support/owl-vision.git project-directory`
- run `sudo chown -R $USER:www-data project-directory`
- run `sudo chmod -R g+rw project-directory`
- run `sudo find project-directory -type d -print0 | sudo xargs -0 chmod g+s`
- run `cd project-directory`
- run `composer install`
- run `cp .env.example .env`
- run `php artisan key:generate`
- run `chmod -R 775 .env storage/framework storage/logs bootstrap/cache`
- run `npm install`
- run `npm run production`
- go to the `/install` page of your site and follow the instruction, example `http://site.com/install`

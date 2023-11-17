# NVisualiser

NVisualiser is a web application that provides tools for interacting with and visualising NHANES data

## Requirements

- PHP: https://www.php.net/
- Composer: https://getcomposer.org/
- Docker: https://www.docker.com/

## Getting Started

- You will need to copy `.env.example` to `.env` and make suitable modifications
- You should run `composer install`
- If it is the first time running, you will need to perform `php artisan key:generate`
- You can then start the containers by running `./vendor/bin/sail up -d`
- Create the database tables and populate with `./vendor/bin/sail artisan migrate:fresh --seed` (Notice the warnings that dataset files aren't present. You can download these from NHANES, e.g. using [nhanes_utils](https://github.com/Toby-Rea/nhanes_utils), then move the files to the specified locations, then run this command again)
- You should install the NPM dependencies with `./vendor/bin/sail npm install`
- Run vite with `./vendor/bin/sail npm run dev` then you should be able to access the application at `0.0.0.0`

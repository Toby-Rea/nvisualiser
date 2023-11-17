# NVisualiser

NVisualiser is a web application that provides tools for interacting with and visualising NHANES data

## Getting Started

- You will need to copy `.env.example` to `.env` and make suitable modifications
- You should run `composer install`
- If it is the first time running, you will need to perform `php artisan key:generate`
- You can then start the containers by running `./vendor/bin/sail up -d`
- Create the database tables and populate with `./vendor/bin/sail artisan migrate:fresh --seed`
- You should install the NPM dependencies with `./vendor/bin/sail npm install`
- Run vite with `./vendor/bin/sail npm run dev` then you should be able to access the application at `localhost:5173`

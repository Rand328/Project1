<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Run the project

To run the project, open the terminal in VS Code or in your terminal in the folder where your project is located. 
Run the command `npm install` to install the needed files or ensure that you have them, then run `npm run dev`.
Keep it running and open a different terminal and go to the same location as the first terminal. 

Here we are going to set the database connection. Open xampp and start your Apache and mySQL, then go back to your terminal and run `php artisan migrate:fresh --seed`. If it refuses to migrate because it didn't find the database "laraveldb", run the migration and seeding steps seperatly as follows: 

`php artisan migrate`

`php artisan db:seed`

This would solve your problem.

Finally, when that is all set we can run the project. In your terminal run the following command: `php artisan serve` and open the link you get. 


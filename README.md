<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Author Hari Yadav

# process to setup
-
- [Clone the project from git]
- [Put it on you local server ]
- [Go to project directory from terminal]
- [Hit the command -> update composer ]
- [Create databse ]
- [In project directory rename the .env.example file to .env ]
- [Configure the mysql and database detils in .env file ]
- [Hit the command -> php artisan key:generate ]
- [Hit the command -> php artisan migrate ]


## TODO
1- DBNAME is not proper
2- In user_profiles table created_by and update_by column is missing
3- Create a utility call Logger
4- What is use of $input extra varriable in app/Http/Controllers/Profile/ProfileController.php-> profile_create function
5- app/Http/Controllers/Profile/ProfileController.php->getpincode URL should come from the config
6- why you have added use Illuminate\Support\Facades\DB; in the controller. 
7- status coluon is missing in user_profiles table




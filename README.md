# gmj-laravel_block2_video

Laravel Block for backend and frontend - need tailwindcss support

**composer require gmj/laravel_block2_video**

in terminal run:

```
php artisan vendor:publish --provider="GMJ\LaravelBlock2Video\LaravelBlock2VideoServiceProvider" --force
php artisan migrate
php artisan db:seed --class=LaravelBlock2VideoSeeder
```

package for test<br>
composer.json#autoload-dev#psr-4: "GMJ\\LaravelBlock2Video\\": "package/laravel_block2_video/src/",<br>
config: GMJ\LaravelBlock2Video\LaravelBlock2VideoServiceProvider::class,

# Laravel Sanctum

## Installation
You may install Laravel Sanctum via the Composer package manager: Dependency
 ```bash
composer require laravel/sanctum
```

Next, you should publish the Sanctum configuration and migration files using the vendor:publish Artisan command. The sanctum configuration file will be placed in your application's config directory:
```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

Finally, you should run your database migrations. Sanctum will create one database table in which to store API tokens:
```
php artisan migrate
```

Next, if you plan to utilize Sanctum to authenticate a SPA, you should add Sanctum's middleware to your ***api*** middleware group within your application's ***app/Http/Kernel.php*** file:
```bash
'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
```


Make a product table
```bash
php artisan make:migration create_products_table
```

Table Blueprint
```php
public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->longText('description');
        $table->timestamps();
    });
}
```

Next, you should products table migrate:
```bash
php artisan migrate
```

Make Controller
``bash
php artisan make:controller BaseController

php artisan make:controller Api/RegisterController

php artisan make:controller Api/ProductController
```


## Success Mind Institute

Laravel Rest API Bangla Tutorial Part I (Create Rest API from Scratch)

- [Rest API Part I](https://youtu.be/bK-9vuZoLqc?si=sz2AbfklvolT5QQ_&t=345)
- Thunder Client | postman https://marketplace.visualstudio.com/items?itemName=rangav.vscode-thunder-client

## generat APP_KEY

```bash
php artisan key:gen
```

## Add new controller

```bash
php artisan make:controller ProductController
```

## Add new controller with default 7 methods

```bash
php artisan make:controller ProductController -r
```

## display a list of all registered routes

```bash
php artisan route:list
or
php artisan r:l
```

## Run all pending migrations
```bash
php artisan migrate
```

## create a new migration to add a new table
```bash
php artisan make:migration create_products_table
```
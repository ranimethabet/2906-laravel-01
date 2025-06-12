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
**Notes:**
```
- should start with (create)
- should have (_)
- should have table name
```

```bash
php artisan make:migration create_products
```

## undo last migration
```bash
php artisan migrate:rollback
```

## undo specific number of migrations
```bash
php artisan migrate:rollback --step=5
```

## create a new migration to add a new table
**Notes:**
```
- should start with any description
- should have (_to_) or(_in_)
- should have table name
```
```bash
php artisan make:migration add_price_to_products
php artisan make:migration update_price_in_products
php artisan make:migration delete_price_from_products
```

## undo all migrations at once
```bash
php artisan migrate:reset
```

## undo all migrations at once and then run all migrations
```bash
php artisan migrate:refresh
```

## drop all tables and restart the migration from beginning
```bash
php artisan migrate:fresh
```

## run DatabseSeeder class in database/seeders folder
```bash
php artisan db:seed 
```

## crate model
```bash
php artisan make:model Post
```

## crate seeder
```bash
php artisan make:seeder PostSeeder
```

## run specific seeder
```bash
php artisan db:seed --class=PostSeeder
```

## drop all tables and restart the migration from beginning, then run all seeders in DatabaseSeeder
```bash
php artisan migrate:fresh --seed
```

## Create a model with all other 7 classes
```bash
php artisan make:model Post -a
```

## Create a resource
```bash
php artisan make:resource PostResource
```

## Create a collection
```bash
php artisan make:resource PostCollection
// OR
php artisan make:resource PostResource --collection
```

## Install Sanctum API
```bash
php artisan install:api
```

## create a new request
```bash
php artisan make:request RegisterRequest
```

## create a new mail
```bash
php artisan make:mail VerificationEmail
```

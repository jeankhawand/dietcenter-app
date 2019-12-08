# Diet Center
## Setup

**After repo cloning**
1. copy .env.example and rename it as .env. Then configure the environment variables to fit your local configuration
2. Generate App Key
```
php artisan key:generate
```
3. Generate password grant token
```
php artisan passport:install --force
```
    
**After each pull from master**
1. Install NPM Dependencies **(at each pull request)**
```
npm install
```
2. Install Laravel Dependencies **(at each pull request)**
```
composer install
```
3. In case of newly repo clone run step 1 - 2 and then **(once no need to redo this step)**
    1. duplicate .env.example to .env and config the environement variables so it would fits your local configuration
    2. run ``` php artisan key:generate ```
4. Import database from google drive to your mysql server
5. in order to compile vueJS Component we need to run **(at each pull request)** :
```
npm run watch
```

6. do migration and then seed data to the tables **(once no need to redo this step)**
```
php artisan migrate:refresh --seed
```
7. generate password grant token **(once no need to redo this step)**
```
php artisan passport:install --force

```
8. then after that we need to run laravel oauth generation .key **if these keys aren't created check storage/oauth-private.key or storage/oauth-public.key**
**(once no need to redo this step)**
```
php artisan passport:keys --force
```
9. next insert ingredients 
**(once no need to redo this step)**
```
php artisan start:ingredientsimport
```



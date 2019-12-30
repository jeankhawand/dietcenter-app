# Diet Center
## Setup

### **After repo cloning**
1. copy .env.example and rename it as .env. Then configure the environment variables to fit your local configuration
2. Generate App Key
```
php artisan key:generate
```

    
### **After each pull from master**
1. Install NPM Dependencies 
```
npm install
```
2. Install Laravel Dependencies 
```
composer install
```
3. in order to compile vueJS Component we need to run  :
```
npm run watch
```

4. do migration and then seed data to the tables 
```
php artisan migrate:refresh --seed
```
5. generate password grant token 
```
php artisan passport:install --force
```



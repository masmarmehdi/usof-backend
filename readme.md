## Requirements

```bash
php : 7.3|8.0
mysql : 8.0.23
Laravel Framework : 8.49.0
```


## Installation
```bash
composer update
cp .env.example .env
php artisan key:generate
```
For the admin lte styles you have to:

```bash
npm install
npm run dev
```
## Usage
First create a database in mysql then:
```bash
php artisan migrate
php artisan serve
php artian db:seed (for fake data and users)
```

<p align="center">
    <img src="https://user-images.githubusercontent.com/63947338/136873969-af36ec9d-58d0-423f-8f63-19f32fef9f91.png" alt="MyBlog logo"/>
</p>

## About the project

  This is a blog web API, which is related to question and answers. It contains only the rest-api for now (back-end), The front-end will be released soon! 

## Languages
<ul>
    <li>php</li>
    <li>mysql</li>
    <li>js</li>
    <li>composer</li>
    <li>npm</li>
 </ul>

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

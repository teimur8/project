## Features

- Laravel 5.5 
- Vue + VueRouter + Vuex + VueI18n
- Pages with custom layouts 
- Login, register and password reset
- Authentication with JWT
- Bootstrap 4 + Font Awesome 5

## Installation

- `composer install`
- Edit `.env` and set your database connection details
- (When installed via git clone or download, run `php artisan key:generate` and `php artisan jwt:secret`)
- `php artisan migrate`
- `yarn` / `npm install`

## Usage

#### Development

```bash
# build and watch
npm run watch

# serve with hot reloading
npm run hot
```

#### Production

```bash
npm run production
```

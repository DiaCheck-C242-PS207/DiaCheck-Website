# DiaCheck

DiaCheck is a diabetes detection application. DiaCheck is present as an innovative application that aims to provide an early diabetes detection tool that is effective, user friendly, simple and fast.
DiaCheck is designed to be a public health partner, helping individuals recognize potential diabetes risks early, take preventative steps, and initiate appropriate management early. With this approach, DiaCheck supports global efforts to reduce the impact of diabetes, improve quality of life, and build a healthier future.

## Requirements

- [Laravel 11](https://laravel.com/docs/11.x)
- [Composer](https://getcomposer.org/)
- [PHP 8.3](https://www.php.net/)
- [XAMPP](https://www.apachefriends.org/download.html)

## Libraries

- [Laravel UI](https://github.com/laravel/ui)
- [Laravel Socialite](https://laravel.com/docs/11.x/socialite)
- [Laravel Livewire](https://livewire.laravel.com/) 
- [SweetAlert2](https://sweetalert2.github.io/)
- [Bootstrap](https://getbootstrap.com/)
- [DataTables](https://datatables.net/)

## Installation

Clone the repository by running the following command:

```shell
git clone https://github.com/DiaCheck-C242-PS207/DiaCheck-Website.git
cd DiaCheck-Website
```

Install Dependency:

```shell
composer install
```

Set Environment Variables:

```shell
cp .env.example .env
```

Generate Application Key:

```shell
php artisan key:generate
```

Database Configuration `.env`:

```shell
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=diacheck
DB_USERNAME=root
DB_PASSWORD=
```

```shell
php artisan migrate
```

## Usage

Run Application:

```shell
php artisan serve
```

Server is running. Open url `http://127.0.0.1:8000` in browser.

## Note

You can visit this article to find out how to use Laravel Socialite
[Cara Membuat Login with Google Menggunakan Laravel Socialite di Laravel 11](https://blog.hikmal-falah.com/detail/cara-membuat-login-with-google-menggunakan-laravel-socialite-di-laravel-11)

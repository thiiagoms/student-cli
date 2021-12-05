<p align="center">
  <a href="https://github.com/thiiagoms/student-cli">
    <img src="assets/student.png" alt="Logo" width="80" height="80">
  </a>
     <h3 align="center">CLI crud :student:</h3>
</p>

Example of CLI crud, just for educational purposes!

- [Dependencies](#Dependencies)
- [Install](#Install)
- [Run](#Run)

### Dependencies
 - PHP +7.4
 - Composer

### Install
- Generate autoload with composer:
```bash
$ composer install
```
- Copy `.env.example` to `.env`:
```bash
$ cp .env.example .env
```
- Add your MySQL credentials in `.env` like:
```bash
# Database credentials
DATABASE_HOST=localhost
DATABASE_PORT=3306
DATABASE_NAME=std
DATABASE_USER=root
DATABASE_PASS=toor
``` 
#### Run

Run the script with
```php
$ php app.php

██████╗ ██╗      █████╗ ███████╗███████╗
██╔════╝██║     ██╔══██╗██╔════╝██╔════╝
██║     ██║     ███████║███████╗███████╗
██║     ██║     ██╔══██║╚════██║╚════██║
╚██████╗███████╗██║  ██║███████║███████║
╚═════╝╚══════╝╚═╝  ╚═╝╚══════╝╚══════╝

[*] Author: Thiago thiiagoms
[*] Description: Little CLI crud
[*] Version: 1.0

=> For get help use: --help | -h

$ php app.php --help
```
- If you want help, run:
```bash
$ php app.php --help
```


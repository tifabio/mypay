# MyPay

### Steps to install:

```sh
$ docker-compose up --build
$ docker exec -it lumen-mypay composer install
$ docker exec -it cp .env.local .env
$ docker exec -it lumen-mypay php artisan migrate:fresh --seed
```

### Steps to run:
```sh
$ docker-compose up
```

### Steps to run tests:

```sh
$ docker exec -it lumen-mypay php vendor/bin/phpunit
```

### API Documentation:
https://tifabio.github.io/mypay
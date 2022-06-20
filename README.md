<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About U Import

Projeto Laravel para upload de grandes arquivos php, utilizando fila como tratativa para o time out do php

## Execução

-------------------------
Dentro do projeto clonado:
    composer install
 
Compiar o .env:
    cp .env.example .env
    
Subindo os container:
    ./vendor/bin/sail up
    
*OBS: A primeira execução desse comando pode demorar um pouco.


### ACESSAR O CONTAINER DO APP 
#### sail-8.1/app

Atualizar a key do Laravel:
    php artisan key:generate

Alterar host DB no .env (Se necessário)
    DE DB_HOST=127.0.0.1
    PARA DB_HOST=mysql

Migration e Seed
    php artisan migrate
    php artisan db:seed

Executar a FILA:
    php artisan queue:work

*OBS: Sem a execução da fila, o arquivo será importado mas não será processado;

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

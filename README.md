<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About U Import

Projeto Laravel para upload de grandes arquivos .CSV, utilizando fila como tratativa para o time out do php

## Ambiente
#### Laravel 8
#### PHP 8.1
#### WLS2 - Distro: Ubuntu 20.04

## Execução

-------------------------
Dentro do projeto clonado:</br>
    <code>composer install</code>
 
Compiar o .env: </br>
    <code>cp .env.example .env</code>
    
Subindo os container:</br>
    <code>./vendor/bin/sail up</code>
</br>   
*OBS: A primeira execução desse comando pode demorar um pouco.


### ACESSAR O CONTAINER DO APP 
#### sail-8.1/app

Atualizar a key do Laravel:</br>
    <code>php artisan key:generate</code>

Alterar host DB no .env (Se necessário):</br>
    <b>DE</b> DB_HOST=127.0.0.1</br>
    <b>PARA</b> DB_HOST=mysql

Migration e Seed:</br>
    <code>php artisan migrate</code></br>
    <code>php artisan db:seed</code>

Executar a FILA:</br>
    <code>php artisan queue:work</code>
</br>
*OBS: Sem a execução da fila, o arquivo será importado mas não será processado;

## License
</br>
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

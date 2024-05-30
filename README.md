# Curso Introducción a Laravel


## Introducción

Este proyecto son notas del Curso Introducción a Laravel9. Este curso recorre los fundamentos del framework Laravel para PHP.

Nota personal: También aprovecho este curso para practicar el uso y configuración de contenedores Docker para crear mi ambientes de desarrollo; el uso de Git para prácticar comandos de esta herramienta de versionamiento y subir un repositorio remoto a Github; PHPUnit para realizar pruebas unitarias y el uso de Composer como manejador de dependencias de php.

Plataforma: Platzi 
Prof: Italo Morales

## Laravel
Laravel es un framework de PHP que nos permite crear aplicaciones web de forma rápida y sencilla. Es un framework que se basa en el patrón de diseño MVC (Modelo Vista Controlador) y que nos proporciona una serie de herramientas que nos facilitan el desarrollo de aplicaciones web.

## Requisitos
Para poder trabajar con Laravel necesitamos tener instalado PHP, Composer y Node.js.

## Estructura de carpetas

APP : Aqui vivira todo nuestro codigo principal.

Bootstrap: Utilizada por laravel para mejorar el rendimiento

config: Cada paquete que se instale. Se genera un archivo que se puede editar y modificar.

Database : Carpeta principal de las bases de datos

a. migrations : Archivos con la estructura principal para desarrollar tablas.

b. factories: nos permite desarrollar datos falsos para probar aplicacion

c. seeders: encargada de ejecutar los factories que desarrollemos

lang: idioma

public: punto de acceso a web.

resources: archivos originales css,javascript y vistas

routes: configuramos rutas del trabaja principalmente en web.php

storage: elementos generados por laravel. cache o si usuario guarda muchos archivos se pueden guardar hay. 11 test: Pruebas

vendor: Nose toca esta carpeta. Hay se ve todo lo que se instala con composer.

## Artisan
Artisan es una herramienta de línea de comandos que nos proporciona Laravel y que nos permite realizar tareas de forma rápida y sencilla. Con Artisan podemos crear controladores, modelos, migraciones, seeders, etc.
Para utilizar Artisan debemos abrir una terminal y acceder a la carpeta de nuestro proyecto. Una vez dentro, podemos utilizar los siguientes comand
os para crear un controlador, modelo, migración, etc.

Para usarlo en docker, desde la terminal del proyecto:

```bash
docker exec laravel-docker bash -c "php artisan"
```

```bash
php artisan make:controller NombreController
php artisan make:model NombreModelo
php artisan make:migration NombreMigracion
php artisan make:seeder NombreSeeder
```

## Controladores
Los controladores son una parte fundamental de Laravel y nos permiten agrupar la lógica de nuestras aplicaciones web. Los controladores se encargan de recibir las peticiones del usuario y devolver una respuesta. Para crear un controlador en Laravel podemos utilizar el siguiente comando de Artisan:

```bash
php artisan make:controller NombreController
```

## Rutas
Las rutas en Laravel nos permiten definir las URL de nuestra aplicación y asociarlas a un controlador o una vista. Las rutas se definen en el archivo routes/web.php y podemos utilizar los siguientes métodos para definir una ruta:

```php
Route::get('ruta', 'Controlador@metodo');
Route::post('ruta', 'Controlador@metodo');
Route::put('ruta', 'Controlador@metodo');
Route::delete('ruta', 'Controlador@metodo');
```

### Ruta con parámetro
Para definir una ruta con parámetro en Laravel podemos utilizar el siguiente código:

```php
Route::get('ruta/{parametro}', 'Controlador@metodo');
```
Donde {parametro} es el nombre del parámetro que queremos pasar a nuestro controlador.

En el navegador colocamos:
```
http://localhost:8000/ruta/valor
```

Si queremos obtener información de request, importamos de Http:

```php
use Illuminate\Http\Request;
```

Y luego lo usamos en la ruta, ejemplo buscar:

```php
Route::get('buscar', function(Request $request){
    return $request->url();
});
```

En el navegador usamos:

```
http://localhost:8000/buscar?nombre=valor
```


## Migraciones
Las migraciones en Laravel nos permiten definir la estructura de nuestras tablas de base de datos de forma sencilla y rápida. Las migraciones se definen en archivos PHP que se encuentran en la carpeta database/migrations y podemos utilizar los siguientes métodos para definir una migración:

```php
Schema::create('nombre_tabla', function (Blueprint $table) {
    $table->id();
    $table->string('nombre_columna');
    $table->timestamps();
});
```

Para ejecutar las migraciones utilizamos el siguiente comando de Artisan:

```bash
php artisan migrate
*/Si uso docker/*
docker exec laravel-docker bash -c "php artisan migrate"
```

Para crear una migración:

```bash
php artisan make:migration nombre_migracion
*/Si uso docker/*
docker exec laravel-docker bash -c "php artisan make:migration nombre_migracion"
```
Para que tenga una estructura preestablecida, el nombre del archivo de la migración debe seguir una estructua:

```bash
php artisan make:migration create_nombre_table
*/Si uso docker/*
docker exec laravel-docker bash -c "php artisan make:migration create_nombre_table"
```

Una vez llenado el archivo con la estructura de la tabla, ejecutamos de nuevo el comando migrate. Con ello se crea solo la tabla faltante, ya que como las migraciones actuan como un registro de versiones de la base de datos puede identificar que la tabla que falta por migrar es la que acabamos de crear.


## Models
Los modelos en Laravel nos permiten interactuar con la base de datos de forma sencilla y rápida. Los modelos se definen en archivos PHP que se encuentran en la carpeta app y podemos utilizar el siguiente comando para crear un modelo:
    
```bash
    php artisan make:model NombreModelo
    */Si uso docker/*
    docker exec laravel-docker bash -c "php artisan make:model Post -fc"
```
En este caso utilizamos las siguientes banderas:
- f: Para crear un factory
- c: Para crear un controlador

Primero trabajaremos con los factories

## Factories
Los factories en Laravel nos permiten generar datos falsos para probar nuestras aplicaciones. Los factories se definen en archivos PHP que se encuentran en la carpeta database/factories y podemos utilizar el siguiente comando para crear un factory (si no lo cree al mismo momento que cree el modelo):

```bash
    php artisan make:factory NombreFactory
*/Si uso docker/*
    docker exec laravel-docker bash -c "php artisan make:factory NombreFactory"
```

En el interior del archivo definimos la estructura para crear datos falsos.



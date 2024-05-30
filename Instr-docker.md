# Doker con Laravel

## Introducción

Este es un tutorial para crear un proyecto php en Docker adapatando las instrucciones de instalación de un proyecto de Laravel (proyecto de referencia).

Referencia: Proyecto "laravel-mysql-may24".

Tutorial de referencia utilizado:Video

[Video](https://www.youtube.com/watch?v=V-MDfE1I6u0) |

[Repositorio](https://github.com/pitocms/laravel-docker/tree/main)

## Instalación

Una vez creados los archivos Dockerfile y docker-compose.yml, ejecutar el siguiente comando:

```bash
docker-compose build
```

## Makefile

Con makefile, podemos escribir los comandos que queremos que se ejecuten (de docker-compose) más abreviados.

```bash
make up
make down
make build
```

## Composer

Tenemos 2 alternativas:

- Ya haber agregado la instalación de composer en el script del Dockerfile para que se ejecute al momento de construir la imagen, esto creará un archivo json (si lo descargamos de git en proyectos futuros).

- Instalar composer dentro del contenedor (manualmente).

Para instalar composer manualmente, debemos ingresar al contenedor (en este caso php-docker).

```bash
docker exec -it laravel-docker bash
```

Una vez dentro del contenedor, ejecutamos el siguiente comando:

```bash
composer create-project --prefer-dist laravel/laravel .
```

> Nota: La opción `--prefer-dist` es para que no descargue los archivos de laravel en formato zip.

Lo anterior permite que si bien estoy instalando las librerias de laravel que necesito en mi contenedor, estas se copiarán a mi ambiente local ya que estoy usando volumenes.


## Consideraciones con Git

Cuando estamos trabajando con git lo más probable es que incorporemos a .gitignore los archivos vendor. Lo anterior, genera que cualquiera que quiera clonar el proyecto necesita que se le proporcione el comando composer update despues de acceder al contenedor de docker. Así que para hacerlo más simple, se agrega el comando al makefile, de este modo se puede ejecutar comandos desde fuera del contenedor para que se ejecuten dentro del contenedor.

Así en el Makefile agregamos el comando necesario para actualizar composer (el cual tenemos instalado dentro del contenedor).

  ```Makefile
composer-update:
	docker exec laravel-docker bash -c "composer update"
  ```

Y en la terminal, posicionados en el archivo raíz del proyecto (no dentro del contenedor) ejecutamos:

```bash
make composer-update
```

## Configuración de la base de datos

Para configurar la base de datos, se debe modificar el archivo .env que se encuentra en la raíz del proyecto.

Primero, vamos a phpmyadmin:

Server: mysql_db  // Nombre del servicio creado en el docker-composer.
Username: root
Password: root

La Base de datos, el nombre se obtiene del archivo .yml, `laravel_docker`

Estos datos tienen que estar en el archivo .env:

Se descargaron así en el proyecto creado:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Se modifican así:

```bash
DB_CONNECTION=mysql
DB_HOST=mysql_db
DB_PORT=3306
DB_DATABASE=laravel_docker
DB_USERNAME=root
DB_PASSWORD=root
```

Si vemos la tabla, inicialmente no hay nada, pero luego ejecutamos el comando que creamos para la data en makefile
  
  ```bash
  make data
  ```

Si vemos la data se ven los archvos (desde phpMyAdmin).

## Setup

Ahora automatizaremos toda la configuración inicial mediante un comando setup en nuestro makefile.

```Makefile
setup:
  @make build
  @make up
  @make composer-update
```

Y ejecutamos el comando:

```bash
$ make setup
```

## Desde Github o repositorio remoto

Una vez que descargamos el proyecto desde Github al directorio local, donde hemos descargado los archivo, ejecutamos el comando setup `make setup`.

Luego, actualizamos el archivo .env con los datos de la base de datos del ambiente local, y corremos el comando `make data` para la base de datos.

Si aparece un error con los permisos, crear un archivo .htaccess en el directorio raiz (donde se encuentra el composer.json) con las siguientes instrucciones:

```bash
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/public/
RewriteRule ^(.*)$ /public/$1 [L,QSA]
```


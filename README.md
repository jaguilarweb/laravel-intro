# Curso Introducción a Laravel


## Introducción

Este proyecto son notas del Curso Introducción a Laravel9. Este curso recorre los fundamentos del framework Laravel para PHP.

Nota personal: También aprovecho este curso para practicar el uso y configuración de contenedores Docker para crear mi ambiente de desarrollo; el uso de Git para prácticar comandos de esta herramienta de versionamiento y subir un repositorio remoto a Github; PHPUnit para realizar pruebas unitarias y el uso de Composer como manejador de dependencias de php.

Plataforma: Platzi 
Prof: Italo Morales

## Laravel
Laravel es un framework de PHP que nos permite crear aplicaciones web de forma rápida y sencilla. Es un framework que se basa en el patrón de diseño MVC (Modelo Vista Controlador) y que nos proporciona una serie de herramientas que nos facilitan el desarrollo de aplicaciones web.

## Requisitos
Para poder trabajar con Laravel necesitamos tener instalado PHP, Composer y Node.js.

Versiones del profesor:
- PHP 8.0.8 
- Composer 2.1.3
- Laravel 4.2.7
- NPM 6.14.14
- Mariadb 15.1

## Estructura de carpetas

**app** : Aquí vivira todo nuestro codigo principal.

**bootstrap** : Utilizada por laravel para mejorar el rendimiento

**config** : Cada paquete que se instale. Se genera un archivo que se puede editar y modificar.

**Database** : Carpeta principal de las bases de datos

a. **migrations** : Archivos con la estructura principal para desarrollar tablas.

b. **factories** : nos permite desarrollar datos falsos para probar aplicación.

c. **seeders** : encargada de ejecutar los factories que desarrollemos.

**lang** : idioma

**public** : punto de acceso a web.

**resources** : archivos originales css, javascript y vistas.

**routes** : configuramos rutas del trabaja principalmente en web.php.

**storage** : elementos generados por laravel. cache o si usuario guarda muchos archivos se pueden guardar hay. 11 test: Pruebas

**vendor**: Nose toca esta carpeta. Hay se ve todo lo que se instala con composer.

## Artisan
Artisan es una herramienta de línea de comandos que nos proporciona Laravel y que nos permite realizar tareas de forma rápida y sencilla. Con Artisan podemos crear controladores, modelos, migraciones, seeders, etc.
Para utilizar Artisan debemos abrir una terminal y acceder a la carpeta de nuestro proyecto. Una vez dentro, podemos utilizar los siguientes comandos para crear un controlador, modelo, migración, etc.

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
php artisan make:model NombreModelo -fc
*/Si uso docker/*
docker exec laravel-docker bash -c "php artisan make:model Post -fc"
```
En este caso utilizamos las siguientes banderas:
- f: Para crear un factory
- c: Para crear un controlador

Primero trabajaremos con los factories

## Factories
Los factories en Laravel nos permiten generar datos falsos para probar nuestras aplicaciones. Los factories se definen en archivos PHP que se encuentran en la carpeta database/factories y podemos utilizar el siguiente comando para crear un factory (si no lo cree al mismo momento que cree el modelo):

Este comando lo utilizamos en caso de que no hubieramos creado el factory junto al modelo, con la bandera -f del caso anterior.

```bash
    php artisan make:factory NombreFactory
*/Si uso docker/*
    docker exec laravel-docker bash -c "php artisan make:factory NombreFactory"
```

En el interior del archivo definimos la estructura para crear datos falsos.

```php
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->sentence(),
            'body' => $this->faker->text(2200),
        ];
    }
}
```
¿Qué es el método `faker`?
Es un generador de datos falsos que nos proporciona Laravel. Con este generador podemos crear nombres, direcciones, textos, etc.

Este método contiene sentencias como:
- sentence(): Genera una oración.
- text(): Genera un texto.
- name(): Genera un nombre.
- email(): Genera un email.


## Seeders
Los seeders en Laravel nos permiten ejecutar los factories y poblar nuestra base de datos con datos falsos. Los seeders se definen en archivos PHP que se encuentran en la carpeta database/seeders.

En este caso, el seeder es el DatabaseSeeder, y en el colocamos el siguiente código:
    
```php
public function run()
{
    \App\Models\User::factory()->create();
    \App\Models\Post::factory(80)->create();
}
```
En este caso, estamos creando 80 posts y un usuario.
Para ejecutar los seeders, deberemos correr la migración:

```bash
php artisan migrate:refresh --seed
*/Si uso docker/*
docker exec laravel-docker bash -c "php artisan migrate:refresh --seed"
```

Los datos semillas se generarán porque existe el factory, en este caso el PostFactory.

Si observamos en phpMyAdmin podemos ver que se crearon los registros.

No obstante, al poblar las tablas con esta forma, el atributo `slug` se pobla con un texto corto pero no todo lo simple que deseamos para un `slug`propiamente tal, considerando que lo incluiremos como la url de nuestro recurso.

Ejemplo, si vemos el registro creado se ve así:

```mysql
| id |      title        |       slug        |       body        |      created_at       |        updated_at         |
|----|-------------------|-------------------|-------------------|-----------------------|---------------------------|
| 1  | Quisquam et autem | Quisquam et autem | Quisquam et autem |   2021-09-29 00:00:   |    2021-09-29 00:00:00    |

```
Para que el slug o cualquier texto sea realmente amigable para nuestro objetivo, es decir se pueda convertir en una url, en el factory importaremos una clase:
    
```php
use Illuminate\Support\Str;
```

Y modificamos el código:
    
```php
    public function definition(): array
{
    return [
        'title' => $title = $this->faker->sentence(),
        'slug' => Str::slug($title),
        'body' => $this->faker->text(2200),
    ];
}
```
Ahora volvemos a correr la migración con la bandera de seed.
    
```bash
php artisan migrate:refresh --seed
*/Si uso docker/*
docker exec laravel-docker bash -c "php artisan migrate:refresh --seed"
```

Ahora si observamos en phpMyAdmin, veremos que el slug se generó de forma amigable para una url:
    
```mysql
| id |      title        |       slug        |       body        |      created_at       |        updated_at         |
|----|-------------------|-------------------|-------------------|-----------------------|---------------------------|
| 1  | Quisquam et autem | quisquam-et-autem | Quisquam et autem |   2021-09-29 00:00:   |    2021-09-29 00:00:00    |
```

## Eloquent

Eloquent es el ORM (Object-Relational Mapping) que nos proporciona Laravel y que nos permite interactuar con la base de datos de forma sencilla y rápida. Eloquent nos permite realizar consultas a la base de datos, insertar, actualizar y eliminar registros, etc.

Revisando el ciclo de la navegación:

1. El usuario ingresa a la URL de la aplicación, es decir, a las rutas, ejemplo `route/web.php`
2. La ruta llama a un controlador, ejemplo `PostController`. Este controlador debe contener toda la lógica de la consulta, incluido proporcionar los datos que obtiene de la base de datos.
3. El controlador llama al modelo, ejemplo `Post`. Este modelo se encarga de interactuar con la base de datos. Los modelos representan las tablas de la base de datos.
4. El modelo se comunica con la base de datos y obtiene los datos solicitados.
5. El modelo devuelve los datos al controlador.
6. El controlador devuelve los datos a la vista, ejemplo `index.blade.php`.
7. La vista muestra los datos al usuario.

En este caso, desde PageController importamos los modelos:
        
```php
use App\Models\Post;
use App\Models\User;
```

Ahora en el PageController, en vez de usar data fake, hacemos la consulta a la base de datos con los comandos Elocuent.

```php
    public function blog()
    {
        $posts = Post::get();
        return view('blog', ['posts' => $posts]);
    }
    public function post(Post $post)
    {
        return view('post', ['post' => $post]);
    }
```

Y hacemos una modificación en el caso de la ruta post, ya que el parámetro slug ahora se obtendrá del atributo del objeto post.

```php
Route::controller(PageController::class)->group(function(){
    Route::get('blog/{post:slug}',   'post')->name('post');
});
```

En el pageController podemos usar las siguientes sentencias de Eloquent:
    
```php
$posts =    
    Post::get();-> Trae todos los registros de la base de datos.
    Post::frist();-> Trae el primer registro de la base de datos.
    Post::find(id); -> Busca un registro en la base de datos por medio de su id.
    Post::latest(); -> Trae todos los registros de la base de datos, y los ordena de forma descendente.
    Post::where('slug', $slug)->first(); -> 

    dd($post);

```

## Relationships

Las relaciones en Laravel nos permiten definir la relación entre dos tablas de la base de datos. Laravel nos proporciona varios tipos de relaciones, como las relaciones uno a uno, uno a muchos, muchos a muchos, etc.

NOTA: La siguiente explicación y modificación de las tablas lo realizamos en el supuesto que es un ejercicio y que correremos las migraciones para borrar todo y actualizar. Por tanto, la data de este ejercicio NO es importante y No debemos realizar esto nunca en producción.

Para lo anterior, crearemos una nueva columna en la tabla 'posts' mediante el archivo create de migrations.

```php
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body');
            $table->timestamps();
        });
    }
```

En este caso, la columna 'user_id' será la llave foránea que se relacionará con la tabla 'users', a través de la referencia de la 'id'.

Como hemos creado una nueva columna y necesitamos los datos fake, haremos una modificación en el PostFactory para agregar el atributo 'user_id' al objeto que crearemos en la tabla.
    
```php
    public function definition(): array
    {
        return [
            'user_id' => 1, //Atributo agregado al usuario de prueba
            'title' => $title = $this->faker->sentence(),
            'slug' => Str::slug($title),
            'body' => $this->faker->text(2200),
        ];
    }
```

Ahora corremos la migración.
        
```bash
php artisan migrate:refresh --seed
*/Si uso docker/*
docker exec laravel-docker bash -c "php artisan migrate:refresh --seed"
```

Veremos la utilidad de esto haciendo una modificación a la vista de blog:
        
```php
    @foreach( $posts as $post )
        <p>
            <strong>{{ $post->id }}</strong>
            <a href="{{ route('post', $post->slug) }}">
                {{ $post->title }}
            </a>
            <br>
            <span>{{$post->user->name}}</span>
        </p>
    @endforeach
```

En este caso, estamos mostrando el nombre del usuario que creó el post. Para ello, en el modelo Post, agregamos la relación con el modelo User, de esta forma Laravel se da por enterada que eciste esta relación.

```php
    public function user()
    {
        return $this->belongsTo(User::class);
    }
```

## Inicio de sesión

Para el inicio de sesión, Laravel nos proporciona un sistema de autenticación que nos permite crear un sistema de inicio de sesión de forma rápida y sencilla. 

Primero instalaremos con composer el proyecto breeze.
    
```bash
composer require laravel/breeze --dev
*/Si uso docker/*
docker exec laravel-docker bash -c "composer require laravel/breeze --dev"
```
Breeze:
- Es un paquete de Laravel que nos permite crear un sistema de autenticación de forma rápida y sencilla.
- Nos proporciona las vistas y rutas necesarias para el inicio de sesión, registro, olvidé mi contraseña, etc.
- Nos proporciona un sistema de autenticación completo que podemos personalizar y adaptar a nuestras necesidades.

Una vez instalado, corremos el siguiente comando dentro del contenedor:
    
```bash
php artisan breeze:install
```
Nos da varias opciones, voy a escoger "Blade with Alphine"


Este comando nos instalará las vistas y rutas necesarias para el inicio de sesión, registro, olvidé mi contraseña, etc. Es decir, activa el modulo de inicio sesión.

No obstante, considerar que borrará las rutas creadas anteriormente así que las guardaremos para incluirlas posteriormente.

Luego, podemos observar que en el archivo de rutas web.php a modificado el archivo, así que nosotros volvemos a incorporar las rutas que estabamos registrando.
El archivo queda:

```php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::controller(PageController::class)->group(function(){
    Route::get('/',             'home')->name('home');
    Route::get('blog',          'blog')->name('blog');
    Route::get('blog/{post:slug}',   'post')->name('post');
});
//Dejar esta parte del código para que no de error al loguear un usuario ejemplo
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
```

Ahora, para ver los cambios vamos a hacer una modificación del archivo de vista template.blade.php.

Ahora ejecutamos los comandos, dentro del contenedor.
        
```bash
npm install
npm run dev
```

Para probar el loguin usar el usuario de ejemplo ubicable en la bse de datos, la password es 'password' conforme lo configurado en UserFactory para los usuarios fake.

Nota: Debido a pruebas en Docker tuve que modificar los nombres de los servicios y contenedores del Dockerfile, y el archivo .env, pero no corresponde a requisitos del curso. Es por ello que en la documentación e incluso en los commit puede haberse registrado o no la modificación del nombre de los contenedores.

## Sistema de autenticación

El sistema de autenticación en Laravel nos permite proteger las rutas de nuestra aplicación y restringir el acceso a los usuarios autenticados. Laravel nos proporciona un middleware que nos permite verificar si un usuario está autenticado y si tiene permisos para acceder a una ruta.

Para efectos de este curso, modificamos el archivo routes->auth.php, para dejar solo las rutas del login considerando que será un sistema administrado por solo un usuario.

## Panel Administrativo

Iniciamos agregando una ruta en el archivo web.php

```php
Route::resource('posts', PostController::class);
```
Luego en la terminal corremos el siguiente comando:
        
```bash
php artisan route:list
*/Si uso docker/*
docker exec laravel-docker-intro bash -c "php artisan route:list"
```

Con esto, vemos que se crearon las rutas para el CRUD de posts.

```bash
GET|HEAD        posts ................... posts.index › PostController@index
POST            posts ................... posts.store › PostController@store
GET|HEAD        posts/create .......... posts.create › PostController@create
GET|HEAD        posts/{post} .............. posts.show › PostController@show
PUT|PATCH       posts/{post} .......... posts.update › PostController@update
DELETE          posts/{post} ........ posts.destroy › PostController@destroy
GET|HEAD        posts/{post}/edit ......... posts.edit › PostController@edi
```

Vamos a eliminar una de las rutas, para ello usaremos el método except:

Ruta: web.php
```php
Route::resource('posts', PostController::class)->except('show');
```

Si ejecutamos de nuevo el comando de listar podemos ver que ya se ha eliminado del listado la ruta:
    
```bash
GET|HEAD        posts ................... posts.index › PostController@index
POST            posts ................... posts.store › PostController@store
GET|HEAD        posts/create .......... posts.create › PostController@create

PUT|PATCH       posts/{post} .......... posts.update › PostController@update
DELETE          posts/{post} ........ posts.destroy › PostController@destroy
GET|HEAD        posts/{post}/edit ......... posts.edit › PostController@edit
```
Ahora modificamos el controlador:

```php
    public function index()
    {
        return view('posts.index');
    }
```
Y creamos la vista, para ello vamos a app->resources->views y creamos un directorio y un archivo 'post/index.blade.php'.

Aprovechamos el mismo código del dashboard y modificamos algunos elementos y con ello logramos la vista de Post.

Lo interesante de esto es que al ingresar en el browser a:
        
```
http://localhost:8000/posts
```

- Si no estoy logueado no puedo ver la página (a esta altura sale un error)
- Pero si estoy logueado puedo ver la página con la misma infraestructura de estilo que el dashboard.


### Listado de publicaciones

Para listar las publicaciones, vamos a modificar el controlador para que nos devuelva los datos de la base de datos.


1.- Desde la ruta web.php enviamos al controlador la consulta

**RUTA**
`app->routes->web.php`

```php
Route::resource('posts', PostController::class)->except('show');
```

2.- En el controlador, modificamos el método index para que nos devuelva los datos de la base de datos.

**CONTROLADOR**

`app->http->Controllers->PostController.php`

```php
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->paginate()
        ]);
    }
```

3.- En la vista, vamos a modificar el archivo index.blade.php para que muestre los datos de la base de datos.

**VISTA**

`app->resources->views->posts->index.blade.php`

```php
<div class="p-6 text-gray-900">
    <table class="mb-4">
        @foreach ($posts as $post)
        <tr class="border-b border-gray-200 text-sm">
            <td class="px-6 py-4">{{ $post->title }}</td>
            <td class="px-6 py-4">
                <a href="" class="text-indigo-600">Editar</a>
            </td>
            <td class="px-6 py-4"> Eliminar</td>
        </tr>
        @endforeach
    </table>
    {{ $posts->links() }}
</div>
```

Con esto, ya podemos ver las publicaciones en la vista de posts.

**Resumen**:
- Creamos las rutas que apuntan a un controlador.
- El controlador ejecuta una lógica, entre la que se encuentra la de devolver los datos de la base de datos y enviar de regreso esos datos.
- La vista, recibe los datos desde el controlador y se encarga de mostrar los datos al usuario.
- El usuario, accede a la vista a través de la ruta.


### Eliminar publicaciones (Delete)

Para eliminar una publicación, vamos a modificar el controlador para que elimine un post de la base de datos.

La ruta ya está creada, puesto anteriormente utilizamos como definición de ruta la que nos da laravel (sección 'Panel Administrativo'). 

```php
Route::resource('posts', PostController::class)->except('show');
```

Al escoger esta estructura de rutas, laravel nos deja automáticamente dispibile las rutas con métodos predefinidos. Estas rutas con métodos prefefinidos son los que vimos al listar con el comando `php artisan route:list` y para poder hacer uso de ellos debemos usar los nombres que stán definidos como por ejemplo 'destroy' para 'eliminar'.

Si hubiera usado como definición de ruta las iniciales como:
```php
    Route::get('blog/{post:slug}', 'post')->name('post');
```
Entonces habria podido usar una configuración personalizada, pero tendría que crear todo lo que laravel me otorga como ya hecho.

Por tanto, ahora nos vamos directo al controlador, y en el creamos el metodo destroy.

**CONTROLADOR**

`app->http->Controllers->PostController.php`

```php
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }
```

Con esto, ya podemos eliminar una publicación desde la vista de posts.
Por tanto, en la vista hacemos una modificación para incluir un formulario.

**VISTA**
`resources->views->posts->index.blade.php`
    
```php
<td class="px-6 py-4">
    <form action="{{ route('posts.destroy', $post) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600">Eliminar</button>
    </form>
</td>
```

Donde:
- @csrf: Es una directiva de Blade que nos permite proteger nuestro formulario contra ataques CSRF, ya que nos genera un token de seguridad.
- @method('DELETE'): Es una directiva de Blade que nos permite enviar una petición DELETE al servidor.








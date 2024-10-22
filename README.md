# Sistema de Gestión de Posts - Backend

Este proyecto es una API RESTful desarrollada en Laravel que permite gestionar posts y usuarios según su rol. La API utiliza autenticación basada en tokens (Laravel Sanctum) y maneja roles como **admin**, **user** y **viewer**.


## PARA FUNCIONAMIENTO DE LA BASE DE DATOS Y EL CRUD:
    -Debe estar en funcionamiento el panel de XAMPP:
        - APACHE
        - MySQL

## Requisitos Previos

Antes de empezar, asegúrate de tener instalado lo siguiente:

- [PHP 8.0+](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/download/)
- [MySQL](https://dev.mysql.com/downloads/) u otra base de datos compatible
- [Laravel 9.x](https://laravel.com/docs/9.x)

## Instalación

1. **Clona este repositorio:**
   ```bash
   git clone https://github.com/tuusuario/sistema-gestion-posts.git


2. **Navega al directorio del proyecto:**
    cd sistema-gestion-posts

3. **Instala las dependencias del proyecto:**
    composer install


4. **Configura el archivo .env:**

    - cp .env.example .env
    - Copia el archivo de entorno:
            APP_NAME=Laravel
            APP_ENV=local
            APP_KEY=base64:SuOgM3ZUtEvdzkDwl7QkprgW7ZYBUyt5jtT72vOsq5k=
            APP_DEBUG=true
            APP_TIMEZONE=UTC
            APP_URL=http://localhost

            APP_LOCALE=en
            APP_FALLBACK_LOCALE=en
            APP_FAKER_LOCALE=en_US

            APP_MAINTENANCE_DRIVER=file
            # APP_MAINTENANCE_STORE=database

            PHP_CLI_SERVER_WORKERS=4

            BCRYPT_ROUNDS=12

            LOG_CHANNEL=stack
            LOG_STACK=single
            LOG_DEPRECATIONS_CHANNEL=null
            LOG_LEVEL=debug

            DB_CONNECTION=mysql
            DB_HOST=127.0.0.1
            DB_PORT=3306
            DB_DATABASE=notaria
            DB_USERNAME=root
            DB_PASSWORD=

            SESSION_DRIVER=database
            SESSION_LIFETIME=120
            SESSION_ENCRYPT=false
            SESSION_PATH=/
            SESSION_DOMAIN=null

            BROADCAST_CONNECTION=log
            FILESYSTEM_DISK=local
            QUEUE_CONNECTION=database

            CACHE_STORE=database
            CACHE_PREFIX=

5. **Genera la migracion y subirla  a la base de datos:**
    php artisan migrate


6. **Poblar las bases de usuarios y publicaciones**
    php artisan db:seed

7. **Inicia el servidor de desarrollo de Laravel:**
    php artisan serve

7. **AUTENTIFICACIÓN**   

  7. 1. ***Registro de un nuevo usuario:***

    POST /api/register
        http://127.0.0.1:8000/api/auth/register

    Datos de ejemplo:
            {
                "name": "John Doe",
                "email": "john@example.com",
                "password": "password",
            }

  7. 2. ***Inicio de sesión y obtención del token***
    POST /api/login    
        http://127.0.0.1:8000/api/auth/login
    
        Datos de ejemplo:
            {
                "email": "john@example.com",
                "password": "password",
            }

    Esto retornará un token de autenticación que debe ser enviado en el encabezado Authorization de las solicitudes siguientes:
        Authorization: Bearer {token}

    Gestión de Roles y Permisos
    Se han implementado los siguientes roles en el sistema:

    Admin: Puede gestionar todos los posts y usuarios.
    User: Puede crear, editar y eliminar sus propios posts. Puede ver los posts de otros usuarios, pero no modificarlos.
    Viewer: Solo puede ver los posts, pero no puede crear, editar ni eliminar ninguno.

    **Me ha faltado que los administradores, usuarios y visitantes tengan los permisos necesarios, todos pueden hacer el CRUD de todos**

    Endpoints Principales
    Gestión de Posts
            Ver todos los posts:
                GET /api/posts
                POST /api/posts  **El id del usuario tiene que estar creado**
                        {
                        "title": "Mi primer post",
                        "content": "Contenido del post"
                        "user_id": "2"
                        }
                GET /api/posts/{id}
                PUT /api/posts/{id}
                DELETE /api/posts/{id}

    Gestión de Posts
            GET /api/users
            POST /api/users
            PUT /api/users/{id}
            DELETE /api/users/{id}

8. **Politicas de Autorizacion**
    - Solo los usuarios registrados que tengan un token valido, podran acceder con eso a cualquier ruta.

9. **Herramientas Usadas**
        Laravel 11
        Laravel Sanctum
        PHP
        XAMPP Control panel
# Predirect
Estructura y funcionalidad para configurar URL dinámicas con el fin de evitar URL largas en redes sociales. Script utilizado en WAI.pe

Redirección dinámica en PHP que permite gestionar URLs personalizadas desde una base de datos MySQL. Ideal para proyectos que necesitan redirigir usuarios a diferentes destinos a través de slugs únicos. Incluye integración con Google Analytics para el seguimiento de las visitas a cada enlace.

Características:
- Gestión de URLs mediante base de datos MySQL.
- Redirección dinámica basada en slugs.
- Integración con Google Analytics para el seguimiento de eventos.
- Configuración segura mediante variables de entorno (.env).

## Instalación

1. Clonar repositorio:

    ```bash
    git clone git@github.com:wZVanG/Predirect.git
    ```

2. Dependencias Composer:

    ```bash
    composer install
    ```

3. Configurar archivo `.env`:

    ```
    DB_HOST=localhost
    DB_NAME=db
    DB_USER=root
    DB_PASSWORD=
    GA_TRACKING_ID=UA-XXXXXXXXX-X
    GA_SERVER=www.wai.pe
    ```

4. Configurar la base de datos con las tablas necesarias. (`_backups/install.sql`)

## Uso

Simplemente llamar a la URL, por ejemplo: `https://www.wai.pe/slug`

- Debe estar configurado el .htaccess para que el script funcione correctamente.
- Contenido de .htaccess:
```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ public/index.php?pagina=$1 [L]
```


## Más información	

Este proyecto fue creado y mantenido por **Walter Chapilliquen**. 

- Walter Chapilliquen: [@wZVanG](https://wai.pe/walter)
- Licencia: [MIT](https://opensource.org/licenses/MIT)

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

2. Instalar dependencias de Composer:

    ```bash
    composer install
    ```

3. Configurar archivo `.env` (copiar de `.env.back`).

4. Ejecutar script de instalación: `/install`

## Uso

Llamar a la URL, por ejemplo: `/curso1/instagram`. Equivalente a `/index.php?pagina=curso1&canal=instagram`
Esto llamará a la URL registrada en la base de datos de `curso1`, registrará el evento en Google Analytics y redirigirá al usuario a la URL correspondiente. 

## Más información	

Este proyecto fue creado y mantenido por **Walter Chapilliquen**. 

- Walter Chapilliquen: [@wZVanG](https://wai.pe/walter)
- Licencia: [MIT](https://opensource.org/licenses/MIT)

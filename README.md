# Proyecto 2 - Catalogo de productos
# Sistema de Gestión de Inventario – INVENIA (Catalogo de productos) 
Este proyecto es un sistema web de gestión de inventario desarrollado con Laravel, diseñado para administrar eficientemente productos y categorías. Las principales características incluyen:

# Características Principales
# 1.	Gestión de Usuarios
•	Sistema de autenticación seguro
•	Verificación de correo electrónico
•	Gestión de perfil personalizado
•	Soft delete para mantener históricos

# 2.	Gestión de Categorías
•	Creación y organización de categorías personalizadas
•	Validación para evitar duplicados por usuario
•	Descripción detallada de cada categoría
•	Sistema de edición y eliminación

# 3.	Gestión de Productos
•	Registro detallado de productos
•	Asignación a categorías específicas
•	Control de stock y stock mínimo
•	Sistema de alertas para stock bajo

# 4.	Control de Inventario
•	Registro de entradas y salidas de productos
•	Historial detallado de movimientos
•	Motivos de movimientos
•	Stock resultante tras cada operación

# 5.	Reportes y Visualización
•	Vista general de todos los productos
•	Historial de movimientos por producto
•	Interfaz intuitiva y responsive
•	Generación de reportes en PDF
# Aspectos Técnicos Destacados
•	Arquitectura MVC
•	Relaciones eloquent entre modelos
•	Middleware de autenticación
•	Validaciones personalizadas
•	Sistema de notificaciones por correo
•	Interfaz basada en Bootstrap
# Seguridad
•	Protección CSRF
•	Validación de datos
•	Autenticación robusta
•	Soft delete para preservar datos históricos


## Requisitos
- PHP 8.1.29
- Composer version 2.7.9
- Node.js v20.18.0
-  npm v10.8.2
-  Laravel 10.48.22
- Base de datos MySQL 8.0.30

## Instalación y configuración

1. Clonar el repositorio:
2. Instalar las dependencias de PHP con Composer:
## composer install
3. Copiar el archivo .env.example y renómbralo a .env:
## cp .env.example .env
4. Genera la clave de la aplicación de Laravel:
## php artisan key:generate
5. Configura la base de datos en el archivo .env (usuario, contraseña, nombre de la base de datos).
6. Ejecutar las migraciones para crear las tablas en la base de datos:
## php artisan migrate
7. Instalar las dependencias de Node.js:
## npm install
8. Se están utilizando herramientas de assets, ejecutar el siguiente comando para compilarlos:
## npm run dev
9. Iniciar el servidor de desarrollo de Laravel:
## php artisan serve

## Funcionalidades
-. Registro e inicio de sesión de usuarios.
-. CRUD de categorías (Crear, Leer, Actualizar, Eliminar).
-. Validación de formularios.
-. Control de sesiones de usuario.







<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# catalago-productos

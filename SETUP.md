# Setup

## Requisitos previos

- Docker Desktop o Docker Engine funcionando
- DDEV instalado
- PHP 8.3+ disponible dentro del contenedor web
- Node.js 20+ recomendado dentro del flujo local o vía contenedor
- Composer 2.8+

## Estado real del skeleton

Hoy el proyecto ya incluye:

- Laravel 13
- DDEV configurado en `.ddev/config.yaml`
- Vite 7
- Tailwind CSS 4
- `.env.example` con defaults del skeleton de Laravel

Todavía no incluye:

- configuración final de Croodev Care en `.env.example`
- seeders propios de la demo
- rutas públicas y admin del producto

## Bootstrap esperado

Desde la raíz del proyecto:

```bash
ddev start
ddev composer install
ddev npm install
cp .env.example .env
ddev artisan key:generate
ddev artisan migrate:fresh --seed
ddev npm run dev
```

## Ajustes manuales requeridos hoy

Antes de que el backend deje lista la configuración final, hay que editar `.env` porque `.env.example` todavía sale con los valores por defecto del skeleton.

Cambios mínimos esperados:

- `APP_NAME="Croodev Care"`
- `APP_URL=https://croodevcare.ddev.site`
- `APP_LOCALE=es`
- `APP_FALLBACK_LOCALE=es`
- reemplazar `DB_CONNECTION=sqlite` por configuración MySQL/MariaDB de DDEV

## Variables de entorno mínimas

Estas claves deben existir en `.env` al cerrar la Fase 1:

```dotenv
APP_NAME="Croodev Care"
APP_ENV=local
APP_URL=https://croodevcare.ddev.site

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=db
DB_USERNAME=db
DB_PASSWORD=db

FILESYSTEM_DISK=public
PAYMENT_DEFAULT_GATEWAY=fake
PAYMENT_FAKE_AUTO_APPROVE=true
ADMIN_PATH=admin
```

## Flujo de desarrollo diario

```bash
ddev start
ddev composer install
ddev npm install
ddev artisan migrate
ddev artisan db:seed
ddev npm run dev
```

## Verificación inicial

Al terminar el bootstrap, validar:

- `ddev describe` responde sin errores
- la vista pública actual carga assets Vite
- la app responde desde `https://croodevcare.ddev.site`
- el seed deja de crear solo el `Test User` default cuando se implemente el seeder real

## Archivos clave

Ya presentes:

- `.ddev/config.yaml`
- `.env.example`
- `database/seeders/DatabaseSeeder.php`

Pendientes de implementación:

- `database/seeders/AdminUserSeeder.php`
- `database/seeders/DemoCauseSeeder.php`
- `public/branding/croodev-logo.svg` o placeholder documentado
- migraciones del dominio solidario

## Integración del logo oficial

Archivo fuente entregado por el usuario:

- `/home/magento/Downloads/logocroodev-1 (1).svg`

Destino recomendado dentro del proyecto:

- `public/branding/croodev-logo.svg`

Si el archivo no se copia todavía, dejar un placeholder con el mismo path para no romper el layout.

## Criterios de cierre de setup

- instalación limpia desde cero
- DDEV operativo
- assets compilando sin errores
- base de datos migrada
- seed demo funcional
- credenciales admin válidas

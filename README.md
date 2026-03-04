# Sleider Calderón

Demo full-stack para una plataforma solidaria premium construida con Laravel 13, Blade, Tailwind CSS, Vite y un panel admin personalizado.

## Estado actual

El proyecto está funcional de punta a punta:

- sitio público dinámico para una causa activa
- detalle de causa con historia, necesidades, galería, timeline y FAQs
- formulario de aportes con montos sugeridos y monto libre
- capa de pagos desacoplada con gateway demo/fake
- panel admin custom con dashboard y CRUDs principales
- seed completo con datos demo listos para presentar
- documentación operativa y checklist QA

## Stack

- PHP 8.3+
- Laravel 13
- MySQL / MariaDB
- Blade + Vite + Tailwind CSS
- Alpine.js puntual
- DDEV para desarrollo local

## URLs

- Local público: `https://croodevcare.ddev.site`
- Local admin: `https://croodevcare.ddev.site/admin/login`
- Producción pública: `https://care.croodev.com`
- Producción admin: `https://care.croodev.com/admin/login`

## Credenciales demo

- Email: `admin@sleidercalderon.test`
- Password: `SleiderDemo!2026`

## Puesta en marcha local

```bash
ddev start
ddev composer install
ddev npm install
ddev artisan migrate:fresh --seed
ddev npm run dev
```

Si querés validar el estado sin Vite en vivo:

```bash
ddev npm run build
ddev artisan test
```

## Documentación incluida

- `SETUP.md`
- `ADMIN_GUIDE.md`
- `DEMO_FLOW.md`
- `TESTING_CHECKLIST.md`
- `PROJECT_STATUS.md`
- `DESIGN_SYSTEM.md`
- `docs/demo-seed-content.yaml`

## Notas de despliegue

- Producción quedó montada en estructura compartida `app/` + `public_html/`.
- Los assets compilados de Vite deben existir tanto en `public_html/build` como en `app/public/build` cuando el servidor no compila frontend.
- La copia desplegada en producción está inicializada como repo Git local mediante `git bundle`, evitando dejar el token de GitHub persistido en el servidor.

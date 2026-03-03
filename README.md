# Croodev Care

Demo full-stack para una plataforma solidaria premium construida con Laravel 13, Blade, Tailwind CSS, Alpine.js puntual y un panel admin personalizado.

## Estado actual

El repositorio ya está bootstrappeado con Laravel 13, Vite 7, Tailwind CSS 4 y DDEV. La implementación funcional del producto todavía está en construcción: hoy la app responde con la vista `welcome` de Laravel y el seed sigue siendo el default del skeleton.

## Objetivo

Mostrar una causa activa con claridad, confianza y humanidad, permitiendo colaborar con montos sugeridos o aportes libres desde una experiencia moderna y entendible en segundos.

## Alcance funcional esperado

- Home pública con hero de causa activa, progreso y CTAs claros
- Página de detalle de causa con historia, necesidades, galería y actualizaciones
- Donación demo con arquitectura desacoplada para futuros gateways reales
- Panel admin custom para gestionar causas, updates, presets, FAQs, branding y settings
- Seed demo completo con contenido coherente listo para una demo comercial

## Stack actual y objetivo

- Laravel 13
- PHP 8.3+
- Base de datos MySQL-compatible
  - estado actual local: MariaDB 10.11 vía DDEV
  - objetivo de dominio: compatibilidad con MySQL
- Blade + Vite + Tailwind CSS
- Alpine.js solo donde aporte valor real
- DDEV para entorno local

## Documentación incluida

- `SETUP.md`: instalación local y bootstrap con DDEV
- `ADMIN_GUIDE.md`: operación del panel admin
- `DEMO_FLOW.md`: recorrido sugerido para demo comercial
- `TESTING_CHECKLIST.md`: checklist funcional, visual y de accesibilidad
- `PROJECT_STATUS.md`: estado por fases y pendientes
- `DESIGN_SYSTEM.md`: dirección visual elegida y sistema de diseño
- `docs/demo-seed-content.yaml`: contenido demo estructurado para seeders

## Credenciales demo sugeridas

Estas credenciales son las recomendadas para el seed inicial. Deben implementarse en el seeder de admins.

- Email: `admin@croodevcare.test`
- Password: `CroodevDemo!2026`

## Comandos objetivo

Con el bootstrap ya creado, el flujo esperado para una instalación limpia es:

```bash
ddev start
ddev composer install
ddev npm install
cp .env.example .env
ddev artisan key:generate
ddev artisan migrate:fresh --seed
ddev npm run dev
```

## URLs previstas

Estas URLs son el objetivo funcional del proyecto. En el estado actual todavía no existen las rutas admin ni la home pública final.

- Sitio público: `https://croodevcare.ddev.site`
- Login admin: `https://croodevcare.ddev.site/admin/login`
- Dashboard admin: `https://croodevcare.ddev.site/admin`

## Seed demo

La demo sugerida se centra en una causa activa llamada `Volver a Casa`, con una familia que necesita adaptar su vivienda y sostener un proceso de rehabilitación. El detalle completo está en `docs/demo-seed-content.yaml`.

## Próximo paso técnico

1. Reemplazar la home default de Laravel por la home pública de Croodev Care.
2. Implementar el modelo de datos según el contenido de `docs/demo-seed-content.yaml`.
3. Conectar el frontend público y el admin al seed demo.

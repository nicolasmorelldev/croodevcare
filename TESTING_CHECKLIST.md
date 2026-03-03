# Testing Checklist

## Alcance

Este documento funciona como checklist de aceptación final para Croodev Care. No describe el estado actual del skeleton, sino lo que debe cumplirse al cerrar la demo.

## 1. Instalación

- `ddev start` funciona sin errores
- `ddev composer install` completa correctamente
- `ddev npm install` completa correctamente
- `.env` queda configurado para `Croodev Care` y base MySQL/MariaDB de DDEV
- `ddev artisan migrate:fresh --seed` crea datos demo consistentes
- `ddev npm run dev` compila assets sin warnings críticos

## 2. Seed y datos demo

- existe al menos una causa activa
- la causa tiene meta, recaudado, historia corta y larga
- existen montos sugeridos con labels coherentes
- existen necesidades con estados variados
- existen updates publicados
- existe una galería con captions útiles
- existen FAQs reales
- existe un admin funcional
- no hay lorem ipsum visible
- no hay datos absurdos o incongruentes

## 3. Home pública

- el hero comunica causa, objetivo y CTA en menos de 5 segundos
- la barra de progreso refleja cifras reales
- header sticky funciona
- navegación a anclas o páginas secundarias funciona
- las tarjetas de ayuda son claras y consistentes
- los CTA principales son visibles sin competir entre sí

## 4. Detalle de causa

- la historia se lee con jerarquía correcta
- la galería se ve bien en mobile y desktop
- el timeline de updates mantiene orden cronológico claro
- el bloque de transparencia contiene datos reales del seed
- FAQs no rompen layout con respuestas largas

## 5. Donación demo

- se puede elegir un preset
- se puede ingresar un monto libre válido
- las validaciones bloquean montos inválidos
- el flujo fake refleja éxito o fallo de forma clara
- la arquitectura no está acoplada al fake gateway

## 6. Admin

- login y logout funcionan
- rutas admin están protegidas
- dashboard muestra métricas demo
- CRUD de causas funciona
- CRUD de updates funciona
- CRUD de presets funciona
- CRUD de necesidades funciona
- CRUD de galería funciona
- CRUD de FAQs funciona
- settings generales impactan el frontend

## 7. Responsive

Validar al menos en:

- 390x844
- 768x1024
- 1280x800
- 1440x900

Checks:

- no hay desbordes horizontales
- los CTA siguen visibles
- tablas admin son utilizables
- formularios mantienen spacing y foco
- imágenes no se deforman

## 8. Accesibilidad

- contraste AA en textos principales
- foco visible en navegación por teclado
- labels asociados a inputs
- headings en orden lógico
- imágenes clave con alt útil
- botones e íconos con nombre accesible
- mensajes de error legibles

## 9. SEO y metadatos

- title único por página
- meta description útil
- open graph básico
- slug limpio en causas
- headings con jerarquía semántica

## 10. Confianza y transparencia

- se identifica quién administra la ayuda
- medios de aporte visibles
- rendición o criterio de uso de fondos explicado
- datos de contacto visibles
- copy evita afirmaciones imposibles de verificar

## 11. Cierre de QA

El proyecto puede considerarse listo para demo si:

- la app instala de cero
- el seed deja una demo completa
- el frontend se siente premium y claro
- el admin es operable y consistente
- no hay errores funcionales críticos

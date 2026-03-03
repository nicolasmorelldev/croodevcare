# Admin Guide

## Objetivo del panel

El panel admin debe permitir operar la demo sin tocar código, manteniendo consistencia visual con el producto público.

## Estado actual

Esta guía documenta el panel objetivo de Croodev Care. En el estado actual del repositorio todavía no existen las rutas `/admin/*`, el login admin ni los módulos descritos abajo.

## Acceso inicial

- URL prevista: `/admin/login`
- Usuario demo previsto: `admin@croodevcare.test`
- Password demo previsto: `CroodevDemo!2026`

## Módulos mínimos

### Dashboard

- total recaudado demo
- cantidad de aportes demo
- causas activas
- progreso por causa
- actividad reciente

### Causas

Gestiona:

- nombre
- slug
- estado
- historia corta
- historia completa
- objetivo económico
- recaudado actual
- imagen principal
- CTA principal
- flags de causa destacada o activa

### Actualizaciones

Cada update debe permitir:

- título
- fecha visible
- resumen
- cuerpo
- tipo de update
- imagen opcional
- publicación

### Montos sugeridos

Cada preset debe definir:

- monto
- label visible
- descriptor de impacto
- orden
- activo/inactivo

### Necesidades

Cada necesidad debe permitir:

- categoría
- título
- descripción breve
- monto estimado
- monto cubierto
- estado
- badge urgente
- orden

### Medios de colaboración

Debe soportar:

- fake gateway demo
- transferencia / alias
- Stripe futuro
- Mercado Pago futuro
- contacto para alianzas

### Galería

Campos sugeridos:

- imagen
- caption
- orden
- visible en home o solo en detalle

### FAQs

Cada FAQ necesita:

- pregunta
- respuesta
- orden
- activo/inactivo

### Configuración general

- nombre del sitio
- submarca
- claim corto
- emails
- teléfono
- WhatsApp
- redes
- footer legal
- bloque de transparencia
- branding básico

### Usuarios admins

- nombre
- email
- password
- rol
- estado

## Flujo operativo recomendado

1. Actualizar la causa activa desde `Causas`.
2. Ajustar el recaudado visible.
3. Publicar nuevas actualizaciones.
4. Mantener la galería y la transparencia al día.
5. Revisar FAQs y métodos de aporte.

## Reglas editoriales

- evitar copy dramático o manipulador
- usar lenguaje claro, humano y verificable
- toda cifra visible debe coincidir con el panel
- no dejar campos vacíos en módulos públicos
- las imágenes deben sentirse reales y sobrias

## Estados vacíos recomendados

- `Sin actualizaciones todavía`
- `Todavía no hay preguntas frecuentes cargadas`
- `No hay imágenes publicadas para esta causa`
- `Aún no hay métodos de aporte configurados`

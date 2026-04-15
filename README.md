# InPro Landing (Base Fase 1)

Base inicial de la landing de InPro con PHP (MVC simple), hero full screen, secciones con scroll y formulario de contacto preparado para Resend.

## Estructura

- `public/`: front controller y assets.
- `app/controllers/`: controladores de Home y Contacto.
- `app/views/`: vista principal y partials por seccion.
- `app/services/ResendMailer.php`: envio de emails con API de Resend.
- `config/`: configuracion de app y rutas.

## Configuracion

1. Copia `.env.example` a `.env`.
2. Completa `RESEND_API_KEY`, `MAIL_FROM` y `MAIL_TO`.
3. Ejecuta `composer dump-autoload`.
4. Sirve el proyecto apuntando a `public/`.

## Flujo actual

- Navbar fija con anclas a secciones.
- Hero full screen con cards de proyectos.
- Click en cards: scroll suave al detalle de cada proyecto.
- Formulario de contacto con endpoint `POST /contact`.

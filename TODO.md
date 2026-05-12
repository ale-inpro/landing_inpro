# TODO - Landing INPRO

## Imágenes y Assets

- [ ] Verificar que existen en `public/assets/img/`: `favicon.png`, `logo_inpro.png`, `logo-vigia.png`, `logo_actalia.png`, `logo_atalaya.png`, `img_hero.png`
- [ ] Convertir imágenes `.png` a `.webp` para mejorar rendimiento de carga
- [ ] Añadir las imágenes al repositorio Git (actualmente no están versionadas)

## Carpeta `inpro/` (prototipo estático)

- [ ] Decidir si `inpro/` se despliega a producción o se excluye
- [ ] Si se mantiene: rellenar contenido real en las páginas de producto (`vigia.html`, `inpro-gestion.html`, `control-empresas.html`, `nuestra-esencia.html`) — actualmente tienen secciones vacías/placeholder
- [ ] Refactorizar las 5 hojas CSS duplicadas (`actalia.css`, `vigia.css`, `inpro-gestion.css`, `control-empresas.css`, `nuestra-esencia.css`) en una sola hoja con variables CSS por tema
- [ ] Dar URLs reales a los enlaces del footer: Aviso Legal, Política de Privacidad, Política de Cookies, Accesibilidad
- [ ] Dar URLs reales a los iconos de redes sociales del footer (Instagram, Facebook, etc.)

## Base de datos

- [ ] Verificar que la tabla `contact_messages` existe en la BD de producción con columnas: `subject`, `name`, `email`, `phone`, `message`
- [ ] Verificar que la tabla `contactos` existe si se mantiene `inpro/php/procesar-contacto.php`

## Legal y cumplimiento

- [ ] Crear páginas de Aviso Legal, Política de Privacidad y Política de Cookies (obligatorio en España / RGPD)
- [ ] Implementar banner de consentimiento de cookies

## Producción

- [ ] Configurar `.env` en el servidor de producción con las claves reales (`RESEND_API_KEY`, `DB_*`, `MAIL_*`)
- [ ] Verificar que el `DocumentRoot` de Apache apunta a `public/`
- [ ] Configurar HTTPS (certificado SSL)

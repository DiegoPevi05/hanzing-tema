# FIERAFLEX · Grupo Hanzing — tema de WordPress

| Carpeta | Qué es |
|---|---|
| `hanzing/` | Tema de WordPress. Lonas como tipo de contenido propio (gramaje, paso de luz, usos, parámetros técnicos, ficha descargable), industrias, testimonios y ajustes en Apariencia > Personalizar. |
| `hanzing-animado/` | Tema hijo de Hanzing: la **versión animada** de la portada (titular por palabras, cifras que cuentan, rollo de 50 m, mapa de envíos, proceso de compra, cortinas). Comparte contenido, ajustes y páginas interiores con `hanzing/`; lo que se corrige en el tema base vale para los dos. |
| `mu-plugins/hanzing-versiones.php` | Selector para comparar las dos versiones en el mismo enlace: `?version=sobria` y `?version=animada` (se recuerda con una cookie y muestra un selector al pie). Se quita con la variable `COMPARAR=no`. |
| `semilla/` | Contenido inicial (subir el número de `semilla/VERSION` para que el próximo despliegue lo vuelva a cargar): `seed.php` crea lonas, industrias, páginas, menú y logos con las imágenes de `semilla/img/`. Se puede correr varias veces: actualiza en lugar de duplicar. |
| `.github/workflows/desplegar.yml` | Despliegue automático a Hostinger. |

## Despliegue automático (GitHub → Hostinger)

Cada `git push` a `main`:
1. revisa la sintaxis del PHP;
2. sube `hanzing/` y `hanzing-animado/` a `wp-content/themes/`, el selector de versiones a `wp-content/mu-plugins/` y `semilla/` a `~/hanzing-semilla/` (fuera de `public_html`) por SSH;
3. pone WordPress en español de México con enlaces `/%postname%/` y activa el tema;
4. carga el contenido inicial si todavía no hay lonas, si cambió el número de `semilla/VERSION` o si `SEMBRAR=si`;
5. en modo prueba pide a Google no indexar el sitio, y limpia la caché.

En GitHub → **Settings → Secrets and variables → Actions**:

| Tipo | Nombre | Valor |
|---|---|---|
| Secret | `SSH_HOST` | IP del servidor (hPanel → Avanzado → Acceso SSH) |
| Secret | `SSH_PORT` | `65002` |
| Secret | `SSH_USER` | usuario SSH (`u123456789`) |
| Secret | `SSH_PRIVATE_KEY` | contenido completo de la clave privada autorizada en hPanel |
| Secret | `RUTA_WP` | carpeta de WordPress del enlace de prueba, sin barra final: `/home/USUARIO/domains/DOMINIO/public_html` |
| Variable (opcional) | `MODO_PRUEBA` | `si` (por defecto) = no indexar; `no` cuando sea el sitio definitivo |
| Variable (opcional) | `TEMA_ACTIVO` | `hanzing` (versión sobria, por defecto) o `hanzing-animado`. Es la versión que ve quien entra sin elegir. |
| Variable (opcional) | `COMPARAR` | `si` (por defecto) sube el selector de versiones; `no` lo quita cuando el cliente ya eligió. |
| Variable (opcional) | `SEMBRAR` | `si` para volver a cargar el contenido inicial. Ojo: sobrescribe textos de lonas, páginas y menú editados en el admin. |

Requisito: WordPress ya instalado en `RUTA_WP` (hPanel → Sitios web → instalar WordPress en el subdominio de prueba).

Sin los secretos, el flujo solo revisa el PHP y avisa que falta configurarlo.

Para forzar un despliegue sin cambios: GitHub → Actions → Desplegar Hanzing en Hostinger → Run workflow.

## Probar en local

Desde la carpeta del proyecto (un nivel arriba de este repositorio), con WordPress + SQLite en `wordpress/` y este tema enlazado en `wordpress/wp-content/themes/hanzing`:

```
php -S localhost:8080 -t wordpress tools/wp-router.php
php wp-cli.phar --path=wordpress eval-file hanzing-tema/semilla/seed.php
```


# 📖 MPWAR (Rendimiento en Aplicaciones web)

[![CI](https://github.com/rubencougil/mpwar-rendimiento/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/rubencougil/mpwar-rendimiento/actions/workflows/ci.yml)
[![Template Sync](https://github.com/rubencougil/mpwar-rendimiento/actions/workflows/template-sync.yml/badge.svg)](https://github.com/rubencougil/mpwar-rendimiento/actions/workflows/template-sync.yml)

## Instalación

- [Instalar Docker](https://docs.docker.com/install/)
- Ejecutar `docker-compose up -d`

## Actualizar cambios detectados en este template

Si estás utilizando este template y quieres integrar los últimos cambios, ejecuta el Action de Github llamado `Template Sync`. 
Se abrirá una nueva Pull Request que habrás de mergear manualmente.

## Servicios

### 1. MySQL

- Puerto: `3306`
- Credenciales: `user/password` o `root/password`
- Schema: `ops/mysql/schema.sql`.
  - NOTA: Si el esquema no se carga automáticamente, ejecutar:
  - `cat ./ops/mysql/schema.sql | docker-compose exec -T mysql /usr/bin/mysql -h localhost --protocol=tcp -u user --password=password db`

### 2. Nginx

- Puerto: `8080`
- Endpoints disponibles en `index.php`
- Config en `ops/nginx/default.conf`

### 3. PHP-fpm

- Dockerfile en `ops/php-fpm/Dockerfile`
- Después de levantar el contenedor, es necesario ejecutar:
  - `docker-compose exec -w "/code/test" php composer install`

### 4. Blackfire

- Puerto: `8307`
- Pasos para configurar Blackfire:
  1. Crear nueva cuenta en [blackfire.io](https://blackfire.io/)
  2. Crear un nuevo archivo `.env` (o modificar y renombrar el existente `.env.dist`) en la raíz de este repositorio con el siguiente contenido: 
  ```
  BLACKFIRE_CLIENT_TOKEN=XXX
  BLACKFIRE_CLIENT_ID=XXX
  BLACKFIRE_SERVER_TOKEN=XXX
  BLACKFIRE_SERVER_ID=XXX
  ```
  3. Sustituir XXX por los valores reales. Estos datos son únicos por cada usuario, y se obtienen en [el siguiente enlace](https://blackfire.io/my/settings/credentials)
  4. Parar, eliminar y arrancar el contenedor para que docker cargue las nuevas variables de entorno. 
     1. `docker-compose stop blackfire`
     2. `docker-compose rm blackfire`
     3. `docker-compose up -d blackfire`
  5. Comprobar que el cli funciona correctamente `docker-compose exec blackfire blackfire curl http://nginx:80`
  6. Instalar la [extensión para navegadores](https://blackfire.io/docs/integrations/browsers/index)
  7. Probar la extensión en `http://localhost:8080`

### 5. Redis

- Puerto: `6379`
- Para usar redis-cli ejecutar `docker-compose exec redis redis-cli`
- Config en `ops/redis/redis.conf`
- Para habilitar la persistencia, comentar la línea `save ""` en `ops/redis/redis.conf`

### 6. RabbitMQ

- Puerto: `5672`
- Dashboard: `http://localhost:15672`, Login: `rabbitmq/rabbitmq`

### 7. Elasticsearch

- Puerto: `9200`
- API Info: `curl http://localhost:9200`

### 8. Kibana

- Puerto: `5601`
- Dashboard: `http://localhost:5601`

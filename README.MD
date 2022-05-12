# 📖 MPWAR (Rendimiento en Aplicaciones web)

[![Actions Status](https://github.com/rubencougil/mpwar-rendimiento-docker/workflows/Docker%20Image%20CI/badge.svg)](https://github.com/rubencougil/mpwar-rendimiento-docker/actions)

## Instalación

- [Instalar Docker](https://docs.docker.com/install/)
- Ejecutar `docker-compose up -d`

## Servicios

### 1. MySQL

- Puerto: `3306`
- Credenciales: `user/password` o `root/password`

---
### 2. Nginx

- Puerto: `8080`
- Endpoints:  
  - Home: `/`
  - Hi: `/users/[name]`
  - Redis: `redis/[key]/[value]`

---
### 3. PHP-fpm

- Dockerfile en `ops/php-fpm/Dockerfile`

---
### 4. Blackfire

- Puerto: `8307`
- Pasos para configurar Blackfire:
  1. Crear nueva cuenta en [blackfire.io](https://blackfire.io/)
  2. Crear un nuevo archivo `.env` en la raíz de este repositorio con el siguiente contenido: 
  ```
  BLACKFIRE_CLIENT_TOKEN=XXX
  BLACKFIRE_CLIENT_ID=XXX
  BLACKFIRE_SERVER_TOKEN=XXX
  BLACKFIRE_SERVER_ID=XXX
  ```
  3. Sustituir XXX por los valores reales. Estos datos son únicos por cada usuario, y se obtienen en [el siguiente enlace](https://blackfire.io/my/settings/credentials)
  4. Reiniciar el contenedor `docker-compose restart blackfire`
  5. Comprobar que el cli funciona correctamente `docker-compose exec blackfire blackfire curl http://nginx:80`
  6. Instalar la [extensión para navegadores](https://blackfire.io/docs/integrations/browsers/index)
  7. Probar la extensión en `http://localhost:8080`

---
### 5. Redis

- Puerto: `6379`
- Para usar redis-cli ejecutar `docker-compose exec redis redis-cli`





- RabbitMQ: 15672
- Elasticsearch: 9200
- Kibana: 5601

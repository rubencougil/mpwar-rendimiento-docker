# 📖 MPWAR (Rendimiento en Aplicaciones web)

[![Actions Status](https://github.com/rubencougil/mpwar-rendimiento-docker/workflows/Docker%20Image%20CI/badge.svg)](https://github.com/rubencougil/mpwar-rendimiento-docker/actions)

## Instalación

- [Instalar Docker](https://docs.docker.com/install/)
- Exportar las variables de entorno necesarias para el [correcto funcionamiento de Blackfire](https://blackfire.io/docs/integrations/docker) y crear el alias `blackfire-curl`. Esta configuración se encuentra en el archivo `.env.dist`. Es necesario renombrar `env.dist` a `.env` y completar los valores.
- Ejecutar `docker-compose up -d`

## Servicios

- Mysql: 3306
- Nginx: 8080
- Redis: 6379
- RabbitMQ: 15672
- Elasticsearch: 9200
- Kibana: 5601
- Blackfire

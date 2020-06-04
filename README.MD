# 📖 MPWAR (Rendimiento en Aplicaciones web)

[![Actions Status](https://github.com/rubencougil/mpwar-rendimiento-docker/workflows/Docker%20Image%20CI/badge.svg)](https://github.com/rubencougil/mpwar-rendimiento-docker/actions)

## Instalación

- [Instalar Docker](https://docs.docker.com/install/)
- [Instalar docker-compose](https://docs.docker.com/compose/install/)
- Exportar las variables de entorno necesarias para el [correcto funcionamiento de Blackfire](https://blackfire.io/docs/integrations/docker) y crear el alias `blackfire-curl`. Esta configuración se encuentra en el archivo `.env`
- Ejecutar `docker-compose up -d`

## Servicios

- Mysql: 3306
- Nginx: 8080
- Redis: 6379
- RabbitMQ: 15672
- Elasticsearch: 9200
- Kibana: 5601
- Blackfire

## Elasticsearch Cluster

El archivo `docker-compose-es-cluster.yml` nos permitirá levantar un Cluster de Elasticsearch con 3 nodos. 

```
docker-compose -f docker-compose-es-cluster.yml up -d --remove-orphans
```

Una vez levantado el cluster, podemos comprobar el estado del mismo:

```
curl http://localhost:9200/_cluster/health?pretty
```

Ahora creamos un índice con replicación 2 y añadimos un documento:

```
curl -H "Content-Type: application/json" -XPUT http://localhost:9200/test -d '{"settings" : {"index" : {"number_of_shards" : 3, "number_of_replicas" : 2 }}}'
curl -H "Content-Type: application/json" -XPUT http://localhost:9200/test/docs/1 -d '{"name": "ruben"}'
```

Para comprobar la distribución de los documentos en el índice:

```
curl http://127.0.0.1:9200/_cat/indices?v
```

Se ha añadido un servicio web extra que servirá como UI para gestionar el cluster (ya que la herramienta oficial 
integrada con Kibana necesita X-Pack). Puedes acceder al servicio a través del navegador en:

`http://localhost:9100`

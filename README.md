# API PROJECT LARAVEL

Este proyecto es una API desarrollada en Laravel para gestionar candidatos. La API incluye autenticación JWT, caché con Redis, y sigue las buenas prácticas de la comunidad de Laravel. También se utiliza SonarQube para el análisis de código estático.

## Requisitos

- PHP 8.0+
- Composer
- MySQL
- Redis
- Docker (para SonarQube)
- SonarQube Scanner

## Instalación

### Paso 1: Clonar el Repositorio

```sh
git clone https://github.com/dabydat/api_project_laravel.git
cd api_project_laravel
```

### Paso 2: Instalar Dependencias

composer install

### Paso 3: Configurar el Archivo .env

Copia el archivo .env.example a .env y configura las variables de entorno necesarias.

cp .env.example .env

### Paso 4: Generar la Clave de la Aplicación

php artisan key:generate

### Paso 5: Configurar la Base de Datos

Configura las variables de entorno de la base de datos en el archivo .env.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

### Paso 6: Ejecutar las Migraciones y Seeders

php artisan migrate --seed

### Paso 7: Configurar JWT

Genera la clave secreta para JWT.

php artisan jwt:secret

### Paso 8: Levantar SonarQube

Crea un archivo docker-compose.yml en el directorio raíz del proyecto con el siguiente contenido:

version: '3.8'

services:
  # Servicio para SonarQube
  sonarqube:
    image: sonarqube:latest
    container_name: sonarqube
    ports:
      - "9000:9000"

docker-compose up -d

### Paso 9: Configurar SonarQube

1. Accede a http://localhost:9000.
2. Inicia sesión con las credenciales predeterminadas (admin/admin).
3. Cambia la contraseña predeterminada.
4. Crea un nuevo proyecto y genera un token de análisis.

### Paso 10: Configurar el Archivo sonar-project.properties

Crea un archivo llamado sonar-project.properties en el directorio raíz del proyecto con el siguiente contenido:

sonar.projectKey=my_project_key
sonar.projectName=My Project Name
sonar.projectVersion=1.0
sonar.sources=.
sonar.host.url=http://localhost:9000
sonar.login=your_generated_token

Reemplaza my_project_key, My Project Name, y your_generated_token con los valores correspondientes.

### Paso 11: Instalar SonarQube Scanner

Descargar e instalar SonarQube Scanner

### Paso 12: Ejecutar el Análisis de SonarQube

sonar-scanner

## Endpoints de la API

### Generar Access Token

POST /auth

Solicitud:

{
  "username": "tester",
  "password": "PASSWORD"
}

Respuesta:

- 200 OK

    {
    "meta": { "success": true, "errors": [] },
    "data": {
      "token": "TOOOOOKEN",
      "minutes_to_expire": 1440
    }
  }
  

- 401 Unauthorized

    {
    "meta": { "success": false, "errors": ["Password incorrect for: tester"] }
  }
  

### Crear Candidato

POST /lead

Solicitud:

{
  "name": "Mi candidato",
  "source": "Fotocasa",
  "owner": 2
}

Respuesta:

- 201 OK

    {
    "meta": { "success": true, "errors": [] },
    "data": {
      "id": "1",
      "name": "Mi candidato",
      "source": "Fotocasa",
      "owner": 2,
      "created_at": "2020-09-01 16:16:16",
      "created_by": 1
    }
  }
  

- 401 Unauthorized

    {
    "meta": { "success": false, "errors": ["Token expired"] }
  }
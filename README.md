# 🖥️ API Parcial Uno 2025I - Sistema de Gestión de Computadoras y Categorías

API RESTful desarrollada con Laravel 11 para la gestión de computadoras y categorías con sistema de autenticación mediante Laravel Sanctum.

## 📋 Características

- ✅ Sistema de autenticación con tokens (Laravel Sanctum)
- ✅ CRUD completo de Computadoras
- ✅ CRUD completo de Categorías
- ✅ Relación 1:N entre Categorías y Computadoras
- ✅ Validaciones de formularios con Form Requests
- ✅ Seeders y Factories para datos de prueba
- ✅ Códigos de barras únicos para computadoras

## 🛠️ Tecnologías Utilizadas

- **PHP** 8.2+
- **Laravel** 11.x
- **PostgreSQL** (Base de datos)
- **Laravel Sanctum** (Autenticación API)
- **Faker** (Datos de prueba)

## 📦 Requisitos Previos

Antes de instalar el proyecto, asegúrate de tener instalado:

- **PHP** 8.2 o superior
- **Composer** (Gestor de dependencias de PHP)
- **PostgreSQL** (Base de datos)
- **Git** (Control de versiones)
- **Postman** o similar para probar la API

### Verificar Instalaciones

```bash
# Verificar PHP
php --version

# Verificar Composer  
composer --version

# Verificar PostgreSQL
psql --version
```

## 🚀 Instalación Paso a Paso

### 1. Clonar el Repositorio

```bash
# Clonar el proyecto
git clone [URL_DEL_REPOSITORIO]
cd api-parcial-uno-2025I
```

### 2. Instalar Dependencias

```bash
# Instalar dependencias de PHP
composer install
```

### 3. Configurar Variables de Entorno

```bash
# Copiar el archivo de configuración
copy .env.example .env
```

Edita el archivo `.env` con tu configuración de base de datos:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=tu_nombre_base_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 4. Generar Clave de Aplicación

```bash
# Generar APP_KEY
php artisan key:generate
```

### 5. Crear Base de Datos

Crea una base de datos en PostgreSQL con el nombre que configuraste en el `.env`.

### 6. Ejecutar Migraciones

```bash
# Ejecutar todas las migraciones
php artisan migrate
```

### 7. Poblar Base de Datos (Opcional pero recomendado)

```bash
# Ejecutar seeders para datos de prueba (RECOMENDADO)
php artisan db:seed

# O ejecutar seeders específicos en orden:
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=ComputerSeeder
```

### 8. Iniciar el Servidor

```bash
# Iniciar servidor de desarrollo
php artisan serve
```

El servidor estará disponible en: `http://127.0.0.1:8000` o `http://localhost:8000`

## 📚 Estructura de Base de Datos

### Tabla: users
```sql
- id (bigint, PK)
- name (string)
- email (string, unique)
- password (string, hashed)
- timestamps
```

### Tabla: categories
```sql
- id_category (bigint, PK)
- category_name (string, 100, unique)
- category_description (text)
- category_order (integer, default: 0)
- category_discount (decimal 5,2, nullable)
- estado (boolean, default: true)
- timestamps
```

### Tabla: computers
```sql
- id_computer (bigint, PK)
- computer_brand (string)
- computer_model (string)
- computer_price (double)
- computer_ram_size (integer)
- computer_is_laptop (boolean)
- category_id (bigint, FK → categories.id_category)
- computer_barcode (string, unique, nullable)
- timestamps
```

## 🔐 Autenticación

La API utiliza **Laravel Sanctum** para autenticación mediante tokens.

### Obtener Token de Acceso

**Endpoint:** `POST /api/login`

```json
{
    "email": "leo@correo.com",
    "password": "123456"
}
```

**Respuesta exitosa:**
```json
{
    "status": true,
    "name": "Leonardo",
    "token": "1|abc123def456..."
}
```

**Usar el Token:**
Incluir en el header de todas las peticiones protegidas:
```
Authorization: Bearer 1|abc123def456...
```

## 📍 Endpoints de la API

### 🔒 Endpoints Públicos

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| POST | `/api/login` | Autenticación de usuario |

### 🔐 Endpoints Protegidos (Requieren Token)

#### 👤 Usuario
| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/user` | Información del usuario autenticado |

#### 💻 Computadoras
| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/computers` | Listar todas las computadoras |
| POST | `/api/computers` | Crear nueva computadora |
| GET | `/api/computers/{id}` | Ver computadora específica |
| PUT | `/api/computers/{id}` | Actualizar computadora |
| DELETE | `/api/computers/{id}` | Eliminar computadora |

#### 📂 Categorías
| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/categories` | Listar todas las categorías |
| POST | `/api/categories` | Crear nueva categoría |
| GET | `/api/categories/{id}` | Ver categoría específica |
| PUT | `/api/categories/{id}` | Actualizar categoría |
| DELETE | `/api/categories/{id}` | Eliminar categoría |
| GET | `/api/categories-active` | Categorías activas con computadoras |

## 🧪 Ejemplos de Uso con Postman

### 1. Autenticación

```http
POST http://localhost:8000/api/login
Content-Type: application/json

{
    "email": "leo@correo.com",
    "password": "123456"
}
```

### 2. Crear Categoría

```http
POST http://localhost:8000/api/categories
Authorization: Bearer {tu_token}
Content-Type: application/json

{
    "category_name": "Gaming",
    "category_description": "Computadoras para videojuegos",
    "category_order": 1,
    "category_discount": 15.50,
    "estado": true
}
```

### 3. Crear Computadora

```http
POST http://localhost:8000/api/computers
Authorization: Bearer {tu_token}
Content-Type: application/json

{
    "computer_brand": "ASUS",
    "computer_model": "ROG Strix",
    "computer_price": 1500.99,
    "computer_ram_size": 16,
    "computer_is_laptop": true,
    "category_id": 1,
    "computer_barcode": "1234567890"
}
```

### 4. Ver Computadora con Categoría

```http
GET http://localhost:8000/api/computers/1
Authorization: Bearer {tu_token}
Accept: application/json
```

### 5. Categorías Activas con Computadoras

```http
GET http://localhost:8000/api/categories-active
Authorization: Bearer {tu_token}
Accept: application/json
```

## ✅ Validaciones

### Computadoras
- `computer_brand`: Requerido, string, máx 255 caracteres
- `computer_model`: Requerido, string, máx 255 caracteres
- `computer_price`: Requerido, numérico, mayor a 0
- `computer_ram_size`: Requerido, entero, mayor a 0
- `computer_is_laptop`: Requerido, boolean
- `category_id`: Opcional, debe existir en tabla categories
- `computer_barcode`: Opcional, string, único

### Categorías
- `category_name`: Requerido, string, máx 100 caracteres, único
- `category_description`: Requerido, string
- `category_order`: Opcional, entero mayor o igual a 0
- `category_discount`: Opcional, decimal, entre 0 y 999.99
- `estado`: Opcional, boolean

## 🎯 Datos de Prueba

El proyecto incluye seeders organizados que crean:

### UserSeeder
- **Usuario de prueba principal**: `leo@correo.com` / `123456`
- **Usuario adicional**: `test@example.com` / `password`
- **5 usuarios aleatorios** con Factory

### CategorySeeder
- **10 categorías** con datos realistas
- Estados aleatorios (80% activos)
- Descuentos opcionales

### ComputerSeeder
- **50 computadoras** con categorías asignadas aleatoriamente
- **Códigos de barras únicos** generados automáticamente
- Relaciones establecidas con categorías existentes

### Orden de Ejecución
Los seeders se ejecutan en orden correcto:
1. `UserSeeder` → Usuarios (independientes)
2. `CategorySeeder` → Categorías (independientes) 
3. `ComputerSeeder` → Computadoras (dependen de categorías)

## 🐛 Solución de Problemas Comunes

### Error: "Class LoginRequest does not exist"
```bash
# Verificar que existe el archivo
ls app/Http/Requests/LoginRequest.php

# Si no existe, se creó automáticamente durante la instalación
```

### Error: "Call to undefined method createToken()"
```bash
# Verificar configuración en User model
# Debe incluir: use Laravel\Sanctum\HasApiTokens;
```

### Error de Migración
```bash
# Limpiar y volver a ejecutar migraciones
php artisan migrate:fresh --seed
```

### Error: "Duplicate entry" al ejecutar seeders
```bash
# Los seeders están diseñados para evitar duplicados
# Puedes ejecutarlos múltiples veces sin problema
php artisan db:seed

# O limpiar toda la BD y empezar de nuevo
php artisan migrate:fresh --seed
```

### Error de Autenticación
```bash
# Verificar que el guard sanctum esté en config/auth.php
# Verificar que el middleware auth:sanctum esté en las rutas
```

## 📝 Comandos Útiles

```bash
# Ver rutas disponibles
php artisan route:list

# Ver estado de migraciones
php artisan migrate:status

# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Generar nuevo seeder
php artisan make:seeder NombreSeeder

# Generar nuevo factory  
php artisan make:factory NombreFactory

# Generar nuevo request
php artisan make:request NombreRequest

# Ejecutar tinker (consola interactiva)
php artisan tinker
```

## 👥 Colaboradores

- **Desarrollador Principal**: [Leonardo Maje Rios]
- **Proyecto**: API Parcial Uno 2025I

## 📄 Licencia

Este proyecto es de uso académico para el parcial de la materia.

---

**¡Listo para usar! 🚀**

Si sigues todos los pasos en orden, tendrás la API funcionando correctamente. Para cualquier duda o problema, revisa la sección de solución de problemas o contacta al desarrollador.

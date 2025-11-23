# 🖥️ Parcial FINAL 2025I - Sistema de Gestión de Computadoras y Categorías

Sistema completo de gestión desarrollado con Laravel 12 que incluye **API RESTful** y **Interfaz Web** moderna con autenticación, CRUD completo de computadoras y categorías, y gestión de relaciones entre entidades.

## 📋 Características Principales

### 🔐 Autenticación y Seguridad
- ✅ Sistema de autenticación completo con **Laravel Jetstream** (Inertia + Vue)
- ✅ Registro, login y logout de usuarios
- ✅ Autenticación API con tokens mediante **Laravel Sanctum**
- ✅ Dashboard protegido accesible después de autenticación
- ✅ Gestión de perfil de usuario

### 💻 Interfaz Web (Frontend)
- ✅ **Interfaz moderna** desarrollada con **Vue 3** e **Inertia.js**
- ✅ **CRUD completo de Categorías** con:
  - Listado paginado con búsqueda (filtrado backend)
  - Formularios de creación y edición con validación frontend y backend
  - Vista de detalle con registros relacionados
  - Eliminación con confirmación
  - Mensajes de éxito y error
  - Contador de computadoras por categoría
- ✅ **CRUD completo de Computadoras** con:
  - Listado paginado con búsqueda
  - Formularios de creación y edición
  - Vista de detalle con categoría relacionada
  - Eliminación con confirmación
- ✅ Actualizaciones sin recargar página (SPA con Inertia)
- ✅ Diseño responsive con **Tailwind CSS**

### 🔌 API RESTful (Backend)
- ✅ **CRUD completo de Computadoras** (endpoints protegidos)
- ✅ **CRUD completo de Categorías** (endpoints protegidos)
- ✅ Relación 1:N entre Categorías y Computadoras
- ✅ Validaciones robustas con Form Requests
- ✅ Eager Loading para optimizar consultas
- ✅ Códigos de barras únicos para computadoras

### 📊 Base de Datos
- ✅ Migraciones completas y organizadas
- ✅ Seeders y Factories para datos de prueba
- ✅ Relaciones Eloquent bien definidas
- ✅ Optimización de consultas (evita N+1)

## 🛠️ Stack Tecnológico

### Backend
- **PHP** 8.2+
- **Laravel** 12.x
- **Laravel Jetstream** 5.3 (Autenticación)
- **Laravel Sanctum** 4.0 (API Tokens)
- **Inertia.js** 2.0 (SPA Framework)
- **PostgreSQL/MySQL/SQLite** (Base de datos)

### Frontend
- **Vue.js** 3.5.24
- **Inertia.js** 2.2.18
- **Tailwind CSS** 3.4.0
- **Vite** 7.0.7 (Build Tool)
- **Axios** 1.11.0

### Herramientas de Desarrollo
- **Composer** (Gestor de dependencias PHP)
- **NPM** (Gestor de dependencias Node.js)
- **Vite** (Bundler y dev server)

## 📦 Requisitos Previos

Antes de instalar el proyecto, asegúrate de tener instalado:

- **PHP** 8.2 o superior
- **Composer** (Gestor de dependencias de PHP)
- **Node.js** 18+ y **NPM** (Para el frontend)
- **Base de datos** (PostgreSQL, MySQL o SQLite)
- **Git** (Control de versiones)

### Verificar Instalaciones

```bash
# Verificar PHP
php --version

# Verificar Composer
composer --version

# Verificar Node.js y NPM
node --version
npm --version

# Verificar base de datos (PostgreSQL ejemplo)
psql --version
```

## 🚀 Instalación Paso a Paso

### 1. Clonar el Repositorio

```bash
git clone [URL_DEL_REPOSITORIO]
cd api-parcial-uno-2025I
```

### 2. Instalar Dependencias de PHP

```bash
composer install
```

### 3. Instalar Dependencias de Node.js

```bash
npm install
```

### 4. Configurar Variables de Entorno

```bash
# Copiar el archivo de configuración
copy .env.example .env  # Windows
# o
cp .env.example .env    # Linux/Mac
```

Edita el archivo `.env` con tu configuración:

```env
APP_NAME="Sistema de Gestión"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

# Base de datos (elige una opción)
DB_CONNECTION=pgsql  # o mysql, sqlite
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nombre_base_datos
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```

### 5. Generar Clave de Aplicación

```bash
php artisan key:generate
```

### 6. Crear Base de Datos

Crea una base de datos en tu sistema de gestión (PostgreSQL, MySQL, etc.) con el nombre que configuraste en el `.env`.

### 7. Ejecutar Migraciones

```bash
php artisan migrate
```

### 8. Poblar Base de Datos (Opcional pero recomendado)

```bash
# Ejecutar todos los seeders
php artisan db:seed

# O ejecutar seeders específicos en orden:
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=ComputerSeeder
```

### 9. Compilar Assets del Frontend

```bash
# Para desarrollo (con hot reload)
npm run dev

# Para producción
npm run build
```

### 10. Iniciar el Servidor

**Terminal 1 - Servidor Laravel:**
```bash
php artisan serve
```

**Terminal 2 - Servidor Vite (si usas `npm run dev`):**
```bash
npm run dev
```

El servidor estará disponible en: `http://127.0.0.1:8000` o `http://localhost:8000`

## 👤 Usuarios de Prueba

Después de ejecutar los seeders, puedes usar estas credenciales:

- **Email:** `leo@correo.com`
- **Password:** `123456`

O:

- **Email:** `test@example.com`
- **Password:** `password`

## 🌐 Uso de la Interfaz Web

### Acceso a la Aplicación

1. Abre tu navegador y ve a: `http://localhost:8000`
2. Haz clic en **"Login"** o **"Register"**
3. Inicia sesión con las credenciales de prueba
4. Serás redirigido automáticamente al **Dashboard**

### Funcionalidades Disponibles

#### 📂 Gestión de Categorías
- **Listado:** `/categories` - Ver todas las categorías con paginación y búsqueda
- **Crear:** `/categories/create` - Formulario de creación con validación
- **Editar:** `/categories/{id}/edit` - Formulario de edición
- **Detalle:** `/categories/{id}` - Ver categoría completa con computadoras relacionadas
- **Eliminar:** Botón de eliminación con confirmación

#### 💻 Gestión de Computadoras
- **Listado:** `/computers` - Ver todas las computadoras con paginación y búsqueda
- **Crear:** `/computers/create` - Formulario de creación con selección de categoría
- **Editar:** `/computers/{id}/edit` - Formulario de edición
- **Detalle:** `/computers/{id}` - Ver computadora completa con categoría relacionada
- **Eliminar:** Botón de eliminación con confirmación

### Características de la Interfaz

- ✅ **Búsqueda en tiempo real** (filtrado desde el backend)
- ✅ **Paginación** automática
- ✅ **Validación frontend** (HTML5) y **backend** (Laravel)
- ✅ **Mensajes flash** de éxito y error
- ✅ **Confirmaciones** antes de eliminar
- ✅ **Actualizaciones sin recargar** (SPA con Inertia)
- ✅ **Diseño responsive** (móvil, tablet, desktop)

## 🔌 Uso de la API RESTful

### Autenticación

**Endpoint:** `POST /api/login`

```http
POST http://localhost:8000/api/login
Content-Type: application/json

{
    "email": "leo@correo.com",
    "password": "123456"
}
```

**Respuesta:**
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

### Endpoints Disponibles

#### 🔒 Endpoints Públicos

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| POST | `/api/login` | Autenticación de usuario |

#### 🔐 Endpoints Protegidos (Requieren Token)

**Usuario:**
| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/user` | Información del usuario autenticado |

**Computadoras:**
| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/computers` | Listar todas las computadoras |
| POST | `/api/computers` | Crear nueva computadora |
| GET | `/api/computers/{id}` | Ver computadora específica |
| PUT | `/api/computers/{id}` | Actualizar computadora |
| DELETE | `/api/computers/{id}` | Eliminar computadora |

**Categorías:**
| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/categories` | Listar todas las categorías |
| POST | `/api/categories` | Crear nueva categoría |
| GET | `/api/categories/{id}` | Ver categoría específica |
| PUT | `/api/categories/{id}` | Actualizar categoría |
| DELETE | `/api/categories/{id}` | Eliminar categoría |
| GET | `/api/categories-active` | Categorías activas con computadoras |

### Ejemplos de Uso de la API

#### Crear Categoría

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

#### Crear Computadora

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

## 📚 Estructura de Base de Datos

### Tabla: users
```sql
- id (bigint, PK)
- name (string)
- email (string, unique)
- password (string, hashed)
- email_verified_at (timestamp, nullable)
- two_factor_secret (text, nullable)
- two_factor_recovery_codes (text, nullable)
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

### Relaciones

- **Categorías → Computadoras:** 1:N (Una categoría tiene muchas computadoras)
- **Computadoras → Categoría:** N:1 (Muchas computadoras pertenecen a una categoría)

## ✅ Validaciones

### Computadoras
- `computer_brand`: Requerido, string, máx 255 caracteres
- `computer_model`: Requerido, string, máx 255 caracteres
- `computer_price`: Requerido, numérico, mayor a 0
- `computer_ram_size`: Requerido, entero, mayor a 0
- `computer_is_laptop`: Requerido, boolean
- `category_id`: Requerido, debe existir en tabla categories
- `computer_barcode`: Opcional, string, único

### Categorías
- `category_name`: Requerido, string, máx 100 caracteres, único
- `category_description`: Requerido, string, mín 10 caracteres
- `category_order`: Requerido, entero, entre 0 y 9999
- `category_discount`: Opcional, decimal, entre 0 y 100
- `estado`: Requerido, boolean

## 🎯 Datos de Prueba

El proyecto incluye seeders organizados que crean:

### UserSeeder
- **Usuario de prueba principal:** `leo@correo.com` / `123456`
- **Usuario adicional:** `test@example.com` / `password`
- **5 usuarios aleatorios** con Factory

### CategorySeeder
- **10 categorías** con datos realistas
- Estados aleatorios (80% activos)
- Descuentos opcionales

### ComputerSeeder
- **50 computadoras** con categorías asignadas aleatoriamente
- **Códigos de barras únicos** generados automáticamente
- Relaciones establecidas con categorías existentes

## 📁 Estructura del Proyecto

```
api-parcial-uno-2025I/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/          # Controladores de API
│   │   │   └── Web/          # Controladores de Web (Inertia)
│   │   └── Requests/         # Form Requests (Validaciones)
│   ├── Models/               # Modelos Eloquent
│   └── Providers/            # Service Providers
├── database/
│   ├── migrations/           # Migraciones
│   ├── seeders/              # Seeders
│   └── factories/            # Factories
├── resources/
│   ├── js/
│   │   ├── Pages/            # Componentes Vue (Inertia)
│   │   │   ├── Categories/   # Páginas de Categorías
│   │   │   ├── Computers/   # Páginas de Computadoras
│   │   │   └── Dashboard.vue
│   │   ├── Layouts/          # Layouts Vue
│   │   └── Components/        # Componentes Vue reutilizables
│   ├── views/
│   │   ├── auth/             # Vistas de autenticación (Jetstream)
│   │   ├── layouts/          # Layouts Blade (base de Inertia)
│   │   └── components/       # Componentes Blade (Jetstream)
│   └── css/                  # Estilos CSS
├── routes/
│   ├── api.php               # Rutas de API
│   └── web.php               # Rutas web (Inertia)
└── tests/                    # Pruebas automatizadas
```

## 🐛 Solución de Problemas Comunes

### Error: "Class LoginRequest does not exist"
```bash
# Verificar que existe el archivo
ls app/Http/Requests/LoginRequest.php
```

### Error: "Vite manifest not found"
```bash
# Compilar assets del frontend
npm run dev
# o para producción
npm run build
```

### Error de Migración
```bash
# Limpiar y volver a ejecutar migraciones
php artisan migrate:fresh --seed
```

### Error: "Module not found" en Vue
```bash
# Reinstalar dependencias de Node.js
rm -rf node_modules package-lock.json
npm install
```

### Error de Autenticación
```bash
# Verificar que el guard sanctum esté en config/auth.php
# Verificar que el middleware auth:sanctum esté en las rutas
```

### Assets no se cargan
```bash
# Asegúrate de tener Vite corriendo en desarrollo
npm run dev

# O compilar para producción
npm run build
```

## 📝 Comandos Útiles

### Laravel
```bash
# Ver rutas disponibles
php artisan route:list

# Ver estado de migraciones
php artisan migrate:status

# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Generar nuevo seeder
php artisan make:seeder NombreSeeder

# Generar nuevo factory
php artisan make:factory NombreFactory

# Generar nuevo request
php artisan make:request NombreRequest

# Ejecutar tinker (consola interactiva)
php artisan tinker
```

### Frontend
```bash
# Desarrollo con hot reload
npm run dev

# Compilar para producción
npm run build

# Verificar dependencias
npm audit
```

## 🧪 Testing

El proyecto incluye pruebas automatizadas:

```bash
# Ejecutar todas las pruebas
php artisan test

# Ejecutar pruebas específicas
php artisan test --filter CategoryTest
```

## 📄 Documentación Adicional

- `VERIFICACION_REQUERIMIENTOS_COMPLETA.md` - Verificación completa de requerimientos del proyecto
- `ARCHIVOS_ELIMINABLES.md` - Análisis de archivos del proyecto
- `LIMPIEZA_COMPLETADA.md` - Resumen de limpieza realizada

## 👥 Colaboradores

- **Desarrollador Principal:** Leonardo Maje Rios
- **Proyecto:** Parcial FINAL 2025I

## 📄 Licencia

Este proyecto es de uso académico para el parcial final de la materia.

---

## 🚀 ¡Listo para usar!

Si sigues todos los pasos en orden, tendrás el sistema completo funcionando correctamente con:
- ✅ Interfaz web moderna con Vue + Inertia
- ✅ API RESTful completa
- ✅ Autenticación con Jetstream
- ✅ CRUD completo de ambas entidades
- ✅ Relaciones y validaciones implementadas

**¡Disfruta del proyecto! 🎉**

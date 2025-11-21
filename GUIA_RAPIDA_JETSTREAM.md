# 🚀 Guía Rápida - Laravel Jetstream

## ✅ Instalación Completada Exitosamente

Laravel Jetstream con Livewire ha sido instalado y configurado en tu proyecto.

---

## 🎯 Cómo Probar la Autenticación

### Paso 1: Iniciar el Servidor

```bash
php artisan serve
```

El servidor iniciará en: **http://localhost:8000**

---

### Paso 2: Acceder al Sistema

#### Opción A: Iniciar Sesión con Usuario Existente

1. Abre tu navegador y ve a: **http://localhost:8000/login**

2. Usa estas credenciales:
   ```
   Email: leo@correo.com
   Password: 123456
   ```
   O estas:
   ```
   Email: test@example.com
   Password: password
   ```

3. Haz clic en **"Log in"**

4. Serás redirigido automáticamente al **Dashboard**: **http://localhost:8000/dashboard**

#### Opción B: Registrar un Nuevo Usuario

1. Ve a: **http://localhost:8000/register**

2. Completa el formulario:
   - Nombre
   - Email
   - Contraseña
   - Confirmar contraseña

3. Haz clic en **"Register"**

4. Serás autenticado automáticamente y redirigido al Dashboard

---

## 📍 Rutas Disponibles

### Públicas (No requieren autenticación):
- **`/`** - Página principal
- **`/login`** - Iniciar sesión
- **`/register`** - Registrarse
- **`/forgot-password`** - Recuperar contraseña

### Protegidas (Requieren autenticación):
- **`/dashboard`** - Dashboard principal ⭐
- **`/user/profile`** - Perfil del usuario
- **`/user/api-tokens`** - Gestión de tokens API (si está habilitado)

---

## 🔐 Funcionalidades Incluidas

### ✅ Autenticación Completa
- [x] Registro de nuevos usuarios
- [x] Inicio de sesión
- [x] Cierre de sesión
- [x] Recuperación de contraseña
- [x] Verificación de email (opcional)

### ✅ Gestión de Perfil
- [x] Actualizar nombre y email
- [x] Cambiar contraseña
- [x] Cerrar sesión en otros dispositivos
- [x] Eliminar cuenta

### ✅ Seguridad Avanzada
- [x] Autenticación de dos factores (2FA)
- [x] Gestión de sesiones
- [x] Protección contra CSRF
- [x] Hashing seguro de contraseñas

---

## 🎨 Interfaz de Usuario

La interfaz está construida con:
- **Tailwind CSS 4.0** - Framework CSS moderno
- **Livewire 3.6** - Componentes reactivos
- **Alpine.js** - JavaScript minimalista

Todo con un diseño **responsive** y moderno.

---

## 🧪 Verificación Rápida

### Verifica que todo funciona:

1. ✅ Migraciones ejecutadas:
   ```bash
   php artisan migrate:status
   ```

2. ✅ Rutas de autenticación disponibles:
   ```bash
   php artisan route:list --path=login
   php artisan route:list --path=register
   php artisan route:list --path=dashboard
   ```

3. ✅ Usuarios de prueba creados:
   ```bash
   php artisan tinker
   >>> User::count()
   ```

---

## 📂 Archivos Importantes

### Configuración:
- `config/jetstream.php` - Configuración de Jetstream
- `config/fortify.php` - Configuración de autenticación

### Vistas:
- `resources/views/auth/` - Vistas de autenticación
- `resources/views/profile/` - Vistas de perfil
- `resources/views/dashboard.blade.php` - Dashboard
- `resources/views/layouts/app.blade.php` - Layout principal

### Modelos:
- `app/Models/User.php` - Modelo de usuario (con traits de Jetstream)

### Rutas:
- `routes/web.php` - Rutas web (incluye dashboard)
- Laravel Fortify registra automáticamente las rutas de autenticación

---

## 🛠️ Comandos Útiles

```bash
# Limpiar cachés
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Ver todas las rutas
php artisan route:list

# Crear nuevos usuarios
php artisan db:seed --class=UserSeeder

# Revertir y ejecutar migraciones
php artisan migrate:fresh --seed
```

---

## 🔧 Personalización

### Cambiar el logo:
Edita: `resources/views/components/application-logo.blade.php`

### Modificar el dashboard:
Edita: `resources/views/dashboard.blade.php`

### Personalizar colores:
El proyecto usa Tailwind CSS. Puedes personalizar colores en las vistas.

### Habilitar características adicionales:
Edita `config/jetstream.php`:
```php
'features' => [
    Features::profilePhotos(),  // Fotos de perfil
    Features::api(),            // Tokens de API
    Features::accountDeletion(), // Eliminar cuentas
],
```

---

## 🐛 Solución de Problemas

### Error: "Page Expired" al enviar formularios
- Limpia la caché: `php artisan config:clear`
- Verifica que el archivo `.env` tenga `APP_KEY` configurado

### Las vistas no se actualizan
- Limpia la caché de vistas: `php artisan view:clear`
- Recompila los assets: `npm run build`

### Error 404 en rutas de autenticación
- Limpia la caché de rutas: `php artisan route:clear`
- Verifica que Fortify esté instalado: `composer show laravel/fortify`

---

## 📚 Recursos Adicionales

- **Documentación de Jetstream**: https://jetstream.laravel.com
- **Documentación de Livewire**: https://livewire.laravel.com
- **Documentación de Laravel**: https://laravel.com/docs

---

## ✨ ¡Listo para Producción!

Tu aplicación ahora tiene:
- ✅ Sistema de autenticación completo
- ✅ Dashboard funcional
- ✅ Gestión de perfiles
- ✅ Interfaz moderna y responsive
- ✅ Seguridad implementada (2FA, CSRF, etc.)

**¡Comienza a desarrollar tu aplicación! 🎉**


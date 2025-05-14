# Proyecto Laravel - Gestión de Clientes

Este proyecto permite gestionar clientes asociados a ciudades y departamentos. A continuación se detallan sus funcionalidades, pasos de instalación local y la generación del modelo de base de datos.

---

## 📑 ¿Qué hace el proyecto?

* **CRUD de Clientes**: Registrar clientes con nombre, apellido, cédula, ciudad, departamento, celular y correo electrónico.
* **Relaciones Eloquent**: Utiliza Eloquent para definir relaciones:

  * Un departamento tiene muchas ciudades y muchos clientes.
  * Una ciudad pertenece a un departamento y tiene muchos clientes.
  * Un cliente pertenece a un departamento y una ciudad.
* **Validación de datos**: Reglas de validación en formularios.
* **Interfaz Blade**: Vistas limpias con Laravel Blade para navegar en la Landing page. 

---

## ✅ Requisitos

* PHP >= 8.1
* Composer
* MySQL o MariaDB
* Node.js y NPM (opcional, si usas Vite)
* Laravel >= 10

---

## 🚀 Instalación local

1. Clona el repositorio:

   ```bash
   git clone [https://github.com/tu-usuario/nombre-del-proyecto.git](https://github.com/SantiagoCodeMaster/Prueba_tecnica)
   cd prueba_
   ```

2. Instala dependencias PHP:

   ```bash
   composer install
   ```

3. Copia y configura el archivo de entorno:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Ajusta tus credenciales de base de datos en `.env`:

   ```dotenv
   DB_DATABASE=clientes_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Ejecuta migraciones y semillas (si las tienes):

   ```bash
   php artisan migrate
   php artisan db:seed  # opcional
   ```

6. (Opcional) Instala y compila assets con Vite:

   ```bash
   npm install && npm run dev
   composer require maatwebsite/excel

   ```

7. Levanta el servidor local:

   ```bash
   php artisan serve
   ```

8. Abre en el navegador:

   ```
   http://localhost:8000
   ```

---


### Pasos para exportar JPG

1. Ingresa a [dbdiagram.io](https://dbdiagram.io)
2. Pega el esquema anterior en el editor.
3. Haz clic en **Export > Image > JPG**.
4. Descarga la imagen como `modelo_base_datos.jpg`.

---



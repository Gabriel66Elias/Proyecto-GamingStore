<div align="center">
  <br />
  <h1><font size="70">E-commerce Gaiming<font color="#0d6efd">Store</font></font></h1>
  
  <br />

  <p align="center">
    <a href="https://laravel.com/"><img src="https://skillicons.dev/icons?i=laravel&theme=dark" width="140" alt="Laravel"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.php.net/"><img src="https://skillicons.dev/icons?i=php&theme=dark" width="140" alt="PHP"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://getbootstrap.com/"><img src="https://skillicons.dev/icons?i=bootstrap&theme=dark" width="140" alt="Bootstrap"></a>
  </p>

  <br />

  <p align="center">
    <img src="https://img.shields.io/badge/ESTADO-EN_DESARROLLO-orange?style=for-the-badge" alt="Estado">
    <img src="https://img.shields.io/badge/VERSI%C3%93N-1.0.0-0d6efd?style=for-the-badge" alt="Versión">
  </p>
</div>

<br />

## <img src="https://img.icons8.com/ios-glyphs/60/ffffff/shopping-cart.png" width="35" align="top"/> Descripción

> <img src="https://img.icons8.com/ios-glyphs/30/ffffff/info.png" width="15" align="center"/> **E-commerce desarrollado para una tienda de tecnología**, enfocado en ofrecer una experiencia moderna, rápida y eficiente para la gestión y compra de productos tecnológicos.

* **Laravel**: Motor principal del backend, seguridad y estructura.
* **PHP**: Lógica de negocio robusta y dinámica.
* **Bootstrap**: Interfaz limpia, 100% responsive y accesible.

---

## <img src="https://img.icons8.com/ios-glyphs/60/ffffff/group.png" width="35" align="top"/> Autores

<div align="center">
  <table border="0">
    <tr>
      <td align="center" width="280" style="border:none;">
        <a href="https://github.com/Lucasz-py" style="text-decoration:none;">
          <img src="https://github.com/Lucasz-py.png" width="160" style="border-radius:50%;" alt="Lucas"/><br />
          <br />
          <b><font color="#0d6efd" size="5">Escobar Lucas Joel</font></b>
        </a>
      </td>
      <td align="center" width="280" style="border:none;">
        <a href="https://github.com/Gabriel66Elias" style="text-decoration:none;">
          <img src="https://github.com/Gabriel66Elias.png" width="160" style="border-radius:50%;" alt="Gabriel"/><br />
          <br />
          <b><font color="#0d6efd" size="5">Fernandez Gabriel Elías</font></b>
        </a>
      </td>
    </tr>
  </table>
</div>

---

## <img src="https://img.icons8.com/ios-glyphs/60/ffffff/key.png" width="35" align="top"/> Credenciales de Acceso

| Tipo de Cuenta | Email | Password |
| :--- | :--- | :--- |
| **Administrador** | admin@gamingstation.com | 12345678 |
| **Cliente de prueba** | lucas.garcia@test.com | 12345678 |
| **Cliente de prueba** | valentina.lopez@test.com | 12345678 |
| **Cliente de prueba** | mateo.fernandez@test.com | 12345678 |

---

## <img src="https://img.icons8.com/ios-glyphs/60/ffffff/rocket.png" width="35" align="top"/> Prueba de Implementación

Antes de iniciar con cualquiera de las dos opciones, asegúrate de configurar el archivo `.env` y definir el nombre de la base de datos como **`gamingstore_grupo25`**.

### Opción 1: Implementación con Volcado MySQL (Dump)
Utiliza esta opción para cargar la base de datos exactamente con los registros e historial pre-cargados.

1. Ejecutar `composer install`
2. Ejecutar `php artisan key:generate`
3. Importar en tu gestor SQL el archivo ubicado en `database/gamingstore_grupo25.sql`
4. Ejecutar `php artisan storage:link`

### Opción 2: Implementación con Migraciones y Seeders
Utiliza esta opción para que Laravel construya las tablas y las pueble automáticamente mediante código.

1. Ejecutar `composer install`
2. Ejecutar `php artisan key:generate`
3. Ejecutar `php artisan migrate:fresh --seed`
4. Ejecutar `php artisan storage:link`

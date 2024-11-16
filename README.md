# Documentación de la API Mateviajes

### Integrantes del grupo

Barragán, Alba -->  albabarragan88@gmail.com  
Rebainera, Maximiliano -->  maxi.reba@gmail.com 
- - -
>[!NOTE]
   >
   >Usuario -->  webadmin  
    Contraseña --> admin

La API implementa el paradigma ABM (Alta, Baja, Modificación), proporcionando un conjunto de endpoints RESTful que permiten realizar operaciones CRUD (Create, Read, Update, Delete) sobre las entidades principales del sistema:

- Viajes: Registra y administra los viajes realizados, con detalles como fechas, horarios, destinos y asientos disponibles.
- Vehículos: Permite gestionar el inventario de vehículos, incluyendo marca, modelo, año, patente y cantidad de asientos.
- Comentarios: Facilita la gestión de llas reseñas que realizan distintos usuarios.

## Vehículos

| Ruta                | Método | Controlador          | Acción                                      | Parámetros adicionales                                     |
|---------------------|--------|----------------------|---------------------------------------------|------------------------------------------------------------|
| /vehiculos          | GET    | VehiculosController  | Muestra todos los vehiculos                 | `limit`, `page`, `filter`, `orderBy`                       |
| /vehiculos/:ID      | GET    | VehiculosController  | Muestra un vehículo dado su ID              | Ninguno                                                    |
| /vehiculos/:ID      | DELETE | VehiculosController  | Borra un vehículo dado su ID                | Ninguno                                                    |
| /vehiculos          | POST   | VehiculosController  | Agrega un nuevo vehículo                    | Ninguno (los datos se envían en el cuerpo de la solicitud) |
| /vehiculos/:ID      | PUT    | VehiculosController  | Modifica los datos de un veículo dado su ID | Ninguno (los datos se envían en el cuerpo de la solicitud) |

**Obtener todos los vehículos**  
   - **Ruta**: `/vehiculos`
   - **Método**: `GET`
   - **Ejemplo en Postman**:  
     - Selecciona `GET` en el método.
     - Ingresa la URL completa de la API, por ejemplo: `http://localhost/web2/mateviajes_api/api/vehiculos`.
     - No necesitas enviar cuerpo de la solicitud ni headers especiales para este caso.

### Parámetros adicionales para la ruta `/vehiculos`:
- **`limit`**: Número de elementos a devolver por página.  
  - Ejemplo: `http://localhost/web2/mateviajes_api/api/vehiculos?limit=10`  
- **`page`**: Página actual para paginación (empezando desde 1).  
  - Ejemplo: `http://localhost/web2/mateviajes_api/api/vehiculos?limit=10&page=2`  
- **`filter`**: Filtrar resultados por un campo específico.  
  - Ejemplo: `http://localhost/web2/mateviajes_api/api/vehiculos?filter=marca='Ford'`    
- **`orderBy`**: Ordenar resultados por una columna (ascendente o descendente).  
  - Ejemplo: `http://localhost/web2/mateviajes_api/api/vehiculos?orderBy=anio desc`  
  - Para múltiples órdenes: `http://localhost/web2/mateviajes_api/api/vehiculos?orderBy=año desc,marca asc`

**Obtener un vehículo por ID**  
   - **Ruta**: `/vehiculos/:ID`
   - **Método**: `GET`
   - **Ejemplo en Postman**:  
     - Selecciona `GET` en el método.
     - Ingresa la URL completa, incluyendo el ID del vehículo: `http://localhost/web2/mateviajes_api/api/vehiculos/4`.
     - Cambia `4` por el ID del vehículo que deseas obtener.

**Borrar un vehículo**  
   - **Ruta**: `/vehiculos/:ID`
   - **Método**: `DELETE`
   - **Ejemplo en Postman**:  
     - Selecciona `DELETE` en el método.
     - Ingresa la URL completa con el ID del vehículo a eliminar: `http://localhost/web2/mateviajes_api/api/vehiculos/4`.
     - Cambia `4` por el ID del vehículo que deseas borrar.
     - Nota: Si el usuario no esta logueado, no se permitirá borrar el vehiculo.

**Agregar un vehículo**  
   - **Ruta**: `/vehiculos`
   - **Método**: `POST`
   - **Ejemplo en Postman**:  
     - Selecciona `POST` en el método.
     - Ingresa la URL completa: `http://localhost/web2/mateviajes_api/api/vehiculos`.
     - En la pestaña "Body", selecciona `raw` y elige `JSON` como tipo de entrada.
     - Ingresa un JSON con los datos del vehículo, por ejemplo:
       ```json
       {
          "marca": "Fiat",
          "modelo": "Ducato",
          "patente": "AB287AI",
          "anio": 2018,
          "asientos": 20
       }
       ```
     - Nota: Si el usuario no esta logueado, no se permitirá agregar el vehículo.

**Actualizar un vehículo**  
   - **Ruta**: `/vehiculos/:ID`
   - **Método**: `PUT`
   - **Ejemplo en Postman**:  
     - Selecciona `PUT` en el método.
     - Ingresa la URL completa con el ID del vehículo que deseas actualizar: `http://localhost/web2/mateviajes_api/api/vehiculos/4`.
     - Cambia `4` por el ID del vehículo que deseas borrar.
     - En la pestaña "Body", selecciona `raw` y elige `JSON` como tipo de entrada.
     - Ingresa un JSON completo y actualizar los datos deseados, por ejemplo:
       ```json
       {
         "marca": "Fiat",
          "modelo": "Ducato",
          "patente": "AB287AI", 
          "anio": 2018,
          "asientos": 23  <-- Elemento modificado
       }
       ```
     - Nota: Si el usuario no esta logueado, no se permitirá actualizar la información.

### Ejemplos avanzados de uso con query params

**Obtener los primeros 5 vehículos de la página 1, ordenados por marca descendente y filtrados por aquellos que tienen más de 20 asientos:**
   ```text
   GET http://localhost/web2/mateviajes_api/api/vehiculos?limit=5&page=1&filter=asientos >20&orderBy=marca desc
   ```

---
## Viajes

| Ruta                | Método | Controlador          | Acción                                    | Parámetros adicionales                                     |
|---------------------|--------|----------------------|-------------------------------------------|------------------------------------------------------------|
| /viajes             | GET    | ViajesController     | Muestra todos los viajes                  | `limit`, `page`, `filter`, `orderBy`                       |
| /viajes/:ID         | GET    | ViajesController     | Muestra un viaje dado su ID               | Ninguno                                                    |
| /viajes/:ID         | DELETE | ViajesController     | Borra un viaje dado su ID                 | Ninguno                                                    |
| /viajes             | POST   | ViajesController     | Agrega un nuevo viaje                     | Ninguno (los datos se envían en el cuerpo de la solicitud) |
| /viajes/:ID         | PUT    | ViajesController     | Modifica los datos de un viaje dado su ID | Ninguno (los datos se envían en el cuerpo de la solicitud) |

**Obtener todos los viajes**  
   - **Ruta**: `/viajes`
   - **Método**: `GET`
   - **Ejemplo en Postman**:  
     - Selecciona `GET` en el método.
     - Ingresa la URL completa de la API, por ejemplo: `http://localhost/web2/mateviajes_api/api/viajes`.

### Parámetros adicionales para la ruta `/viajes`:
- **`limit`**: Número de elementos a devolver por página.  
  - Ejemplo: `http://localhost/web2/mateviajes_api/api/viajes?limit=5`  
- **`page`**: Página actual para paginación (empezando desde 1).  
  - Ejemplo: `http://localhost/web2/mateviajes_api/api/viajes?limit=5&page=3`  
- **`filter`**: Filtrar resultados por un campo específico.
  - Ejemplo: `http://localhost/web2/mateviajes_api/api/viajes?filter=destino='Córdoba'`    
- **`orderBy`**: Ordenar resultados por una columna (ascendente o descendente).  
  - Ejemplo: `http://localhost/web2/mateviajes_api/api/viajes?orderBy=fecha asc`  
  - Para múltiples órdenes: `http://localhost/web2/mateviajes_api/api/viajes?orderBy=destino,fecha desc`

**Obtener un viaje por ID**  
   - **Ruta**: `/viajes/:ID`
   - **Método**: `GET`
   - **Ejemplo en Postman**:  
     - Selecciona `GET` en el método.
     - Ingresa la URL completa con el ID del viaje: `http://localhost/web2/mateviajes_api/api/viajes/18`.
     - Cambia `18` por el ID del viaje que deseas obtener.

**Borrar un viaje**  
   - **Ruta**: `/viajes/:ID`
   - **Método**: `DELETE`
   - **Ejemplo en Postman**:  
     - Selecciona `DELETE` en el método.
     - Ingresa la URL completa con el ID del viaje a eliminar: `http://localhost/web2/mateviajes_api/api/viajes/18`.
     - Cambia `18` por el ID del viaje que deseas borrar.
     - Nota: Si el usuario no esta logueado, no se permitirá borrar el viaje.

**Agregar un viaje**  
   - **Ruta**: `/viajes`
   - **Método**: `POST`
   - **Ejemplo en Postman**:  
     - Selecciona `POST` en el método.
     - Ingresa la URL completa: `http://localhost/web2/mateviajes_api/api/viajes`.
     - En la pestaña "Body", selecciona `raw` y elige `JSON` como tipo de entrada.
     - Ingresa un JSON con los datos del viaje, por ejemplo:
       ```json
       {
          "destino": "Tandil",
          "fecha": "2024-12-20",
          "horario": "06:30:00",
          "pasajeros": 23,
          "fk_vehiculo": 4,
          "descripcion": "Viaje a Tandil..."
       }
       ```
     - Nota: Si el usuario no esta logueado, no se permitirá agregar el viaje.

**Actualizar un viaje**  
   - **Ruta**: `/viajes/:ID`
   - **Método**: `PUT`
   - **Ejemplo en Postman**:  
     - Selecciona `PUT` en el método.
     - Ingresa la URL completa con el ID del viaje que deseas actualizar: `http://localhost/web2/mateviajes_api/api/viajes/18`.
     - Cambia `18` por el ID del viaje que deseas obtener.
     - En la pestaña "Body", selecciona `raw` y elige `JSON` como tipo de entrada.
     - Ingresa un JSON completo y actualizar los datos deseados, por ejemplo:
       ```json
       {
         "destino": "Tandil",
          "fecha": "2024-12-20",
          "horario": "07:00:00", <-- Elemento modificado
          "pasajeros": 23,
          "fk_vehiculo": 4,
          "descripcion": "Viaje a Tandil..."
       }
       ```
     - Nota: Si el usuario no esta logueado, no se permitirá actualizar el viaje.
### Ejemplos avanzados de uso con query params

**Obtener los obtener los viajes que realizará un vehículo comenzando por el último planificado:**
   ```text
   GET http://localhost/web2/mateviajes_api/api/viajes?filter=fk_vehiculo='6'&orderBy=fecha desc
   ```
---   
## Comentarios

| Ruta                | Método | Controlador          | Acción                 |
|---------------------|--------|----------------------|------------------------|
| /comentarios        | GET    | ComentariosController| obtenerComentarios     |
| /comentarios/:ID    | GET    | ComentariosController| obtenerComentarioByID  |
| /comentarios/:ID    | DELETE | ComentariosController| borrarComentario       |
| /comentarios        | POST   | ComentariosController| agregarComentario      |

**Obtener todos los comentarios**  
   - **Ruta**: `/comentarios`  
   - **Método**: `GET`  
   - **Ejemplo en Postman**:  
     - Selecciona `GET` en el método.  
     - Ingresa la URL completa de la API: `http://localhost/web2/mateviajes_api/api/comentarios`.

**Obtener un comentario por ID**  
   - **Ruta**: `/comentarios/:ID`  
   - **Método**: `GET`  
   - **Ejemplo en Postman**:  
     - Selecciona `GET` en el método.  
     - Ingresa la URL completa con el ID del comentario: `http://localhost/web2/mateviajes_api/api/comentarios/15`.  
     - Cambia `15` por el ID del comentario que deseas obtener.

**Borrar un comentario**  
   - **Ruta**: `/comentarios/:ID`  
   - **Método**: `DELETE`  
   - **Ejemplo en Postman**:  
     - Selecciona `DELETE` en el método.  
     - Ingresa la URL completa con el ID del comentario a eliminar: `http://localhost/web2/mateviajes_api/api/comentarios/15`.  
     - Cambia `15` por el ID del comentario que deseas borrar.  
     - Nota: Si el usuario no está logueado, no se permitirá borrar el comentario.

**Agregar un comentario**  
   - **Ruta**: `/comentarios`  
   - **Método**: `POST`   
   - **Ejemplo en Postman**:  
     - Selecciona `POST` en el método.  
     - Ingresa la URL completa: `http://localhost/web2/mateviajes_api/api/comentarios`.  
     - En la pestaña "Body", selecciona `raw` y elige `JSON` como tipo de entrada.  
     - Ingresa un JSON con los datos del comentario, por ejemplo:  
       ```json
       {
          "usuario": "Juan Perez",
          "resenia": "El viaje fue excelente, puntual y cómodo."
       }
       ```  
     - Nota: Si el usuario no está logueado, no se permitirá agregar el comentario.

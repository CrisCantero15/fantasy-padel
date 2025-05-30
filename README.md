# Padel Fantasy

<!-- Descripción general del proyecto y su propósito principal -->

Padel Fantasy es una aplicación web desarrollada como proyecto de fin de grado, cuyo propósito es ofrecer una experiencia tipo fantasy league centrada en el mundo del pádel. Los usuarios pueden crear su equipo, seguir noticias y novedades del deporte, y competir en una clasificación general. Este proyecto busca combinar la pasión por el pádel con la gamificación, promoviendo la participación y el seguimiento activo de los torneos y jugadores.

---

## Tabla de contenidos

<!-- Índice para facilitar la navegación -->

- [Instalación](#Instalación)<!-- me lleva a la sección #instalación ojo con acentos tiene que ser literal -->
- [Contribución](#contribución)
- [Licencia](#licencia)
- [Texto libre para enlace](url)<!-- me lleva a un enlace -->

---

## Instalación

<!-- Instrucciones detalladas para instalar dependencias y configurar el entorno -->

Instrucciones paso a paso para instalar el proyecto.

1. Clona el repositorio:

```bash
git clone https://github.com/CrisCantero15/fantasy-padel.git
```

2. Instala y configura un entorno local con XAMPP (o similar) que incluya Apache y MySQL.

3. Inicia Apache y MySQL desde el panel de control de XAMPP.

4. Crea una base de datos en MySQL para la aplicación (preferiblemente, usa el nombre 'fantasy').

5. La estructura de la base de datos debe ser la siguiente:

<details>
  <summary>Script SQL para crear tablas de la base de datos</summary>

```sql
CREATE TABLE configuracion (
  id INT AUTO_INCREMENT PRIMARY KEY,
  modif_titulares TINYINT(1) NOT NULL DEFAULT 0,
  fecha_jornada DATE NOT NULL
);

CREATE TABLE contacto (
  id_consulta INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  motivo VARCHAR(150) NOT NULL,
  mensaje TEXT NOT NULL,
  fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE usuarios (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  contrasena VARCHAR(255) NOT NULL,
  fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  foto_perfil VARCHAR(255)
);

CREATE TABLE equipos (
  id_equipo INT AUTO_INCREMENT PRIMARY KEY,
  nombre_equipo VARCHAR(100) NOT NULL,
  id_usuario INT NOT NULL,
  puntuacion_total INT DEFAULT 0,
  presupuesto DECIMAL(10,2) DEFAULT 0.00,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

CREATE TABLE jugadores (
  id_jugador INT AUTO_INCREMENT PRIMARY KEY,
  nombre_jugador VARCHAR(100) NOT NULL,
  puntuacion_jugador INT DEFAULT 0,
  precio DECIMAL(10,2) DEFAULT 0.00,
  en_equipo TINYINT(1) DEFAULT 0
);

CREATE TABLE equipos_jugadores (
  id_equipo INT NOT NULL,
  id_jugador INT NOT NULL,
  fecha_seleccion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  en_titular TINYINT(1) DEFAULT 0,
  PRIMARY KEY (id_equipo, id_jugador),
  FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo) ON DELETE CASCADE,
  FOREIGN KEY (id_jugador) REFERENCES jugadores(id_jugador) ON DELETE CASCADE
);
```
</details>

6. Abre el archivo config/Configuracion.php y edita las variables de configuración para conectar la aplicación con la base de datos local:

---

## Contribución

<!-- Pasos recomendados para contribuir al repositorio -->

1. Haz un fork del repositorio.
2. Crea tu rama (`git checkout -b feature/NuevaFuncionalidad`).
3. Haz commit de tus cambios (`git commit -am 'Añade nueva funcionalidad'`).
4. Haz push a la rama (`git push origin feature/NuevaFuncionalidad`).
5. Abre un Pull Request.

---

## Licencia

<!-- Indica la licencia del proyecto para uso y distribución -->

[MIT](LICENSE)

---

## Créditos

<!-- Información sobre el autor o colaboradores del proyecto -->

Creado por [Cristian Cantero López](https://github.com/criscantero15), junto a Francisco Dodero Moreno y Marcos López Galvín. 
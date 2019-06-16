# Proyecto MVC

## A tener en cuenta
### -En el ejercicio 2 fue creado un objeto con fines teoricos
### -Para resolver el trabajo práctico se inslato el programa WAMP3.1.7_x64.
### -Se utilizo PHP 7.2.18.
### -Para ejecutar los proyectos se utilizo el comando php -S ip:puerto
### -La base utilizada se llama mytodo cuyas tablas son :
id,nombre,edad,telefono,email,altura,fecha_de_nacimiento,color_de_pelo,fecha_del_turno,horario_del_turno,imagen_diagnostico

Un proyecto derivado del tutorial introductorio de Laracast y con algunos
agregados para ser utilizado como material de PAW - UNLu.

## Instalación

 - Clonar el repositorio
 - Crear un schema de base de datos con algun cliente MySQL
 - Ejecutar los migrations del directorio `sql/` en orden
 - Crear un archivo `config.php` (Hay un ejemplo para copiar en `config.php.example`)
  - Configurar la base de datos creada y los usuarios correspondientes
 - Ejecutar `composer install`

### Aclaración

Por cada objeto creado por usted mismo (Model o Controller), debera indicar a
composer que regenere el autoload:

```
composer dumpautoload
```

Si lo que se desea es agregar una nueva libreria de 3ero

```
composer requiere name/lib:version
```

## Deploy / ejecución

### Local

Ejecutar:

```
git clone https://github.com/tomasdelvechio/The-PHP-Practitioner-Full-Source-Code.git paw-mvc/
cd paw-mvc/
# Aca irian los pasos de instalación
php -S localhost:8888
```

Luego ingresar a http://localhost:8888


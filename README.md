# Sitio Web del Centro de estudiantes de la confederacion suiza

Probado con Apache 2.4.51, php 7.4.25, y mariadb 10.5.12

Requiere de las extensiones de php `gmp` y `mysqli`. En xampp ya vienen activadas. En el caso de que no lo estén, pueden abrir el archivo de configuración de php.ini (que aparece en las listas de posibilidades de configuración de apache en XAMPP) y cambiar
```
;extension=gmp
``` 
a
```
extension=gmp
```

El proyecto debe estar directamente en la carpeta raíz (en el caso de xampp, htdocs) del servidor web, y no en una subcarpeta. Si no quieren hacer esto, se puede hacer lo siguiente:
Para hacer esto sin borrar lo que ya tenes en esas carpetas, se puede poner algo como esto en  `C:/xampp/apache/conf/extra/httpd-vhosts.conf` (o donde este el archivo de configuracion de vhosts en tu sistema operativo, como sites-available/enabled, etc.) y poner la carpeta del proyecto como C:/xampp/htdocs/cecs. Haciendo esto, se puede acceder al sitio desde `http://cecs.localhost` 

```
<VirtualHost *:80>
    ServerAdmin admin@example.com
    DocumentRoot "/xampp/htdocs/"
    ServerName sitio.externo.com
    ServerAlias localhost
        <Directory "/xampp/htdocs/">
            Options Indexes FollowSymLinks ExecCGI Includes
            AllowOverride All
            Require all granted
        </Directory>
</VirtualHost>
<VirtualHost *:80>
    ServerAdmin contact@amogus.ar
    DocumentRoot "/xampp/htdocs/cecs/"
    ServerName cecs.externo.com
    ServerAlias cecs.localhost
    <Directory "/xampp/htdocs/cecs/">
        AllowOverride All
    </Directory>
</VirtualHost>

```

Para configurar el sitio hay que copiar el archivo `assets/.credentials.php`, sacarle el punto del principio, y poner las contrasenias correspondientes. **SI VA A ESTAR ABIERTO AL PUBLICO, ASEGURARSE QUE ESTE EN FALSO LA CONSTANTE DEBUG AL PRINCIPIO DE `routes.php`  
~~Hay una base de datos de ejemplo. Las contrasenias no van a ser compatibles debido a salting asi que no funcionaran.~~
no hay base de datos.

Puede ser que al importar la base de datos haya un error de máximo de tamaño de fila o algo asi. Busquenlo en google que la solución aparece.

El codigo esta escrito en php,js,y html con pocas librerias y frameworks. La idea de esto era que con las cosas que vemos en 4to o 3ro en computacion ya alcanza para entender y contribuir al sitio. Esta fue una idea horrible, y probablemente hubiera sido mejor usar solo wordpress, pero ya es medio tarde para cambiarlo :). 

Esta totalmente abierto a las contribuciones, hagan un pull request o lo que sea si tienen alguna idea.

Sitio bajo licencia MIT. 

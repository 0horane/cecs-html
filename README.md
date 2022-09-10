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
    DocumentRoot "C:/xampp/htdocs/"
    ServerName sitio.externo.com
    ServerAlias localhost
        <Directory "C:/xampp/htdocs/">
            Options Indexes FollowSymLinks ExecCGI Includes
            AllowOverride All
            Require all granted
        </Directory>
</VirtualHost>
<VirtualHost *:80>
    ServerAdmin contact@amogus.ar
    DocumentRoot "C:/xampp/htdocs/cecs/"
    ServerName cecs.externo.com
    ServerAlias cecs.localhost
    <Directory "C:/xampp/htdocs/cecs/">
        AllowOverride All
        RewriteEngine On
        RewriteCond %{REQUEST_URI}  !(\.png|\.jpg|\.gif|\.jpeg|\.zip|\.css|\.svg|\.js|\.php|\.webp|\.ico)$
        RewriteRule (.*) routes.php [QSA,L]
        php_flag opcache.enable Off
    </Directory>
    

</VirtualHost>

```

Para configurar el sitio hay que copiar el archivo `assets/.credentials.php`, sacarle el punto del principio, y poner las contrasenias correspondientes. **SI VA A ESTAR ABIERTO AL PUBLICO, ASEGURARSE QUE ESTE EN FALSO LA CONSTANTE DEBUG AL PRINCIPIO DE `routes.php`  
~~Hay una base de datos de ejemplo. Las contrasenias no van a ser compatibles debido a salting asi que no funcionaran.~~
~~no hay base de datos.~~
Base de datos de ejemplo en assets. todas las contraseñas cambiadas a abc123. 
Seria ideal que alguien cambia el sistema de manejo de contraseñas que actualmente usa MD5.

Puede ser que al importar la base de datos haya un error de máximo de tamaño de fila o algo asi. Busquenlo en google que la solución aparece.

El codigo esta escrito en php,js,y html con pocas librerias y frameworks. La idea de esto era que con las cosas que vemos en 4to o 3ro en computacion ya alcanza para entender y contribuir al sitio. Esta fue una idea horrible, y probablemente hubiera sido mejor usar solo wordpress, pero ya es medio tarde para cambiarlo :). 

Esta totalmente abierto a las contribuciones, hagan un pull request o lo que sea si tienen alguna idea.

La rama 000web está modificada para usar bcmath en vez de gmp y separado como para poder usarlo en 000webhosting. Solo desarrollen en mail, y de ahí le hacemos merge haca 000web cuando sea necesario.

Si estan hosteando con nginx+fastcgi, esta configuración sirve
```
server {
    listen       80;
    server_name  cecs.ar cecs.localhost;
    location / {
        root   /srv/cecs;
        try_files $uri /routes.php?dummy=0&$query_string;
        index index.php index.html index.htm;
    }
    location ~ \.php$ { root /srv/cecs; fastcgi_pass unix:/run/php-fpm/php-fpm.sock; fastcgi_index  index.php; fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name; include fastcgi_params; }
    location ~ /\.ht { deny  all; }
}
```







Mini-Documentación:
    El codigo esta aca. Cualquier persona puede mandar un pr para agregar funcionalidad o lo que sea.

    La idea principal, cuando empezé con este sitio, era que este cumpla toda la funcionalidad que le pueda servir al centro y que esté escrito en PHP sin dependencias para que cualquier persona que haya pasado por 4to de computacion, o no este en computacion pero haya visto los basicos por su cuenta, lo pueda entender. Esto claramente fue un error, y hubiera sido mucho major usar simplemente wordpress, o por lo menos un framework de php, pero esto ya esta hecho y no lo pienso rehacer. 

 

    La pagina actualmente esta funcionando muy lenta porque el servidor es una netbook de la escuela de las viejas usando windows. ACTUALIZACION: sigue estando en el mismo sistema pero cambiandole el sistema operativo lo dejo mas o menos decente. Actualización 2: Actualmente esta en 000webhosting porque era gratis, pero volvió a ser mas lento que antes.

 

    El sistema de votos estaba diseñado para que todos los votos sean secretos, incluso para la persona que tenga acceso a la base de datos, y que cada usuario pueda votar solo una vez. Por esto, si cada alumno se le facilita la creación de una cuenta, se podrían hacer votos referendums entre los alumnos directamente en los casos que normalmente se hubiera tenido que hacer una reunion de delegados con mandato imperativo o una asamblea. Para esto tendría que haber una reforma al estatuto para permitirlo. De todas maneras, si esto no se hace, ya que ademas seria bastante complicado darle una cuenta a cada alumno, igual sirve para cosas informales como elejir un toneo, etc. 

 

    La pagina de busqueda puede recibir una variable “c” por el url (get) que restringe las categorias a la que se ingresan. Las categorias se pueden poner como un numero (representando el array de bits de cada categoria incluida como 1, en decimal), el url ("finanzas", “cultura”), o el nombre, y se puede operar usando “.” como AND, “,” como OR, “!”  como NOT, y parentesis. (ej. “1,!(3.Comision.genero).!7”

 

En el contenido hatml o css de la pagina se puede poner un comentario con el formato /*CSS:DEFAULT*/, /*CSS:55*/, <​!---HTML:48-->, para reusar algo anterior. Tener en cuenta que el numero es el id del texto (version) del articulo, que se puede ver apretando el menu desde la pagina de historia, y no el del articulo mismo. Puede usarse como parte de un mayor codigo, como por ejemplo poner primero el /*CSS:DEFAULT*/ y despues agregar mas cambios. El sitio intenta reemplazar el contenido o css con uno de estos si es posible cuando se guarda, para ahorrar espacio, pero creo que por temas LF/CRLF no siempre funciona

    

    Los articulos borrados o editados permanecen accesibles por motivos de transparencia. De todas maneras, si es necesario se puede editar directamente la base de datos para quitarlo.

 

    Internamente, casi todas las paginas del sitio son articulos, que se muestran en distintas maneras segun el contexto. Cada uno de estos articulos tiene una o mas versiones correspondientes, y normalmente se muestra la mas reciente.

    Las paginas no estan filtradas y no hay ninguna protección contra js dañino que se suba como articulo. Esto fue intencional, aunque ahora me parece que la libertad que le das a cada usuario con permisos de hacer lo que quiera no fue la mejor idea  

    Un usuario tiene permiso a editar, eliminar, restaurar, etc. a un articulo si coincide por lo menos uno de sus permisos con uno de ese articulo. Por esto, la idea sería que muy pocos usuarios tengan permisos mayores a 0.

    Cualquier operacion relacionado con permisos en el código tiene que estar hecha con numeros gmp. Los permisos se almacenan como un int que representa un array de bits, pero esta representacion numerica puede ser mayor a lo que permite php antes de convertirlo a un float. El limite de 64 categorias es porque el tipo bigint de mysql permite hasta 64 bits.  
    
    Las api están documentados en los archivos mismos.
    Hay unas cuantas cosas en issues de github que sería ideal de que si alguirn quiere contribuir lo solucione.

Sitio bajo licencia MIT. 

<style>
<?php include 'newStyles/Header.css'; ?>
<?php include 'newStyles/index.css'; ?>
</style>
<header class="header">
    <div class="flex flex-column items-center justify-center w-full h-full">
        <div class="flex gap-5" style="transform: translateY(5%);">
            <picture class="h-24 w-24 lg:h-52 lg:w-52">
                <source srcset="/img/logoblanco.webp" type="image/webp">
                <source srcset="/img/logoblanco.png" type="image/png"> 
                <img src="/img/logoblanco.png" alt="Logo">
            </picture>
            <picture class="h-32 w-32 lg:h-64 lg:w-64" >
                <!-- <source srcset="/img/suizablanco.webp" type="image/webp">
                <source srcset="/img/suizablanco.png" type="image/png"> 
                <img src="/img/suizablanco.png" alt="Logo"> -->
                <source srcset="../newImages/white.webp" type="image/webp">
                <source srcset="../newImages/white.png" type="image/png"> 
                <img src="../newImages/white.png" alt="Logo">
            </picture>
        </div>
        <div style="transform:translateY(-20%);" class="navbartexts flex flex-column items-center justify-center headerMainTitle">
            <span class="text-3xl lg:text-5xl text-white">CENTRO DE</span>
            <span class="text-3xl lg:text-5xl text-white">ESTUDIANTES</span>
            <span class="text-xl text-white">ESCUELA TECNICA N 26</span>
            <span class="text-xl text-white">"CONFEDERACION SUIZA"</span>
        </div>
    </div>
</header> 
<div style="height: 70vh;width:100%;" class='spaceBlock'></div>
<!-- <div class="MainPost">
    <h1 class='mainPostTitle'>Se viene La feria Del Plato!</h1>
    <div class="mainPostContent">
        <div class='mainpostContentImgCtn'>
            <img src="../newImages/mainPost.jpg" alt="">
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus eligendi laborum eveniet. Error, ipsa facilis. Debitis magni doloribus commodi, repudiandae harum, sint ab a at hic similique provident vel nobis?</p>
    </div>
</div> -->
<div class="flex gap-2 flex-column w-full">

    <div class="flex justify-evenly flex-wrap postrow pl">
        
        <div class="encuesta">
            <div class="pollHeader">
                <div class="pfpSecretaria"></div>
                <div class="secretariaNamePersona">
                    <h5>Finanzas</h5>
                    <p>Alberto Fernandez</p>
                </div>
                <p>:</p>
            </div>
            <div class="pollContent">
                <p class='question'>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Expedita accusantium numquam, error assumenda quasi officiis?</p>
                <div class='pollOptionsCtn' >
                    <div class='pollOptionCtn'>
                        <button class='pollOption colored'>Opcion 1</button>
                        <p>57.1%</p>
                    </div>
                    <div class='pollOptionCtn'>
                        <button class='pollOption'>Opcion 2</button>
                        <p>42.9%</p>
                    </div>
                </div>
            </div>
            <div class="pollFooter">
                <div class='votes-result-ctn'>
                    <p>14 Votes</p>
                    <p>Final Results</p>
                </div>
                <p>11:08 AM · Jul 31, 2020</p>
            </div>
        </div>
        <div class="posteo">
        <h5 class='reunionTitle hover:underline'><a href="/reunion/27" class='hover:text-gray-900'>Tenemos Canasta De Utiles</a></h5>
            <span class='reunionFecha'> 
                Fecha: 2022-02-11 20:53:19</span>
            <div class="tags">
            <a href="/listado/0" class="text-blue-800 font-medium text-xs leading-tight uppercase rounded transition duration-150 ease-in-out">
                Post
            </a>
            <div class="reunionContent">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium officia optio culpa quibusdam fugiat. Nihil.
                <button class='postBtn'>Ver más</button>
            </div>
            </div>
        </div>
        <div class="posteo reunion">
            <h5 class='reunionTitle hover:underline'><a href="/reunion/27" class='hover:text-gray-900'>Torneo de Truco</a></h5>
            <span class='reunionFecha'> 
                Fecha: 2022-02-11 20:53:19</span>
            <div class="tags">
            <a href="/listado/0" class="text-blue-800 font-medium text-xs leading-tight uppercase rounded transition duration-150 ease-in-out">
                Reuniones
            </a>
            <div class="reunionContent">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vel repellendus reprehenderit necessitatibus, dolorem hic et rem laudantium! Eius doloribus, iste maxime ipsa aut blanditiis quae facere libero! Repellat, temporibus suscipit!
            </div>
            </div>
        </div>
        
        <div class="mt-1 w-1/5 h-full min-w-min overflow-hidden  indpost">
            <?php $nxtarticle($entries, 200) ?>
        </div> 
       
    </div>
    
    <br>
    <hr>
    <br>
    
    <div class="flex justify-evenly flax-wrap flex-row postrow">
        <div class="mt-1 w-1/5 h-full min-w-min overflow-hidden  indpost">
            <?php $nxtarticle($sccentries, 200) ?>
        </div>     
        <div class="mt-1 w-1/5 h-full min-w-min overflow-hidden  indpost">
            <?php $nxtarticle($sccentries, 200) ?>
        </div> 
        <div class="mt-1 w-1/5 h-full min-w-min overflow-hidden  indpost">
            <?php $nxtarticle($sccentries, 200) ?>
        </div> 
        
        <div class="mt-1 w-1/5 h-full min-w-min overflow-hidden  indpost">
            <?php $nxtarticle($sccentries, 200) ?>
        </div> 
    </div>

</div>
<?php /*
    <!-- Empieza el carrousel -->
     
    <!-- Termina el carrousel -->
    <!-- Empieza el infinite scroll -->
        <div id="divContent">
oh
        </div>
        <div id="listEnd">
            Cargando mas items...
        </div>
        <br/>
    </div>
    <!-- Termina el infinite scroll -->
    <!-- Empieza el footer -->
    <!-- Termina el footer -->
    <script>
        let divContent = document.getElementById('divContent');
        let listEnd = document.getElementById('listEnd');
        let itemCount = 0;
        let appending = false;

        window.addEventListener('DOMContentLoaded', load)
        function load() {
            addItems();
        }
        function addItems(){ // Con esta funcion hacemos que se vea en la pantalla determinados divs
            appending = true;
            for(let i = 0; i < 20; i++){ // El comentario de arriba, se concatena con esto ya que el numero maximo del i, es la cantidad de items que nos va a mostrar en pantalla. 
                let item = generateDataBlock(['Este es el item #', itemCount].join(''));
                divContent.appendChild(item);
                itemCount++;
            }
            appending = false;
        }
        function generateDataBlock(message){ // Con esta funcion generamos, traducido, "bloques de datos" que son los divs que vemos en la pagina.
            let item = document.createElement('div');
            item.setAttribute('class', 'item');
            item.textContent = message;
            return item; // Esto es lo que hace que siempre se vaya incrementando mas divs
        }
        let options = {
            root: null,
            rootMargin:'0px',
            threshold:1.0
        };
        let callback = (entries, observer)=>{ // Con esta funcion vamos a hacer que se muestre la fila de divs
            entries.forEach(entry => {
                if(entry.target.id === 'listEnd'){
                    if(entry.isIntersecting && !appending){
                        appending = true;
                        setTimeout(() =>{
                            addItems();
                        }, 1000); // Ese numero, nos va a decir el tiempo en el que va a "esperar" para mostrar los demas elementos
                    }
                }
            });
        };
        let observer = new IntersectionObserver(callback, options);
        observer.observe(listEnd);
    </script>

<!-- --------------------------Este es el verdadero comentario, con el estilo y todo----------------------------------- -->
<!--   <div class="container">
        <div class="noticias border border-gray-400 p-2">
            <div class="noticia bg-red-200 rounded-md p-2 border-2 border-gray-400">
                <div class="noticia-content bg-red-100 rounded-md">
                    <div class="separacion m-2 p-2">
                        <div class="info-usuarios flex flex-wrap items-center">
                            <img src="logo.jpg" alt="" class="w-20">
                            <p class="mx-2">Nombre Apellido y Horario en el que se subio</p>
                        </div>
                        <hr class="mt-2">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum explicabo possimus eveniet molestias similique sed, vel facilis architecto praesentium dolorum, repellendus doloribus? Itaque debitis vero maxime quo nihil accusantium repellat! Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis neque ex id molestias veritatis quam praesentium reiciendis exercitationem placeat ipsa culpa, vel quaerat, veniam, recusandae quibusdam possimus voluptas asperiores mollitia.</p> 
                    </div>
                </div>
            </div>
            <div class="noticia bg-red-200 rounded-md p-2 mt-2 border-2 border-gray-400">
                <div class="noticia-content bg-red-100 rounded-md">
                    <div class="separacion m-2 p-2">
                        <div class="info-usuarios flex flex-wrap items-center">
                            <img src="logo.jpg" alt="" class="w-20">
                            <p class="mx-2">Nombre Apellido y Horario en el que se subio</p>
                        </div>
                        <hr class="mt-2">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum explicabo possimus eveniet molestias similique sed, vel facilis architecto praesentium dolorum, repellendus doloribus? Itaque debitis vero maxime quo nihil accusantium repellat! Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis neque ex id molestias veritatis quam praesentium reiciendis exercitationem placeat ipsa culpa, vel quaerat, veniam, recusandae quibusdam possimus voluptas asperiores mollitia.</p> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->



    */
?>
    

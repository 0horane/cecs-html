var fillme=document.getElementById('fillme');
var i_radios = document.forms['fullform'].elements['type'];
var i_title = document.forms['fullform'].elements['title'];
var categoryarr = JSON.parse(permsdata);
var categories = document.getElementById('categories'); 
var originalcategories= categories.querySelectorAll('[data-original]');
var othercategories= categories.querySelectorAll('input:not([data-original])');
var parentcats= document.getElementById('parentcats');
var editorcontainer= document.getElementById('form2');
var currenteditor = 1;
var richtexthtmldata= isnew ? "" : t_content;
var codehtmldata= isnew ? "" : t_content;
var cssdata= isnew ? "" : t_css;
var editasbtn= document.getElementById('editas');
var htmleditor, csseditor;

var savedhtml={
    static: "Una pagina Sin Fecha",
    post: "Una actualizacion, como anunciando un evento, pidiendo ayuda, etc. No se recomienda usar CSS.",
    vote: `Un voto. Cada usuario puede votar anonimamente
        <br><br>
        <label for="end_date">Fecha final</label>
        <input type="datetime-local" id="end_date" name="end_date">

        <br><br>
        
        <span class="my-3" >Opciones:</span>
        <div class="my-3" id="options"></div>
        <button type='button' id="addoption" onclick="addvoteoption()"  class="my-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">+</button>

    `,
    alert: "Una alerta. Aparece arriba de la pagina hasta que se borre. No se recomienda usar CSS.",
};

var radiocategories={
    4: "static",
    8: "post",
    16: "vote",
    32: "alert",
};
var checkboxcategories={
    "static": 2,
    "post": 3,
    "vote": 4,
    "alert": 5,
};

var prev="";


CodeMirror.commands.autocomplete = function(cm) {
    CodeMirror.showHint(cm, CodeMirror.hint.html);
}

function addvoteoption(name="", disabled=""){
    var options=document.getElementById('options');
    options.innerHTML+=`
        <div class="flex p-2 border items-center justify-around" >
            <span>${options.children.length}: </span> 
            <input type="text" value=${name}>
            <button onclick="rmoption(this.parentElement)" ${disabled} class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">-</button>
        </div>`;
}

function rmoption(poption){
    poption.remove();
    let optionsarr = document.getElementById('options').children;
    for (x=0; x<optionsarr.length; x++){
        optionsarr[x].children[0].innerHTML=x+optionsarr[x].children[0].innerHTML.substr(1);
    }
    

}


function binarydecompose(value) {
    var b = 1;
    var pows = [];
    while (b <= value) {
        if (b & value) pows.push(b);
        b <<= 1;
    }
    return pows;
}

function refreshcats(){
    var reqcats= new Set();
    originalcategories.forEach(x=>{
        if (x.checked){
            binarydecompose(categoryarr[x.getAttribute('data-cat')]['parents']).forEach(y=>reqcats.add(Math.log(y)/Math.log(2)));
        }
    });
    reqcats.add(0);
    if (prev){
        reqcats.add(checkboxcategories[prev]);
    }
    inputstr=""
    reqcats.forEach(z=>{
        inputstr+=`
            <div class="relative">
                <div class="top-0 flex items-center m-1 border justify-around">
                    <input type="checkbox" class="mx-1 checkbox" disabled checked data-cat='${z}'" > 
                    <span class="mx-1">${categoryarr[z]['name']}</span>
                </div> 
                <div class="background"></div> <!--TODO hocer que aparezca un color cuando esta seleccionado-->
            </div> 
        `;
    });
    parentcats.innerHTML=inputstr;
    originalcategories.forEach(w=>{
        w.parentElement.hidden = reqcats.has(parseInt(w.getAttribute(['data-cat'])));
    });
}

function sethtmleditor(){
    editor.then(x=>{return (x.getData())}).then(x=>{
        richtexthtmldata=x;
        editorcontainer.innerHTML=`<div id='htmlcont'>HTML<div id='htmledit' class="border cmeditor"></div></div><div id='csscont'>CSS<div id='cssedit' class="border cmeditor"></div></div>`
        currenteditor=0;
        htmleditor = CodeMirror(editorcontainer.children['htmlcont'].children['htmledit'], {
            value: codehtmldata,
            mode:  "text/html",
            lineNumbers: true,
            styleActiveLine: true,
            matchBrackets: true,

            extraKeys: {
                "Ctrl-Space": "autocomplete"
            },

        });
        csseditor = CodeMirror(editorcontainer.children['csscont'].children['cssedit'], {
            value: cssdata,
            mode:  "css",
            lineNumbers: true,
            styleActiveLine: true,
            matchBrackets: true,

            extraKeys: {
                "Ctrl-Space": "autocomplete"
            },

        });
        editasbtn.innerHTML="Editar como Texto"
    });
};

function setrichtexteditor(){
    codehtmldata=htmleditor.getValue();
    cssdata=csseditor.getValue();
    editorcontainer.innerHTML=`<div name="texto" id="editor"></div>`;
    editor=ClassicEditor.create(document.querySelector('#editor'));
    editor.then(editorobj =>{editorobj.setData(richtexthtmldata)});
    editasbtn.innerHTML="Editar como HTML";
    currenteditor=1;

};

function swapeditor(){
    if (currenteditor){
        swapwarn(sethtmleditor);
    } else {
        swapwarn(setrichtexteditor);
    }
};

function swapwarn(after){
    Swal.fire({
        title: 'Cambiar de editor?',
        text: "Los editores no son compatibles. tus cambios se perderan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Cambiar'
      }).then((result) => {
        if (result.isConfirmed) {
          after();
        }
      })
}

for(var i = 0, max = i_radios.length; i < max; i++) {
    i_radios[i].onclick = function() {
        
        savedhtml[prev] = fillme.innerHTML;
        fillme.innerHTML = savedhtml[this.value];
        prev = this.value
        refreshcats();
        console.log(this);
    }
}

//setup

var editor=ClassicEditor.create(document.querySelector('#editor'))
    .catch(error =>{
        //console.log('Error');
    });
if (!isnew){
    i_title.value=p_title;
    i_title.disabled=true;
    editor.then(editorobj =>{editorobj.setData(t_content)});

    var selectedradio = radiocategories[p_category & 60];
    document.getElementById(selectedradio).checked = true;
    fillme.innerHTML = savedhtml[selectedradio];
    prev = selectedradio;
    i_radios.forEach(x=>x.disabled=true);
    if (p_category & 60==16){ //votes
        var options=document.getElementById('options');
        document.getElementById('addoption').disabled=true;
        document.getElementById('end_date').disabled=true;
        JSON.parse(t_options).forEach(x=>addoption(x, "disabled"));
    }
}
refreshcats();
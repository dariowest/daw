function tipoFolleto(){
    console.log("Hola");
    document.getElementById("fecha").setAttribute('type', 'date');
    document.getElementById("reso").setAttribute('type', 'number');
    document.getElementById("copias").setAttribute('type', 'number');
    document.getElementById("color").setAttribute('type', 'color');
    document.getElementById("radio1").setAttribute('type', 'radio');
    document.getElementById("radio2").setAttribute('type', 'radio');
    document.getElementById("telefono").setAttribute('type', 'tel');
    document.getElementById("numero").setAttribute('type', 'number');
    document.getElementById("cp").setAttribute('type', 'number');
    document.getElementById("Email").setAttribute('type', 'email');

    document.getElementById("adicional").setAttribute('type', 'text');
    document.getElementById("nombre").setAttribute('type', 'text');
    document.getElementById("calle").setAttribute('type', 'text');

}

function muestraTabla(){
    var display = window.getComputedStyle(document.getElementById('tabla')).display;

    if(display=="block"){
        document.getElementById('tabla').style.display = 'none';

    }
    else{
        document.getElementById('tabla').style.display = 'block';

    }
    

}

function interiorTabla(){
    let base=10, baseTotal=0, baseColor=0, baseCalidad=0, baseColorCalidad=0;
    let costePagina=0;
    let html="";
    let interior = document.getElementById("interior");

    for(let i=1, j=3; i<=15||j<=45; i++){
        if(i<5){
            costePagina=2;
        }
        else if(i>10){
            costePagina=1.6;
        }
        else{
            costePagina=1.8;
        }
        baseTotal = (base + costePagina * i).toFixed(2);
        baseCalidad = (parseFloat(baseTotal) + j * 0.2).toFixed(2);
        baseColor = (parseFloat(baseTotal) + j * 0.5).toFixed(2);
        baseColorCalidad = (parseFloat(baseCalidad) + j * 0.5).toFixed(2);

        html += `<tr><td>${i} Paginas</td><td>${j} fotos</td><td>${baseTotal} €</td><td>${baseCalidad} €</td><td>${baseColor} €</td><td>${baseColorCalidad} €</td></tr>`;



        
        
        j=j+3
    }
    interior.innerHTML=html;
}



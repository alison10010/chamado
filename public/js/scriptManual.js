// ESTENDE/RECOLHE MENU
function menu(){
    document.getElementById("accordionSidebar").classList.toggle("toggled");
}

// FECHA MODAL
function fechaModal(){
    document.getElementById("alert").classList.toggle("fechar");
}

var chamado = true;
var solicitacaoPapel = true;

// PEGA OS DADOS DO FORM E PASSA VIA URL PARA O IFRAME
function frame(){

    document.getElementById("frame").classList.remove("frame");

    var form = document.getElementById('signup-form');

    var DataOne = form.elements['dataOne'];
    var dataOne = DataOne.value;

    var DataTwo = form.elements['dataTwo'];
    var dataTwo = DataTwo.value;
    
    var link = 'http://10.19.9.239:8000/relatorioPDF?chamado='+chamado+'&solicitacaoPapel='+solicitacaoPapel+'&dataOne='+dataOne+'&dataTwo='+dataTwo;

    document.getElementById('frame').src = link;
}

function checkboxChamado(){  // TRAZ LISTA DE CHAMADOS SE ESTIVER MARCADO
    if(chamado){
        chamado = '';
    }else{
        chamado = 'chamados';
    }
}
function checkboxSolicPapel(){ // TRAZ LISTA DE PAPEIS SE ESTIVER MARCADO
    if(solicitacaoPapel){
        solicitacaoPapel = '';
    }else{
        solicitacaoPapel = 'solicitacaoPapel';
    }
}



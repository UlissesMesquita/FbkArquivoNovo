 $(document).ready(function() {

    var enrollType;
  //  $("#div_id_As").hide();
    $("input[name='As']").change(function() {
        memberType = $("input[name='select']:checked").val();
        providerType = $("input[name='As']:checked").val();
		toggleIndividInfo();
    });
    
    $("input[name='select']").change(function() {
		memberType = $("input[name='select']:checked").val();
		toggleIndividInfo();
		toggleLearnerTrainer();
	});
	
	function toggleLearnerTrainer() {

	if (memberType == 'P' || enrollType=='company') {
		$("#cityField").hide();
		$("#providerType").show();
		$(".provider").show();
		$(".locationField").show();
		if(enrollType=='INSTITUTE'){
			$(".individ").hide();
		}
	
	} 
    else {
		$("#providerType").hide();
		$(".provider").hide();
		$('#name').show();
		$("#cityField").hide();
		$(".locationField").show();
		$("#instituteName").hide();
		$("#cityField").show();
		
	}
    }
    function toggleIndividInfo(){

	if(((typeof memberType!=='undefined' && memberType == 'TRAINER')||enrollType=='INSTITUTE') && providerType=='INDIVIDUAL'){
		$("#instituteName").hide();
		$(".individ").show();
		$('#name').show();
	}
    else if((typeof memberType!=='undefined' && memberType == 'TRAINER')|| enrollType=='INSTITUTE'){
		$('#name').hide();
		$("#instituteName").show();
		$(".individ").hide();
	}
    }
   
 });



//Valida Botão Enviar dados
 var campo1 = document.getElementById('id_terms'); //Seleciona o campo com a ID "nome"
campo1.setCustomValidity('Preencha todos os campos porfavor.'); //uso setCustomValidity para trocar a mensagem de erro dele.


    
function limpa_formulario_cep() {
	//Limpa valores do formulário de cep.
	document.getElementById('rua').value=("");
	document.getElementById('bairro').value=("");
	document.getElementById('cidade').value=("");
	document.getElementById('estado').value=("");
	
}

function meu_callback(conteudo) {
if (!("erro" in conteudo)) {
	//Atualiza os campos com os valores.
	document.getElementById('rua').value=(conteudo.logradouro);
	document.getElementById('bairro').value=(conteudo.bairro);
	document.getElementById('cidade').value=(conteudo.localidade);
	document.getElementById('estado').value=(conteudo.uf);
} //end if.
else {
	//CEP não Encontrado.
	limpa_formulario_cep();
	alert("CEP não encontrado.");
	document.getElementById('cep').value=("");
}
}

function pesquisacep(valor) {

//Nova variável "cep" somente com dígitos.
var cep = valor.replace(/\D/g, '');

//Verifica se campo cep possui valor informado.
if (cep !== "") {

	//Expressão regular para validar o CEP.
	var validacep = /^[0-9]{8}$/;

	//Valida o formato do CEP.
	if(validacep.test(cep)) {

			//Preenche os campos com "..." enquanto consulta webservice.
			document.getElementById('rua').value="...";
			document.getElementById('bairro').value="...";
			document.getElementById('cidade').value="...";
			document.getElementById('estado').value="...";

			//Cria um elemento javascript.
			var script = document.createElement('script');

			//Sincroniza com o callback.
			script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

			//Insere script no documento e carrega o conteúdo.
			document.body.appendChild(script);

	} //end if.
	else {
			//cep é inválido.
			limpa_formulario_cep();
			alert("Formato de CEP inválido.");
	}
} //end if.
else {
	//cep sem valor, limpa formulário.
	limpa_formulario_cep();
}
}

function formatar(mascara, documento){
var i = documento.value.length;
var saida = mascara.substring(0,1);
var texto = mascara.substring(i);

if (texto.substring(0,1) != saida){
	documento.value += texto.substring(0,1);
}

}

function idade (){
var data=document.getElementById("dtnasc").value;
var dia=data.substr(0, 2);
var mes=data.substr(3, 2);
var ano=data.substr(6, 4);
var d = new Date();
var ano_atual = d.getFullYear(),
mes_atual = d.getMonth() + 1,
dia_atual = d.getDate();

ano=+ano,
mes=+mes,
dia=+dia;

var idade=ano_atual-ano;

if (mes_atual < mes || mes_atual == mes_aniversario && dia_atual < dia) {
idade--;
}
return idade;
} 


function exibe(i) {



document.getElementById(i).readOnly= true;




}

function desabilita(i){

document.getElementById(i).disabled = true;    
}
function habilita(i)
{
document.getElementById(i).disabled = false;
}


function showhide()
{
var div = document.getElementById("newpost");

if(idade()>=18){

div.style.display = "none";
}
else if(idade()<18) {
div.style.display = "inline";
}

}









//Funções após a leitura do documento
$(document).ready(function() {
  
  //Select para mostrar e esconder divs
  $('#Dep').on('change',function(){
      var SelectValue='.'+$(this).val();

      //Desabilita o Campo
      $(".DivPai #Loc_Box_Eti").prop( "disabled", true );
      //Esconde o Campo
      $('.DivPai div').hide();

      //Mostra os Campos
      $(SelectValue).toggle();
      //Habilita o Campo
      $(SelectValue).find('select').prop("disabled", false);


  });

  
});


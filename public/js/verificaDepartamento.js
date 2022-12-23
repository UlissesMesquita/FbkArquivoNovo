function verifica(value){
	var input = document.getElementById("input");

  if(value == 2){
    input.disabled = false;
  }else if(value == 3){
    input.disabled = true;
  }
};
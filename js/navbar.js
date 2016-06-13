window.addEventListener("load", function () {
	
	var liDropDown = document.querySelector(".acount");

	var dropDown = document.querySelector(".dropDown");

	liDropDown.onclick = function(){
		if (dropDown.style.display == "block") {
			dropDown.style.display = "none";
		}else{
			dropDown.style.display = "block";
		}
		
		
	}





});	
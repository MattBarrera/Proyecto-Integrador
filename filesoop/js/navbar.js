window.addEventListener("load", function () {
	
	var liDropDown = document.querySelector(".user");

	var dropDown = document.querySelector(".dropDown");

	liDropDown.onclick = function(){
		if (dropDown.style.display == "block") {
			dropDown.style.display = "none";
		}else{
			dropDown.style.display = "block";
		}
		
		
	}





});	
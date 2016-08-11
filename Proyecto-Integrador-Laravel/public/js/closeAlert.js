// window.onload = function(){
// 			var closeAlert = document.getElementById('closeAlert');
//             // closeAlert.hide();
//             // $("#myWish").click(function showAlert() {
//                 // closeAlert.alert();
//                 closeAlert.fadeTo(2000, 500).slideUp(300, function(){
//                closeAlert.slideUp(100);
//                 });   
//             // });
//  };


 // $(document).ready (function(){
 //            $("#closeAlert").hide();
 //            // $("#myWish").click(function showAlert() {
 //                // $("#closeAlert").alert();
 //                $("#closeAlert").fadeTo(2000, 500).slideUp(300, function(){
 //               $("#closeAlert").slideUp(100);
 //                // });   
 //            });
 // });

 window.setTimeout(function() {
    $("#closeAlert").fadeTo(700, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
$(function () {
    "use strict";
    //trigle the selectboxit
     $("select").selectBoxIt({
         autoWidth:false
     }); 
    //==================================================================================
    //hide placeholder on form focus
    $('[placeholder]').focus(function () {
        $(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placeholder', "");
    }).blur(function () {
        $(this).attr('placeholder', $(this).attr('data-text'));
    });
   //=================================================================================== 
    //add asterisk  on required Field 
    $('input').each(function () {
        if ($(this).attr("required") === "required") {
            $(this).after('<span class="asterisk">*</span>');
        }//end if
    });//end function
    //==================================================================================
    //==================================================================================
    //Confirmation  Message  on buton
    $(".confirm").click(function(){
        return confirm('Are you sure?');
    });
    //==================================================================================
});
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
/*global $,document,confirm,console*/
$(document).ready(function () {
    "use strict";
    
    //nice scroll
    $("Html").niceScroll({
        cursorwidth: "12px",
        cursorcolor: "#424242"
    });
    //==================================================================================
        //trigle the selectboxit
    $("select").selectBoxIt({
        autoWidth: false
    });
    //==================================================================================
//switch between login and signup
    $(".login-page h1 span").click(function () {
        $(this).addClass("selected").siblings().removeClass("selected");
        $(".login-page form").hide();
        $("." + $(this).data("class")).fadeIn(100);
        
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
    //Confirmation  Message  on buton
    $(".confirm").click(function () {
        return confirm('Are you sure?');
    });
    //==================================================================================
    $(".live").keyup(function () {
        $($(this).data("class")).text($(this).val());
    });
    //====================================================================

//==================================================================================
//================================================================================== 
$('#zoom_04').elevateZoom({
    zoomType: 'inner',
    cursor: 'crosshair'
});
//==========================================================================================

    if($("#wrapfabtest").height() > 0) {
        
    } else {
        $( ".adblock" ).append( "<p>You Must Turn off Adblock</p>" );        
        $(".adBanner").css({"background-color": "transparent", "height": "1px","width":"1px"});
        $(".adblock").css({"color": "red", "border": "2px solid #eeee","padding":"10px"});
    }
    
/////////////////////////////
      $(document).scroll(function () {
    var $nav = $(".navbar-fixed-top");
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
  });
  

    
});




                    

              

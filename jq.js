 $(window).on('load',function() {});
reposition();
var navH_now = $("#cats").css("height");
 // alert ('тык высота = '+ navH_now);
  $("#info_banner").css({
         "height" : navH_now
     });

   var nav_h = $("nav.navbar").css("height");
   $("#info_banner").css({
         "top" : nav_h
     });

if ($("#pop_down").css("display")=="block")
{

	$("#t_log").css({
        "background-color" : "transparent",
        "color" : "#FFFFFF"
    });
    $("#t_reg").css({
        "border" : "none",
        "color" : "#FFFFFF"
    });	

    $("#t_log, #t_reg").css({
        "box-shadow" : "none",
    });
}
$('#pop_down').click(function(){
 // alert('Вы нажали на элемент "foo"');
  var h = $("nav.navbar").css("height");
  //alert("h = "+h);
  if (h == "107.6px")
  {
    $("#info_banner").css({
         "top" : "189.6px"
     });
   // alert("1");
  }
  else
  {
    $("#info_banner").css({
         "top" : "107.6px"
    });
    //alert("2");
  }
});

$(window).resize(function(){  
  var dis = $("#pop_down").css("display");
  if (dis == "none") {
  	$("#t_log").css({
        "background-color" : "#94D3D4",
        "color" : "#2D2D2E"
    });
    $("#t_reg").css({
    	"border" : "2px solid #FFFFFF",
    	"color" : "#FFFFFF"
    });
  }
  else
  {
  	$("#t_log").css({
        "background-color" : "transparent",
        "color" : "#FFFFFF"
    });
    $("#t_reg").css({
        "border" : "none",
        "color" : "#FFFFFF"
    });

    $("#t_log, #t_reg").css({
        "box-shadow" : "none",
    });
  }

  var bannback_h = $("#cats").css("height");
 // alert ('тык высота = '+ bannback_h);
  $("#info_banner").css({
        "height" : bannback_h
    });

  var nav_h = $("nav.navbar").css("height");
  $("#info_banner").css({
        "top" : nav_h
    });

  reposition();
});

function reposition()
{
  var w_field = parseFloat($("#back_top").css("width"));
  var w_symb = parseFloat($("#back_top span").css("width"));
  var left = w_field/2 - w_symb/2;
  left = left + 'px';
  $("#back_top span").css({
    "margin-left" : left
  })
}






$(document).ready( function() {
    
    var netAmount = 7000;
        sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
    
    
    
    $('#Emblem').carousel({
    	interval:   4000
	});
	
	var clickEvent = false;
	$('#Emblem').on('click', '.badge-box img', function() {
			clickEvent = true;
			//$('.badge-box img').removeClass('active');
			//$(this).parent().addClass('active');
        var string = '/assets/img/pic1.png';
        document.getElementById("vbadge").src = string;
	});
    /*
    .on('slid.bs.carousel', function(e) {
		if(!clickEvent) {
			var count = $('.nav').children().length -1;
			var current = $('.nav li.active');
			current.removeClass('active').next().addClass('active');
			var id = parseInt(current.data('slide-to'));
			if(count == id) {
				$('.nav li').first().addClass('active');	
			}
		}
		clickEvent = false;
	});
    */
    
    $("#Vehicle-Type").delegate("div","click",function(e){
    $("#Vehicle-Type .selected").removeClass("selected");
    $(this).addClass("selected");
    });
    
    /*--------------------- Sizes For Plate with price work -------------*/
    
    $('#platesize').change(function(event){ 
            var val = $(this).val();
            
            if ($(this).val() == "520") {
                
                //$('#bkplate').css("border","4px solid white");
                //$('#rearbkplate').css("border","white solid 4px");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 13000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            } else if ($(this).val() == "302") {
                
                //$('#bkplate').css("border","black solid 4px");
                //$('#rearbkplate').css("border","black solid 4px");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 7000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            } else if ($(this).val() == "372") {
                
                //$('#bkplate').css("border","black solid 4px");
                //$('#rearbkplate').css("border","black solid 4px");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 5000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            }
                                   
    });
    
    /*--------------------- End Plate Size -----------------------*/
    
    /*--------------------- Categories For Badges -----------------------*/
    
    $('#badgecategory').change(function(event){ 
            var val = $(this).val();
            
            if ($(this).val() == "1") { // assuming sports
                                
                // $.getJSON("assets/img/GetFolderList/", function(result) {
                //     var optionsValues = '<select>';
                //     $.each(result, function(item) {
                //         optionsValues += '<option value="' + item.ImageFolderID + '">' + item.Name + '</option>';
                //     });
                //     optionsValues += '</select>';
                //     var options = $('#options');
                //     options.replaceWith(optionsValues);
                // });
                
                //$("#badge").html("<option value='test'>item1: test 1</option><option value='test2'>item1: test 2</option>");
                
                // var borderAddedAmount = sessionStorage.getItem('totalAmount');
                // var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                // var netAmount = comingAmount + 8000;
                // $("#netAmount").text(netAmount);
                // sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            } else if ($(this).val() == "2") { // assuming historical - if coming from DB use unique-text 
                
                //$("#badge").html("<option value='test'>item1: test 1</option><option value='test2'>item1: test 2</option>");
                
                // var borderAddedAmount = sessionStorage.getItem('totalAmount');
                // var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                // var netAmount = comingAmount + 8000;
                // $("#netAmount").text(netAmount);
                // sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            } 
                                   
    });
    
    /*--------------------- End Categories For Badges -----------------------*/
    
    
    /*--------------------- Badges w.r.t Categories -----------------------*/
    // badges count
    var count = 1;
    $("#selectId > option").each(function() {
        count++;
    });

    $('#badges').change(function(event){ 
            var val = $(this).val();
        
            //var conceptName = $('#badges').find(":selected").value();
            if ($(this).val() > 0) {

                $('#Bdg').css("background-image", "url(assets/img/pic"+ $(this).val() +".png)"); 
                $('#rearBdg').css("background-size", "cover");

                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 15000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));

            } 
            
    });
    
  
    /*-----------------------------------------------------------*/
    
    
    
    /*----------------------- change plate background ---------------------------*/
    
    //$(function){
        $('#LightGreen').click(function(){
            $('#bkplate').css("background-image", "url(assets/img/Plate-Background_09.jpg)");
            $('#bkplate').css("background-repeat", "no-repeat"); 
            $('#bkplate').css("background-size", "cover"); 
            $('#rearbkplate').css("background-image", "url(assets/img/Plate-Background_09.jpg)");
            $('#rearbkplate').css("background-repeat", "no-repeat"); 
            $('#rearbkplate').css("background-size", "cover"); 
            
            var borderAddedAmount = sessionStorage.getItem('totalAmount');
            var comingAmount = parseInt($.parseJSON(borderAddedAmount));
            var netAmount = comingAmount + 17000;
            $("#netAmount").text(netAmount);
            sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
        });
    //} background-repeat:no-repeat;background-size:cover;
        $('#Blue').click(function(){
            $('#bkplate').css("background-image", "url(assets/img/Plate-Background_05.jpg)");
            $('#bkplate').css("background-repeat", "no-repeat"); 
            $('#bkplate').css("background-size", "cover"); 
            $('#rearbkplate').css("background-image", "url(assets/img/Plate-Background_05.jpg)");
            $('#rearbkplate').css("background-repeat", "no-repeat"); 
            $('#rearbkplate').css("background-size", "cover"); 
            var borderAddedAmount = sessionStorage.getItem('totalAmount');
            var comingAmount = parseInt($.parseJSON(borderAddedAmount));
            var netAmount = comingAmount + 17000;
            $("#netAmount").text(netAmount);
            sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
        });
        
        $('#Orange').click(function(){
            $('#bkplate').css("background-image", "url(assets/img/Plate-Background_07.jpg)");
            $('#bkplate').css("background-repeat", "no-repeat"); 
            $('#bkplate').css("background-size", "cover"); 
            $('#rearbkplate').css("background-image", "url(assets/img/Plate-Background_07.jpg)");
            $('#rearbkplate').css("background-repeat", "no-repeat"); 
            $('#rearbkplate').css("background-size", "cover"); 
            var borderAddedAmount = sessionStorage.getItem('totalAmount');
            var comingAmount = parseInt($.parseJSON(borderAddedAmount));
            var netAmount = comingAmount + 17000;
            $("#netAmount").text(netAmount);
            sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
        });
        
        $('#GreenGrass').click(function(){
            $('#bkplate').css("background-image", "url(assets/img/Plate-Background_03.jpg)");
            $('#bkplate').css("background-repeat", "repeat"); 
            $('#bkplate').css("background-size", "cover"); 
            $('#rearbkplate').css("background-image", "url(assets/img/Plate-Background_03.jpg)");
            $('#rearbkplate').css("background-repeat", "no-repeat"); 
            $('#rearbkplate').css("background-size", "cover"); 
            var borderAddedAmount = sessionStorage.getItem('totalAmount');
            var comingAmount = parseInt($.parseJSON(borderAddedAmount));
            var netAmount = comingAmount + 17000;
            $("#netAmount").text(netAmount);
            sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
        });
    
        /* ------------------------- Badges Change ------------------------*/
        $('#front-greenEmblem').click(function(){
            $('#Bdg').css("background-image", "url(assets/img/pic1.png)");
            $('#Bdg').css("background-repeat", "no-repeat"); 
            $('#Bdg').css("background-size", "cover"); 
            $('#rearBdg').css("background-image", "url(assets/img/pic1.png)");
            $('#rearBdg').css("background-repeat", "no-repeat"); 
            $('#rearBdg').css("background-size", "cover"); 
            var borderAddedAmount = sessionStorage.getItem('totalAmount');
            var comingAmount = parseInt($.parseJSON(borderAddedAmount));
            var netAmount = comingAmount + 17000;
            $("#netAmount").text(netAmount);
            sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
        });
    
        $('#front-bmw').click(function(){
            $('#Bdg').css("background-image", "url(assets/img/pic3.png)");
            $('#Bdg').css("background-repeat", "no-repeat"); 
            $('#Bdg').css("background-size", "cover"); 
            $('#rearBdg').css("background-image", "url(assets/img/pic3.png)");
            $('#rearBdg').css("background-repeat", "no-repeat"); 
            $('#rearBdg').css("background-size", "cover"); 
            var borderAddedAmount = sessionStorage.getItem('totalAmount');
            var comingAmount = parseInt($.parseJSON(borderAddedAmount));
            var netAmount = comingAmount + 17000;
            $("#netAmount").text(netAmount);
            sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
        });
    
        $('#front-manchester').click(function(){
            $('#Bdg').css("background-image", "url(assets/img/pic4.png)");
            $('#Bdg').css("background-repeat", "no-repeat"); 
            $('#Bdg').css("background-size", "cover"); 
            $('#rearBdg').css("background-image", "url(assets/img/pic4.png)");
            $('#rearBdg').css("background-repeat", "no-repeat"); 
            $('#rearBdg').css("background-size", "cover"); 
            var borderAddedAmount = sessionStorage.getItem('totalAmount');
            var comingAmount = parseInt($.parseJSON(borderAddedAmount));
            var netAmount = comingAmount + 17000;
            $("#netAmount").text(netAmount);
            sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
        });
    
        $('#front-lahoreq').click(function(){
            $('#Bdg').css("background-image", "url(assets/img/pic2.png)");
            $('#Bdg').css("background-repeat", "no-repeat"); 
            $('#Bdg').css("background-size", "cover"); 
            $('#rearBdg').css("background-image", "url(assets/img/pic2.png)");
            $('#rearBdg').css("background-repeat", "no-repeat"); 
            $('#rearBdg').css("background-size", "cover"); 
            var borderAddedAmount = sessionStorage.getItem('totalAmount');
            var comingAmount = parseInt($.parseJSON(borderAddedAmount));
            var netAmount = comingAmount + 17000;
            $("#netAmount").text(netAmount);
            sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
        });
    
        /* ------------  Border color front change ----------- */ 
        //var borderAmount = 5000;
        
//         sessionStorage.setItem('netAmount', JSON.stringify(netAmount));
        
//         var myselect = document.getElementById("bkgColor");
//         colour = myselect.options[myselect.selectedIndex].id;
    
        $('#bkgColor').change(function(event){ 
            var val = $(this).val();
            
            if ($(this).val() == "noborder") {
                
                $('#bkplate').css("border","4px solid white");
                $('#rearbkplate').css("border","white solid 4px");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 8000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            } else if ($(this).val() == "blackborder") {
                
                $('#bkplate').css("border","black solid 4px");
                $('#rearbkplate').css("border","black solid 4px");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 8000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            } else if ($(this).val() == "apacheborder") {
                
                $('#bkplate').css("border", "4px solid rgb(223, 187, 101)");
                $('#rearbkplate').css("border", "4px solid rgb(223, 187, 101)");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 8000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));

            } else if ($(this).val() == "darkblueborder") {
                
                //sessionStorage.setItem('borderAmount', JSON.stringify(borderAmount));
                $('#bkplate').css("border", "4px solid rgb(34, 42, 123)");
                $('#rearbkplate').css("border", "4px solid rgb(34, 42, 123)");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 8000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            } else if ($(this).val() == "lightblueborder") {
                
                $('#bkplate').css("border", "4px solid rgb(26, 174, 202)");
                $('#rearbkplate').css("border", "4px solid rgb(26, 174, 202)");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 8000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            } else if ($(this).val() == "blueborder") {
                
                $('#bkplate').css("border", "4px solid rgb(0, 147, 221)");
                $('#rearbkplate').css("border", "4px solid rgb(0, 147, 221)");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 8000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            } else if ($(this).val() == "maroonborder") {
                
                sessionStorage.setItem('borderAmount', JSON.stringify(borderAmount));
                $('#bkplate').css("border", "4px solid rgb(193, 32, 38)");
                $('#rearbkplate').css("border", "4px solid rgb(193, 32, 38)");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 8000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            } else if ($(this).val() == "darkmaroonborder") {
                
                sessionStorage.setItem('borderAmount', JSON.stringify(borderAmount));
                $('#bkplate').css("border", "4px solid rgb(143, 41, 52)");
                $('#rearbkplate').css("border", "4px solid rgb(143, 41, 52)");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 8000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            } else if ($(this).val() == "greenborder") {
                
                sessionStorage.setItem('borderAmount', JSON.stringify(borderAmount));
                $('#bkplate').css("border", "4px solid rgb(0, 146, 63)");
                $('#rearbkplate').css("border", "4px solid rgb(0, 146, 63)");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 8000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            } else if ($(this).val() == "darkgreenborder") {
                
                sessionStorage.setItem('borderAmount', JSON.stringify(borderAmount));
                $('#bkplate').css("border", "4px solid rgb(48, 97, 65)");
                $('#rearbkplate').css("border", "4px solid rgb(48, 97, 65)");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 8000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            } else if ($(this).val() == "yellowborder") {
                
                sessionStorage.setItem('borderAmount', JSON.stringify(borderAmount));
                $('#bkplate').css("border", "4px solid rgb(255, 245, 0)");
                $('#rearbkplate').css("border", "4px solid rgb(255, 245, 0)");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 8000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            } else if ($(this).val() == "purpleborder") {
                
                sessionStorage.setItem('borderAmount', JSON.stringify(borderAmount));
                $('#bkplate').css("border", "4px solid rgb(154, 73, 132)");
                $('#rearbkplate').css("border", "4px solid rgb(154, 73, 132)");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 8000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            } else if ($(this).val() == "pinkborder") {
                
                sessionStorage.setItem('borderAmount', JSON.stringify(borderAmount));
                $('#bkplate').css("border", "4px solid rgb(228, 147, 166)");
                $('#rearbkplate').css("border", "4px solid rgb(228, 147, 166)");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 8000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            } else if ($(this).val() == "bisqueborder") {
                
                sessionStorage.setItem('borderAmount', JSON.stringify(borderAmount));
                $('#bkplate').css("border", "4px solid rgb(255, 159, 85)");
                $('#rearbkplate').css("border", "4px solid rgb(255, 159, 85)");
                var borderAddedAmount = sessionStorage.getItem('totalAmount');
                var comingAmount = parseInt($.parseJSON(borderAddedAmount));
                var netAmount = comingAmount + 8000;
                $("#netAmount").text(netAmount);
                sessionStorage.setItem('totalAmount', JSON.stringify(netAmount));
                
            }
                                   
        });
    
  
        /* ----------------------- end border color ---------------------- */
        
        
});

/*$(document).ready(function(){
    var option_data=$("ul#select_vehicle>option:li.selected").val();
    $('#select_vehicle').change(function () {
        alert(option_data);
    }); 
});*/
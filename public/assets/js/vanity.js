$(document).ready( function() {
    
    
        
        
});



$(document).ready(function(){
    var net_amount = '';
    var plate_size_amount = '';
    var net_badge_price = '';

    $("#platesize").change(function(){
        var platesize  = $("#platesize").val();
        var platesize_arr = platesize.split('|');
        var plate_id = platesize_arr[0];
        var plate_size_amount = platesize_arr[1];
        $(".plate-box").css('background-image', 'none');
        if (platesize==""){
            $('#badgecategory').attr("disabled","disabled");
            $('#badges').attr("disabled","disabled");
            
        }
        else if (platesize!=""){
            $('#badgecategory').removeAttr('disabled');
            $('#badges').removeAttr('disabled');
            $("#badgecategory option:eq(0)").prop("selected", true);
            $("#badges option:eq(0)").prop("selected", true);
            $(".bkgColor option:eq(0)").prop("selected", true);
            $(".plate-box").css('border','');
            $(".rear_badge").attr("src","");
            $("#select_background_array").val('');
            $(".plate-box").css('background-image', 'none');

            
            plate_size_amount = platesize_arr[1];
            $(".plate-amount-style").text(plate_size_amount);
        }

        if (platesize==''){
            $("#badgecategory option:eq(0)").prop("selected", true);
            $("#badges option:eq(0)").prop("selected", true);
            $("#badges option:eq(0)").prop("selected", true);
            $(".bkgColor option:eq(0)").prop("selected", true);
            $(".plate-box").css('border','');
            $(".rear_badge").attr("src","");
            plate_size_amount = 0;
            $(".plate-amount-style").text('');
            $("#select_background_array").val('');
            $(".plate-box").css('background-image', 'none');
        }
    });

    $("#badgecategory").change(function(){
        $(".plate-box").css('background-image', 'none');
        var cat_id = $("#badgecategory").val();
        $(".plate-box").css('border','');
        $(".rear_badge").attr("src","");
        $.ajax({
            type: "POST",
            url: "/get-badges",
           // dataType : 'json', 
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                cat_id: cat_id
            },
            success: function(data){
                $('.bkgColor').removeAttr('disabled');
                $("#badges").html(data);
            }
        });

    });

    $("#badges").change(function(){
    	$(".bkgColor option:eq(0)").prop("selected", true);
        $("#select_background_array").val('');
        $(".plate-box").css('background-image', 'none');
        var platesize  = $("#platesize").val();
        var platesize_arr = platesize.split('|');
        var plate_id = platesize_arr[0];
        var plate_size_amount = platesize_arr[1];

        var badges = $("#badges").val();
        var arr = badges.split('|');

        var badge_id = arr[0];
        var badge_price = arr[1];
        var badge_image = arr[2];

        net_badge_price = parseInt(plate_size_amount) + parseInt(badge_price);

        $(".plate-box").css('border','');
        $(".rear_badge").attr("src","");

        $(".rear_badge").attr("src","http://vanity.freetreasure.org/images/badges/"+badge_image+"");
        $(".rear_badge").attr("src","http://vanity.freetreasure.org/images/badges/"+badge_image+"");

        $(".plate-amount-style").text(net_badge_price);
        $('.rear_badge').show();
        if ( badges == '' ) {
            //console.log(badges);
            $('.rear_badge').hide();
            $(".plate-amount-style").text(parseInt(plate_size_amount));
        }
    
    });

    $(".bkgColor").change(function(){
        $("#select_background_array").val('');
        $(".plate-box").css('background-image', 'none');
        var platesize  = $("#platesize").val();
        var platesize_arr = platesize.split('|');
        var plate_id = platesize_arr[0];
        var plate_size_amount = platesize_arr[1];


        var badges = $("#badges").val();
        var arr = badges.split('|');
        var badge_id = arr[0];
        var badge_price = arr[1];
        var badge_image = arr[2];
        var net_badge_price = parseInt(plate_size_amount) + parseInt(badge_price);

        var borderColors = $(".bkgColor").val();
        var borderColors_arr = borderColors.split('|');
        var border_id = borderColors_arr[0];
        var border_color = borderColors_arr[1];
        var border_price = borderColors_arr[2];
        total_amount_with_border = parseInt(net_badge_price) + parseInt(border_price);

        if (borderColors!=''){
            $(".plate-amount-style").text(total_amount_with_border);
            $(".plate-box").css({"border-color": '#'+border_color, "border-width":"4px", "border-style":"solid"});
        }

        if (borderColors==''){
            $(".plate-amount-style").text(net_badge_price);
            $(".plate-box").css('border','');
        }
    });

    $(".select_background ").click(function(){
        /* Selected Background Array */
        var select_background = $(this).attr('value');
        var select_background_arr = select_background.split('|');
        var select_background_id = select_background_arr[0];
        var select_background_name = select_background_arr[1];
        var select_background_amount = select_background_arr[2];
        var select_background_image = select_background_arr[3];
        /*End Selected Background Array */

        /*Plate Size Array*/
        var platesize  = $("#platesize").val();
        var platesize_arr = platesize.split('|');
        var plate_id = platesize_arr[0];
        var plate_size_amount = platesize_arr[1];
        /* End Plate Size Array*/

        /*Badges Array*/
        var badges = $("#badges").val();
        var arr = badges.split('|');
        var badge_id = arr[0];
        var badge_price = arr[1];
        var badge_image = arr[2];
        var net_badge_price = parseInt(plate_size_amount) + parseInt(badge_price);
        /*End Badges Array*/


        /* Border Array */
        var borderColors = $(".bkgColor").val();
        var borderColors_arr = borderColors.split('|');
        var border_id = borderColors_arr[0];
        var border_color = borderColors_arr[1];
        var border_price = borderColors_arr[2];
        total_amount_with_border = parseInt(net_badge_price) + parseInt(border_price);
        /*End Border*/

        total_amount_with_border_background = total_amount_with_border + parseInt(select_background_amount);

        $("#select_background_array").val(select_background);
        $(".plate-amount-style").text(total_amount_with_border_background);
        $(".plate-box").css({ "background-image": "url(http://vanity.freetreasure.org/images/backgrounds/"+select_background_image+")", "background-size": "100% 100%"});


    });
});
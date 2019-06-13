    $(document).ready(function () {

        if ($(".cos1").is(':checked')){}else{
            $('#overnight_fixed').attr('readonly', true);$("#overnight_fixed").addClass("disable");}
        if ($(".cos2").is(':checked')){}else{
            $('#secondday_fixed').attr('readonly', true);$("#secondday_fixed").addClass("disable");}
        if ($(".cos3").is(':checked')){}else{
            $('#thirdday_fixed').attr('readonly', true);$("#thirdday_fixed").addClass("disable");}
        if ($(".cos4").is(':checked')){}else{
            $('#ground_fixed').attr('readonly', true);$("#ground_fixed").addClass("disable");}
        if ($(".cos5").is(':checked')){}else{
            $('#etc_fixed').attr('readonly', true);$("#etc_fixed").addClass("disable");}                            

        $('form input').keypress(function (event) {
            if (event.charCode == 13) {
                $(this).closest('form').parent().find('.btn_click').trigger('click');
            }
        });
        $('#f_email').keypress(function (event) {
            if (event.charCode == 13) {
                $(this).parent().parent().parent().parent().find('.btn_click').trigger('click');
            }
        });
        $('#defaultForm-email').keypress(function (event) {
            if (event.charCode == 13) {
                $(this).parent().parent().parent().parent().find('.social_email').trigger('click');
            }
        });
        $('#bid_amount').keypress(function (event) {
            if (event.charCode == 13) {
                $(this).parent().find('#submit_bid').trigger('click');
            }
        });
        $('.return_number').on('keypress', function (evt) {       
            return evt.charCode >= 48 && evt.charCode <= 57    
        });



    // $('.return_number').on("keypress", function (event) {
    //     if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
    //         if ((event.which != 46 || $(this).val().indexOf('.') != -1)) {
    //         }
    //         event.preventDefault();
    //     }
    //     if (this.value.indexOf(".") > -1 && (this.value.split('.')[1].length > 1)) {
    //         event.preventDefault();
    //     }
    // });

    $('.floatnumbersOnly').keyup(function(event){
        var quantity = $(this).val();
        var total_quantity = $(this).data('quantity');
        var price = $(this).data('price');
        
    });


    $('.number_only').keypress(function (event) {
        var $this = $(this);
        if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
            ((event.which < 48 || event.which > 57) &&
                (event.which != 0 && event.which != 8))) {
            event.preventDefault();
    }

    var text = $(this).val();
    if ((event.which == 46) && (text.indexOf('.') == -1)) {
        setTimeout(function () {
            if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
            }
        }, 1);
    }

    if ((text.indexOf('.') != -1) &&
        (text.substring(text.indexOf('.')).length > 2) &&
        (event.which != 0 && event.which != 8) &&
        ($(this)[0].selectionStart >= text.length - 2)) {
        event.preventDefault();
    }
    });

    $("#primary_pic").click(function () {
        $("#file1").trigger('click');
    });

    $(".auctioncls").click(function () {
        $("#auction_id").val(1);
    });

    $(".fixedcls").click(function () {
        $("#auction_id").val(2);
    });

    $("#second_pic").click(function () {
        $("#file2").trigger('click');
    });

    $("#third_pic").click(function () {
        $("#file3").trigger('click');
    });

    $("#firearms_search").click(function () {
        $("#search_form").submit();
    });

    $('#list_manufacturer').on('change', function () {
        var selectedText = $(this).find("option:selected").text();
        var str2 = "Other";
        if (selectedText.indexOf(str2) != -1) {
            $('.other_manu').css('display', 'block');
        } else {
            $('.other_manu').css('display', 'none');
        }
    });

    $("#header_search").click(function () {
        $('#header_search_form').submit();
    });

    $("#single_share").click(function () {
        var list_id = $(this).attr('data-attr');
        $("#myModal").modal();
        $('#share_list_id').val(list_id);
    });

    $(".my_network").click(function(){
        $(".my_network_section").slideToggle();
        $(".mynetwork_submit").slideToggle();
    });

    $(document).on('click', '[data-network="mynetwork"]', function() {
        $id=$(this).data("id");
        var val=$(this).data("val");
        var mynetwork_selected_video=$("#mynetwork_selected_video").val();

        if ($(this).prop("checked")) {       
            $(".video_sec_"+$id).addClass("network_border");                  
            if(mynetwork_selected_video ==''){
               $added_value =val;
            }else{
                $added_value =mynetwork_selected_video+","+val;
            }
            $('#mynetwork_selected_video').val($added_value);        
        }else{
            $(".video_sec_"+$id).removeClass("network_border");          
            var  separator = ","; 
            var values = mynetwork_selected_video.split(separator);
            for(var i = 0 ; i < values.length ; i++) {
                if(values[i] == val) {
                  values.splice(i, 1);values.join(separator);                 
                }
            }     
            $('#mynetwork_selected_video').val(values);  
        }
    });

    $("#ask_question").click(function () {
        var list_id = $(this).attr('data-attr');
        var first_name = $(this).data('id');
        var list_user_image = $(this).data('prod-id');
        var base_url = $('#base_url').val();
        var buyer_name = $(this).data('userid');
        var buyeremail = $(this).data('useremail');
        var subject = $(this).data('subject');
        var selleremail = $(this).data('selleremail');
        var title = $(this).data('title');
        
        $('#seller_list_too').val(first_name);
        $('#seller_list_fromo').val(buyer_name);
        $('#seller_list_subjecto').val("Question regarding Firearms.com item #"+subject);

        $('#seller_list_to').text(first_name);
        $('#seller_list_from').text(buyer_name);
        $('#seller_list_subject').text("Question regarding Firearms.com item #"+subject);
        $('#buyers_list_email').val(buyeremail);
        $('#seller_list_email').val(selleremail);
        
        $("#ask_question_modal").modal();
        $('#seller_list_id').val(list_id);
        $('#saller_name').text(first_name);
        $('#title').text(title);

        $full_images = base_url + 'assets/img/profile_image/' + list_user_image;

        $("#listing_user_image").attr('src', $full_images);

    });

    //this function is hold form short time
    $('#category_sell_hold').on('change', function () {
        var cat_id = $(this).val();
            // alert(cat_id);
            var base_url = $('#base_url').val();

            if (false) {
            } else {
                $.ajax({
                    method: 'post',
                    url: base_url + 'home/get_manufacturer',
                    data: {'cat_id': cat_id}
                }).done(function (resp) {

                    if (resp == 'null') {
                        $('#manufacturer_validate').val(0);
                        $('#manufacturer_section').css('display', 'none');
                        $('.other_manu').css('display', 'none');
                        $("#list_manufacturer").html('');
                        $("#other_manufacturer_name").val('');

                    } else {
                        $('#manufacturer_validate').val(1);
                        $('#manufacturer_section').css('display', 'block');
                        var dataObj = JSON.parse(resp);
                        $("#list_manufacturer").html('');
                        $('.other_manu').css('display', 'none');
                        $("#other_manufacturer_name").val('');

                        $option = '';

                        $option += "<option value=''> Choose Manufacturer</option>";
                        for (var i = 0; i < dataObj.length; i++) {
                            $option += "<option value='" + dataObj[i]['id'] + "'>" + dataObj[i]['name'] + "</option>";
                        }
                        $("#list_manufacturer").append($option);
                    }
                });
            }


        })

    $("input[name = 'shiping_payer']").click(function(){      
        var shiping_payer = $("input[name='shiping_payer']:checked").val();
        if(shiping_payer==3){
            $('#buyer_fixed_section').show();
        }else{
            $('#buyer_fixed_section').hide();
        }             
    });

    $('.ship_check').change(function() {
        var $check = $(this),
        $div = $check.parent();
        var $shipping_val = $(this).val(); 
        
        if($shipping_val=='Overnight'){
            if ($check.prop('checked')) {$('#overnight_fixed').attr('readonly', false);
            $("#overnight_fixed").removeClass("disable");
        } else {$('#overnight_fixed').attr('readonly', true);  
        $("#overnight_fixed").addClass("disable");} 
    }  
    if($shipping_val=='2nd day'){
        if ($check.prop('checked')) {$('#secondday_fixed').attr('readonly', false);$("#secondday_fixed").removeClass("disable");
    } else {$('#secondday_fixed').attr('readonly', true);$("#secondday_fixed").addClass("disable");} 
    } 
    if($shipping_val=='3rd day'){
        if ($check.prop('checked')) {$('#thirdday_fixed').attr('readonly', false);$("#thirdday_fixed").removeClass("disable");
    } else {$('#thirdday_fixed').attr('readonly', true);$("#thirdday_fixed").addClass("disable");} 
    } 
    if($shipping_val=='Ground'){
        if ($check.prop('checked')) {$('#ground_fixed').attr('readonly', false);$("#ground_fixed").removeClass("disable");
    } else {$('#ground_fixed').attr('readonly', true);$("#ground_fixed").addClass("disable");} 
    }
    if($shipping_val=='Etc'){
        if ($check.prop('checked')) {$('#etc_fixed').attr('readonly', false);$("#etc_fixed").removeClass("disable");
    } else {$('#etc_fixed').attr('readonly', true);$("#etc_fixed").addClass("disable");} 
    }
    });    





    $("#submit_bid").click(function () {
        var base_url = $('#base_url').val();
        var check_time = $('#demo').text();
        var current = $(this).parent().find('input[name=bid_amount]');
        var bid_value = current.val();
        var list_id = $('#list_id').val();

        if (check_time == 'EXPIRED') {
            $('#bid_amount_valid').html('this item is not available in auction');
        } else {
            if (bid_value != '') {
                $.ajax({
                    method: 'post',
                    url: base_url + 'user_action/bid',
                    data: {'bid_value': bid_value, 'list_id': list_id}
                }).done(function (resp) {
                    if (resp == 0) {
                        $('#bid_amount_valid').html('Bid value should be greater than current bid');
                    } else if (resp == 'less') {
                        $('#bid_amount_valid').html('Bid value should be greater or equal to starting bid value');
                    } else {
                        data1 = JSON.parse(resp);

                        var reserve_price = data1.reserve_price;

                        if (bid_value >= reserve_price) {
                            $("#res_no_met").text('Reserve Met');
                        }
                        $(".hb1").hide();
                        $(".sb1").show();

                        current.val('');
                        $('#bid_amount_valid').html('');
                        $('.current_bid').html('$' + bid_value);
                        $('.min_bid').html('$' + data1.bid_amount);
                        $('.bid_count').html(data1.bid_count + ' Bid(s)');
                        swal("Success!", "Bid successfully added.", "success");
                    }
                });
            } else {
                $('#bid_amount_valid').html('Bid value cannot be empty');
            }
        }


    });

    $(".like_list").click(function () {

        var base_url = $('#base_url').val();
        var list_id = $(this).attr('id');
        var current = $(this);
            //alert(list_id);
            // current.parent().find('.icon').css('display','none');
            // current.parent().find('.like_loader').css('display','block');
            $.ajax({
                method: 'post',
                url: base_url + 'user_action/like_list',
                data: {'list_id': list_id}
            }).done(function (resp) {
                // current.parent().find('.like_loader').css('display','none');
                // current.parent().find('.icon').css('display','block');
                if (resp == 'remove') {

                    current.parent().find('.icon').removeClass('fa-heart');
                    current.parent().find('.icon').addClass('fa-heart-o');

                    swal("Success!", "Listing removed from favourites .", "success");
                } else {

                    current.parent().find('.icon').removeClass('fa-heart-o');
                    current.parent().find('.icon').addClass('fa-heart');
                    swal("Success!", "Listing added to favourites .", "success");
                }
            });
        });

    function list_like_fun() {
        alert("test");
    }

    $(".fav_seller").click(function () {
        var base_url = $('#base_url').val();
        var seller_id = $('#list_user_id').val();
        var current = $(this);
        $.ajax({
            method: 'post',
            url: base_url + 'user_action/fav_seller',
            data: {'seller_id': seller_id}
        }).done(function (resp) {
            if (resp == 'remove') {
                current.parent().find('#seller_fav').removeClass('fa fa-heart');
                current.parent().find('#seller_fav').addClass('fa fa-heart-o');
                current.parent().find('#fav_seller_text').text('Add to favourite seller');
                swal("Success!", "Seller removed from favourites.", "success");
            } else {
                current.parent().find('#seller_fav').removeClass('fa fa-heart-o');
                current.parent().find('#seller_fav').addClass('fa fa-heart');
                current.parent().find('#fav_seller_text').text('Remove from favourite seller');
                swal("Success!", "Seller added to favourites.", "success");
            }
        });
    });

    $(".add_watchlist").click(function () {

        var base_url = $('#base_url').val();
        var list_user_id = $('#list_user_id').val();
        var list_id = $('#list_id').val();

        var current = $(this);
        $.ajax({
            method: 'post',
            url: base_url + 'user_action/add_watchlist_item',
            data: {'list_user_id': list_user_id, 'list_id': list_id}
        }).done(function (resp) {

            if (resp == 'remove') {
                current.parent().find('#watchlist_span_id').text('Add to watchlist');
                swal("Success!", "Item successfully removed from watchlist.", "success");
            } else {
                current.parent().find('#watchlist_span_id').text('Remove from watchlist');
                swal("Success!", "Item successfully added in watchlist.", "success");
            }
        });

    });

    $("#single_share_user").on("change", function () {
        $('#defaultForm-email').val('');
    });

    $('#defaultForm-email').keyup(function () {
        $('#single_share_user option:eq(0)').attr('selected', 'selected');
    });

    $(".social_email").click(function () {
        var send = 1;
        $('.share_err').html('');
        var base_url = $('#base_url').val();
        var soc_email = $('#defaultForm-email').val();
        var single_share_user = $('#single_share_user').val();
        var list_id = $('#share_list_id').val();
        var mail_validation = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (soc_email == '' && single_share_user == '') {
            $('.single_share_valid').html('Please select any user or enter email to share the listing');
            send = 0;
        } else if (soc_email != '' && single_share_user != '') {
            $('.single_share_valid').html('Please select Only one option');
            send = 0;
        } else if (soc_email != '' && single_share_user == '') {
            if (!soc_email.match(mail_validation)) {
                $('.social_email_valid').html('Please enter valid email address');
                send = 0;
            } else {
                var share_to = soc_email;
            }
        } else {
            var share_to = single_share_user;
        }

        if (send == 1) {
            $.ajax({
                method: 'post',
                url: base_url + 'user_action/social_email',
                data: {'share_to': share_to, 'list_id': list_id}
            }).done(function (resp) {
                console.log(resp);
                if (resp == 'Success11') {
                    swal("Success!", "Post shared to user.", "success");
                    $('#defaultForm-email').val('');
                    $('.social_email_valid').html('');
                    $(".social_close").trigger('click');
                } else {
                    swal("Oops!", "Post not shared to user.", "error");
                }
            });
        }
    });


    $(".amount_pay").click(function () {

        var base_url = $('#base_url').val();
        var user_email = $('#user_email').val();
        var user_pass = $('#user_pass').val();


        $.ajax({
            method: 'post',
            url: base_url + 'user_action/amount_pay',
            data: {'user_email': user_email, 'user_pass': user_pass}
        }).done(function (resp) {

            window.location.href = base_url + "signing_amount/" + resp;

        });

    });


    $(".add_list_question").click(function () {
        var send = 1;
        $('.que_err').html('');
        var base_url = $('#base_url').val();
        var seller_que = $('#seller_que').val();
        var seller_id = $('#seller_list_id').val();

        var seller_email = $('#seller_list_email').val();
        var buyers_email =  $('#buyers_list_email').val();
        var to = $('#seller_list_too').val();
        var from = $('#seller_list_fromo').val();
        var subject = $('#seller_list_subjecto').val();

        if (seller_que == '') {
            $('.que_valid').html('Please add quesiton');
            send = 0;
        } else {

            if (send == 1) {
                $.ajax({
                    method: 'post',
                    url: base_url + 'user_action/add_question',
                    data: {
                        'seller_id': seller_id,
                        'seller_que': seller_que,
                        'seller_email':seller_email,
                        'buyers_email':buyers_email,
                        'to':to,
                        'from':from,
                        'subject':subject
                    }
                }).done(function (resp) {

                    if (resp == 1) {
                        swal("Success!", "Question added successfully.", "success");

                        $('.que_valid').html('');
                        $('.seller_que').html('');
                        $(".social_close").trigger('click');
                    } else {
                        swal("Oops!", "Post not shared to seller.", "error");
                    }
                });
            }
        }


    });



    var count = 2;
    $(".add_more_pic").click(function () {
        var base_url = $('#base_url').val();
        var photo = '<div class="img_upload_sec">' +
        '<div class="img_upload_inner">' +
        '<div class="col-md-2 img_label">Add Picture:</div>' +
        '<div class="col-md-2 upload_btn">' +
        '<a onclick="a_photo(this)">Upload</a>' +
        '<input type="file" class="file_input upd_file" name="a_file[]" style="display:none" onchange="a_readURL(this);" accept=".jpg,.jpeg,.png">' +
        '</div>' +
        '<div class="col-md-2 img_thumb"><img style="width:100%; height:100px;" class="a_display_section" src="' + base_url + 'assets/img/image_not_found.png" id="display_a_pic' + count + '"/><a style="display:none;" onclick="a_cancel_img(this);" class="cancel_btn"><img src="' + base_url + 'assets/img/cancel_btn.png"/></a></div>' +
        '</div>' +
        '</div>';
        $('#picture_section').append(photo);
        count++;
    });

    $(".add_more_video").click(function () {
        var base_url = $('#base_url').val();
        var video = '<div class="img_upload_inner">' +
        '<div class="col-md-2 img_label">Url :</div>' +
        '<div class="col-md-4 video_input">' +
        '<input type="text" class="display_video" name="youtube_video_url[]" onchange="youFunction(this)" onkeyup="youFunction(this)" onpaste="youFunction(this)" oninput="youFunction(this)" />' +
        '</div>' +
        '</div>';
        $('#video_section').append(video);
    });

    $("#payment_form").click(function () {

        var err = 0;
        $('.c_error').html('');
        var p_name = $('#p_name').val();
        var p_address = $('#p_address').val();
            //var p_city=$('#p_city').val();
            //var p_state=$('#p_state').val();
            //var p_zip=$('#p_zip').val();
            var p_credit_card = $('#p_credit_card').val();
            var p_exp_month = $('#p_exp_month').val();
            var p_exp_year = $('#p_exp_year').val();
            var p_csc = $('#p_csc').val();
            // if(p_name==''){
            //   $('#p_name_valid').html('Name is required');
            //   err=1;
            // }
            // if(p_address==''){
            //   $('#p_address_valid').html('Address is required');
            //   err=1;
            // }
            // if(p_city==''){
            //   $('#p_city_valid').html('City is required');
            //   err=1;
            // }
            // if(p_state==''){
            //   $('#p_state_valid').html('State is required');
            //   err=1;
            // }
            // if(p_zip==''){
            //   $('#p_zip_valid').html('Zip is required');
            //   err=1;
            // }
            // if(p_credit_card==''){
            //   $('#p_credit_card_valid').html('Credit Card is required');
            //   err=1;
            // }
            // if(p_exp_month==''){
            //   $('#p_exp_month_valid').html('Expiration month is required');
            //   err=1;
            // }
            // if(p_exp_year==''){
            //   $('#p_exp_year_valid').html('Expiration year is required');
            //   err=1;
            // }
            // if(p_csc==''){
            //   $('#p_csc_valid').html('Csc is required');
            //   err=1;
            // }
            if (err == 0) {
                $('#paytrace_payment').submit();
            }

        });


    $("#signing_amount_form").click(function () {
        var err = 0;
        $('.c_error').html('');

        var p_name = $('#p_name').val();
        var p_address = $('#p_address').val();
        var p_city = $('#p_city').val();
        var p_state = $('#p_state').val();
        var p_zip = $('#p_zip').val();
        var p_credit_card = $('#p_credit_card').val();
        var p_exp_month = $('#p_exp_month').val();
        var p_exp_year = $('#p_exp_year').val();
        var p_csc = $('#p_csc').val();


        if ($('#term_and_condition').is(":checked"))
        {

        } else {
            $('#t_and_c_valid').html('Term And Condition is required');
            err = 1;
        }

        if (p_name == '') {
            $('#p_name_valid').html('Name is required');
            err = 1;
        }
        if (p_address == '') {
            $('#p_address_valid').html('Address is required');
            err = 1;
        }
            // if(p_city==''){
            //   $('#p_city_valid').html('City is required');
            //   err=1;
            // }
            // if(p_state==''){
            //   $('#p_state_valid').html('State is required');
            //   err=1;
            // }
            if (p_zip == '') {
                $('#p_zip_valid').html('Zip Code is required');
                err = 1;
            }
            if (p_credit_card == '') {
                $('#p_credit_card_valid').html('Credit Card is required');
                err = 1;
            }
            if (p_exp_month == '') {
                $('#p_exp_month_valid').html('Expiration month is required');
                err = 1;
            }
            if (p_exp_year == '') {
                $('#p_exp_year_valid').html('Expiration year is required');
                err = 1;
            }
            if (p_csc == '') {
                $('#p_csc_valid').html('Cvv is required');
                err = 1;
            }

            // if(term_and_condition==''){
            //    $('#t_and_c_valid').html('term And condition is required');
            //    err=1;
            // }

            if (err == 0) {
                $('#paytrace_payment_for_signing_amount').submit();
            }

        });

        // $(".chosen").chosen();

    });

    function check_form(element) {
        var chk = checkRequire(element);
        if (chk == 0) {
            var target = (typeof element == 'object') ? $(element) : $('#' + element);
            target.submit();
        }
    }

    function on_submit(element) {
        var chk = checkRequire(element);
        if (chk == 0) {
            return true;
        } else {
            return false;
        }
    }

    function register_form() {
        var err = 0;
        $('.c_error').html('');
        var base_url = $('#base_url').val();
        var email = $('#email').val().trim();
        var fname = $('#fname').val().trim();
        var company_name = $('#company_name').val().trim();
        var pass = $('#password').val().trim();
        var c_pass = $('#cpassword').val().trim();
        var address1 = $('#address1').val().trim();
        var zipcode = $('#zipcode').val().trim();
        var country = $('#country').val().trim();
        var state = $('#state').val().trim();
        var city = $('#city').val().trim();
        var phone = $('#phone').val().trim();
        var mail_validation = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (email == '') {
            $('#email_valid').html('Email is required');
            err = 1;
        } else if (!(email.match(mail_validation))) {
            $('#email_valid').html('Email should be valid');
            err = 1;
        }

        if (fname == '') {
            $('#f_name_valid').html('Name is required');
            err = 1;
        }

        if (company_name == '') {
            $('#company_name_valid').html('Company name is required');
            err = 1;
        }

        if (pass == '' || c_pass == '') {
            if (pass == '') {
                $('#pass_valid').html('Password is required');
                err = 1;
            }
            if (c_pass == '') {
                $('#c_pass_valid').html('Repeat Password is required');
                err = 1;
            }

        } else if (pass.length < 8) {
            $('#pass_valid').html('Password should be atleast 8 characters');
            err = 1;
        } else if (c_pass != pass || pass != c_pass) {
            $('#pass_valid').html('Password and confirm password does not match');
            err = 1;
        }

        if (address1 == '') {
            $('#address_valid').html('Address is required');
            err = 1;
        }

        if (zipcode == '') {
            $('#zip_valid').html('Zip code is required');
            err = 1;
        }

        if (country == '') {
            $('#country_valid').html('Country is required');
            err = 1;
        }

        if (state == '') {
            $('#state_valid').html('State is required');
            err = 1;
        }

        if (city == '') {
            $('#city_valid').html('City is required');
            err = 1;
        }

        if (phone == '') {
            $('#phone_valid').html('Cell phone no. is required');
            err = 1;
        }

        if (err == 0) {
            $.ajax({
                method: 'post',
                url: base_url + 'user/sign_up',
                data: $("#Sign_up_form").serialize(),
            }).done(function (resp) {
                if (resp == 0) {
                    swal("Oops!", "Email already exist.", "info");
                } else {
                    $('#Sign_up_form')[0].reset();
                    swal("Congratulations!", "Registration successfully completed. Please check your email to verify your account.", "success");
                }
            });
        }
    }

    function profile_update() {
        var err = 0;
        $('.c_error').html('');
        var base_url = $('#base_url').val();
        var fname = $('#first_name').val();
        var company_name = $('#company_name').val();
        var address1 = $('#address1').val();
        var country = $('#country').val();
        var state = $('#state').val();
        var city = $('#city').val();
        var zipcode = $('#zipcode').val();
        var phone = $('#phone').val();
        var business_phone = $('#business_phone').val();

        if (fname == '') {
            $('#f_name_valid').html('Name is required');
            err = 1;
        }
        if (company_name == '') {
            $('#company_name_valid').html('Company name is required');
            err = 1;
        }
        if (address1 == '') {
            $('#address_valid').html('Address is required');
            err = 1;
        }
        if (zipcode == '') {
            $('#zip_valid').html('Zip code is required');
            err = 1;
        }
        if (country == '') {
            $('#country_valid').html('Country is required');
            err = 1;
        }
        if (state == '') {
            $('#state_valid').html('State is required');
            err = 1;
        }
        if (city == '') {
            $('#city_valid').html('City is required');
            err = 1;
        }
        if (phone == '') {
            $('#phone_valid').html('Cell phone no. is required');
            err = 1;
        }

        if (err == 0) {
            $(".loader").show();

            $.ajax({
                method: 'post',
                url: base_url + 'user/update_profile',
                data: $("#update_profile").serialize(),
            }).done(function (resp) {
                $(".loader").hide();
                if (resp == 1) {
                    swal("Success!", "Profile update successfully.", "success");


                } else {
                    swal("Oops!", "Something went wrong", "info");
                }
            });
        }
    }

    function reset_password() {
        var err = 0;
        $('.c_error').html('');
        var base_url = $('#base_url').val();
        var p_code = $('#p_code').val();
        var n_pass = $('#n_pass').val();
        var c_n_pass = $('#c_n_pass').val();

        if (n_pass == '') {
            $('#reset_pass_valid').html('New password is required.');
            err = 1;
        } else if (n_pass.length < 8) {
            $('#reset_pass_valid').html('New password should be atleast 8 characters.');
            err = 1;
        } else if (n_pass != c_n_pass || c_n_pass != n_pass) {
            $('#reset_c_pass_valid').html('New password and confirm password does not match.');
            err = 1;
        }
        if (err == 0) {
             $(".loader").show();
            $.ajax({
                method: 'post',
                url: base_url + 'user/update_password',
                data: {'p_code': p_code, 'n_pass': n_pass}
            }).done(function (resp) {
                 $(".loader").hide();
                if (resp == 0) {
                    swal("Oops!", "Something went wrong.", "info");
                } else {
                    window.location.href = base_url + "sign-in";
                    swal("Congratulations!", "Password updated successfully. You can login now.", "success");
                }
            });
        }
    }

    function forgot_password() {
        var err = 0;
        $('.c_error').html('');
        var base_url = $('#base_url').val();
        var mail_validation = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var f_email = $('#f_email').val();

        if (f_email == '') {
            $('#f_email_valid').html('Email is required');
            err = 1;
        } else if (!(f_email.match(mail_validation))) {
            $('#f_email_valid').html('Email should be valid');
            err = 1;
        }

        if (err == 0) {
            $.ajax({
                method: 'post',
                url: base_url + 'user/forgot_pass',
                data: {'f_email': f_email}
            }).done(function (resp) {
                if (resp == 0) {
                    swal("Oops!", "Invalid email", "info");
                } else {
                    $('#f_email').val('');
                    swal("Congratulations!", "Reset password link generated. Please check your email.", "success");
                }
            });
        }
    }

    function sign_in() {
        var err = 0;
        $('.c_error').html('');
        var base_url = $('#base_url').val();
        var mail_validation = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var email = $('#l_email').val();
        var password = $('#l_password').val();
        var remember = ($('#remember').is(':checked')) ? 1 : 0;
        if (email == '') {
            $('#l_email_valid').html('Please enter your email');
            err = 1;
        } else if (!(email.match(mail_validation))) {
            $('#l_email_valid').html('Email should be valid');
            err = 1;
        }

        if (password == '') {
            $('#l_pass_valid').html('Please enter your password');
            err = 1;
        }

        if (err == 0) {
            $.ajax({
                method: 'post',
                url: base_url + 'user/sign_in',
                data: {'email': email, 'password': password, 'remember': remember}
            }).done(function (resp) {
                console.log(resp);
                if (resp == true) {
                    if ($('#list_page').length) {
                        var slug = $('#list_page').val();
                        window.location = base_url + 'list-details/' + slug;
                    } else if ($('#home_like').length && $('#home_like').val() == 1) {
                        window.location = base_url;
                    } else if ($('#buy_like').length && $('#buy_like').val() == 1) {
                        window.location = base_url + 'buy';
                    } else {
                        window.location = base_url + 'buy';
                    }
                } else if (resp == 6) {
                    swal("Oops!", "Your accout blocked by Firearms Network.For unblock please contact to Firearms Network", "info");
                } else if (resp == 5) {
                    $("#signing_amount_modal").modal();
                    $('#user_email').val(email);
                    $('#user_pass').val(password);

                    //swal("Oops!", "Please pay signing amount to access your account.", "info");
                } else if (resp == 2) {
                    swal("Oops!", "Please verify your email.", "info");
                } else if (resp == 4) {
                    swal("Oops!", "Your account is inactive.Please contact to Firearms Network.", "info");
                } else {
                    swal("Oops!", "Credentials does not matched", "error");
                }
            });
        }
    }

    function change_password() {
        var err = 0;
        $('.c_error').html('');
        var base_url = $('#base_url').val();
        var old_password = $('#l_old_password').val();
        var new_password = $('#l_password').val();
        var c_password = $('#c_password').val();

        if (old_password == '') {
            $('#old_password_valid').html('Please enter your old password');
            err = 1;
        }

        if (new_password == '') {
            $('#new_password_valid').html('Please enter your new password');
            err = 1;
        }

        if (c_password == '') {
            $('#c_password_valid').html('Please enter your confirm password');
            err = 1;
        }

        // if(){

        //   $('#new_password_valid').html('Password should be atleast 8 characters');
        //   err=1;
        // }else{
        //   alert("not");
        // }


        if (new_password != '' && c_password != '' && c_password != new_password) {
            $('#match_password_valid').html('New password and Confirm password not matched');
            err = 1;
        } else if (new_password != '' && new_password.length < 8) {
            $('#match_password_valid').html('Password should be atleast 8 characters');
            err = 1;
        }

        if (err == 0) {
            $.ajax({
                method: 'post',
                url: base_url + 'user/new_password',
                data: {'old_password': old_password, 'new_password': new_password, 'c_password': c_password}
            }).done(function (resp) {

                if (resp == 'success') {

                    $('#l_old_password').val('');
                    $('#l_password').val('');
                    $('#c_password').val('');


                    swal("Success!", "Password updated successfully.", "success");
                } else if (resp == 'not_exist') {
                    $('#old_password_valid').text('Old password does not matched');
                    //swal("Oops!", "Old password does not matched", "error");
                } else {
                    swal("Oops!", "Some thing went wrong", "error");
                }
            });
        }
    }

    function readURL(input) {

        var a = (input.files[0].size);

        if (a > 1000000) {
            $('#image_not_valid_msg').html('Image size should be less then 1 MB');
        } else {
            $('#image_not_valid_msg').html('');
            var img_id = $(input).parent().parent().find('.display_section').attr('id');
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#' + img_id)
                    .attr('src', e.target.result)
                    .width('100%')
                    .height('auto');
                };

                reader.readAsDataURL(input.files[0]);
                $(input).parent().parent().find('.cancel_btn').css('display', 'block');
            }
        }

    }

    function a_readURL(input) {


        var a = (input.files[0].size);

        if (a > 1000000) {
            $('#image_not_valid_msg').html('Image size should be less then 1 MB');
        } else {
            $('#image_not_valid_msg').html('');
            var img_id = $(input).parent().parent().find('.a_display_section').attr('id');
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#' + img_id)
                    .attr('src', e.target.result)
                    .width('100%')
                    .height('auto');
                };

                reader.readAsDataURL(input.files[0]);
                $(input).parent().parent().find('.cancel_btn').css('display', 'block');
            }
        }



    }

    function youFunction(element) {
        var video_link = $(element).val();
        if (video_link.indexOf('watch?v=') != -1 && video_link.indexOf('&') != -1) {
            var value = video_link.replace("watch?v=", "embed/");
            var url = value.substring(0, value.indexOf("&"));
        } else if (video_link.indexOf('watch?v=') != -1) {
            var url = video_link.replace("watch?v=", "embed/");
        } else if (video_link.indexOf('youtu.be') != -1) {
            var url = video_link.replace("youtu.be", "www.youtube.com/embed");
        }
        $(element).parent().parent().find(".v_url").attr("src", url);
        $(element).parent().parent().find(".cancel_btn").css("display", 'block');
    }



    function form_first_validation() {
        var err = 0;
        $('.display_err').html('');
        var auction = $('#auction_id').val();
        // var list_manufacturer = $('#list_manufacturer').val();
        var manufacturer_validate = $('#manufacturer_validate').val();
        var list_manufacturer_text = $('#list_manufacturer :selected').text(); 

        var total_checked = $('.subcat_cls:checked').length;
        var manufacturer_list = $('#manufacturer_list').val();
        var model_list = $('#model_list').val();
        var caliber_list = $('#caliber_list').val();
        var barrel_length_list = $('#barrel_length_list').val();
        var capacity_list = $('#capacity_list').val();
        




        if (auction == 1) {    

            if(total_checked == 0){
                $('#manufacturer_valid').html('Please select category');err = 1;
            }
            if (manufacturer_validate == '1') {
                if (manufacturer_list == '') {
                    $('#manufacturer_list_valid').html('Please select manufacturer');err = 1;
                } 
                if (model_list == '') {
                    $('#model_list_valid').html('Please select model');err = 1;
                } 
                if (caliber_list == '') {
                    $('#caliber_list_valid').html('Please select caliber');err = 1;
                }   
            }   

            if (err == 1) {
                return false;
            } else {
                return true;
            }
        } else {   
            var str2 = "Other";
            if (list_manufacturer_text.indexOf(str2) != -1) {
                if ($('#other_manufacturer_name').val() == '') {
                    $('#other_manu_name_valid').html('Please enter manufacturer name');
                    err = 1;
                }
            }
            if (err == 1) {
                return false;
            } else {
                return true;
            }
        }
    }

    var Allcode = [];

    function add_state()
    {   
       $("#select_sale").text('');
       var code = $( "#state" ).val();
       if(jQuery.inArray( code,Allcode) == -1){

        Allcode.push(code);
        console.log(Allcode.length);
        if(code != ""){
            $("#show_state").text('');
            var state = $( "#state option:selected" ).text();
            var rnum = Math.floor(Math.random() * 20);
            
            $("#append_state").append('<div class="'+rnum+'">\
                <input type="hidden" name="codes[]" id="" value="'+code+'">\
                <div class="tax_rate_div col-md-4">\ '+code+': <input type="text" name="state_tax[]" id="tax_'+code+'" value=""> % include \
                </div>\
                <div class="form-area ship_form col-md-8 form_area_checkbox">\
                <span><a onclick="remove_input(\''+rnum+'\',\''+code+'\')">remove</a></span>\
                <span class="display_err" id="di_valid"></span>\
                <br>\
                </div>\
                </div>');
        }
        else{
            $("#show_state").text('Please select state.');
        }
    }
    else
    {
        $("#show_state").text('Please select different state.');
    }

    }

    function form_second_validation() {
        var err = 0;
        $('.display_err').html('');
        var auction = $('#auction_id').val();
        var days_duration = $('#duration_days').val();
        var starting_bid = $('#starting_bid').val();
        var reserve_price = $('#reserve_price').val();
        var buy_now_price = $('#buy_now_price').val();
        var overnight_fixed = $('#overnight_fixed').val();
        var secondday_fixed = $('#secondday_fixed').val();
        var thirdday_fixed = $('#thirdday_fixed').val();
        var ground_fixed = $('#ground_fixed').val();
        var etc_fixed = $('#etc_fixed').val();
        var ffl = $('#ffl').val();               

        var title = $('#title').val();
        var description = $('#description').val();
        var fixed_price = $('#fixed_price').val();
        var quantity = $('#quantity').val();

        var payment_method = document.getElementsByName('payment_method[]');
        var shipping_class = document.getElementsByName('shipping_class[]');

        var j = 0;
        for (var i = 0, n = payment_method.length; i < n; i++) {
            if (payment_method[i].checked) {
                j++;
            }
        }

        var k = 0;
        for (var i = 0, n = shipping_class.length; i < n; i++) {
            if (shipping_class[i].checked) {
                k++;
            }
        }

        
        var seller_tax = $( "#seller_tax" ).val();
        
        if(seller_tax == 1)
        {  
            var select_sale = $("#select_sale" ).text();     
            if(select_sale != "")
            {

                if(select_sale == "Please enter only numeric value.")
                {
                    $("#select_sale").text('Please enter only numeric value.');
                    err = 1;
                }
                else{
                    $("#select_sale").text('States must be specified.');
                    err = 1;
                }
                
            }
            if(Allcode.length >0)
            {
               for(var i=0; i<Allcode.length;i++)
               {
                var dy_id = $('#tax_'+Allcode[i]).val();
                //console.log(dy_id);
                if(isNaN(dy_id) || dy_id == "") 
                { 
                        //console.log('i am reached');
                        $("#di_valid").text('Please enter only numeric value.');
                        err = 1;

                    }
                    
                }
            }

            if ($('#co_id').length)
            {
             var co_id = $('#co_id').val();
             

             if(isNaN(co_id) || co_id == "") 
             { 
              
                $("#co_valid").text('Please enter only numeric value.');
                err = 1;

            }
        }
        
        if ($('#fm_id').length)
        {
         var fm_id = $('#fm_id').val();
         

         if(isNaN(fm_id) || fm_id == "") 
         { 
          
            $("#fm_valid").text('Please enter only numeric value.');
            err = 1;

        }
    }
    if ($('#hi_id').length)
    {
     var hi_id = $('#hi_id').val();
     

     if(isNaN(hi_id) || hi_id == "") 
     { 
      
        $("#hi_valid").text('Please enter only numeric value.');
        err = 1;

    }
    }



    }

    if ($(".cos1").is(':checked')){
        if (overnight_fixed == '') {
            $('#overnight_fixed_valid').html('Overnight must be a valid decimal no');
            err = 1;}}
            if ($(".cos2").is(':checked')){
                if (secondday_fixed == '') {
                    $('#secondday_fixed_valid').html('2nd day must be a valid decimal no');
                    err = 1;}}
                    if ($(".cos3").is(':checked')){
                        if (thirdday_fixed == '') {
                            $('#thirdday_fixed_valid').html('3rd day must be a valid decimal no');
                            err = 1;}}
                            if ($(".cos4").is(':checked')){
                                if (ground_fixed == '') {
                                    $('#ground_fixed_valid').html('Ground must be a valid decimal no');
                                    err = 1;}}
                                    if ($(".cos5").is(':checked')){
                                        if (etc_fixed == '') {
                                            $('#etc_fixed_valid').html('Etc must be a valid decimal no');
                                            err = 1;}}
                                            if (ffl == '') {
                                                $('#ffl_valid').html('Requires FFL is required ');
                                                err = 1;
                                            }        


                                            var relist_options = $("input[name='relist_options']:checked").val();
                                            var relist_time = $('#relist_time_after_sold').val();

                                            



                                            if (auction == 1) {
                                                if (title == '') {
                                                    $('#title_valid').html('Please enter the title');
                                                    err = 1;
                                                }
                                                if (description == '') {
                                                    $('#description_valid').html('Please enter description');
                                                    err = 1;
                                                }
           // if (terms_of_sale == '') {
             //   $('#terms_of_sale_valid').html('Please enter terms of sale');
    //err = 1;
            //}
            if (days_duration == '') {
                $('#duration_days_valid').html('Please enter days for duration of listing');
                err = 1;
            }


            if (starting_bid == '') {          
                $('#starting_bid_valid').html('Please enter starting bid price');            
                err = 1;
            }else{
                if(!$.isNumeric( $('#starting_bid').val()) )
                {
                    $('#starting_bid_valid').html('Starting bid must be a valid decimal no');            
                    err = 1;
                }
            }

            if (reserve_price != '' && reserve_price != 0.00 || reserve_price != 0) {
                if(!$.isNumeric( $('#reserve_price').val()) )
                {
                    $('#reserve_price_valid').html('Reserve price must be a valid decimal no');            
                    err = 1;
                }

                if (parseInt(reserve_price) < parseInt(starting_bid)) {
                    $('#price_compair_valid').html('Reserve price must be grether than starting bid');
                    err = 1;
                }

            }
            if (buy_now_price != '' && buy_now_price != 0.00 || buy_now_price != 0) {
                if(!$.isNumeric( $('#buy_now_price').val()) )
                {
                    $('#buy_price_valid').html('Buy now price must be a valid decimal no');            
                    err = 1;
                }

                if (reserve_price != '') {
                    if (parseInt(buy_now_price) < parseInt(reserve_price)) {
                        $('#price_compair_valid').html('Buy now price must be grether than Reserve price');
                        err = 1;
                    }
                } 
            }

            if (j == 0) {
                $('#payment_method_valid').html('Please check atleast one payment method');
                err = 1;
            }
            if (k == 0) {
                $('#shipping_class_valid').html('Please check atleast one shipping class');
                err = 1;
            }

            if (relist_options == 'Relist After Sold') {
                if (relist_time == '') {
                    $('#relist_time_valid').html('Please enter relist time');
                    err = 1;
                }
            }

            if (err == 1) {
                return false;
            } else {
                return true;
            }
        } else {
            if (title == '') {
                $('#title_valid').html('Please enter the title');
                err = 1;
            }
            if (description == '') {
                $('#description_valid').html('Please enter description');
                err = 1;
            }
            //if (terms_of_sale == '') {
             //   $('#terms_of_sale_valid').html('Please enter terms of sale');
              //  err = 1;
            //}
            if (days_duration == '') {
                $('#duration_days_valid').html('Please enter days for duration of listing');
                err = 1;
            }
            if (fixed_price == '') {
                $('#fixed_price_valid').html('Please enter fixed price');
                err = 1;
            }
            if (quantity == '') {
                $('#quantity_valid').html('Please enter quantity');
                err = 1;
            }
            if (j == 0) {
                $('#payment_method_valid').html('Please check atleast one payment method');
                err = 1;
            }
            if (k == 0) {
                $('#shipping_class_valid').html('Please check atleast one shipping class');
                err = 1;
            }

            if (err == 1) {
                return false;
            } else {
                return true;
            }

        }
    }

    function form_third_validation() {
        var err = 0;
        $('.display_err').html('');
        var auction = $('#auction_id').val();

        var exts = ['jpg', 'jpeg', 'png'];
        var primary_img = $('#file1').val();
        var primary_dimension = $("#file1")[0];
        var get_ext = primary_img.split('.');
        get_ext = get_ext.reverse();
        var img_sec = $('#file2').val();
        var second_dimension = $("#file2")[0];
        var get_ext1 = img_sec.split('.');
        get_ext1 = get_ext1.reverse();
        var img_third = $('#file3').val();
        var third_dimension = $("#file3")[0];
        var get_ext2 = img_third.split('.');
        get_ext2 = get_ext2.reverse();


        if (auction == 1) {
         
           
            if (primary_img != '') {
                if ($.inArray(get_ext[0].toLowerCase(), exts) == -1) {
                    $('#primary_img_valid').html('Primary image should be in Jpg,Jpeg or png format');
                    err = 1;
                }
            }
            if (img_sec != '') {
                if ($.inArray(get_ext1[0].toLowerCase(), exts) == -1) {
                    $('#sec_img_valid').html('Picture2 image should be in Jpg,Jpeg or png format');
                    err = 1;
                }
            }
            if (img_third != '') {
                if ($.inArray(get_ext2[0].toLowerCase(), exts) == -1) {
                    $('#third_img_valid').html('Picture3 image should be in Jpg,Jpeg or png format');
                    err = 1;
                }
            }

            if (err == 1) {
                return false;
            } else {
                return true;
            }
        } else {   
          
            if (primary_img != '') {
                if ($.inArray(get_ext[0].toLowerCase(), exts) == -1) {
                    $('#primary_img_valid').html('Primary image should be in Jpg,Jpeg or png format');
                    err = 1;
                }
            }
            if (img_sec != '') {
                if ($.inArray(get_ext1[0].toLowerCase(), exts) == -1) {
                    $('#sec_img_valid').html('Picture2 image should be in Jpg,Jpeg or png format');
                    err = 1;
                }
            }
            if (img_third != '') {
                if ($.inArray(get_ext2[0].toLowerCase(), exts) == -1) {
                    $('#third_img_valid').html('Picture3 image should be in Jpg,Jpeg or png format');
                    err = 1;
                }
            }
            if (err == 1) {
                return false;
            } else {
                return true;
            }
        }
    }

    function cancel_img(element) {
        $(element).parent().parent().find('.file_input').val('');
        $(element).parent().find('.display_section').attr('src', 'http://webhungers.com/firearms-new/assets/img/image_not_found.png');
        $(element).css('display', 'none');
    }

    function a_cancel_img(element) {
        $(element).parent().parent().remove();
    }

    function cancel_video(element) {
        $(element).parent().parent().find('.display_video').val('');
        $(element).parent().find('.v_url').attr('src', 'https://www.youtube.com/embed/22ljUGis8oE?rel=0');
        $(element).css('display', 'none');
    }

    function a_cancel_video(element) {
        $(element).parent().parent().remove();
    }

    function a_photo(element) {
        $(element).parent().find('input').trigger('click');
    }
    //14 March 2019 Js Starts
    function qty_validation(obj)
    {
        var maxlimit=parseInt($('#qty_available_num').text());
        var entered_val=parseInt($(obj).val());
        var thisid=$(obj).attr('id');
        if(entered_val==0 || entered_val>50 || entered_val > maxlimit)
        {
            $(obj).val(''); 
            $('.qtyerror').html('Please Enter Value between 1 and '+maxlimit);
            $('.buy_right_sec_out').addClass('disable_anchor');
        }
        else
        {
            $('.qtyerror').html('');
            $('.buy_right_sec_out').removeClass('disable_anchor');
        }

    }



    function remove_input(rnum,code)
    {
        
        $("."+rnum).remove();
        
        var index = Allcode.indexOf(code);
        
        if (index > -1) {
         Allcode.splice(index, 1);
         
         if(Allcode.length == 0)
         {
           console.log("i am empty");
           $("#select_sale").text('States must be specified.');
       }

    }
    } 

    var period = 0; 
    function remove_static_input(cl_name)
    {  
        period = period+1;
        //console.log(period);
        $("."+cl_name).remove();
        if(period>2)
        {
            
            $("#select_sale").text('States must be specified.');
        }
        var rm_check = $(".rm").hasClass("check");
        if(rm_check == false)
        {
            $("#select_sale").text('States must be specified.');
        }
       //console.log(cl_name);
    }

    function remove_dy_input(cl_name)
    {   
       $("."+cl_name).remove();
       var rm_check = $(".rm").hasClass("check");
       if(rm_check == false)
       {
        $("#select_sale").text('States must be specified.');
    }
    }

    function getSallestax(sel)
    {
        $(".hide_when_no").removeClass("hide");
        $(".hide_when_no_1").removeClass("hide");
        
        
        if(sel.value == 0)
        {
            
            $(".hide_when_no").hide();
            $(".hide_when_no_1").hide();
        }
        else
        {
            
            $(".hide_when_no").show();
            $(".hide_when_no_1").show();
        }
    }
    $(document).ready(function(){
       $('#shipping_1').change(function() {
        if(this.checked) {
           $("#shipping_1").val(1);
       }
       else
       {
        $("#shipping_1").val(0);
    }   

    });
    });
    $(document).ready(function(){
       $('#shipping_2').change(function() {
        if(this.checked) {
           $("#shipping_2").val(1);
       }
       else
       {
        $("#shipping_2").val(0);
    }   

    });
    });

    $(document).ready(function(){
       $('#shipping_3').change(function() {
        if(this.checked) {
           $("#shipping_3").val(1);
       }
       else
       {
        $("#shipping_3").val(0);
    }   

    });
    });

    $(document).ready(function(){
       $('#handling_1').change(function() {
        if(this.checked) {
           $("#handling_1").val(1);
       }
       else
       {
        $("#handling_1").val(0);
    }   

    });
    });

    $(document).ready(function(){
       $('#handling_2').change(function() {
        if(this.checked) {
           $("#handling_2").val(1);
       }
       else
       {
        $("#handling_2").val(0);
    }   

    });
    });

    $(document).ready(function(){
       $('#handling_3').change(function() {
        if(this.checked) {
           $("#handling_3").val(1);
       }
       else
       {
        $("#handling_3").val(0);
    }   

    });
    });

    $(document).ready(function(){
       $('#insurance_1').change(function() {
        if(this.checked) {
           $("#insurance_1").val(1);
       }
       else
       {
        $("#insurance_1").val(0);
    }   

    });
    });

    $(document).ready(function(){
       $('#insurance_2').change(function() {
        if(this.checked) {
           $("#insurance_2").val(1);
       }
       else
       {
        $("#insurance_2").val(0);
    }   

    });
    });

    $(document).ready(function(){
       $('#insurance_3').change(function() {
        if(this.checked) {
           $("#insurance_3").val(1);
       }
       else
       {
        $("#insurance_3").val(0);
    }   

    });
    });

    $(document).ready(function(){
       $('#misc_1').change(function() {
        if(this.checked) {
           $("#misc_1").val(1);
       }
       else
       {
        $("#misc_1").val(0);
    }   

    });
    });

    $(document).ready(function(){
       $('#misc_2').change(function() {
        if(this.checked) {
           $("#misc_2").val(1);
       }
       else
       {
        $("#misc_2").val(0);
    }   

    });
    });

    $(document).ready(function(){
       $('#misc_3').change(function() {
        if(this.checked) {
           $("#misc_3").val(1);
       }
       else
       {
        $("#misc_3").val(0);
    }   

    });
    });
    //14 March 2019 Js Ends
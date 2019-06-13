toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": true,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

jQuery(document).ready(function(){

	$('form input').keypress(function(event){
	    if(event.charCode == 13){
	       $(this).closest('form').parent().find('.btn_click').trigger('click');
	    }
	});

	$('.return_number').on('keypress',function(evt){
	    var charCode = (evt.which) ? evt.which : event.keyCode;
		    if (charCode > 31 && (charCode < 48 || charCode > 57)){
		     return false;
		    }else{
		     return true;
		    } 
	});
	
	jQuery(document).on("click", ".deleteUser", function(){
		var userId = $(this).data("userid"),
			hitURL = baseURL + "deleteUser",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this user ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			url : hitURL,
			data : { userId : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("User successfully deleted"); }
				else if(data.status = false) { alert("User deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});

	jQuery(document).on("click", ".deleteList", function(){
		var listId = $(this).data("id"),
			hitURL = baseURL + "deleteList",
			currentRow = $(this);

		//start	
  		swal({
	        title: "Are you sure?",
	        text: "Once deleted, you will not be able to recover!",
	        icon: "warning",
	        buttons: true,
	        dangerMode: true,
      	}).then((willDelete) => {
          if (willDelete) {
              	jQuery.ajax({
					method : 'post',
					url : hitURL,
					data : {'listId' : listId}
				}).done(function(data){
					 //console.log(data);
					 currentRow.parents('tr').remove();
					if(data.status = true) {
						swal("List successfully deleted!", { icon: "success",});
						}
					else if(data.status = false) { 
						swal("List deletion failed!", {
                        icon: "error",
                      }); }
					else { alert("Access denied..!"); }
				});
          	} else {
              	// swal("Student is safe!");
          	}
      	});
		//end

	});

	jQuery(document).on("click", ".deletebid_admin", function(){
		var bidid = $(this).data("id"),
			hitURL = baseURL + "listings/deletebid_admin",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Bid ?");
		
		if(confirmation)
		{
		 jQuery.ajax({
					method : 'post',
					url : hitURL,
					data : {'bidid' : bidid}
				}).done(function(data){
					 console.log(data);
					 currentRow.parents('tr').remove();
					if(data.status = true) { alert("Bid successfully deleted"); }
					else if(data.status = false) { alert("Bid deletion failed"); }
					else {  }
				}); 
		}
	});

	jQuery(document).on("click", ".reList", function(){
		var base_url = $('#base_url').val();
		var listId = $(this).data("id"),
			hitURL = baseURL + "relist";
		

		swal({
	        text: "Are you sure to relist this listing!",
	        icon: "warning",
	        buttons: true,
	        dangerMode: true,
      	}).then((willDelete) => {
          if (willDelete) {
              	jQuery.ajax({
					method : 'post',
					url : hitURL,
					data : {'listId' : listId}
				}).done(function(data){
					 if(data==1){
					 	window.location.href=base_url+"allListings";
					 }else{
					 	 toastr.error('Something went wrong.','Error'); 
					 }
				}); 
          	} else {
              	// swal("Student is safe!");
          	}
      	});

		
	});

	jQuery(document).on("click", ".deleteBid", function(){
		var bidId = $(this).data("id"),
			hitURL = baseURL + "deleteBid",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this bid ?");
		
		if(confirmation)
		{
		 jQuery.ajax({
					method : 'post',
					url : hitURL,
					data : {'bidId' : bidId}
				}).done(function(data){
					 //console.log(data);
					currentRow.parents('tr').remove();
					if(data.status = true) { alert("Bid successfully deleted"); }
					else if(data.status = false) { alert("Bid deletion failed"); }
					else { alert("Access denied..!"); }
				}); 
		}
	});
	
});


function check_form(element){
	
  var chk = checkRequire(element);
  if(chk == 0){
    var target = (typeof element == 'object')? $(element):$('#'+element);
    target.submit();
  }
}

function on_submit(element){
  var chk = checkRequire(element);
  if(chk == 0){
    return true;
  }else{
    return false;
  }
}

function categories(element){
  var valid_frm = on_submit('m_category');
  if(valid_frm==true){
  	var base_url = $('#base_url').val();
            $.ajax({
                method : 'post',
                url : base_url+'user/add_category',
                data : $("#m_category").serialize(),
            }).done(function(resp){
            	if(resp==0){
                  toastr.error('Something went wrong.','Error'); 
                }else{
                  window.location.href=base_url+"manageCategories";
                }
              });
  }
}

function edit_categories(element){
  var valid_frm = on_submit('m_category');
  if(valid_frm==true){
  	var base_url = $('#base_url').val();
            $.ajax({
                method : 'post',
                url : base_url+'user/edit_category',
                data : $("#m_category").serialize(),
            }).done(function(resp){
            	if(resp==0){
                  toastr.error('Something went wrong.','Error'); 
                }else{
                  window.location.href=base_url+"manageCategories";
                }
              });
  }
}

function deleteCategory(element){
	var base_url = $('#base_url').val();
	var cat_id=$(element).closest('tr').attr('id');
	var current=$(element).closest('tr');
	var confirmation = confirm("Are you sure to delete this category ?");	
	if(confirmation)
		{
			$.ajax({
                method : 'post',
                url : base_url+'user/delete_category',
                data : {'cat_id' : cat_id}
            }).done(function(resp){
            	if(resp==1){
            		toastr.error('This category is having the listing. You cannot delete it.','Error'); 	
            	}else if(resp==2){
            		toastr.error('The subcategories of this category is having the listing. You cannot delete it.','Error'); 	
            	}else if(resp==3){
            		subcate_not_listing(cat_id);
            	}else if(resp==4){
            		current.remove();
            		toastr.success('Category deleted successfully.','Success');
            	}
              });
		}
}

function deleteManufacturer(element){
	var base_url = $('#base_url').val();
	var manufacturer_id=$(element).closest('tr').attr('id');
	var current=$(element).closest('tr');
	var confirmation = confirm("Are you sure to delete this category ?");	
	if(confirmation)
		{
			$.ajax({
                method : 'post',
                url : base_url+'user/delete_manufacturer',
                data : {'manufacturer_id' : manufacturer_id}
            }).done(function(resp){
            	if(resp==1){
            		toastr.error('This manufacturer is having the listing. You cannot delete it.','Error'); 	
            	}else if(resp==2){
            		current.remove();
            		toastr.success('Item deleted successfully.','Success');
            	}
              });
		}
}

function add_manufacturer(element){
	
  		var valid_frm = on_submit('manufacturer');
  	if(valid_frm==true){

  		var base_url = $('#base_url').val(); 
  		var mange_sub_id = parseInt($('#mange_sub_id').val());
  		var manufacturer_name = $('#manufacturer_name').val();  		
  		var subcat_status = $('input[name=subcat_status]:checked').val();

  		if (mange_sub_id==1) {
  			var sub_cat = $('#parent_cat').val();
  		}else{
  			var mange_sub_id = mange_sub_id-1;
  			var sub_cat = $('#sub_cat_'+mange_sub_id).val();
  		}
  		// alert('#sub_cat_'+mange_sub_id);
  		// alert(sub_cat);


  	
        $.ajax({
            method : 'post',
            url : base_url+'user/submit_manufacturer',
           
            data : {'manufacturer_name' : manufacturer_name,'subcat_status' : subcat_status,'sub_cat' : sub_cat},
        }).done(function(resp){
        	//alert(resp);
        	if(resp==0){
              toastr.error('Something went wrong.','Error'); 
            }else{
            	toastr.success('Manufacturer Added Successfully.','success'); 
            	document.getElementById("manufacturer").reset();
              //window.location.href=base_url+"addmanufacturer";
            }
       });
  	}
}

function subcate_not_listing(cat_id){
	var base_url = $('#base_url').val();
	var confirmation = confirm("If you delete this category the subcategory of this category will become the subcategories of previous category?");	
	if(confirmation)
		{
			$.ajax({
                method : 'post',
                url : base_url+'user/subcate_not_listing',
                data : {'cat_id' : cat_id}
            }).done(function(resp){
            	if(resp==1){
            		location.reload();
            	}else{
            		toastr.error('Something went wrong.','Error');
            	}
              });
		}
}

function block_status(element){
	var base_url = $('#base_url').val();
	var user_id = $(element).closest('tr').attr('id');
	var current = $(element).closest('tr');
	var block_value = $('#block_value').val();
		var select_value = $(element).val();

			$.ajax({
                method : 'post',
                url : base_url+'user/block_status',
                data : {'user_id' : user_id , 'block_value' : select_value}
            }).done(function(resp){

            	if(resp==1){
            		toastr.success('User status updated successfully.','Success');
            	}else{
            		toastr.error('User status not updated.','Error');
            	}
              });
}

function selectall(element) {
	var chk_value=($(element).is(':checked'))?1:0;
		$('.list_idd').each(function(){
			if(chk_value=='1'){
				$(this).prop('checked',true);
			}else{
				$(this).prop('checked',false);
			}	
		});
}
function selectallbid(element) {
	var chk_value=($(element).is(':checked'))?1:0;
		$('.bid_id').each(function(){
			if(chk_value=='1'){
				$(this).prop('checked',true);
			}else{
				$(this).prop('checked',false);
			}	
		});
}

function delete_lists(){
	var base_url = $('#base_url').val();
	var l_id=[];
	$('.list_idd').each(function(){
		var all_id=($(this).is(':checked'))?1:0;
		if(all_id==1){
			var current_id=$(this).val();  
			l_id.push(current_id);
		}
	})
	if (l_id.length === 0) {
    	toastr.error('Please select list(s).','Error');
	}else{
		var confirmation = confirm("Are you sure to delete this listing(s)?");	
		if(confirmation){
			$.ajax({
		        method : 'post',
		        url : base_url+'listings/delete_b_list',
		        data : {'list_id' : JSON.stringify(l_id)}
		    }).done(function(resp){
		    	if(resp==1){
		    		window.location.href=base_url+"allListings";
		    	}else{
		    		toastr.error('List(s) not deleted.','Error');
		    	}
		      });
			}
	}
}

function relist_lists(){
	var base_url = $('#base_url').val();
	
	$('.list_idd').each(function(){
		var all_id=($(this).is(':checked'))?1:0;
		if(all_id==1){
			var current_id=$(this).val();  
			l_id.push(current_id);
		}
	})
	if (l_id.length === 0) {
    	toastr.error('Please select list(s).','Error');
	}else{
		var confirmation = confirm("Are you sure to relist this listing(s)?");
		if(confirmation){
			$.ajax({
		        method : 'post',
		        url : base_url+'listings/relist_b_list',
		        data : {'list_id' : JSON.stringify(l_id)}
		    }).done(function(resp){
		    	// if(resp==1){
		    	// 	window.location.href=base_url+"allListings";
		    	// }else{
		    	// 	toastr.error('List(s) not relisted.','Error');
		    	// }
		      });
		}
	}
}

function delete_all_bids(){
	var base_url = $('#base_url').val();
	var l_id=[];
	$('.bid_id').each(function(){
		var all_id=($(this).is(':checked'))?1:0;
		if(all_id==1){
			var current_id=$(this).val();  
			l_id.push(current_id);
		}
	})
	if (l_id.length === 0) {
    	toastr.error('Please select bid(s).','Error');
	}else{

		var confirmation = confirm("Are you sure to delete this bid(s)?");	
		if(confirmation){
			$.ajax({
		        method : 'post',
		        url : base_url+'listings/delete_all_bid',
		        data : {'bid_id' : JSON.stringify(l_id)}
		    }).done(function(resp){
		    	if(resp==1){
		    		window.location.href=base_url+"allBids";
		    	}else{
		    		toastr.error('bid(s) not deleted.','Error');
		    	}
		      });
			}
	}
}

function more_video(id){
	var base_url = $('#base_url').val();
	$.ajax({
        method : 'post',
        url : base_url+'listings/load_more_videos',
        data : {'id' : id}
    }).done(function(resp){
    	var result = jQuery.parseJSON(resp);
	    	$('.append_more_content').append(result.html);
	    	if(typeof result.html_btn != 'undefined'){
			    $('.replace_more_btn').html(result.html_btn);
			}else{
				$('.replace_more_btn').hide();
			}
      });
}

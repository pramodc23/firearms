function checkRequire(element){
	var email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;	 
	/* var url = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/; */
	var url = /(http|ftp|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&amp;:/~\+#]*[\w\-\@?^=%&amp;/~\+#])?/;
	var image = /\.(jpe?g|gif|png|PNG|JPE?G)$/;
	var mobile = /^[\s()+-]*([0-9][\s()+-]*){6,20}$/;
	var facebook = /^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/;
	var twitter = /^(https?:\/\/)?(www\.)?twitter.com\/[a-zA-Z0-9(\.\?)?]/;
	var google_plus = /^(https?:\/\/)?(www\.)?plus.google.com\/[a-zA-Z0-9(\.\?)?]/;
	var check = 0;
	var target = (typeof element == 'object')? $(element):$('#'+element);
	target.find('input , textarea , select').each(function(){
		if($(this).hasClass('require')){
			if($(this).val().trim() == ''){
				check = 1;
				toastr.error('You missed out some fields.','Error');
				$(this).addClass('error');
				$(this).focus();
				return false; 
			}else{
				$(this).removeClass('error');
			} 
		}   
		
		
		if($(this).val() != ''){
			var valid = $(this).attr('data-valid'); 
			if(typeof valid != 'undefined'){
				if(!eval(valid).test($(this).val().trim())){
					toastr.error($(this).attr('data-error'),'Error');
					$(this).addClass('error');	
					check = 1;
					$(this).focus();
					return false; 
				}else{
					$(this).removeClass('error'); 
				}
			}
		}
	});
	return check;
}
<!-- contact us start -->
<style type="text/css">
    .c_error{
        color:red;
        margin-top:5px;
        display:block;
    }
    .swal-text{text-align: center;}

</style>
<section id="contact_page">
	<div class="container">
		<div class="row">
			<div class="col-md-12 outer-page-head">
				<div class="col-md-5 divider"></div>
				<div class="col-md-2 divider_head">Contact us</div>
				<div class="col-md-5 divider"></div>
			</div>
		</div>
	</div>
<main class="full-width-section">
<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-8 contact-form-new">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Submit a request</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form name="contact_us" id="contactusForm" enctype="multipart/form-data"  method="post">
			    			<div class="form-group">
			    				<label class='control-label'>Please choose your issue below<span>*</span></label>
			    				<select id="selectbasic" name="selectbasic" class="form-control" >
			    					<option value="">choose a subject below</option>
			    					<option value="1 Needs help of 1 person">1 Needs help of 1 person</option>
			    					<option value="0 Needs help of 2+ people">0 Needs help of 2+ people</option>
			    				</select>
			    				<span class="c_error" id="selectbasic_valid"></span>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<label class='control-label'>your email address<span>*</span></label>
			    						<input type="email" name="email" id="email" class="form-control input-sm">
			    						<span class="c_error" id="email_valid"></span>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<label class='control-label'>Subject<span>*</span></label>
			    						<input type="text" name="subject" id="subject" class="form-control input-sm">
			    						<span class="c_error" id="subject_valid"></span>
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<label class='control-label'>Description<span>*</span></label>
			    				<textarea class="form-control" type="textarea" id="message" name="message" maxlength="140" rows="7"></textarea>
			    				<span class="c_error" id="Description_valid"></span>
			    				<p class="para01">Please enter the details of your request. A member of our support staff will respond as soon as possible.</p>
			    			</div>


			    			<div class="form-group">

			    				<label class='control-label'>attachment</label>
			    				<span class="upload-section form-control input-sm">
			    				<input type="file" name="userfile" class="upload-box" id="userfile" accept=".png,.PNG,.jpg,.JPG,.jpeg,.JPEG"></span>
			    				<span class="c_error" id="userfile_valid"></span>
                           
                            </div>
			    				

			    			

			    			<button type="button" class="btn btn-warning " style="margin-top: 15px;border-radius: 5px;" onclick="contact_us1();">Update</button>
			    		</form>


  
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
</main>
</section>


<script type="text/javascript">
  
function contact_us1(){
 	var err = 0;
    $('.c_error').html('');

    var base_url = $('#base_url').val();
    var selectbasic =$('#selectbasic').val();
    var email = $('#email').val().trim(); 
    var subject = $('#subject').val().trim(); 

    var message = $('#message').val().trim();
  
    var image = $('#userfile1').val();


    var mail_validation = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(email==''){
       $('#email_valid').html('Email is required');err=1;
    }else if(!(email.match(mail_validation))){
       $('#email_valid').html('Please enter valid contact email');err=1;
    }else{
        $('#email_valid').html('');
    }

 if(selectbasic==''){$('#selectbasic_valid').html('Select basic is required');err=1;} 
    if(subject==''){$('#subject_valid').html('Subject is required');err=1;} 
    if(message==''){$('#Description_valid').html('Description is required');err=1;}
     if(image==''){$('#userfile_valid').html('userfile  is required');err=1;}
    

     if(err==0){

  
    $('#contactusForm').on('submit',(function(e) {
      	$(".loader").show();
        e.preventDefault();
        var formData = new FormData(this);
        var base_url = $('#base_url').val(); 
     
        $.ajax({
            type:'POST',
            url: base_url+'home/contact_us_submit',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
             	 $(".loader").hide();
                swal("Success!", "Thanks for submitting enquiry. We will get back to you soon.", "success");
                $('#contactusForm').trigger("reset");

            },
            error: function(data){
               swal("Opps!", "something went wrong.", "error");
            }
        });
    }));
     	   	$("#contactusForm").submit();
	}  

}
</script>
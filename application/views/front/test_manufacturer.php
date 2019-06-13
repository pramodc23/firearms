<!DOCTYPE html>
<html>
   <head>
    <title>Codeigniter Dependent Dropdown Example with demo</title>
<link href="https://webhungers.com/firearms-new-dev/assets/css/bootstrap.css?v=5" rel="stylesheet" type="text/css">
<script src="https://webhungers.com/firearms-new-dev/assets/js/jquery-1.11.1.min.js" type="text/javascript"></script>
</head>
    <body>
        <div class="container">
    <div class="panel panel-default">
      <div class="panel-body">
          <div class="form-group">
              <input type="hidden" name="base_url" value="<?php echo base_url();?>" id="base_url">
          </div>
            <div class="form-group">
                <label for="title">Select Category:</label>
                <select name="category" class="form-control">
                    <option value="">Select Category</option>
                    <?php
                        if(!empty($categories)){
                            foreach ($categories as $key => $value) {
                                echo "<option value='".$value->id."'>".$value->name."</option>";
                            }
                        }else{
                            echo '<option value="">Category not available</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="title">Select Manufacturer:</label>
                <select name="manufacturer" class="form-control">
                </select>
            </div>


      </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
        $('select[name="category"]').on('change', function() {
            var categoryId = $(this).val();
            var base_url = $('#base_url').val();
            alert(categoryId);
            if(categoryId) {
                $.ajax({
                    url:  base_url+'test/getmanufacturer/'+categoryId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      
                        $('select[name="manufacturer"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="manufacturer"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="manufacturer"]').empty();
            }
        });
    });
</script>

    </body>
</html>


    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Firearms.network</b> Admin Panel
        </div>
        <strong>Copyright &copy; 2017-<?php echo date('Y');?> Firearms.network</strong> All rights reserved worldwide.
    </footer>
    
    <!-- jQuery UI 1.11.2 -->
    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <!-- DataTable -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <!-- DataTable -->
    <!-- Owl Carousel -->
    <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
    <!-- Owl Carousel -->
    <script src="<?php echo base_url(); ?>assets/js/toastr.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/valid.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js?1.23" charset="utf-8"></script>
    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');
    </script>

    <script>
    $(document).ready(function(){
     $('.owl-carousel').owlCarousel({
        loop: true,
        autoplay: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
          0: {
            items: 1,
            nav: true
          },
          600: {
            items: 3,
            nav: false
          },
          1000: {
            items: 5,
            nav: true,
            loop: false,
            margin: 20
          }
        }
     });
    });
    </script>

    <?php 
  
    if($this->session->flashdata('notice') != ''){
    echo '<script>toastr.warning("'.$this->session->flashdata('notice').'","Notice");</script>';
    }
    
    if($this->session->flashdata('error') != ''){
    echo '<script>toastr.error("'.$this->session->flashdata('error').'","Error");</script>';
    }
    
    if($this->session->flashdata('success') != ''){
    echo '<script>toastr.success("'.$this->session->flashdata('success').'","Success");</script>';
    }
  ?>
  </body>
</html>
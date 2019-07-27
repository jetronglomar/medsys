<!DOCTYPE html>
<html lang="en">
<?php
  $this->load->view('includes/head');
?>

<!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" /> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/css/daterangepicker.css" />
<link href="<?php echo base_url();?>resources/css/select2.min.css" rel="stylesheet" />

<script>


</script>

<body class="nav-sm">
    <div class="container body">
        <div class="main_container">
            <?php
        $this->load->view('includes/side-bar');
      ?>


            <!-- top navigation -->
            <?php
          $this->load->view('includes/top-nav');
        ?>
            <!-- /top navigation -->

            <style>
                .title-stats {
                    font-size: 30px !important;
                }
            </style>

            <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <!-- Content Here -->
                <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Nurse Actitivities</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="list-unstyled timeline">
                    <?php foreach($NurseActivity as $row){ ?>
                            <li>
                            <div class="block">
                                <div class="tags">
                                <a href="" class="tag">
                                    <span>Activity</span>
                                </a>
                                </div>
                                <div class="block_content">
                                <h2 class="title">
                                                <a><?php echo $row->ActivityDetails; ?></a>
                                            </h2>
                                <div class="byline">
                                    <span id="testdate"><?php echo date('m-d-y h:i a', strtotime($row->DateCreated)) ?></span> by <a><?php echo $row->Name; ?></a>
                                </div>
                                
                                </div>
                            </div>
                            </li>
                    <?php } ?>
                    
                  </ul>

                </div>
              </div>
            </div>
                </div>

                <!-- Content End -->
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <?php $this->load->view('includes/footer'); ?>
            <!-- /footer content -->
        </div>
    </div>

    <?php $this->load->view('includes/scripts'); ?>
    <script src="<?php echo base_url();?>resources/js/sweetalert2@8.js"></script>
    <script src="<?php echo base_url();?>resources/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>resources/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>resources/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>resources/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>resources/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>resources/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>resources/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>resources/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>resources/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url();?>resources/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url();?>resources/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url();?>resources/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>





</body>

</html>
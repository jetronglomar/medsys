<!DOCTYPE html>
<html lang="en">
<?php
  $this->load->view('includes/head');
?>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

  <body class="nav-md">
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
            font-size:30px !important;
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
                    <h2>Patient Engagement Form</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form action="<?php echo base_url();?>patient/saveEngagement/0" class="form-horizontal form-label-left" method="post">

                       <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="occupation">Patient Name</label>
                                <select class="ronselect form-control col-md-7 col-xs-12" id="PatientId" name="Patient" required="required" disabled>
                                    <option value="">---Search Patient Name---</option>
                                    <?php 
                                        foreach($Patient as $row){
                                          if($PatientDetails['Id'] == $row->Id){
                                            echo "<option value='".$row->Id."' selected>".$row->LastName.", ".$row->FirstName." ".$row->MiddleName."</option>";
                                          }
                                          else{
                                            echo "<option value='".$row->Id."'>".$row->LastName.", ".$row->FirstName." ".$row->MiddleName."</option>";
                                          }
                                        }
                                    ?>                                       
                                </select>
                                <input type="text" name="PatientId" value="<?php echo $Id; ?>" hidden/>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label for="occupation">Purpose</label>
                                    <select class="ronselect form-control col-md-7 col-xs-12" id="PurposeId" name="PurposeId" required="required">
                                        <option value=""> ---Select Engagement Purpose---</option>
                                        <?php 
                                            foreach($Purpose as $row){
                                                echo "<option value='".$row->Id."'>".$row->Description."</option>";
                                            }
                                        ?>         
                                    </select>
                            </div>
                        </div>


                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12" hidden>
                                <label for="occupation">Patient Type</label>
                                <select class="ronselect form-control col-md-7 col-xs-12" id="PatientType" name="PatientType" required="required">
                                    <option value=""> ---Select Patient Type---</option>
                                    <option value="1">Outpatient</option>
                                    <option value="2" selected>Inpatient</option>
                                </select>
                            </div>

                            <div id="roomDiv" class="col-md-6 col-sm-6 col-xs-12">
                                <label for="occupation">Room</label>
                                <select class="ronselect form-control col-md-7 col-xs-12" id="RoomId" name="RoomId">
                                    <option value=""> ---Search Room---</option>
                                     <?php 
                                            foreach($Room as $row){
                                                echo "<option value='".$row->Id."'>".$row->Description."</option>";
                                            }
                                        ?>   
                                </select>
                            </div>
                        </div>                    

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">Proceed</button>
                          <a href="<?php echo base_url()?>patient/detail/<?php echo $Id; ?>" class="btn btn-info">Cancel</a>
                        </div>
                      </div>
                    </form>
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
          
     
      <script src="<?php echo base_url();?>resources/vendors/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap -->
      <script src="<?php echo base_url();?>resources/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- FastClick -->
      <script src="<?php echo base_url();?>resources/vendors/fastclick/lib/fastclick.js"></script>
      <!-- NProgress -->
      <script src="<?php echo base_url();?>resources/vendors/nprogress/nprogress.js"></script>
      <!-- bootstrap-progressbar -->
      <script src="<?php echo base_url();?>resources/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
      <!-- iCheck -->
      <script src="<?php echo base_url();?>resources/vendors/iCheck/icheck.min.js"></script>
      <!-- bootstrap-daterangepicker -->
      <script src="<?php echo base_url();?>resources/vendors/moment/min/moment.min.js"></script>
      <script src="<?php echo base_url();?>resources/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
      <!-- bootstrap-wysiwyg -->
      <script src="<?php echo base_url();?>resources/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
      <script src="<?php echo base_url();?>resources/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
      <script src="<?php echo base_url();?>resources/vendors/google-code-prettify/src/prettify.js"></script>
      <!-- jQuery Tags Input -->
      <script src="<?php echo base_url();?>resources/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
      <!-- Switchery -->
      <script src="<?php echo base_url();?>resources/vendors/switchery/dist/switchery.min.js"></script>
      <!-- Parsley -->
      <script src="<?php echo base_url();?>resources/vendors/parsleyjs/dist/parsley.min.js"></script>
      <!-- Autosize -->
      <script src="<?php echo base_url();?>resources/vendors/autosize/dist/autosize.min.js"></script>
      <!-- jQuery autocomplete -->
      <script src="<?php echo base_url();?>resources/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
      <!-- starrr -->
      <script src="<?php echo base_url();?>resources/vendors/starrr/dist/starrr.js"></script>
      <!-- Custom Theme Scripts -->
      <script src="<?php echo base_url();?>resources/build/js/custom.js"></script>
    <!-- insert scripts here -->

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    
    <script>
            $(document).ready(function() {
                $('.ronselect').select2();

                $('#CityVillage').select2();
            });
    $(document).ready(function (){
        $('#PatientType').on('change', function() {
            if(this.value == 2){
                $('#roomDiv').show();
                $('#RoomId').prop('required',true);
            }
            else{
                $('#roomDiv').hide();
                $('#RoomId').prop('required',false);
            }
        });

    });

    </script>
    
	
  </body>
</html>

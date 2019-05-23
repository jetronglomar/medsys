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
                    <h2>Patient Details</h2>
                    <div class="pull-right">
                        <a href="<?php echo base_url(); ?>patient/register/0" class="btn btn-primary btn-md pull-right"></a>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form action="<?php echo base_url();?>patient/savePatient/<?php echo $PatientDetails['Id']; ?>" class="form-horizontal form-label-left" novalidate="" method="post">

                        <div class="item form-group">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="occupation">First Name<span class="required">*</span></label>
                                <input id="FirstName" type="text" name="FirstName" class="optional form-control col-md-7 col-xs-12" value="<?php if($PatientDetails['FirstName']) echo $PatientDetails['FirstName']; ?>" required="required" placeholder="Enter First Name" readonly>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="occupation">Middle Name</label>
                                <input id="MiddleName" type="text" name="MiddleName" value="<?php if($PatientDetails['MiddleName']) echo $PatientDetails['MiddleName']; ?>" class="optional form-control col-md-7 col-xs-12" placeholder="Enter Middle Name" readonly>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="occupation">Last Name<span class="required">*</span></label>
                                <input id="LastName" type="text" name="LastName" class="optional form-control col-md-7 col-xs-12" value="<?php if($PatientDetails['LastName']) echo $PatientDetails['LastName']; ?>" required="required" placeholder="Enter Last Name" readonly>
                            </div>
                        </div>


                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="website">Birthday <span class="required">*</span></label>
                            <input type="text" id="Birthday" name="Birthday" value="<?php if($PatientDetails['Birthday']) echo date("m/d/Y", strtotime($PatientDetails['Birthday'])); ?>" required="required" class="form-control col-md-7 col-xs-12" readonly>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="website">Gender <span class="required">*</span></label>
                                <br/>
                                <label>
                                <input type="radio" name="Gender" value="1" <?php if($PatientDetails['Gender']==1) echo "checked"; ?> disabled> &nbsp; Male &nbsp;
                                </label>
                                <label>
                                <input type="radio" name="Gender" value="2" <?php if($PatientDetails['Gender']==2) echo "checked"; ?> disabled> Female
                                </label>
                            </div>
                        
                        </div>

                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="textarea">Address 1<span class="required">*</span></label>
                                <textarea id="textarea"  name="Address1" class="form-control col-md-7 col-xs-12" placeholder="Enter Address Details" readonly><?php if($PatientDetails['Address1']) echo $PatientDetails['Address1']; ?></textarea>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="textarea">Address 2<span class="required"></span></label>
                                <textarea id="textarea" name="Address2" class="form-control col-md-7 col-xs-12" placeholder="Enter Address Details" readonly><?php if($PatientDetails['Address1']) echo $PatientDetails['Address2']; ?></textarea>
                            </div>
                        </div>

                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="occupation">City/Village</label>
                                <select class="ronselect form-control col-md-7 col-xs-12" id="CityVillage" name="CityVillage" required="required" disabled>
                                    <option value="">---Select City or Village---</option>
                                    <?php 
                                        foreach($Cities as $row){
                                            if($PatientDetails['CityVillage'] == $row->id)
                                                echo "<option value='".$row->id."' selected>".$row->citymunDesc."</option>";
                                            else
                                                echo "<option value='".$row->id."'>".$row->citymunDesc."</option>";
                                        }
                                    ?>                                       
                                </select>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="occupation">State/Province</label>
                                <select class="ronselect form-control col-md-7 col-xs-12" id="StateProvince" name="StateProvince" required="required" disabled>
                                    <option value="">---Select City or Province---</option>
                                    <?php 
                                        foreach($Provinces as $row){
                                            if($PatientDetails['StateProvince'] == $row->id)
                                                echo "<option value='".$row->id."' selected>".$row->provDesc."</option>";
                                            else
                                            echo "<option value='".$row->id."'>".$row->provDesc."</option>";
                                        }
                                    ?>                              
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="occupation">Country</label>
                                <select class="ronselect form-control select2 col-md-7 col-xs-12" id="Country" name="Country" required="required" disabled>
                                    <option value="">---Select Country---</option>
                                    <?php 
                                        foreach($Countries as $row){
                                            if($PatientDetails['Country'] == $row->id)
                                                echo "<option value='".$row->id."' selected>".$row->country_name."</option>";
                                            else
                                                echo "<option value='".$row->id."'>".$row->country_name."</option>";
                                        }
                                    ?>                           
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="occupation">Postal Code</label>
                                <input id="PostalCode" type="text" name="PostalCode" value="<?php if($PatientDetails['PostalCode']) echo $PatientDetails['PostalCode']; ?>" class="optional form-control col-md-7 col-xs-12" placeholder="Enter Postal Code" readonly>
                            </div>
                        </div>

                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="occupation">Cellphone Number<span class="required">*</span></label>
                                <input id="PhoneNumber" type="text" name="PhoneNumber" value="<?php if($PatientDetails['PhoneNumber']) echo $PatientDetails['PhoneNumber']; ?>" class="optional form-control col-md-7 col-xs-12" required="required" placeholder="Enter Cellphone Number" readonly>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="occupation">Tel. Number</label>
                                <input id="CellPhoneNumber" type="text" name="CellPhoneNumber" value="<?php if($PatientDetails['CellPhoneNumber']) echo $PatientDetails['CellPhoneNumber']; ?>" class="optional form-control col-md-7 col-xs-12" placeholder="Enter Telephone Number" readonly>
                            </div>
                        </div>

                      <div class="ln_solid"></div>
                      <div class="col-md-6 col-md-offset-3">
                          <a href="<?php echo base_url() ?>patient" class="btn btn-primary">Get Back</a>
                        </div>
                      <!-- <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div> -->
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
      
    <!-- insert scripts here -->

    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script src="<?php echo base_url();?>resources/build/js/custom.js"></script>
    <script>
            $(document).ready(function() {
                $('.ronselect').select2();

                $('#CityVillage').select2();
            });
    </script>
    
    <script>
        $(function() {
            $('input[name="Birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true
            });
        });
    </script>
	
  </body>
</html>

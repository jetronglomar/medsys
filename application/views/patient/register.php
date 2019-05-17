<!DOCTYPE html>
<html lang="en">
<?php
  $this->load->view('includes/head');
?>

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
                    <h2>Patient Form</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form action="http://webapps/bps/booking/saveBooking/0" class="form-horizontal form-label-left" novalidate="" method="post">

                        <div class="item form-group">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="occupation">First Name<span class="required">*</span></label>
                                <input id="FirstName" type="text" name="FirstName" class="optional form-control col-md-7 col-xs-12" required="required">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="occupation">Middle Name</label>
                                <input id="MiddleName" type="text" name="MiddleName" class="optional form-control col-md-7 col-xs-12">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="occupation">Last Name<span class="required">*</span></label>
                                <input id="LastName" type="text" name="LastName" class="optional form-control col-md-7 col-xs-12" required="required">
                            </div>
                        </div>


                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="website">Date of Travel <span class="required">*</span></label>
                                <input type="text" id="DateRange" name="DateRange" required="required" class="form-control col-md-7 col-xs-12">
                            </div>

                            
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="occupation">T.O. Number<span class="required">*</span></label>
                                <input id="TO_Number" type="text" name="TO_Number" class="optional form-control col-md-7 col-xs-12" required="required">
                            </div>
                        </div>

                        <div class="item form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label for="occupation">Date Booked<span class="required">*</span></label>
                                    <input id="DateBooked" type="text" name="DateBooked" class="optional form-control col-md-7 col-xs-12" required="required">
                                </div>
                                
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label for="occupation">Booking Reference <span class="required">*</span></label>
                                    <input id="BookingReferenceNo" type="text" required="required" name="BookingReferenceNo" class="form-control col-md-7 col-xs-12">
                                </div>
                        </div>


                        <div class="item form-group"> 
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="textarea">Route <span class="required">*</span></label>
                                    <textarea name="Route" class="form-control col-md-7 col-xs-12" required="required"></textarea>
                                </div>
                        </div>


                        <div class="item form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label for="occupation">Airline<span class="required">*</span></label>
                                    <input id="Airline" type="text" name="Airline" class="optional form-control col-md-7 col-xs-12" required="required">
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label for="occupation">Ticket Cost<span class="required">*</span></label>
                                <input id="TicketCost" type="text" name="TicketCost" required="required" class="optional form-control col-md-7 col-xs-12">
                                </div>
                        </div>

                        <div class="item form-group">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="occupation">PAL CL</label>
                                <input id="PAL_CL" type="text" name="PAL_CL" class="optional form-control col-md-7 col-xs-12">
                            </div> 

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="occupation">CEBAC CL</label>
                                <input id="CEBAC_CL" type="text" name="CEBAC_CL" class="optional form-control col-md-7 col-xs-12">
                            </div>

                            
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="occupation">Ageing Period</label>
                                <input id="AegingPeriod" type="text" name="AegingPeriod" class="optional form-control col-md-7 col-xs-12">
                            </div>
                        </div>


                        <div class="item form-group">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="occupation">Agent<span class="required">*</span></label>
                                <select class="optional form-control col-md-7 col-xs-12" id="Agent" name="Agent" required="required">
                                    <option value="">---Select Agent---</option>
                                    <option value="1">CEB CL</option><option value="2">PAL CL</option><option value="3">PAL UNILINK</option><option value="4">INTL UNILINK</option><option value="5">TRIPCLUB</option><option value="6">CREDIT LINE</option>                                </select>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="occupation">Requestor Lead Time</label>
                                <input id="RequestorLeadTime" type="text" name="RequestorLeadTime" class="optional form-control col-md-7 col-xs-12">
                            </div>

                            
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="occupation">Condition</label>
                                <select class="optional form-control col-md-7 col-xs-12" id="Condition" name="Condition">
                                    <option value="">---Select Condition---</option>
                                    <option value="1">CONSIDERING LEAD TIME
</option><option value="2">NOT CONSIDERING LEAD TIME
</option><option value="3">--N/A--</option>                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="textarea">Remarks<span class="required">*</span></label>
                                <textarea id="textarea" required="required" name="Remarks" class="form-control col-md-7 col-xs-12"></textarea>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="textarea">Purpose<span class="required">*</span></label>
                                <textarea id="textarea" required="required" name="Purpose" class="form-control col-md-7 col-xs-12"></textarea>
                            </div>
                        </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <a href="http://webapps/bps/booking" class="btn btn-primary">Cancel</a>
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
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
      <!-- Select2 -->
      <script src="<?php echo base_url();?>resources/vendors/select2/dist/js/select2.full.min.js"></script>
      <!-- Parsley -->
      <script src="<?php echo base_url();?>resources/vendors/parsleyjs/dist/parsley.min.js"></script>
      <!-- Autosize -->
      <script src="<?php echo base_url();?>resources/vendors/autosize/dist/autosize.min.js"></script>
      <!-- jQuery autocomplete -->
      <script src="<?php echo base_url();?>resources/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
      <!-- starrr -->
      <script src="<?php echo base_url();?>resources/vendors/starrr/dist/starrr.js"></script>
      <!-- Custom Theme Scripts -->
      <script src="<?php echo base_url();?>resources/build/js/custom.min.js"></script>
    <!-- insert scripts here -->
	
  </body>
</html>

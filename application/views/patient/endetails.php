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
              <div class="col-md-8 col-sm-12 col-xs-12">
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
                                <input id="PhoneNumber" type="text" name="PhoneNumber" value="<?php echo $PatientDetails['LastName'].', '.$PatientDetails['FirstName'].' '.$PatientDetails['MiddleName'] ?>" class="optional form-control col-md-7 col-xs-12" required="required" placeholder="Enter Cellphone Number" readonly>
                            </div>

                           <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="occupation">Cellphone Number<span class="required">*</span></label>
                                <input id="PhoneNumber" type="text" value="<?php echo $PatientDetails['CellPhoneNumber']; ?>" name="PhoneNumber" class="optional form-control col-md-7 col-xs-12" required="required" placeholder="Enter Cellphone Number" readonly>
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="occupation">Patient Type</label>
                                <input id="PhoneNumber" type="text" value="<?php if($EngagementDetails['PatientType'] == 1){ echo 'Outpatient'; } else{ echo 'Inpatient'; } ?>" name="PhoneNumber" class="optional form-control col-md-7 col-xs-12" required="required" placeholder="Enter Cellphone Number" readonly>
                            </div>

                           <div id="roomDiv" class="col-md-6 col-sm-6 col-xs-12" <?php if($EngagementDetails['PatientType'] == 1) echo "hidden";?>>
                                <label for="occupation">Room<span class="required">*</span></label>
                                <input id="PhoneNumber" type="text" name="PhoneNumber" class="optional form-control col-md-7 col-xs-12" required="required" value="<?php if($EngagementDetails['PatientType'] == 2) echo $this->database_model->getDescription($EngagementDetails['RoomId'],'R_Room'); ?>" placeholder="Enter Cellphone Number" readonly>
                            </div>

                        </div>


                        <div class="item form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label for="textarea">Address 1<span class="required">*</span></label>
                                <textarea id="textarea"  name="Address1" class="form-control col-md-7 col-xs-12" placeholder="Enter Address Details" readonly><?php echo $PatientDetails['Address1']; ?></textarea>
                            </div>
                        </div>                    

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <!-- <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">Proceed</button>
                          <a href="<?php echo base_url()?>patient/detail/<?php echo $Id; ?>" class="btn btn-info">Cancel</a>
                        </div> -->
                      </div>
                    </form>
                  </div>
                </div>
              </div>

               <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Medical Record</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <?php if($MedicalRecord==null){ ?>
                      <h3><i class='fa fa-folder'></i> No Records Found</h3>
                      <?php }else{ ?>
                        <table id="datatablenew" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Result Date</th>
                          <th>Category</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                        <!-- <tr>
                          <td>1001</td>
                          <td>Glomar, Jet Ronrick T.</td>
                          <td>M</td>
                          <td>27</td>
                          <td>Check-up</td>
                          <td>OP</td>
                        </tr> -->
                        <?php 
                          foreach($MedicalRecord as $row){
                            echo "<tr>";
                              echo "<td>".$row->TestDate."</td>";
                              echo "<td>".$row->CategoryDescription."</td>";
                              echo "<td>
                              <a href='".base_url()."uploads/".$row->Attachment."' class='btn btn-info btn-xs' target='_blank' data-toggle='tooltip' title='View'> <i class='fa fa-eye'></i></a>
                                </td>";


                            echo "</tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                        <?php } ?>
                  </div>
                </div>
               </div>

            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Recent Engagement</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <?php if($RecentEngagement == null){ ?>
                                    <h3><i class='fa fa-folder'></i> No Records Found</h3>

                                    <?php }else{ ?>
                                            <?php foreach($RecentEngagement as $row){ 
                                                echo '<a href="'.base_url().'patient/enDetails/'.$row->Id.'" target="_blank"><div style="width:100%; padding-inline-start:10px"><p>'.date('Y-m-d, h:i A', strtotime($row->DateOfEngagement)).'<span style="right:15px; position:absolute"> <strong><i class="fa fa-save"></i> View Record</strong></span></p></div></a>';
                                                }
                                            ?>      
                                    <?php }?>
                                    <div class="ln_solid"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Purpose</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="item form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input id="PhoneNumber" type="text" name="PhoneNumber" class="optional form-control col-md-7 col-xs-12" required="required" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Chief Complaint</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="item form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input id="PhoneNumber" type="text" name="PhoneNumber" class="optional form-control col-md-7 col-xs-12" required="required" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="x_panel">
                                    <div class="x_title">
                                        <h2>(O) Objective</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form action="<?php echo base_url();?>patient/saveEngagement/0" class="form-horizontal form-label-left" method="post">
                                            <div class="item form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="occupation">Height (cm)</label>
                                                    <input id="PhoneNumber" type="text" name="PhoneNumber" value="<?php echo $PatientDetails['LastName'].', '.$PatientDetails['FirstName'].' '.$PatientDetails['MiddleName'] ?>" class="optional form-control col-md-7 col-xs-12" required="required" placeholder="Enter Cellphone Number" readonly>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="occupation">Pulse (/min)</label>
                                                    <input id="PhoneNumber" type="text" value="<?php echo $PatientDetails['CellPhoneNumber']; ?>" name="PhoneNumber" class="optional form-control col-md-7 col-xs-12" required="required" placeholder="Enter Cellphone Number" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="item form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="occupation">Weight (kg)</label>
                                                    <input id="PhoneNumber" type="text" name="PhoneNumber" value="<?php echo $PatientDetails['LastName'].', '.$PatientDetails['FirstName'].' '.$PatientDetails['MiddleName'] ?>" class="optional form-control col-md-7 col-xs-12" required="required" placeholder="Enter Cellphone Number" readonly>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="occupation">Respiratory Rate (/min)</label>
                                                    <input id="PhoneNumber" type="text" value="<?php echo $PatientDetails['CellPhoneNumber']; ?>" name="PhoneNumber" class="optional form-control col-md-7 col-xs-12" required="required" placeholder="Enter Cellphone Number" readonly>
                                                </div>

                                            </div>   
                                            <div class="item form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="occupation">Calculated BMI (kg/m&sup2;)</label>
                                                    <input id="PhoneNumber" type="text" name="PhoneNumber" value="<?php echo $PatientDetails['LastName'].', '.$PatientDetails['FirstName'].' '.$PatientDetails['MiddleName'] ?>" class="optional form-control col-md-7 col-xs-12" required="required" placeholder="Enter Cellphone Number" readonly>
                                                </div>

                                                <div class="col-md-2 col-sm-6 col-xs-12">
                                                    <label for="occupation">BP (mmHg)</label>
                                                    <input id="PhoneNumber" type="text" value="<?php echo $PatientDetails['CellPhoneNumber']; ?>" name="PhoneNumber" class="optional form-control col-md-6 col-sm-6 col-xs-6 form-group " required="required" placeholder="Enter Cellphone Number" readonly>
                                                </div>
                                                <div class="col-md-1 col-sm-6 col-xs-12" style="width:10%; padding-left:0px; padding-right:0px">
                                                    <label for="occupation">&nbsp;</label>
                                                    <p>/</p>
                                                </div>

                                                <div class="col-md-2 col-sm-6 col-xs-12">
                                                    <label for="occupation">&nbsp;</label>
                                                    <input id="PhoneNumber" type="text" value="<?php echo $PatientDetails['CellPhoneNumber']; ?>" name="PhoneNumber" class="optional form-control col-md-6 col-sm-6 col-xs-6 form-group " required="required" placeholder="Enter Cellphone Number" readonly>
                                                </div>
                                            </div>               

                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                            <!-- <div class="col-md-6 col-md-offset-3">
                                            <button id="send" type="submit" class="btn btn-success">Proceed</button>
                                            <a href="<?php echo base_url()?>patient/detail/<?php echo $Id; ?>" class="btn btn-info">Cancel</a>
                                            </div> -->
                                            </div>
                                        </form>
                                    </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="x_panel">
                                    <div class="x_title">
                                        <h2>(P) Plan</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <h3><i class='fa fa-folder'></i> No Records Found</h3>
                                    </div>
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
    
    
    <script>
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


        $('#datatablenew').dataTable( {
        "lengthMenu": [3, 5, 10, 20, 100],
        "pageLength": 3
        });


    });

    

    </script>
    
	
  </body>
</html>

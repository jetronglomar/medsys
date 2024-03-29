<!DOCTYPE html>
<html lang="en">
<?php
  $this->load->view('includes/head');
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/css/daterangepicker.css" />
<link href="<?php echo base_url();?>resources/css/select2.min.css" rel="stylesheet" />


<script>


</script>
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
                        <div class="pull-right" style="margin-right:7px; margin-bottom:3px">
                            <button id="addActivity" class="btn btn-md btn-primary"><i class="fa fa-plus"></i> Activity</button>
                        </div>
          </div>
          
          <form id="enDetailsForm" action="<?php echo base_url();?>doctor/saveEnDetails/<?php echo $EngagementDetailsFinal['Id']; ?>" class="form-horizontal form-label-left" method="post">
          <div class="row">
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Patient Engagement Form</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                      <input type="text" value="<?php echo $this->uri->segment(3); ?>" name="EngagementId" hidden/>
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
                    
                  </div>
                </div>
              </div>

               <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pending Medicines</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <?php if($PendingMedicines==null){ ?>
                      <h3><i class='fa fa-folder'></i> No Pending Medicine Found</h3>
                      <?php }else{ ?>
                        <table id="datatablenew" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Medicine Description</th>
                          <th>Schedule</th>
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
                          foreach($PendingMedicines as $row){
                            echo "<tr>";
                              echo "<td>".$row->medicineDescription."</td>";
                              echo "<td>".date('Y-m-d h:i a', strtotime($row->PlannedSchedule))."</td>";
                              if($row->Status == 1){
                                echo "<td>
                                <span class='label label-warning'>Provided & Pending for Relative's Approval</span>
                                  </td>";
                              }
                              else if($row->Status == 2){
                                echo "<td>
                                    <span class='label label-success'>Approved by Relative</span>
                                  </td>";
                              }
                            //   else if($row->Status == 3){
                            //    echo "<td>
                            //             <span class='label label-success'>Disapproved by Relative</span>
                            //       </td>";
                            //   }
                              else{
                              echo "<td>
                              <button class='providedMed btn btn-xs btn-success' value='".$row->Id."'><i class='fa fa-check-square-o'></i> Provided</button>
                                </td>";
                            }


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
                                            <input id="PhoneNumber" value="<?php echo $this->database_model->getDescription($EngagementDetails['PurposeId'],'R_Purpose'); ?>" type="text" name="PhoneNumber" class="optional form-control col-md-7 col-xs-12" required="required" readonly>
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
                            <h2>Allergies</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div id="allergyForm">

                                    <?php if($Allergies!=null){ 
                                        $i = 1;
                                        foreach($Allergies as $row){
                                            if($i == 1){
                                                echo '<div class="item form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <input type="text" name="allergy[]" class="form-control" value="'.$row->Description.'" placeholder="Enter Allergy" required readonly>
                                                            </div>
                                                        </div>';
                                            }
                                            else{
                                                echo '<div class="item form-group"><div class="col-md-12 col-sm-12 col-xs-12"><input name="allergy[]"  type="text" class="form-control" placeholder="Enter Allergy" value="'.$row->Description.'" required readonly></div><div class="btnholder col-md-4 col-sm-12 col-xs-12" hidden><button  onClick="$(this).parent().parent().remove();" class="removeAllergy btn btn-danger btn-md pull-right">Remove</button></div></div>';
                                            }
                                            $i = $i+1;
                                        }
                                    }
                                  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                </div>

                
                    
                 <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
           
                  <div class="x_content">

                    <!-- start accordion -->
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">(O) Objective</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                          <div class="item form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="occupation">Height (cm)</label>
                                                    <input value="<?php if($EngagementDetailsFinal['Height']!=null) echo $EngagementDetailsFinal['Height']; ?>" id="Height" type="text" name="Height"  class="form-control col-md-7 col-xs-12" required="required" placeholder="Enter in CM" readonly>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="occupation">Pulse (/min)</label>
                                                    <input value="<?php if($EngagementDetailsFinal['Pulse']!=null) echo $EngagementDetailsFinal['Pulse']; ?>" id="Pulse" type="number"  name="Pulse" class="optional form-control col-md-7 col-xs-12" required="required" placeholder="Enter /min" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="item form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="occupation">Weight (kg)</label>
                                                    <input value="<?php if($EngagementDetailsFinal['Weight']!=null) echo $EngagementDetailsFinal['Weight']; ?>" id="Weight" type="number" name="Weight"  class="optional form-control col-md-7 col-xs-12" required="required" placeholder="Enter in kg" readonly>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="occupation">Respiratory Rate (/min)</label>
                                                    <input value="<?php if($EngagementDetailsFinal['Respiratory']!=null) echo $EngagementDetailsFinal['Respiratory']; ?>" id="Respiratory" type="number" name="Respiratory" class="optional form-control col-md-7 col-xs-12" required="required" placeholder="Enter /min" readonly>
                                                </div>

                                            </div>   
                                            <div class="item form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="occupation">Calculated BMI (kg/m&sup2;)</label>
                                                    <input value="<?php if($EngagementDetailsFinal['BMI']!=null) echo $EngagementDetailsFinal['BMI']; ?>" id="BMI" type="number" name="BMI" class="optional form-control col-md-7 col-xs-12" required="required" placeholder="Enter BMI" readonly>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="occupation">BP (mmHg)</label>
                                                    <input type="text" class="form-control" value="<?php echo $EngagementDetailsFinal['BPNum']; ?>/<?php echo $EngagementDetailsFinal['BPDen'] ?>" readonly/>
                                                    <!-- <input value="<?php if($EngagementDetailsFinal['BPNum']!=null) echo $EngagementDetailsFinal['BPNum']; ?>"  id="BPNum" type="number" name="BPNum" class="optional form-control col-md-6 col-sm-6 col-xs-6 form-group " required="required" placeholder="0" readonly> -->
                                                </div>
                                            </div>    
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          <h4 class="panel-title">(S) Subjective</h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                                 <div class="item form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <select class="form-control" id="chiefComplaint" name="chiefComplaint" required readonly>
                                                <option value="">--Select Here--</option>
                                                <?php
                                                    foreach($ChiefComplaint as $row){
                                                      if($EngagementDetailsFinal['chiefComplaint']!=null){
                                                        if($EngagementDetailsFinal['chiefComplaint']==$row->Id){
                                                            echo "<option value='".$row->Id."' selected>".$row->Description."</option>";
                                                        }
                                                        else{
                                                            echo "<option value='".$row->Id."'>".$row->Description."</option>";
                                                        }
                                                      }
                                                      else{
                                                        echo "<option value='".$row->Id."'>".$row->Description."</option>";
                                                      }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item form-group">

                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <textarea class="form-control" id="chiefComplaintRemarks" name="chiefComplaintRemarks" readonly><?php if($EngagementDetailsFinal['chiefComplaintRemarks']!=null) echo $EngagementDetailsFinal['chiefComplaintRemarks']; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label for="occupation">History of Present Illness</label>
                                            <textarea class="form-control" id="presentIllnessHistory" name="presentIllnessHistory" readonly><?php if($EngagementDetailsFinal['PresentIllnessHistory']!=null) echo $EngagementDetailsFinal['PresentIllnessHistory']; ?></textarea>
                                        </div>
                                    </div>

                                     <div class="item form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label for="occupation">Current Medicine</label>
                                            <textarea class="form-control" id="currentMedicine" name="CurrentMedicine"  readonly><?php if($EngagementDetailsFinal['CurrentMedicine']!=null) echo $EngagementDetailsFinal['CurrentMedicine']; ?></textarea>
                                        </div>
                                    </div>

                                     <div class="item form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label for="occupation">Review of Systems</label>
                                            <textarea class="form-control" id="systemsReview" name="systemsReview" readonly><?php if($EngagementDetailsFinal['SystemsReview']!=null) echo $EngagementDetailsFinal['SystemsReview']; ?></textarea>
                                        </div>
                                    </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          <h4 class="panel-title">(P) Plan</h4>
                        </a>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                                                <div class="item form-group" hidden>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <label for="occupation">Medicine</label>
                                                        <textarea class="form-control" id="medicine" name="medicine" placeholder=""  readonly><?php if($EngagementDetailsFinal['Medicine']!=null) echo $EngagementDetailsFinal['Medicine']; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <label for="occupation">Tests</label>
                                                        <textarea class="form-control" placeholder="" id="tests" name="tests" readonly><?php if($EngagementDetailsFinal['Tests']!=null) echo $EngagementDetailsFinal['Tests']; ?></textarea>
                                                    </div>
                                                </div>

                                                 <div class="item form-group">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <label for="occupation">Referrals</label>
                                                        <textarea class="form-control" placeholder="" id="referrals" name="referrals"  readonly><?php if($EngagementDetailsFinal['Referrals']!=null) echo $EngagementDetailsFinal['Referrals']; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                                        <label for="occupation">Disposition</label>
                                                        <select class="form-control" id="dispositionId" name="dispositionId" readonly>
                                                            <option value="">--Select Here--</option>
                                                            <?php foreach($Disposition as $row){
                                                                if($EngagementDetailsFinal['DispositionId']!=null){
                                                                    if($row->Id == $EngagementDetailsFinal['DispositionId']){
                                                                        echo '<option value="'.$row->Id.'" selected>'.$row->Description.'</option>';
                                                                    }
                                                                    else{
                                                                        echo '<option value="'.$row->Id.'">'.$row->Description.'</option>';
                                                                    }
                                                                }
                                                                
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <label for="occupation">Follow Up</label>
                                                        <input type="text"  id="followUpDate" name="followUpDate" class="form-control"  readonly/>
                                                    </div>
                                                </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end of accordion -->


                  </div>
                </div>
            </div>
            </div>
         

            <!-- <br/> -->
                                                </form>
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
    
    
    <script>
     
     
    $(document).ready(function (){
        $('.providedMed').on('click', function(e){
            e.preventDefault();
            var Id = $(this).val();
            var obj = $(this);

            Swal.fire({
                    title: 'Enter Provided Medicine Remarks',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    showLoaderOnConfirm: true,
                    preConfirm: (activity) => {
                        $.ajax({type: "POST",
                            url: "<?php echo base_url();?>nurse/saveMedicineActivity/",
                            data: {'activity': activity, 'MedicineScheduleId':Id, 'EngagementDetailsId': <?php echo $EngagementDetailsFinal['Id']; ?>},
                            success:function(result) {
                                obj.prop('disabled', true);
                                Swal.fire({
                                    type: 'success',
                                    title: 'Successfully Saved!'
                                })
                            },
                            error:function(result) {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Something went wrong, Please try again.'
                                })
                            }
                        });
                    }
                    })
        });

        $("#addActivity").on('click', function(e){
            Swal.fire({
                    title: 'Enter Activity Details',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    showLoaderOnConfirm: true,
                    preConfirm: (activity) => {
                        $.ajax({type: "POST",
                            url: "<?php echo base_url();?>nurse/saveactivity/",
                            data: {'activity': activity, 'EngagementDetailsId': <?php echo $EngagementDetailsFinal['Id']; ?>},
                            success:function(result) {
                                Swal.fire({
                                    type: 'success',
                                    title: 'Successfully Saved!'
                                })
                            },
                            error:function(result) {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Something went wrong, Please try again.'
                                })
                            }
                        });
                    }
                    })
        });

      
      $("#endEngagementButton").on('click', function(e){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.value) {

                $.ajax({type: "POST",
                    url: "<?php echo base_url();?>doctor/endEngagement/<?php echo $EngagementDetailsFinal['Id']; ?>",
                    success:function(result) {
                        Swal.fire(
                        'Success!',
                        'Ended the engagement',
                        'success'
                        );
                        $("#endEngagementButton").hide();
                        $("#updateRecordButton").hide();
                        $("#printEngagementButton").show();
                        $("#presentIllnessHistory").prop('disabled', true);
                        $("#currentMedicine").prop('disabled', true);
                        $("#systemsReview").prop('disabled', true);
                        $("#medicine").prop('disabled', true);
                        $("#tests").prop('disabled', true);
                        $("#referrals").prop('disabled', true);
                        $("#dispositionId").prop('disabled', true);
                        $("#followUpDate").prop('disabled', true);
                    },
                    error:function(result) {
                        Swal.fire({
                            type: 'error',
                            title: 'Something went wrong, Please try again.'
                        })
                    }
                });
            }
            })
      });

        $(function() {
            $('input[name="followUpDate"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true
            });
        });
  
        //Allergy Counter
        var i = 0;
        

        $("#enDetailsForm").submit(function(e) {
            var form = $(this);
            e.preventDefault();
            $.ajax({type: "POST",
                url: "<?php echo base_url();?>doctor/saveEnDetails/<?php echo $EngagementDetailsFinal['Id']; ?>",
                data: form.serialize(),
                success:function(result) {
                    Swal.fire({
                        type: 'success',
                        title: 'Successfully Updated'
                    })
                },
                error:function(result) {
                    Swal.fire({
                        type: 'error',
                        title: 'Something went wrong, Please try again.'
                    })
                }
            });
        });

        $('#AddAllergy').click(function(event){
            event.preventDefault();
            i = i+1;
            $("#allergyForm").append('<div class="item form-group"><div class="col-md-8 col-sm-12 col-xs-12"><input id="allergy'+i+'" name="allergy[]"  type="text" class="form-control" placeholder="Enter Allergy" required></div><div class="btnholder col-md-4 col-sm-12 col-xs-12"><button value="'+i+'" onClick="$(this).parent().parent().remove();" class="removeAllergy btn btn-danger btn-md pull-right">Remove</button></div></div>');
          
        });



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
            "lengthMenu": [5, 10, 20, 100],
            "pageLength": 5
        });


    });

    

    </script>
    
	
  </body>
</html>

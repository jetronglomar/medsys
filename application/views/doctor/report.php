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

          <div class="row"> 
              <!-- Insert Datatable Here -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                <div class="x_title">
                    <h2>JG Hospital Report Design</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                                          <i class="fa fa-stethoscope"></i> Medical Enagement
                                          <small class="pull-right">Date: <?php echo date("m/d/Y"); ?></small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                          Patient Details
                          <address>
                                          <strong><?php echo  $PatientDetails['LastName'].', '.$PatientDetails['FirstName'].' '.$PatientDetails['MiddleName']?></strong>
                                          <br><?php echo $PatientDetails['Address1']; ?>
                                          <br>Phone: <?php echo $PatientDetails['PhoneNumber'];  ?>
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6 invoice-col">
                          Doctor Details
                          <address>
                                          <strong>Dr. Jet Ronrick Glomar</strong>
                                          <br>General Doctor
                                          <br>Phone: 1 (804) 123-9876
                                          <br>Email: jetronglomar@gmail.com
                                      </address>
                        </div>
                        <!-- /.col -->
                        <!-- <div class="col-sm-4 invoice-col">
                         
                        </div> -->
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <!-- <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>Serial #</th>
                                <th style="width: 59%">Description</th>
                                <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>Call of Duty</td>
                                <td>455-981-221</td>
                                <td>El snort testosterone trophy driving gloves handsome gerry Richardson helvetica tousled street art master testosterone trophy driving gloves handsome gerry Richardson
                                </td>
                                <td>$64.50</td>
                              </tr>
                              <tr>
                                <td>1</td>
                                <td>Need for Speed IV</td>
                                <td>247-925-726</td>
                                <td>Wes Anderson umami biodiesel</td>
                                <td>$50.00</td>
                              </tr>
                              <tr>
                                <td>1</td>
                                <td>Monsters DVD</td>
                                <td>735-845-642</td>
                                <td>Terry Richardson helvetica tousled street art master, El snort testosterone trophy driving gloves handsome letterpress erry Richardson helvetica tousled</td>
                                <td>$10.70</td>
                              </tr>
                              <tr>
                                <td>1</td>
                                <td>Grown Ups Blue Ray</td>
                                <td>422-568-642</td>
                                <td>Tousled lomo letterpress erry Richardson helvetica tousled street art master helvetica tousled street art master, El snort testosterone</td>
                                <td>$25.99</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div> -->
                      <!-- /.row -->
                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-12">
                            <p class="lead">(S) Subjective</p>
                                <div class="table-responsive">
                                    <table class="table">
                                    <tbody>
                                        <tr>
                                        <th style="width:50%">Chief Complaint</th>
                                        <td><?php if($EngagementDetailsFinal['chiefComplaint'] != null) echo $this->database_model->getDescription($EngagementDetailsFinal['chiefComplaint'],'R_ChiefComplaint'); ?></td>
                                        </tr>
                                        <tr>
                                        <th>Complaint Remarks</th>
                                        <td><?php if($EngagementDetailsFinal['chiefComplaintRemarks']!=null) echo $EngagementDetailsFinal['chiefComplaintRemarks'] ?></td>
                                        </tr>
                                        <tr>
                                        <th>History of Present Illness</th>
                                        <td><?php if($EngagementDetailsFinal['PresentIllnessHistory'] != null) echo $EngagementDetailsFinal['PresentIllnessHistory']; ?></td>
                                        </tr>
                                        <tr>
                                        <th>Current Medicine</th>
                                        <td><?php if($EngagementDetailsFinal['CurrentMedicine'] != null) echo $EngagementDetailsFinal['CurrentMedicine']; ?></td>
                                        </tr>
                                        <tr>
                                        <th>Review of System</th>
                                        <td><?php if($EngagementDetailsFinal['SystemsReview'] != null) echo $EngagementDetailsFinal['SystemsReview']; ?></td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                        </div>
        </div>
        <div class="row">
                        <!-- /.col -->
                        <div class="col-xs-12">
                          <p class="lead">(P) Plan</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                              
                                <tr>
                                  <th>Tests</th>
                                  <td><?php if($EngagementDetailsFinal['Tests'] != null) echo $EngagementDetailsFinal['Tests']; ?></td>
                                </tr>
                                <tr>
                                  <th>Referrals</th>
                                  <td><?php if($EngagementDetailsFinal['Referrals'] != null) echo $EngagementDetailsFinal['Referrals']; ?></td>
                                </tr>
                                <tr>
                                  <th>Disposition</th>
                                  <td><?php if($EngagementDetailsFinal['DispositionId'] != null) echo $EngagementDetailsFinal['SystemsReview']; ?></td>
                                </tr>
                                <tr>
                                  <th>Follow-up</th>
                                  <td><?php if($EngagementDetailsFinal['FollowUpDate'] != null) echo $EngagementDetailsFinal['FollowUpDate']; ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                     
                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-12">
                        <p class="lead">(M) Medicine</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Description</th>
                                  <th style="width:50%">Date</th>
                                  <th style="width:50%">Qty Recommended</th>
                                  <th style="width:50%">Qty Taken</th>
                                </tr>
                                <?php
                                  foreach($MedicineList as $row){

                                    $dateEnd = strtotime($row->DateEnd); 
                                    $dateStart = strtotime($row->DateStart);
        
                                    $diff = $dateEnd - $dateStart;
        
                                    $hours = $diff / ( 60 * 60 );
                                    $days = round($hours/24);


                                    echo "<tr>";
                                      echo "<td>".$this->database_model->getDescription($row->MedicineId, 'R_Medicine')."</td>";
                                      echo "<td>".date('M-d-Y h:i a', strtotime($row->DateStart))." to ".date('m-d-Y h:i a', strtotime($row->DateEnd))."</td>";
                                      echo "<td>".$days*$row->Qty."</td>";
                                      echo "<td>".$this->database_model->countTaken($row->Id)."</td>";
                                    echo "</tr>";
                                  }
                                ?>
                              
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-12">
                          <p class="lead">(O) Objective</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Height</th>
                                  <td><?php if($EngagementDetailsFinal['Height'] != null) echo $EngagementDetailsFinal['Height'].' cm'; ?></td>
                                </tr>
                                <tr>
                                  <th>Weight</th>
                                  <td><?php if($EngagementDetailsFinal['Weight'] != null) echo $EngagementDetailsFinal['Weight'].' kg'; ?></td>
                                </tr>
                                <tr>
                                  <th>Pulse</th>
                                  <td><?php if($EngagementDetailsFinal['Pulse'] != null) echo $EngagementDetailsFinal['Pulse'].' /min'; ?></td>
                                </tr>
                                <tr>
                                  <th>Respiratory Rate</th>
                                  <td><?php if($EngagementDetailsFinal['Respiratory'] != null) echo $EngagementDetailsFinal['Respiratory'].' /min'; ?></td>
                                </tr>
                                <tr>
                                  <th>Calculated BMI</th>
                                  <td><?php if($EngagementDetailsFinal['BMI'] != null) echo $EngagementDetailsFinal['BMI'].' kg/m&sup2'; ?></td>
                                </tr>
                                <tr>
                                  <th>BP</th>
                                  <td><?php if($EngagementDetailsFinal['BPNum'] != null) echo $EngagementDetailsFinal['BPNum'].'/'.$EngagementDetailsFinal['BPDen'].' mmHg'; ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                          <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
          </div>

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
    <!-- insert scripts here -->
	
  </body>
</html>

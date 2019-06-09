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
          <br />

          <div class="row"> 
              <!-- Insert Datatable Here -->
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Laboratory Results</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url(); ?>lab/new/0" class="btn btn-primary btn-md pull-right">Add Laboratory Results</a>
                  </div>
                  <div class="x_content">
                    
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Patient Name</th>
                          <th>Category</th>
                          <th>Requested By</th>
                          <th>Date of Test</th>
                          <th>Date of Result</th>
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
                          foreach($Laboratory as $row){
                            echo "<tr>";
                              echo "<td>".$row->PatientName."</td>";
                              echo "<td>".$row->CategoryDescription."</td>";
                              echo "<td>".$row->DoctorName."</td>";
                              echo "<td>".$row->TestDate."</td>";
                              echo "<td>".$row->ResultDate."</td>";
                              echo "<td>
                                      <a href='".base_url()."uploads/".$row->Attachment."' class='btn btn-info btn-xs' target='_blank' data-toggle='tooltip' title='View'> <i class='fa fa-eye'></i></a>
                                      <a href='".base_url()."lab/edit/".$row->Id."' target='_blank' class='btn btn-warning btn-xs' data-toggle='tooltip' title='Edit'><i class='fa fa-edit'></i></a>
                                    </td>";
                            echo "</tr>";
                          }
                        ?>
                      </tbody>
                    </table>
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

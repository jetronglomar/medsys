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
          <div class="row top_tiles">
             <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-search"></i></div>
                  <!-- <div class="count">179</div> -->
                  <a href="<?php echo base_url()?>doctor/findpatient">
                    <div class="count" style="font-size:30px !important">Find Patient</div>
                    <p style="margin-bottom:10px !important">Search for Patient Profile</p>
                  </a>
                </div>
              </div>
          </div>
          <!-- /top tiles -->

          <div class="row"> 
              <!-- Insert Datatable Here -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Today's Patients</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Gender</th>
                          <th>Purpose</th>
                          <th>Type</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                          <?php
                            foreach($EngagementList as $row){
                                echo "<tr>";
                                echo "<td>".$row->LastName.", ".$row->FirstName."</td>";
                                if($row->Gender == 1){
                                    echo "<td>M</td>";
                                }
                                else{
                                    echo "<td>F</td>";
                                }
                                echo "<td>".$this->database_model->getDescription($row->PurposeId,'R_Purpose')."</td>";
                                if($row->PatientType == 1){
                                    echo "<td>Outpatient</td>";
                                }
                                else{
                                    echo "<td>Inpatient</td>";
                                }
                                echo "<td><a class='btn btn-xs btn-primary' data-toggle='tooltip' data-original-title='View'><i class='fa fa-eye'></i></a></td>";
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

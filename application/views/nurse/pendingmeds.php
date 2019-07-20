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
                    <h2>List of Requested Medicines</h2>
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
                          <th>Request Number</th>
                          <th>Room Number</th>
                          <th>Requested By</th>
                          <th>Patient Name</th>
                          <th>Qty</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      <?php 
                        foreach($RequestedMedicine as $row){
                            $dateEnd = strtotime($row->DateEnd); 
                            $dateStart = strtotime($row->DateStart);

                            $diff = $dateEnd - $dateStart;

                            $hours = $diff / ( 60 * 60 );
                            $days = round($hours/24);

                            echo "<tr>"; 
                                echo "<td>".date('Y').'-'.date('m',strtotime($row->DateCreated)).'-'.str_pad($row->Id, 4, '0', STR_PAD_LEFT)."</td>";
                                echo "<td>".$row->roomDescription."</td>";
                                echo "<td>Dr. ".$row->DoctorName."</td>";
                                echo "<td>".$row->PatientName."</td>";
                                echo "<td>".$days*$row->Qty."</td>";    
                                if($row->Status == 1){
                                    echo "<td>Pending</td>";
                                }
                                else if($row->Status == 2){
                                    echo "<td>Aprpoved</td>";
                                }
                                else{
                                    echo "<td>Disapproved</td>";
                                }

                                if($row->Status == 0){
                                    echo "<td>
                                            <a href='".base_url()."nurse/disapprovedMedsToggle/".$row->Id."/2' data-toggle='tooltip' title='Provided by Patient' class='btn btn-success btn-xs '><i class='fa fa-check'></i></a>
                                        </td>";
                                }
                                else{
                                    echo "<td>N/A</td>";
                                }
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

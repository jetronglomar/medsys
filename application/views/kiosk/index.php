<!DOCTYPE html>
<html lang="en">
<?php
  $this->load->view('includes/head');
?>

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
            font-size:30px !important;
          }
        </style>

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
             <div class="animated flipInY col-lg-6 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon" style="padding-top:15px !important"><i class="fa fa-edit"></i></div>
                  <!-- <div class="count">179</div> -->
                  <a href="<?php echo base_url()?>kiosk/endetails">
                    <div class="count" style="font-size:70px !important">Nurse Activity</div>
                    <p style="margin-bottom:10px!important; font-size:20px !important;">Approve Nurse Activity for your Patient</p>
                  </a>
                </div>
              </div>
              <div class="animated flipInY col-lg-6 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon" style="padding-top:15px !important"><i class="fa fa-bell"></i></div>
                  <!-- <div class="count">179</div> -->
                  <a id="buzz" stlye="cursor:pointer !important" href="#">
                    <div class="count" style="font-size:70px !important">Buzz to Notify</div>
                    <p style="margin-bottom:10px!important; font-size:20px !important;">Real-time notification for Nurse</p>
                  </a>
                </div>
              </div>

               <!-- <div class="animated flipInY col-lg-6 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <a href="<?php echo base_url()?>patient">
                    <div class="count" style="font-size:70px !important">View Reports</div>
                    <p style="margin-bottom:10px!important; font-size:20px !important;">Real-time notification for Nurse</p>
                  </a>
                </div>
              </div>
              <div class="animated flipInY col-lg-6 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-user"></i></div>
                  
                  <a href="<?php echo base_url()?>patient/register">
                    <div class="count" style="font-size:30px !important">Register</div>
                    <p style="margin-bottom:10px !important">Create new Patient Profile</p>
                  </a>
                </div>
              </div> -->
          </div>
          <!-- /top tiles -->
          <br />

          <div class="row"> 
              <!-- Insert Datatable Here -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Mdicine Schedule Status</h2>
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
                          <th>Description</th>
                          <th>Schedule</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                          <?php
                            foreach($medicineSchedule as $row){
                                echo "<tr>";
                                    echo "<td>".$row->medicineDescription."</td>";
                                    echo "<td>".date('M-d-Y h:i a',strtotime($row->PlannedSchedule))."</td>";
                                    if($row->Status == 0){
                                        echo "<td><span class='label label-warning'>Pending</span></td>";
                                    }
                                    else if($row->Status == 1){
                                        echo "<td><span class='label label-primary'>Provided</span></td>";
                                    }
                                    else if($row->Status == 2 || $row->Status == 3){
                                        echo "<td><span class='label label-success'>Confirmed</span></td>";
                                    }

                                    if($row->Status == 1){
                                        echo "<td><button class='confirmMed btn btn-xs btn-success' data-toggle='tooltip' title='Confirm' value='".$row->Id."'><i class='fa fa-check'></i></button></td>";
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
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

  <script>
      $(document).ready(function(){


var conn = new WebSocket('ws://localhost:8000');
conn.onopen = function(e) {
    console.log("Connection established!");
    
};  

conn.onmessage = function(e) {
    console.log(e.data);
};

$('#buzz').on('click', function(){
conn.send('Relative of <?php echo $PatientDetails["FirstName"]." ".$PatientDetails['LastName']; ?> is trying to call your attention. Please proceed to <?php echo $EngagementDetails['roomDescription']; ?>');
});



        $('.confirmMed').on('click', function(e){
            e.preventDefault();
            var Id = $(this).val();
            var obj = $(this);

            Swal.fire({
                    title: 'Enter Remarks',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                    showLoaderOnConfirm: true,
                    preConfirm: (activity) => {
                        $.ajax({type: "POST",
                            url: "<?php echo base_url();?>kiosk/saveMedicineActivity/",
                            data: {'activity': activity, 'MedicineScheduleId':Id},
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


      });
  </script>
</html>

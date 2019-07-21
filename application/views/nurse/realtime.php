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
              font-size: 30px !important;
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
                    <h2>Patient Profile</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <table id="example" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Room No.</th>
                          <th>Patient Name</th>
                          <th>Medicine Description</th>
                          <th>Missed Count</th>
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
    <script src="<?php echo base_url(); ?>resources/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
      <script src="<?php echo base_url(); ?>resources/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
      <script src="<?php echo base_url(); ?>resources/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
      <script src="<?php echo base_url(); ?>resources/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
      <script src="<?php echo base_url(); ?>resources/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
      <script src="<?php echo base_url(); ?>resources/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
      <script src="<?php echo base_url(); ?>resources/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
      <script src="<?php echo base_url(); ?>resources/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
      <script src="<?php echo base_url(); ?>resources/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
      <script src="<?php echo base_url(); ?>resources/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
      <script src="<?php echo base_url(); ?>resources/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
      <script src="<?php echo base_url(); ?>resources/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
      <!-- insert scripts here -->
  
  </body>

    <script>
      $(document).ready(function() {

var conn = new WebSocket('ws://localhost:8000');
conn.onopen = function(e) {
    console.log("Connection established!");
    
};  

conn.onmessage = function(e) {
    // alert(e.data);
    Swal.fire({
      title: 'Buzz by Relative',
      type:'info',
      html:e.data,
      confirmButtonText: 'Ok'
    });
};

        

          var modals =[];
        function InitOverviewDataTable() {
          oOverviewTable = $('#example').DataTable(
            {
              "pageLength": 10,
              "ajax": { url: '<?php base_url() ?>nurse/pendingMeds', type: 'POST', "dataSrc": "" },
              "columns": [
                { data: "Id" },
                { data: "roomDescription" },
                {
                  data: "patientName", "render": function (data, type, row) {
                    return data;
                    }
                },
                {
                  data: "medicineDescription", "render": function (data, type, row) {
                    return data;
                    }
                }
                ,
                {
                  data: "Count", "render": function (data, type, row) {
   
                    return ' <span class="label label-danger">'+data+'</span>';
                    }
                },
                {
                  data: "EngagementId", "render": function (data, type, row) {
   
                    return ' <a class="btn btn-xs btn-primary" href="<?php echo base_url() ?>/nurse/endetails/'+data+'"><i class="fa fa-eye"></i></a>';
                    }
                }
              ],
              "aoColumnDefs": [{ "bVisible": false, "aTargets": [0] }],
              "order": [[0, "desc"]],
              "createdRow": function (row, data, index) {
                // console.log(row);
                // console.log(data);
                    if(data['Count']>0){
                      // swalFire(row.patientName, row.roomDescription, row.medicineDescription);
                      patientName = data['patientName'];
                      medicineName = data['medicineDescription'];
                      roomNumber = data['roomDescription'];
                      engagementId = data['EngagementId'];
                      modals.push({title:'<strong>Medicine Reminder</strong>', type:'info', html: '<b>'+patientName+'</b> needs to take <b>'+medicineName+'</b> in 10 minutes. Please proceed to Room: <b>'+roomNumber+'</b><br/><b><a href="<?php echo base_url() ?>nurse/endetails/'+engagementId+'" target="_blank">Click here</a></b> to view Engagement Details',confirmButtonText: 'Ok'})
                    }
                    Swal.queue(modals);
                }
            });
           
            
            
          }
          function refresh(){
          var url = '<?php base_url() ?>nurse/pendingMeds';

          oOverviewTable.ajax.url(url).load();
         }

          window.setInterval(function(){
            modals = [];
            refresh()();
          }, 50000);
          InitOverviewDataTable();


        });
      
        
  </script>
</html>  

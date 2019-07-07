<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url() ?>home" class="site_title"><i class="fa fa-stethoscope"></i> <span>JG | PMTS</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url();?>resources/images/nurse.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <?php if($this->session->userdata('RoleId') == 1 || $this->session->userdata('RoleId') == 3){ ?>
                  <span>Welcome Nurse</span>
                <?php }
                else{ ?>
                  <span>Welcome Doctor</span>
                <?php }?>

                <!-- <h2>Jet Glomar</h2> -->
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                <?php if($this->session->userdata('RoleId') == 2){ ?>
                  <li><a href="<?php echo base_url() ?>doctor"> <i class="fa fa-stethoscope"></i> Doctor Dashboard</a></li>
                  <li><a href="<?php echo base_url() ?>doctor/findpatient"> <i class="fa fa-search"></i> Find Patient</a></li>
                <?php } ?>

              <?php if($this->session->userdata('RoleId') == 1){ ?>
                <li><a href="<?php echo base_url() ?>home"> <i class="fa fa-stethoscope"></i>Dashboard</a></li>
                  <!-- <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url() ?>home">Dashboard</a></li>
                      <li><a href="index2.html">Profile</a></li>
                    </ul>
                  </li> -->
                
                  <li><a><i class="fa fa-group"></i> Patient Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>patient">Profile</a></li>
                      <li><a href="<?php echo base_url();?>lab">Laboratory Result</a></li>
                      <!-- <li><a href="<?php echo base_url();?>appointment">Appointment</a></li> -->
                      <li><a href="index3.html">Activities</a></li>
                    </ul>
                  </li>
              <?php } else{ ?>
                <li><a href="<?php echo base_url() ?>nurse"> <i class="fa fa-stethoscope"></i> Find Patient</a></li>
              <?php }?>

                  
                  <!-- <li><a><i class="fa fa-desktop"></i> Queries <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="general_elements.html">Patient History</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Reports <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Patient History</a></li>
                      <li><a href="tables_dynamic.html">TBA</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-cogs"></i> Configuration <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="form.html">Doctor</a></li>
                      <li><a href="form_advanced.html">Nurse</a></li>
                      <li><a href="form_validation.html">Specialization</a></li>
                      <li><a href="form_wizards.html">Patient</a></li>
                      <li><a href="form_upload.html">User Account</a></li>
                    </ul>
                  </li> -->
                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
       
            <!-- /menu footer buttons -->
          </div>
        </div>
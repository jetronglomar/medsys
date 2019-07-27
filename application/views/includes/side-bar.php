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
                <?php if($this->session->userdata('RoleId') == 1){ ?>
                  <span>Welcome Admin</span>
                <?php }
                else if($this->session->userdata('RoleId') == 2){ ?>
                  <span>Welcome Doctor</span>
                <?php }
                else if($this->session->userdata('RoleId') == 4){ ?>
                  <span>Welcome Pharmacist</span>
                <?php }
                  else if($this->session->userdata('RoleId') == 5){ ?>
                    <span>Welcome Patient's Guardian</span>
                  <?php }
                  else if($this->session->userdata('Nurse') == 3){?>
                    <span>Welcome Nurse</span>
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
                
                  <li><a><i class="fa fa-group"></i> Patient Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>patient">Profile</a></li>
                      <li><a href="<?php echo base_url();?>lab">Laboratory Result</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-cog"></i> System Setup <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>admin/user">User</a></li>
                    
                    </ul>
                  </li>
              <?php } else if($this->session->userdata('RoleId')==3){ ?>
                <li><a href="<?php echo base_url() ?>nurse"> <i class="fa fa-stethoscope"></i> Upcoming Activities</a></li>
                <li><a href="<?php echo base_url() ?>nurse/pendings"> <i class="fa fa-tasks"></i> Out of Stock Medicines</a></li>
              <?php } else if($this->session->userdata('RoleId') == 5){ ?>
                <li><a href="<?php echo base_url() ?>Kiosk"> <i class="fa fa-home"></i>Home</a></li>
              <?php } ?>

                  
             
                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
       
            <!-- /menu footer buttons -->
          </div>
        </div>
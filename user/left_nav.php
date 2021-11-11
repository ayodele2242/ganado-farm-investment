
    <!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
      <div class="brand-sidebar myimg" style="margin-bottom: 20px;">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="#">
        
                              <?php
                                  if(empty($set['logo'])){
                                  ?>
                                  <img src="../assets/logo/avatar.png" class="responsive-img">
                                <?php }else{
                                  ?>
                                  <img id="profile_pics"  data-holder-rendered="true" src="<?php echo $set['installUrl']; ?>assets/logo/<?php echo $set['logo']; ?>" class="responsive-img">
                                  <?php
                                 }
                              ?>
         <span class="logo-text hide-on-med-and-down">
          <?php
          if(!empty($name)){
            echo ucwords($name);
          }
          else{
            echo "Fagsoft Ltd.";
          }
          ?>
         

       </span></a><a class="navbar-toggler" href="#"><i class="material-icons col-white">radio_button_checked</i></a></h1>
      </div>
      <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">

        <li class="active bold"><a class="waves-effect waves-cyan " href="dashboard"><i class="material-icons" style="color: #fff;">settings_input_svideo</i><span class="menu-title" data-i18n="">Dashboard</span></a>
        </li>

         <li class="bold"><a class="waves-effect waves-cyan modal-trigger" href="active-plans"><i class="material-icons" style="color: #fff;">access_time</i><span class="menu-title" data-i18n="">Active Investment</span></a>
         
        </li>

         <li class="bold"><a class="waves-effect waves-cyan modal-trigger" href="awaiting-withdrawals"><i class="material-icons" style="color: #fff;">payment</i><span class="menu-title" data-i18n="">Awaiting Withdrawal</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan modal-trigger" href="paid-out"><i class="material-icons" style="color: #fff;">assignment_turned_in</i><span class="menu-title" data-i18n="">All Paid Out</span></a>
         
        </li>


             


      </ul>
      <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out" style="background: #007E33;"><i class="material-icons">menu</i></a>
    </aside>
    <!-- END: SideNav-->
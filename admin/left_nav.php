
    <!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
      <div class="brand-sidebar myimg">
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
          if(!empty($set['storeName'])){
            echo ucwords($set['storeName']);
          }
          else{
            echo "Fagstore";
          }
          ?>
         

       </span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
      </div>
      <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">

        <li class="active bold"><a class="waves-effect waves-cyan col-white" href="dashboard"><i class="material-icons" style="color: #fff;">settings_input_svideo</i><span class="menu-title" data-i18n="">Dashboard</span></a>
         
        </li>

  


             <?php foreach ($_SESSION["access"] as $key => $access) { ?>
                   <li class="bold"><a class="collapsible-header waves-effect waves-cyan col-white" href="#">
                    <?php 
                    if($access["top_menu_name"] == 'User'){
                    echo '<i class="material-icons" style="color: #fff;">people</i>';
                    }if($access["top_menu_name"] == 'Inventory'){
                      echo '<i class="material-icons" style="color: #fff;">add_shopping_cart</i>';
                    }if($access["top_menu_name"] == 'Checkout'){
                      echo '<i class="material-icons" style="color: #fff;">money</i>';
                    }if($access["top_menu_name"] == 'Sales'){
                      echo '<i class="material-icons" style="color: #fff;">shopping_cart</i>';
                    }
                     if($access["top_menu_name"] == 'Investors'){
                    echo '<i class="material-icons" style="color: #fff;">people</i>';
                    }
                    if($access["top_menu_name"] == 'Products'){
                      echo '<i class="material-icons" style="color: #fff;">list_alt</i>';
                    }if($access["top_menu_name"] == 'Slidders'){
                      echo '<i class="material-icons" style="color: #fff;">panorama</i>';
                    }
                    if($access["top_menu_name"] == 'Settings'){
                      echo '<i class="material-icons" style="color: #fff;">settings</i>';
                    }if($access["top_menu_name"] == 'Pages'){
                      echo '<i class="material-icons" style="color: #fff;">note</i>';
                    }
                    if($access["top_menu_name"] == 'Menu Categories'){
                      echo '<i class="material-icons" style="color: #fff;">dehaze</i>';
                    }
                    if($access["top_menu_name"] == 'Farm Plans'){
                      echo '<i class="material-icons" style="color: #fff;">view_list</i>';
                    }
                    if($access["top_menu_name"] == 'Biddings'){
                      echo '<i class="material-icons" style="color: #fff;">gavel</i>';
                    }
                    if($access["top_menu_name"] == 'Bidders'){
                      echo '<i class="material-icons" style="color: #fff;">people</i>';
                    }
                    ?>
                    <span class="menu-title" data-i18n="">
                        <?php echo $access["top_menu_name"]; ?>
                        <?php
                        echo '</span></a> 
                        <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion" >';
                        foreach ($access as $k => $val) {
                            if ($k != "top_menu_name") {
                                echo '<li><a class="collapsible-body col-white" href="' . ($val["page_name"]) . '" data-i18n="">' . $val["menu_name"] . '</a></li>';
                                ?>
                                <?php
                            }
                        }
                        echo '</ul></div>';
                        ?>
                    </li>
                    <?php
                }
                ?>

                <li class="bold"><a class="waves-effect waves-cyan col-white " href="messenger"><i class="material-icons" style="color: #fff;">message</i><span class="menu-title" data-i18n="Messenger">Messenger</span></a>
                </li>

                <li class="bold"><a class="collapsible-header waves-effect waves-cyan col-white" href="JavaScript:void(0)"><i class="material-icons" style="color: #fff;">settings_brightness</i><span class="menu-title" data-i18n="Advanced UI" style="color: #fff;">External Pages</span></a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              
              <li><a href="faqs" class="col-white"><i class="material-icons" style="color: #fff;">radio_button_unchecked</i><span data-i18n="Collapsibles">FAQs</span></a>
              </li>
              <li><a href="terms_conditions" class="col-white"><i class="material-icons" style="color: #fff;" >radio_button_unchecked</i><span data-i18n="Toasts">Terms & Conditions</span></a>
              </li>
              <li><a href="policy" class="col-white"><i class="material-icons" style="color: #fff;">radio_button_unchecked</i><span data-i18n="Toasts">Private Policy</span></a>
              </li>
                            
            </ul>
          </div>
        </li>


      </ul>
       <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out" style="background: #007E33;"><i class="material-icons">menu</i></a>
    </aside>
    <!-- END: SideNav-->
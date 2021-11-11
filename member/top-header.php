   <div class="nk-header nk-header-fluid nk-header-fixed is-theme  nk-header-fixed mb-3" style="background: #344106;">
                    <div class="container-xl wide-lg">
                        <div class="nk-header-wrap">
                           <!-- <div class="nk-menu-trigger mr-sm-2 d-lg-none">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon menu-btn" data-target="headerNav">
                                    
                                    <ion-icon class="icon" name="menu"></ion-icon>
                                </a>
                            </div>-->
                            <div class="nk-header-brand">
                                <a href="dashboard" class="logo-link">
                                    <img class="logo-light logo-img" src="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?>" srcset="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?> 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?>" srcset="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?> 2x" alt="logo-dark">
                                    
                                </a>
                            </div>
                            
                            <div class="nk-header-menu" data-content="headerNav">
                                <div class="nk-header-mobile">
                                    <div class="nk-header-brand">
                                        <a href="dashboard" class="logo-link">
                                            <img class="logo-light logo-img" src="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?>" srcset="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?> 2x" alt="logo">
                                            <img class="logo-dark logo-img" src="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?>" srcset="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?> 2x" alt="logo-dark">
                                            <span class="nio-version">Invest</span>
                                        </a>
                                    </div>
                                    <div class="nk-menu-trigger mr-n2">
                                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav">
                                            <em class="icon ni ni-arrow-left"></em>
                                        </a>
                                    </div>
                                </div>
                                <ul class="nk-menu nk-menu-main">
                                    <li class="nk-menu-item">
                                        <a href="dashboard" class="nk-menu-link">
                                            <span class="nk-menu-text">Overview</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="active-plans" class="nk-menu-link">
                                            <span class="nk-menu-text">MY Plans</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="invest" class="nk-menu-link">
                                            <span class="nk-menu-text">Invest</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="awaiting-withdrawals" class="nk-menu-link">
                                            <span class="nk-menu-text">Awaiting Withdrawal</span>
                                        </a>
                                    </li>


                                    
                                </ul>
                            </div>


                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                   
                                   
                                    <li class="dropdown user-dropdown order-sm-first">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <!--<ion-icon class="icon" name="person"></ion-icon>-->
                                                    <img src="<?php echo $myimg; ?>">
                                                   
                                                </div>
                                                <div class="user-info d-none d-xl-block">
                                                    <?php if($acno == ""){ ?>
                                                    <div class="user-status user-status-unverified">
                                                    Bank A/c Unverified
                                                    </div>
                                                    <?php }else{ ?>
                                                    <div class="user-status user-status-verified">
                                                    <ion-icon name="checkmark-circle"></ion-icon> Bank A/c Verified
                                                    </div>
                                                    <?php } ?>
                                                    <div class="user-name dropdown-indicator"><?php echo ucwords($name); ?></div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1 is-light">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span><?php echo initials($name); ?></span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text"><?php echo ucwords($name); ?></span>
                                                        <span class="sub-text"><?php echo obfuscate_email($email); ?></span>
                                                    </div>
                                                    <div class="user-action">
                                                        <a class="btn btn-icon mr-n2" href="profile">
                                                            <ion-icon class="icon" name="settings"></ion-icon>
                                                            
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                   
                                                   

                                                    <li class="mobi">
                                                        <a href="dashboard">
                                                            <ion-icon class="icon" name="apps-outline"></ion-icon>
                                                            <span>Overview</span>
                                                        </a>
                                                    </li>
                                                    <li class="mobi">
                                                        <a href="active-plans">
                                                            <ion-icon class="icon" name="stats-chart-outline"></ion-icon>
                                                            <span>My Plans</span>
                                                        </a>
                                                    </li>

                                                    <li class="mobi">
                                                        <a href="invest">
                                                           <ion-icon class="icon" name="cash-outline"></ion-icon>
                                                            <span>Invest</span>
                                                        </a>
                                                    </li>

                                                    <li class="mobi">
                                                        <a href="awaiting-withdrawals">
                                                          <ion-icon class="icon" name="calendar-outline"></ion-icon>
                                                            <span>Awaiting Withdrawal</span>
                                                        </a>
                                                    </li>

                                                    
                                                    
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li>
                                                        <a href="profile">
                                                            <ion-icon class="icon" name="settings"></ion-icon>
                                                            <span>Account Setting</span>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="profile-activity">
                                                            <ion-icon class="icon" name="stopwatch"></ion-icon>
                                                            <span>Login Activity</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner bg-red">
                                                <ul class="link-list">
                                                    <li class="">
                                                        <a href="logout" class="col-white">
                                                            <ion-icon class="icon" name="exit"></ion-icon>
                                                            <span>Sign out</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
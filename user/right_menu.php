<!-- START RIGHT SIDEBAR NAV -->
<aside id="right-sidebar-nav">
   <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
      <div class="row">
         <div class="slide-out-right-title">
            <div class="col s12 border-bottom-1 pb-0 pt-1">
               <div class="row">
                  <div class="col s2 pr-0 center">
                     <i class="material-icons vertical-text-middle"><a href="#" class="sidenav-close">clear</a></i>
                  </div>
                  <div class="col s10 pl-0">
                     <ul class="tabs">
                        <li class="tab col s4 p-0">
                           <a href="#messages" class="active">
                              <span>Messages</span>
                           </a>
                        </li>
                        <li class="tab col s4 p-0">
                           <a href="#settings">
                              <span>Settings</span>
                           </a>
                        </li>
                        
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="slide-out-right-body">
            <div id="messages" class="col s12">
               <div class="collection border-none">
                  <input class="header-search-input mt-4 mb-2" type="text" name="Search" placeholder="Search Messages" />
                  <ul class="collection p-0">
                     <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-online avatar-50"
                           ><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />
                           <i></i>
                        </span>
                        <div class="user-content">
                           <h6 class="line-height-0">AY</h6>
                           <p class="medium-small blue-grey-text text-lighten-3 pt-3">Thank you</p>
                        </div>
                        <span class="secondary-content medium-small">5.00 AM</span>
                     </li>
                     
                    
                  </ul>
               </div>
            </div>
            <div id="settings" class="col s12">
               <p class="mt-8 mb-0 ml-5 font-weight-900">GENERAL SETTINGS</p>
               <ul class="collection border-none">
                  <li class="collection-item border-none mt-3">
                     <div class="m-0">
                        <span>Notifications</span>
                        <div class="switch right">
                           <label>
                              <input type="checkbox" <?php echo $notify; ?> id="notification" value="notification" name="notification" />
                              <span class="lever"></span>
                           </label>
                        </div>
                     </div>
                  </li>
               
                  <li class="collection-item border-none mt-3">
                     <div class="m-0">
                        <span>Show Recent Activities</span>
                        <div class="switch right">
                      <label>
                        <input type="checkbox" <?php echo $active; ?> id="activity_status" value="activity_status" name="activity_status">
                        <span class="lever"></span>
                      </label>
                    </div>
                     </div>
                  </li>
                 
                  <li class="collection-item border-none mt-3">
                     <div class="m-0">
                        <span>Email Notifications</span>
                        <div class="switch right">
                           <label>
                              <input type="checkbox" <?php echo $es; ?> id="email_status" value="email_status" name="email_status" />
                              <span class="lever"></span>
                           </label>
                        </div>
                     </div>
                  </li>
               </ul>
               <p class="mt-8 mb-0 ml-5 font-weight-900">SYSTEM SETTINGS</p>
               <ul class="collection border-none">
                  
                  <li class="collection-item border-none mt-3">
                     <div class="m-0">
                        <span>Backup Database</span>
                        <div class="switch right">
                           <label>
                              <input type="checkbox" id="backup" name="backup_status" value="backup" />
                              <span class="lever"></span>
                           </label>
                        </div>
                     </div>
                  </li>
                 
               </ul>
            </div>
            
         </div>
      </div>
   </div>

   <!-- Slide Out Chat -->
   <ul id="slide-out-chat" class="sidenav slide-out-right-sidenav-chat">
      <li class="center-align pt-2 pb-2 sidenav-close chat-head">
         <a href="#!"><i class="material-icons mr-0">chevron_left</i>Elizabeth Elliott</a>
      </li>
      <li class="chat-body">
         <ul class="collection">
            <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
               <span class="avatar-status avatar-online avatar-50"
                  ><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />
               </span>
               <div class="user-content speech-bubble">
                  <p class="medium-small">hello!</p>
               </div>
            </li>
            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
               <div class="user-content speech-bubble-right">
                  <p class="medium-small">How can we help? We're here for you!</p>
               </div>
            </li>
            
            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
               <div class="user-content speech-bubble-right">
                  <p class="medium-small">https://pixinvent.ticksy.com/</p>
               </div>
            </li>
         </ul>
      </li>
      <li class="center-align chat-footer">
         <form class="col s12" onsubmit="slide_out_chat()" action="javascript:void(0);">
            <div class="input-field">
               <input id="icon_prefix" type="text" class="search" />
               <label for="icon_prefix">Type here..</label>
               <a onclick="slide_out_chat()"><i class="material-icons prefix">send</i></a>
            </div>
         </form>
      </li>
   </ul>
</aside>
<!-- END RIGHT SIDEBAR NAV -->


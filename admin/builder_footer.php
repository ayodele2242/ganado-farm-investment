
     <!-- Logout div starts here -->
<div class="modal" id="signOut" >
        <div class="modal-content">
            <div class="modal-body">
                <p class="lead">Hello <strong><?php echo ucwords($name).' </strong>'. $signOutQuip; ?></p>
            </div>
            <div class="modal-footer">
                <a href="logout" class="btn btn-danger btn-small btn-icon-alt"><?php echo $signOutBtn; ?> <i class="fa fa-sign-out"></i></a>
                <button type="button" class="btn btn-default btn-small btn-icon" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo $cancelBtn; ?></button>
            </div>
        </div>
</div><!-- Logout div ends here -->
    

    <!-- END: Footer-->
    <script src="../assets/default/main/js/vendors.min.js" type="text/javascript"></script>
    <script src="../assets/default/main/js/plugins.js" type="text/javascript"></script>
    <script src="../assets/default/main/js/dashboard-modern.js" type="text/javascript"></script>
  
    <script src="../assets/default/main/js/customizer.js" type="text/javascript"></script>
    <script type="text/javascript" src="../assets/js/custom.js"></script>  
    
   
   

   
  

   
  </body>
</html>
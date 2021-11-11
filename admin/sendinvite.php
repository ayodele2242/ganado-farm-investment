<?php include('header.php'); ?>
<?php include('top.php'); ?>
<?php include('links.php'); ?>
   
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2><i class="fa fa-envelope" aria-hidden="true"></i> Send Email/SMS Message</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="">
                <?php
                //to run PHP script on submit       


                if(!empty($_POST['mailcheckbox'])){

                // Counting number of checked checkboxes.

                $checked_count = count($_POST['mailcheckbox']);
											//echo "You have selected following ".$checked_count." option(s): <br/>";
												// Loop to store and display values of individual checked checkbox.
                $addr ="";
                $phone="";
                foreach($_POST['mailcheckbox'] as $selected){
                $sq = mysqli_query($mysqli,"select email,cell_phone from alumni_users where user_id = '$selected'");
                $rs = mysqli_fetch_array($sq);
                $addr .= $rs['email'].";";
                $phone.="234".substr($rs['cell_phone'], 1).",";

                $_SESSION['addr'] = $addr;
                $_SESSION['phone'] = $phone;
												 
				}
							
												
												
                }
                ?>

<div class="profile">   
<ul class="nav nav-tabs" id="myTab">
<li class="active"><a data-toggle="tab" href="#sectionA" style="font-weight:bolder;"><i class="fa fa-envelope"></i> Email</a></li>
<li><a data-toggle="tab" href="#sectionC" style="font-weight:bolder;"><i class="fa fa-comment" ></i> SMS</a></li>
</ul>

<div class="tab-content card">
<div id="sectionA" class="tab-pane fade in active " ><!--Email-->
<div id="error"></div>
<div class="inform"></div>
<form   id="mail-form" class="form-vertical">
                                        
                                        
										<div class="form-group">
                                        <div class="form-line">
										<input type="text" class="form-control" value="<?php $addr1 = substr($_SESSION['addr'], 0, -1); echo $addr1; ?>"  id="typehead" name="email" readonly placeholder="To"/>
                                        </div>
                                         </div>
                                        
										<div class="form-group">
                                        <div class="form-line">
										<input type="text" class="form-control" name="subject" id="subject"  placeholder="Subject">
                                        </div>
                                        </div>
										
										<div class="form-group">
										<textarea class="form-control" rows="8" name="body"  id="body"   placeholder="Message"></textarea>
										</div>

                                        <div class="form-group">
                                        
                                        <div align="center">
	                                     <button type="submit" class="btn btn-info"  id="btn-submit">
	                                       <span class="glyphicon glyphicon-envelope"></span> &nbsp; Send Mail
                                          </button> 
                                        </div>
	                                    </div>

</form>        
</div><!--#End Email-->

<div id="sectionC" class="tab-pane fade"><!--SMS-->
<div id="errors" ></div>
<form  id="sms-form">
									
										<div class="form-group">
																
											<div class="controls">
												<input type="text" class="form-control" value="<?php $_SESSION['phone'] = substr($_SESSION['phone'], 0, -1); echo $_SESSION['phone']; ?>"  id="typehead" name="phone" readonly placeholder="Phone"/>
											</div>
										</div>
										<div class="form-group">
                                        <div class="form-line">
												<input type="text" class="form-control" id="subject_sms" name="subject_sms" value="OSUN JOB CENTER" placeholder="SMS Title" >
											</div>
										</div>
										
										<div class="form-group">
                                        <span class="control-label" id="charLeft" class="charsRemaining"></span> Characters left
                                        <div class="form-line">
											<textarea class="form-control countit" rows="3"  id="body_sms" name="body_sms"   placeholder="Message"></textarea>
											</div>
										</div>
										<div>
                                        <div class="form-group" align="center">
											<button type="submit" id="btn-submits" class="btn btn-info" name="sendinvite"><i class="fa fa-comment"></i> Send</button>
											
                                        </div>
                                        </div>
									
								</form>

</div><!--#End SMS-->

</div>

</div>


                
           </div>
            </div>
            </div>


        </div>
    </section>

<script src="../afiles/js/pages/forms/editors.js"></script>
<?php include('footer.php'); ?>    

   
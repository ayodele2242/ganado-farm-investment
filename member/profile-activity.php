<?php
include("header.php");
include("top-header.php");
$limit = 1000;
$log = activitiesLog($id, $limit);
$query = mysqli_query($mysqli,"select * from members where id='$id'");
$row = mysqli_fetch_array($query);

if(empty($row['img'])){
  $img = $set['installUrl'].'assets/logo/avatar.png';
}else{
   $img = $set['installUrl'].'assets/images/'.$row['img'];
}
?>


<div class="nk-content nk-content-lg nk-content-fluid">
<div class="container-xl wide-lg">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                   
                    <h2 class="nk-block-title fw-normal">Activities</h2>
                    <div class="nk-block-des">
                        <p>
                            This information about the last login activity on your account.
                           
                        </p>
                    </div>
                </div>
            </div>


 <table class="table table-ulogs">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="tb-col-os">
                                                        <span class="overline-title">
                                                            Browser <span class="d-sm-none">/ IP</span>
                                                        </span>
                                                    </th>
                                                    <th class="tb-col-ip">
                                                        <span class="overline-title">IP</span>
                                                    </th>
                                                    <th class="tb-col-time">
                                                        <span class="overline-title">Time</span>
                                                    </th>
                                                    <th class="tb-col-action">
                                                        <span class="overline-title">&nbsp;</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if(!$log){
                                                    echo '<tr><td colspan="3">No Logs Available.</td></tr>';
                                                }else{
                                                foreach ($log as $logs) { ?>
                                                <tr>
                                                    <td class="tb-col-os"><?php echo $logs['browser']; ?></td>
                                                    <td class="tb-col-ip">
                                                        <span class="sub-text"><?php echo $logs['ip']; ?></span>
                                                    </td>
                                                    <td class="tb-col-time">
                                                        <span class="sub-text">
                                                            <?php echo $logs['log_time']; ?>
                                                        </span>
                                                    </td>
                                                    <td class="tb-col-action">
                                                       
                                                    </td>
                                                </tr>
                                                <?php }

                                                } ?>
                                            </tbody>
                                        </table>






        </div>
    </div>
</div>
</div>







<?php
include("footer.php");
?>
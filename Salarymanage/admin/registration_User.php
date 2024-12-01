<?php include 'header/header_startding.php';?> 
<link rel="stylesheet" href="../admin/css/allCommon.css">
<!-- model -->
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<style> .modal-header {  display: flex;justify-content: space-between;align-items: center;}
.close {color: brown;}.close:hover{color: brown;}</style>
 <!--End model  -->
<div class="table_data_print">
    <div class="panel panel-primary">
        <div class="panel-heading">Register User List
        <a href="registration_user_by_admin.php"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Add User</a>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover" id="table_registration_User">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php               
            $sql="SELECT * FROM `registration_user`";
            $querry= mysqli_query($con,$sql);
            $row=mysqli_num_rows($querry);
            if( $row)
            {
              $s_no=0;
              while($res=mysqli_fetch_array($querry))
              {
                $s_no++;
                ?>
                  <tr>
                    <td><?php  echo $s_no  ; ?></td>                    
                    <td><?php  echo $res['Fname']; ?></td>
                    <td><?php  echo $res['Lname']; ?></td>
                    <td><?php  echo $res['email']; ?></td>
                    <td><?php  echo $res['mobile']; ?></td>
                    <td><?php
                            if(!empty($res['image_path'])){?>
                            <button type="button" style="font-size: 12px;" class="btn btn-link" data-toggle="modal" data-target="#myModal<?php echo $res['id'] ?>"><u>View</u></button>
                            <?php }else{echo"-";}?></td>
                    <td >                      
                      <button class="fa fa-edit btn_fa" onclick="checkAccept(<?php  echo $res['id'];   ?>)" title="Edit" style="font-size:20px;" >
                    <button class="fa fa-times-circle btn_fa" onclick="checkDelete(<?php  echo $res['id'];  ?>)" title="Delete" style="font-size:23px;"></td>
                  </tr>
                  <!-- //  here i am creating a modal popup code......... -->
                  <div id="myModal<?php echo $res['id'] ?>" class="modal" role="dialog">
                  <div class="modal-dialog">
                      <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Details</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                        <h3>Name :<?php echo $res['Fname'].' '.$res['Lname'];?></h3>
                        <h3>Mobile Number :<?php echo $res['mobile']; ?> </h3>
                        <h3>Email : <?php echo $res['email']; ?> </h3>
                        <div class="div_img">
                          <?php 
                          $image_path = "../API/uploads/" . $res['image_path'];
                          if (file_exists($image_path)) { ?>
                            <img class="image_showing_list" src="../API/uploads/<?php echo $res['image_path']?> " alt="image not found " width="200" height="200">
                          <?php }else{?> 
                            <img class="image_showing_list" src="../API/uploads/default_image.jpg" alt="image not found " width="200" height="200">
                          <?php }?>
                        </div>
                        </div>
                    </div>
                  </div>
                  </div>
                  <!-- // end modal popup code........ -->
                <?php
              }
            }
            else{ ?> <h3 style="color: red;"> Register User records are not available </h3> <?php } ?>                     
                </tbody>
            </table>
            
        </div>
    </div>
</div>
<?php // include 'image_popup.php';?>
<?php include 'header/header_ending.php';?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
function checkDelete(x){
  var y = confirm('Are you sure Delete the recoard ?');
  if(y){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "delete_regiter_user.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function(){
      if (xhr.readyState === 4 && xhr.status === 200){window.location.href = "registration_User.php";} 
      else if (xhr.readyState === 4) {console.log("Error Deleting status"); }
    };
    xhr.send("id=" + x);
  }
}
function checkAccept(x){
  var y = confirm('Are you sure \nYoy Are Update the recoard ?');
  if(y){window.location.href = "user_registration_by_admin.php?id="+x;}
  else{window.location.href = "registration_User.php";}
}
</script>
<script>
  $(document).ready(function(){let table = new DataTable('#table_registration_User');});
</script>

<?php include 'header/header_startding.php';?> 
<div class="table_data_print">
    <div class="panel panel-primary">
        <div class="panel-heading">
          List Of User Notes
        </div> 
        <div class="panel-body table-responsive">
            <table class="table table-hover" id="table_adminUser">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date Of Birth </th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php               
            $sql="SELECT * FROM registration_user WHERE id IN (SELECT user_id FROM notes );";
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
                    <td><?php  echo $res['dob_date']; ?></td>
                    <td><?php  echo $res['email']; ?></td>
                    <td><?php  echo $res['mobile']; ?></td>                 
                    <td >                      
                        <a href="list_notes_page.php?id=<?php  echo $res['id']; ?>">View</a>
                  </tr>
                <?php
              }
            }
            else{ ?> <h3 style="color: red;"> Admin User  records are not available </h3> <?php } ?>                      
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'header/header_ending.php';?>
<script type="text/javascript">
function checkDelete(x){
  var y = confirm('Are you sure Delete the recoard ?');
  if(y){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "delete.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function(){
      if (xhr.readyState === 4 && xhr.status === 200){window.location.href = "adminUser.php"; } 
      else if (xhr.readyState === 4) {console.log("Error Deleting status"); }
    };
    xhr.send("id=" + x);
  }
}
function checkAccept(x){
  console.log(x);  
  var y = confirm('Are you sure \nYoy Are Update the recoard ?');
  if (y) { window.location.href = "adminEdit.php?id="+x;}else{ window.location.href = "adminUser.php"; }
}
</script>
<script>
  $(document).ready(function(){let table = new DataTable('#table_adminUser'); 
  });
</script>
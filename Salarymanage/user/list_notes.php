<?php include 'header/header_startding.php';?> 
<link rel="stylesheet" href="../user/css/allCommon.css">
<?php  $id = !empty($_GET['id'])?$_GET['id']:'';
    $urlname = !empty($_GET['urlname'])?$_GET['urlname']:'';
    if($urlname == 'noteedit'){
        $sql  ="SELECT * FROM notes WHERE `id`={$id}";
        $showdata = mysqli_query($con,$sql);
        $arrdata=mysqli_fetch_array($showdata);
    }
    function testt($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<div class="container mt-5 addnotes">
    <form action="" method="post" id="admin_form">
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter amount" value="<?= !empty($arrdata['amount'])?$arrdata['amount']:''; ?>" onkeypress="return isNumberKey(event)" autocomplete="off">
            </div>
            <div class="col-md-9">
                <label for="description" class="form-label">Description<span class="star">*</span></label> <p id="errors_description" class="field_erros"></p>
                <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter description"><?= !empty($arrdata['description'])?$arrdata['description']:''; ?></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between">
                <input type="submit" value="<?= ($urlname == 'noteedit')?'Update':'Submit'?>" name="submit" class="btn btn-primary">
                <?php if($urlname == 'noteedit'){ ?> <a href="list_notes.php" class="btn btn-info">Cancle Edit </a> <?php }else{?> <button type="reset" class="btn btn-secondary" onclick="resetall()">Reset</button><?php } ?>
                
            </div>
        </div>
    </form>
</div>
<div class="container mt-4 addnotes"  style="max-height: 500px; overflow-y: auto;">
    <?php  $sql="SELECT * FROM `notes` WHERE `user_id` =".$userData['id']." ORDER BY notes.id DESC";
        $querry= mysqli_query($con,$sql);
        $row=mysqli_num_rows($querry);
        if( $row){while($res=mysqli_fetch_array($querry)){?> 
        <div class="listnotes md-1 ">
            <!-- <strong> <?php  echo $res['amount']; ?> </strong>  <p class="mb-0"><?php  echo $res['date']; ?></p></br> -->
            <div class="note-header">
                    <strong><?php echo $res['amount']; ?></strong>
                    <span class="date-text"><?php echo $res['date']; ?></span>
            </div>
            <p style="color: black; font-family: 'Times New Roman', Times, serif;"> <?php  echo $res['description']; ?> </p>
            <div class="iconsectionnotes d-flex justify-content-end align-items-end ">
                <!-- <a href="#" class="btn btn-sm btn-light mr-2"><i class="fa fa-edit"  aria-hidden="true" style="font-size:20px;color:blue"></i></a>
                <a href="#" class="btn btn-sm btn-light"><i class="fa fa-trash"  aria-hidden="true" style="font-size:20px;color:red"></i></a> -->
                <button class="fa fa-edit btn_fa" onclick="checkAccept(<?php  echo $res['id'];   ?>,'noteedit')" title="Edit" style="font-size:20px;" >
                <button class="fa fa-trash btn_fa" onclick="checkDelete(<?php  echo $res['id'];  ?>,'notesdelete')" title="Delete" style="font-size:23px;;color:red;">
            </div>
        </div>
    <?php   } } else{ ?> <h3 style="color: gray; text-align: center;"> Notes not found !! <br> Please add Notes...</h3> <?php } ?> 
</div>

<?php include 'header/header_ending.php';?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    function resetall(){
         $('#description').val('');
        $('#errors_description').text('');
    }
    function checkDelete(x,name){
    var y = confirm('Are you sure Delete the recoard ?');
    if(y){
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "delete.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            Swal.fire({
              icon: 'success',
              title: 'Successfully Deleted',
              showConfirmButton: false,
              timer: 1500
            }).then(function() {
              window.location.href = "list_notes.php";
            });
          } else {
            console.log("Error Deleting status");
          }
        }
      };
      var params = "id=" + encodeURIComponent(x) + "&urlname=" + encodeURIComponent(name);
    xhr.send(params);
    }
  }
    $('#admin_form').on('submit', function(event) {
        let isValid = true;
        let description = $('#description').val().trim();
        $('#errors_description').text('');
        if (description === '') {
            $('#errors_description').text('Please enter a Description.');
            isValid = false;
        }
        if (!isValid) {
            event.preventDefault();
        }
    });
    $('#description').on('input', function() {
        let description = $(this).val().trim();
        if (description !== '') {
            $('#errors_description').text('');
        }else{
            $('#errors_description').text('Please enter a Description.');
        }
    });

    function checkAccept(x,urlname){
    var y = confirm('Are you sure \nYoy Are Update the recoard ?');
    if(y){window.location.href = "list_notes.php?id="+x+ "&urlname=" + urlname;}
    else{window.location.href = "list_notes.php";}
  }
</script>
<?php
if(isset($_POST['submit']))
{   $error = [];
    $id = !empty($_GET['id'])?$_GET['id']:'';
    $urlname = !empty($_GET['urlname'])?$_GET['urlname']:'';    
    if(!empty($userData['email']) && !empty($userData['mobile']) && !empty($userData['id']) ){
        $description = !empty($_POST['description'])?$_POST['description']:'';
        $amount = !empty($_POST['amount'])?$_POST['amount']:'';
        $uiser_email = $userData['email'];
        $user_id = $userData['id'];
        $user_mobile = $userData['mobile'];
        $date = date('Y-m-d');
        $update_at = date('Y-m-d H:i:s');
        $create_at = date('Y-m-d H:i:s');
        if(!empty($id) && !empty($urlname)){
            if(!empty($user_id) && !empty($uiser_email) && !empty($user_mobile)){
                
                $update = "UPDATE `notes` SET `id`='$id',`user_id`='$user_id',`amount`=' $amount',`description`='$description',`date`='$date',`update_at`='$update_at' WHERE `id`={$id}";
                $res=mysqli_query($con,$update);   
                $message = "Updatation has been successful.";     
                $error_massage = "Your record has not been Updated !</br>Please Try Again ";}
            else{$res = false;$error_massage = "Your record has not been Updated !</br>Please Try Again "; }
        }else{
            if(!empty($user_id) && !empty($uiser_email) && !empty($user_mobile)){
                $insert = "INSERT INTO `notes` (`user_id`, `amount`, `description`, `date`) VALUES ('$user_id','$amount','$description','$date')";
                $res=mysqli_query($con,$insert);
                $message = "Successful Adds Your Notes."; 
                $error_massage = "Your Notes has not been Saved !</br>Plase Try Again";
            }else{$res = false;$error_massage = "Your record has not been Updated !</br>Please Try Again "; }
        }
    }
    if($res){ ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: '<?php echo $message; ?>',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = "list_notes.php";
                });
            });
        </script>   
        <?php }else{ ?> <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: '<?php echo $error_massage; ?>',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    var id = <?php echo $id ;?>;
                    var url = '<?php echo $urlname;?>';
                    window.location.href = "list_notes.php?id="+id+ "&urlname=" + url;
                });
            });
        </script><?php }
}
?>
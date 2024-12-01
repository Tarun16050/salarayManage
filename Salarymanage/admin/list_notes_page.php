<?php include 'header/header_startding.php';?> 
<link rel="stylesheet" href="../admin/css/allCommon.css">
<?php 
    $id = !empty($_GET['id'])?$_GET['id'] : 0;
    if($id){
        $sql="SELECT * FROM registration_user WHERE id = '$id'";
        $querry= mysqli_query($con,$sql);
        $user_data=mysqli_fetch_array($querry);     
    }
?>
<div class="container mt-5 addnotes">
    <p style="color: black; font-family: 'Times New Roman', Times, serif;">Name : <?php echo $user_data['Fname'].' '.$user_data['Lname']; ?> </p>
    <p style="color: black; font-family: 'Times New Roman', Times, serif;">Email : <?php echo $user_data['email']; ?> </p>
    <p style="color: black; font-family: 'Times New Roman', Times, serif;">Mobile No. : <?php echo $user_data['mobile']; ?> </p>
</div>
<div class="container mt-4 addnotes"  style="max-height: 500px; overflow-y: auto;">
    <?php  
    $sql="SELECT * FROM `notes` WHERE `user_id` =".$id." ORDER BY notes.id DESC";
    $querry= mysqli_query($con,$sql);
    $row=mysqli_num_rows($querry);
        if( $row){while($res=mysqli_fetch_array($querry)){?> 
        <div class="listnotes md-1 ">
            <div class="note-header">
                    <strong><?php echo $res['amount']; ?></strong>
                    <span class="date-text"><?php echo $res['date']; ?></span>
            </div>
            <p style="color: black; font-family: 'Times New Roman', Times, serif;"> <?php  echo $res['description']; ?> </p>
        </div>
    <?php   } } else{ ?> <h3 style="color: gray; text-align: center;"> Notes not found !! <br> Please add Notes...</h3> <?php } ?> 
</div>
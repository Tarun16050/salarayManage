<?php
    class DbConnect{
        private $con;
        function __construct(){ }
        function connect(){
            include_once dirname(__FILE__).'/Constant.php';
            $this->con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
            if(mysqli_connect_error()){ ?> <script>swal.fire("DataBase Is Not Connent \n <?php mysqli_connect_error(); ?>");</script> <?php }
            return $this->con;
        }
    }
?>
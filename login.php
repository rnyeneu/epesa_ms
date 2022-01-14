<?php 
 include('db/connect_db.php');
session_start();
    if(isset($_POST['btn_login']))
    {
       if(empty($_POST['username']) || empty($_POST['password']))
       {
            header("location:index.php?Empty= Please Fill in the Blanks");
       }
       else
       {
            $query="select * from users where username='".$_POST['username']."' and password='".$_POST['password']."'";
            $result=mysqli_query($db,$query);

            if($row = mysqli_fetch_assoc($result))
            {
					$_SESSION['username']=$_POST['username'];
					$_SESSION['user_id']=$row['user_id'];
					$_SESSION['fullname']=$row['fullname'];
					$_SESSION['role']=$row['role'];
               header('location:app/index.php');
            }
            else
            {
                header("location:index.php?Invalid= Please enter correct Username and Password ");
            }
       }
    }
    else
    {
        echo 'Not Working Now Guys';
    }

?>
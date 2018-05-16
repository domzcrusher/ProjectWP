<?php

require_once "core/init.php";
require_once "view/header_admin.php";

$error = '';

if (isset($_POST['submit'])) {
	$user  = $_POST['user'];
	$pass  = $_POST['pass'];

	if (!empty(trim($user)) && !empty(trim($pass))) {

		if (cek_data($user, $pass)) {
      session_start();
      $_SESSION['user'] = $user;
			$_SESSION['status'] = "login";
			header('Location: index.php');
		}else{
			header('Location: login_admin.php');
		}
	}else{
		$error = 'Username & Password wajib diisi';
	}
}
 ?>

 <div class="container">
   <div class="row">
     <div class="col-md-4 col-md-offset-4">
       <div class="panel panel-info" style="margin-top:150px; margin-bottom:50px;">
         <div class="panel-heading" style="background-color:#000000; color:white;">
             <h3 class="text-center">Cek Data Pegawai</h3>
         </div>
         <div class="panel-body">
           <form action="" method="post">
             <div class="form-group">
               <label for="nama"><h5>Pengguna</h5></label> <br>
               <input type="text" name="user" class="form-control" placeholder="Pengguna" required> <br> <br>

               <label for="password"><h5>Katasandi</h5></label> <br>
               <input type="password" name="pass" class="form-control" placeholder="*******" required> <br> <br>

               <div id="error"><?= $error  ?></div>

               <div class="text-center">
                 <input type="submit" name="submit" class="btn btn-primary" value="Login" style="background-color:#000000; color:#65ff00; width:200px;">
               </div>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>

<?php
require_once "view/footer.php";

 ?>

<?php
session_start();
	include 'koneksi.php';
	$username = $_POST['username'];
	$pass     = $_POST['password'];
	$cekuser  = mysql_query("SELECT * FROM admin WHERE username = '$username'");

	$jumlah   = mysql_num_rows($cekuser);
	$hasil    = mysql_fetch_array($cekuser);
	if($jumlah == 0) {
		?>
             <script language="JavaScript">
				alert('admin tidak tersedia');
				window.location=history.go(-1);
			</script>
		<?php
	} else {
			if($pass <> $hasil['password']) {
				?>
		             <script language="JavaScript">
						alert('Password Salah');
						window.location=history.go(-1);
					</script>
				<?php
			} else {
				$_SESSION['username'] = $hasil['username'];
				header('location:dashboard.php');
			}
	}
?>


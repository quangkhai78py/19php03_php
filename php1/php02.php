<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		p{
			width: 10%;
			display: inline-block;
			margin-left:526px;
			font-size: 20px;
			font-weight: bold; 
		}
		div{
			text-align: center;
			margin-top: 50px;			
		}
		div a{
			text-decoration: none;	
			color: red;

		}
	</style>
</head>
<body>
	<?php
		session_start();

		if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {

			if (!empty($_POST['name']) && !empty($_POST['gender']) && !empty($_POST['address']) && !empty($_POST['birthday']) && !empty($_POST['email'])) {
	?>	
			<h1 style="color: green;width: 50%; margin-left: 375px;">Chúc Mừng Bạn Đăng Kí Thành Công</h1>
			<p>Tên: </p><span><?php echo $_POST['name']; ?></span>
			<p>Giới Tính:</p>
				<span>
					<?php 	
					if ($_POST['gender'] == 1) {
						echo "Nam";
					}elseif ($_POST['gender'] == 2) {
						echo "Nữ";
					}elseif ($_POST['gender'] == 3) {
						echo "Giới Tính Khác";
					} 	
					?>	
				</span>
			<p>Thành Phố:</p>
				<span>
					<?php  
					if ($_POST['address'] == 1) {
						echo "Hà Nội";
					}elseif ($_POST['address'] == 2) {
						echo "Đà Nẵng";
					}elseif ($_POST['address'] == 3) {
						echo "Vũng Tàu";
					}elseif ($_POST['address'] == 4) {
						echo "TP.Hồ Chí Minh";
					}
					?>
				</span>
			<p>Ngày Sinh:</p>
				<span><?php echo $_POST['birthday']; ?></span>
			<p>Email:</p>
				<span><?php echo $_POST['email']; ?></span>
			
			<div>
				<span><a href="php03.php"><----Trở Lại</a></span>
			</div>		
	<?php			
			}
		}else{
			echo "vui lòng nhập thông tin đăng kí";
			echo '<a href="php01.php"><----Trở Lại</a>';
		}
	?>
</body>
</html>
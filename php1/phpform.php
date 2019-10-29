

<?php
	if (isset($_POST['sum'])) {
		if (!empty($_POST['number1'])) {
			$number1 = $_POST['number1'];
		}else{
			echo "vui lòng nhập số number 1".'</br>';
		}

		if (!empty($_POST['number2'])) {
			$number2 = $_POST['number2'];
		}else{
			echo "vui lòng nhập number 2".'</br>';
		}

		if (!empty($_POST['number1']) && !empty($_POST['number2'])) {
			$result =  $number1 + $number2;
		}

		if (!empty($result)) {
			echo $result;
		}
	}
?>
<h1>Calculator</h1>
<form method="POST" action="#">
	<div style="margin-bottom: 10px;">
		<input type="number" placeholder="Number 1" name="number1" />
	</div>
	<div style="margin-bottom: 10px;">
		<input type="number" placeholder="Number 2" name="number2" />
	</div>
	
	<button name="sum" type="submit" style="margin-right: 20px" class="btn btn-default">Login</button>
</form>
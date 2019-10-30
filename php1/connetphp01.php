<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
	.signup-form{
		width: 50%;
   	 	margin: 0 377px;
	}
	h2{
		margin-left: 250px;
	}
	form{
		width: 100%;
		display: inline-block;
	}
	p{
		width: 20%;
		display: inline-block;

	}
	select{
		width: 79%;
		display: inline-block;
	}
	input{
		width: 78%;
		display: inline-block;
	}
	textarea{
		width: 78%;
		display: inline-block;
		height: 60px;
	}
	button{
		margin-left: 260px;
	}
	span{
		width: 100%;
    	display: inline-block;
    	margin-left: 300px;
    	color: red;
	}
</style>
<body>
</body>
	<?php
	//kết nối database.
	include "connectdatabase.php";

		$errorCategoty = '';
		$errorSize = '';
		$errorProduct = '';
		$errorPrice = '';
		$errorQuantily = '';
		$errorImage = '';
		$errorCreateDate = '';
		$errorOverDate = '';
		$errorDescription = '';
		$productName = '';
		$price = '';
		$quantily = '';
		$createDate = '';
		$overDate = '';
		$description = '';
		if (isset($_POST['submit'])) {

			$date = date('Y-m-d  H:i:s');
			//validate thể loại sản phẩm
			if (!empty($_POST['category_id'])) {
				$category = $_POST['category_id'];	

			}else{
				$errorCategoty = 'vui lòng chọn thể loại sản phẩm';
			}

			//validate size sản phẩm
			if (!empty($_POST['size_id'])) {
				$size = $_POST['size_id'];	
			}else{
				$errorSize = 'vui lòng chọn size cho sản phẩm';
			}

			//validate tên sản phẩm
			if (!empty($_POST['product'])) {		
				if (strlen($_POST['product']) < 3 || strlen($_POST['product']) > 100) {
					$errorProduct = 'tên sản phẩm không được quá 3 hoặc hơn 100 ký tự';		
				}else{
					$productName = $_POST['product'];
				}			
			}else{
				$errorProduct = 'vui lòng nhập tên sản phẩm';
			}

			//validate giá sản phẩm
			if (!empty($_POST['price'])) {
				if (is_numeric($_POST['price'])) {
					if (strlen($_POST['price']) < 0 || strlen($_POST['price']) > 15) {
						$errorPrice = 'giá tiền không hợp lệ';
					}else{
						$price = $_POST['price'];
					}
				}else{
					$errorPrice = 'giá sản phẩm không hơp lệ';
				}
			}else{
				$errorPrice = 'vui lòng nhập giá sản phẩm';
			}

			//validate số lượng sản phẩm đăng kí
			if (!empty($_POST['quantily'])) {
				$quantily = $_POST['quantily'];
			}else{
				$errorQuantily = 'vui lòng nhập số lượng sản phẩm';
			}

			//validate mô tả sản phẩm
			if (!empty($_POST['description'])) {
				$description = $_POST['description'];
			}else{
				$errorDescription = 'vui lòng nhập description';
			}

			//validate ngày tạo sản phẩm
			if (!empty($_POST['createDate'])) {
				$createDate = $_POST['createDate'];
			}else{
				$errorCreateDate = 'vui lòng nhập ngày đăng sản phẩm';
			}

			//validate ngày hết hản sản phẩm
			if (!empty($_POST['overDate'])) {
				if ($_POST['overDate'] < $createDate) {
					$errorCreateDate = 'ngày hết hạn không được nhỏ hơn ngày đăng';
				}else{
					$overDate = $_POST['overDate'];
				}
			}else{
				$errorOverDate = 'vui lòng nhập ngày hết hạn sản phẩm';
			}

			//file size của file ảnh
			$maxfilesize   = 1000000; //(bytes)	
			//mảng đuôi của file ảnh		
			$allowtypes    = array('jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG');
				
			$getName = '';
			$getTmp='';
			
			//validate file ảnh
			if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) 
			{	
				//lấy name của file ảnh
				$getName = $_FILES['image']['name'];
				//lấy đuôi của file ảnh
				$ext = pathinfo($getName, PATHINFO_EXTENSION);	

				//1 MB = 1,000,000 bits/bytes
				//valide size file ảnh	
				if ($_FILES["image"]["size"] > $maxfilesize) {				
				    $errorImage =  "Không được upload ảnh lớn hơn". " " .$maxfilesize ;
				//validate đuôi file ảnh  
				} else if (!in_array($ext,$allowtypes )) {
				    $errorImage = "Chỉ được upload các định dạng jpg, png, jpeg, JPG, PNG, JPEG";
				} else {
					//lưu vào bộ nhớ tạm file ảnh
					$getTmp = $_FILES['image']['tmp_name'];					
				}					
				
			}else{
				$errorImage = "vui lòng chọn file upload <br>";
			}


			if (!empty($category) && !empty($size) && !empty($productName) && !empty($price) && !empty($quantily) && !empty($createDate) && !empty($overDate) && !empty($description) && !empty($getName)) {

				$sql_product = 
				"
				INSERT INTO `product`(
					`category_id`, 
					`size_id`, 
					`product`, 
					`price`, 
					`quantily`, 
					`createdate`, 
					`overdate`, 
					`image`, 
					`created_at`, 
					`update_at`) 
				VALUES (
					'".$category."',
					'".$size."',
					'".$productName."',
					'".$price."',
					'".$quantily."',
					'".$createDate."',
					'".$overDate."',
					'".$getName."',
					'".$date."',
					'".$date."'
					)
				";

				$result = $con->query($sql_product);
				if ($result) {
				 	$path = "upload/avatar/".$getName;
		            move_uploaded_file($getTmp, $path);       
		            echo "chúc mừng bạn đăng kí thành công";
				}
			}
		}
	?>
	<div class="signup-form"><!--sign up form-->
		<h2>Create Product</h2>
		<form action="" method="POST" enctype="multipart/form-data">
			
			<p>Category:</p>
			<select name="category_id">
				<option></option>
				<option value="1" <?= isset($_POST['category_id']) && $_POST['category_id'] == 1 ? "selected" : '' ?>>Mens</option>
				<option value="2" <?= isset($_POST['category_id']) && $_POST['category_id'] == 2 ? "selected" : '' ?>>Womens</option>
				<option value="3" <?= isset($_POST['category_id']) && $_POST['category_id'] == 3 ? "selected" : '' ?>>Kids</option>
				<option value="4"  <?= isset($_POST['category_id']) && $_POST['category_id'] == 4	 ? "selected" : '' ?>>Fashions</option>
			</select>
			<span><?php echo $errorCategoty; ?></span>
			<p>Size:</p>
			<select name="size_id">
				<option></option>
				<option value="1" <?= isset($_POST['size_id']) && $_POST['size_id'] == 1 ? "selected" : '' ?>>XS</option>
				<option value="2" <?= isset($_POST['size_id']) && $_POST['size_id'] == 2 ? "selected" : '' ?>>S</option>
				<option value="3" <?= isset($_POST['size_id']) && $_POST['size_id'] == 3 ? "selected" : '' ?>>M</option>
				<option value="4" <?= isset($_POST['size_id']) && $_POST['size_id'] == 4 ? "selected" : '' ?>>L</option>
				<option value="5" <?= isset($_POST['size_id']) && $_POST['size_id'] == 5 ? "selected" : '' ?>>XL</option>
			</select>
			<span><?php echo $errorSize; ?></span>
			<p>Name Product:</p>
			<input type="text" placeholder="Name Product" value="<?php echo $productName ?>" name="product" />
			<span><?php echo $errorProduct; ?></span>
			<p>Price Product:</p>
			<input type="text" placeholder="Price" name="price" value="<?php echo $price ?>" />
			<span><?php echo $errorPrice; ?></span>
			<p>Quantily Product:</p>
			<input type="text" placeholder="Quantily" name="quantily" value="<?php echo $quantily ?>" />
			<span><?php echo $errorQuantily; ?></span>
			<p>Avatar Product:</p>
			<input id="Image" type="file" name="image" multiple/>
			<span><?php echo $errorImage; ?></span>
			<p>Create Date:</p>
			<input type="date"  name="createDate" value="<?php echo $createDate ?>" />
			<span><?php echo $errorCreateDate; ?></span>
			<p>Over Date:</p>
			<input type="date"  name="overDate" value="<?php echo $overDate ?>" />
			<span><?php echo $errorOverDate; ?></span>
			<p>Description:</p>
			<textarea placeholder="Description" name="description"><?php echo $description; ?></textarea>
			<span><?php echo $errorDescription ?></span>
			<button type="submit" name="submit" class="btn btn-default">Create Product</button>			
		</form>
	</div><!--/sign up form-->
</body>
</html>
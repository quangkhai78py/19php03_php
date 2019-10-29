 
 <!DOCTYPE html>
 <html>
 <head>
     <title></title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script><script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 </head>
 <body>

    <?php
    session_start();

    $error1 = '';
    $error2 = '';
    $error3 = '';
    $error4 = '';
    $error5 = '';
   
    if (isset($_POST['submit'])) {
            if (!empty($_POST['name'])) {
                $name = $_POST['name'];
            }else{
                $error1 = 'vui lòng nhập tên của bạn';
            }

            if (!empty($_POST['gender'])) {
                $gender = $_POST['gender'];
                
            }else{
                $error2 = 'vui lòng chọn giới tính của bạn';
            }

            if (!empty($_POST['address'])) {
                $address = $_POST['address'];
            }else{
                $error3 = 'vui lòng chọn thành phố của bạn';
            }

            if (!empty($_POST['email'])) {
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                     $error4 = 'vui lòng chọn nhập đúng email email của bạn';
                }else{
                    $email = $_POST['email'];
                    $_SESSION['email'] = $email;
                }
            }else{
                $error4 = 'vui lòng chọn nhập email của bạn';
            }

            if (!empty($_POST['birthday'])) {
                $birthday = $_POST['birthday'];
            }else{
                $error5 = 'vui lòng chọn nhập Ngày sinh của bạn';
            }
          
        }
    ?>
    <div style="width: 50%; margin-left: 350px; margin-top: 50px;">
        <form style="width: 50%;" method="post" action="<?= isset($_POST['submit']) && !empty($name) && !empty($gender) && !empty($email) && !empty($birthday) && !empty($address) ? 'php02.php' : '' ?>">
            <div class="form-group">
                <label for="exampleInputEmail1">HỌ TÊN</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Họ và tên" value="<?= !empty($name) ? $name : '' ?>">
                <span style="color: red;"><?php echo $error1; ?></span>
            </div>
            <div class="form-group">
                <label style="width: 100%;" for="exampleInputPassword1">GIỚI TÍNH</label>
                <input type='radio' name='gender' size='30' value='1'<?= isset($_POST['gender']) && $_POST['gender'] == 1 ? "checked" : ''?> /> Nam <br>
                <input type='radio' name='gender' size='30' value='2'<?= isset($_POST['gender']) && $_POST['gender'] == 2 ? "checked" : ''?> /> Nữ <br>
                <input type='radio' name='gender' size='30' value='3'<?= isset($_POST['gender']) && $_POST['gender'] == 3 ? "checked" : ''?> /> Giới Tính Khác <br>
                <span style="color: red;"><?php echo $error2; ?></span>
            </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Quê Quán</label>
                <select name="address" style="width: 100%;">
                    <option></option>
                    <option value='1' <?= isset($_POST['address']) && $_POST['address'] == 1 ? "selected" : '' ?> >Hà Nội</option>
                    <option value="2" <?= isset($_POST['address']) && $_POST['address'] == 2 ? "selected" : '' ?> >Đà Nẵng</option>
                    <option value="3" <?= isset($_POST['address']) && $_POST['address'] == 3 ? "selected" : '' ?> >Vũng Tàu</option>
                    <option value="4" <?= isset($_POST['address']) && $_POST['address'] == 4 ? "selected" : '' ?> >TP.Hồ Chí Minh</option>
                </select>             
                <span style="color: red;"><?php echo $error3; ?></span>        
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input name="email" type="text" class="form-control" id="exampleInputPassword1" placeholder="Email" value="<?= !empty($email) ? $email : '' ?>">
                <span style="color: red;"><?php echo $error4; ?></span>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Ngày Sinh</label>
                <input name="birthday" type="date" class="form-control" id="exampleInputPassword1" value="<?= !empty($birthday) ? $birthday : '' ?>">
                <span style="color: red;"><?php echo $error5; ?></span>
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
 </body>
 </html>

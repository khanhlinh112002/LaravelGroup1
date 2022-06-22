<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <form method="post">
        @csrf
        <div class="form=group">
            <input type ="number" class ="form-control" placeholder="Số a" name ="soA">
        </div>
        <div class="form=group">
            <input type ="number" class ="form-control" placeholder="Số b" name ="soB">  
        </div>
        <button type ="submit" class="btn btn-danger">Tính</button>
        <div class="form=group"> 
        <input type ="number" class ="form-control" placeholder="Kết Quả" disabled="" value="<?php if(isset($sum)) echo $sum?>">
        </div>
    </form>
    </div>
</body>
</html>
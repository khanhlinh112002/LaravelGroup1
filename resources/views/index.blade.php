<?php
if(session_id() === '')
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <title>Totoro milk tea</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
  <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
</head>

<body class="container">
  <h1 class="text-center">Admin Page</h1>
  <div class="container">
    <form  method="post" enctype="multipart/form-data">
      @csrf
      <div class="card-text row">
        <h4 class="text-left col"><b>Quản lý phòng</b></h4>
        <div class="text-right col">
          <button class="btn" type="submit" style="background-color:  #ff631c !important; color:white">Thêm mới phòng <i class="fas fa-calendar-check"></i></button>
        </div>
      </div>

      <hr style="border:2px solid #ff631c;" />

      <div class="form-row">
        <div class="form-group col">
          <label for="roomName">Tên phòng</label>
          <input type="text" name="roomName" class="form-control" placeholder="Nhập tên phòng...">
        </div>
        <div class="form-group col">
          <label for="roomDescription">Mô tả phòng</label>
          <input type="text" name="roomDescription" class="form-control" placeholder="Nhập mô tả phòng...">
        </div>
        <div class="form-group col">
          <label for="roomPrice">Giá</label>
          <input type="number" name="roomPrice" class="form-control" placeholder="Giá phòng...">
        </div>

        <div class="form-group text-center">
          <input type="file" name="roomImage" id="roomImage" style="display: none;">
          <button type="button" class="btn btn-outline-warning" onclick="chooseFile()" style="border:1px solid #ff631c; color:#ff631c;padding: 21px">
            <i class="fas fa-images"></i> Chọn hình ảnh
          </button>
          <script>
            function chooseFile() {
              $("#roomImage").click();
            }
          </script>
        </div>
      </div>
    </form>
  </div>
  <div class="container">
  <table class="w3-table-all" >
    <thead>
      <tr class="w3-red" style="background-color:  #ff631c !important;">
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Image</th>
        <th>Action</th>

      </tr>
    </thead>
    <?php
    if(isset($_SESSION['rooms']))
    $arr = $_SESSION['rooms'];
    ?>
    @foreach($arr as $key => $value)
            
            <!-- <p>Name: {{$value['name']}}</p>
            <p>Description: {{$value['description']}}</p>
            <p>Price: {{$value['price']}}</p>
            <p>Image: <img src="/images/{{$value['image']}}" style="width:150px"></p>
            <a href="/delete{{$value['name']}}">delete </a>
        -->
    <tr>
      <td>{{$value['name']}}</td>
      <td>{{$value['description']}}</td>
      <td>{{$value['price']}}</td>
      <td><img src="/images/{{$value['image']}}" style="width:200px"></td>
      <td>
        <h6 class="w3-button w3-deep-orange"~>Delete</h6>
      </td>
    </tr>
    @endforeach
    
  </table>
    
    </div>
  <div>
    @include('error')
  </div>
</body>

</html>

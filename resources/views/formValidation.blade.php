<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Signup</title>
</head>
<body>
    <form method="post" class="w3-container">
        @csrf
        <div>
            <label for="name" class="w3-text-brown">Name</label>
            <input type="text" name="name" class="w3-input w3-border w3-sand">
        </div>
        <div>
            <label for="age" class="w3-text-brown">Age</label>
            <input type="text" name="age" class="w3-input w3-border w3-sand">
        </div>
        <div>
            <label for="date" class="w3-text-brown">Date</label>
            <input type="date" name="date" class="w3-input w3-border w3-sand">
        </div>
        <div>
            <label for="phone" class="w3-text-brown">Phone</label>
            <input type="text" name="phone" class="w3-input w3-border w3-sand">
        </div>
        <div>
            <label for="web" class="w3-text-brown">Web</label>
            <input type="text" name="web" class="w3-input w3-border w3-sand">
        </div>
        <div>
            <label for="address" class="w3-text-brown">Address</label>
            <input type="text" name="address" class="w3-input w3-border w3-sand">
        </div>
        <div>
            @include('error')
        </div>
        <button class="w3-btn w3-brown" type="submit">OK</button>
        <div>
           
       
             @if(isset($user))
            <p>Name: {{$user['name']}}</p>
            <p>Age: {{$user['age']}}</p>
            <p>Date: {{$user['date']}}</p>
            <p>Phone: {{$user['phone']}}</p>
            <p>Website: {{$user['web']}}</p>
            <p>Address: {{$user['address']}}</p>
            @endif
        </div>
    </form>
</body>
</html>
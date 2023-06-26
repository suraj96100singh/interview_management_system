<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>
<body>
    

<div class="text-center">
    <img src={{$message->embed('storage/email_vedio/image.jpeg')}} alt="image not found" class="rounded">
    {{-- <div style="height:800px;">
        <lottie-player src="{{ ('https://assets3.lottiefiles.com/packages/lf20_snmbndsh.json') }}"  background="transparent"   speed="1"  autoplay></lottie-player>
    </div> --}}
    <h3>Congratulation {{ $name }} ! <br></h3>
    <h3>You have Received an offer letter from Mahesh suppliers (india) Pvt. Ltd.</h3>
    </div>
    
     <p class="mt-3 display-6">Please find below the Offer letter</p><br>
    <div class="mt-5">
     <h3>Regards</h3>
     <h3>Mahesh suppliers (india) Pvt. Ltd.</h3>
    </div>
    
    
    
</body>
</html>



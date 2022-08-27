<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Document</title>
</head>

<body>
publico
    <div id="publico">
    </div>
</body>

<script src="{{asset('js/app.js')}}"></script> 

<script>
    var publico =  document.getElementById("publico");  

     Echo.channel('channel-publico')  //USANDO A VERSÃO 7.3 DO PHP
        .listen('channelPublico', (e) => {
            //alert('novo chamado!')
            document.location.reload(true);
    });
</script>

</html>
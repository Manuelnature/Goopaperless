<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
{{-- <body>
    {{$data->name}}
    {{$data->description}}

    <iframe frameborder="0" 
    marginheight="0" 
    marginwidth="0" 
    width="100%" 
    height="100%" 
    scrolling="auto" src="/assets/files/{{$data->file}}" ></iframe>
    
</body> --}}

<frameset rows="100%,*">
    <frame src="/assets/files/{{$data->file}}">
        <noframes>
  
            <body>
  
            </body>
        </noframes>
</frameset>
</html>

    


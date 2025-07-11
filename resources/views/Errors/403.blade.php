<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@section('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/global.css')}}">
    <link rel="stylesheet" href="{{asset('css/errors.css')}}">
  
    

    
</head>
<body>
     <div class="errors-container-wrapper">
        <div class="errors-container-layout">
            <h3 class="errors-status-code">403</h3>
            <div class="errors-status-message">
                Access
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                            <path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256C511.847,114.678,397.322,0.153,256,0z M256,64   c39.843,0.004,78.686,12.477,111.083,35.669L99.669,367.061c-61.503-86.178-41.499-205.897,44.679-267.4   C176.93,76.409,215.972,63.939,256,64z M256,448c-39.837-0.002-78.673-12.475-111.061-35.669l267.392-267.413   c61.514,86.17,41.527,205.891-44.643,267.406C335.098,435.588,296.042,448.064,256,448z"/>
                        </g>
                        </svg>
                Denied
            </div>
        </div>
    </div>
 
</body>
</html>


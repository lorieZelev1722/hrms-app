

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HRMS-Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="{{asset('css/loader.css')}}">
    <link rel="stylesheet" href="{{asset('css/global.css')}}">
    
</head>
<body>
 
   <div class="hrms-login-container">
   <div class="hrms-login-div-content">
            <div class="hrms-login-div-top-container">
                <div class="hrms-login-icon-container">
                    <div class="hrms-login-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
                    <path d="m22,14.537v-1.537c0-2.206-1.794-4-4-4s-4,1.794-4,4v1.537c-1.195.693-2,1.986-2,3.463v2c0,2.206,1.794,4,4,4h4c2.206,0,4-1.794,4-4v-2c0-1.477-.805-2.77-2-3.463Zm-4,5.963c-.828,0-1.5-.672-1.5-1.5s.672-1.5,1.5-1.5,1.5.672,1.5,1.5-.672,1.5-1.5,1.5Zm2-6.5h-4v-1c0-1.103.897-2,2-2s2,.897,2,2v1Zm-12-2c3.309,0,6-2.691,6-6S11.309,0,8,0,2,2.691,2,6s2.691,6,6,6Zm2,8c0,1.535.58,2.938,1.532,4H1c-.552,0-1-.448-1-1v-.729c0-4.115,2.993-7.76,7.083-8.219.96-.108,1.891-.044,2.766.164.616.146.887.839.637,1.42-.312.726-.486,1.525-.486,2.364v2Z"/>
                    </svg>
                    </div>
                </div>
                <span class="jsSpanContainer">Login Page
                    
                </span>
            </div>
           <div class="jsLoginForm"></div>
        </div>
    </div>

    <script src="{{ asset('js/globalfunc.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
  

     
   
</body>
</html>


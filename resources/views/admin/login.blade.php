<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        	body,
		html {
			margin: 0;
			padding: 0;
			height: 100%;
			background: rgba(0, 0, 0,0.5) ;
            {{--    background-image: url("{{asset('/image/login-bg.jpg')}}");--}}
            /*    background-size: cover;*/
		}
		.user_card {
			height: 400px;
			width: 350px;
			margin-top: auto;
			margin-bottom: auto;
			background: rgba(0, 0, 0,0.3);
			position: relative;
			display: flex;
			justify-content: center;
			flex-direction: column;
			padding: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 5px;

		}
		.brand_logo_container {
			position: absolute;
			height: 170px;
			width: 170px;
			top: -75px;
			border-radius: 50%;
			background: rgba(0, 0, 0,0.3);
			padding: 10px;
			text-align: center;
		}
		.brand_logo {
			height: 150px;
			width: 150px;
			border-radius: 50%;
			border: 2px solid white;
		}
		.form_container {
			margin-top: 50px;
		}
		.login_btn {
			width: 100%;
			/* background: rgba(34, 194, 230, 1) !important; */
			color: white !important;
		}
		.login_btn:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.login_container {
			padding: 0 2rem;
		}
		.input-group-text {
			background: rgba(0, 0, 0,0.3); !important;
			color: black !important;
			border: 0 !important;
			border-radius: 0.25rem 0 0 0.25rem !important;
		}
		.input_user,
		.input_pass:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
			background-color: rgba(0, 0, 0,0.3);
		}
    </style>
</head>
<body>

<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <div class="user_card ">
			
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img src="{{asset('/logo/download.jpg')}}" class="brand_logo" alt="Logo">
                </div>
            </div>
            <div class="d-flex justify-content-center form_container">
                
                <form method="post">
					{{csrf_field()}}
					<legend class="text-center text-white">{{$hotel->title}}</legend>
					@foreach ($errors->all() as $error)
						<p class="alert alert-danger">{{$error}}</p>
					@endforeach
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-envelope text-white"></i></span>
                        </div>
                        <input type="text" name="email" class="form-control input_user" value="" placeholder="email">
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key text-white"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control input_pass" value="" placeholder="password">
                    </div>
                    
                        <div class="d-flex justify-content-center mt-3 login_container">
                 <input type="submit" class="btn login_btn btn-dark" value="Login">
               </div>
                </form>
            </div>
    
            
        </div>
    </div>
</div>
</body>
</html>
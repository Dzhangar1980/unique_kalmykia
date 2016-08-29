<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
    </head>
    <body>
			<?php if (Auth::check()){
					echo 'You are auth!
					<h4>You\'r name is '.Auth::user()->name.'</h4>
					<h4>You\'r email is '.Auth::user()->email.'</h4>
					<img src="'.Auth::user()->avatar.'">
					<p><a class="btn btn-info" href="logout" role="button">Logout</a></p>';
					}else{
					echo '
						<p><a class="btn btn-info" href="auth/facebook" role="button">Login with Facebook</a></p>
						';
   					} 
				?>

    </body>
</html>

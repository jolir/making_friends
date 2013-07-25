<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#create_user').submit(function(){
				var form = $(this);
				$.post(form.attr('action'), form.serialize(), function(data){
					console.log(data);
					if(data.status)
						$("#notify").html(data.message);
					else
						$("#notify").html(data.errors);
				}, 'json');
				return false;
			});
			$('#login').submit(function(){
				var form = $(this);
				$.post(form.attr('action'), form.serialize(), function(data){
					console.log(data);
					if(data.status)
						window.location = data.redirect_url
					else
						$("#login_notify").html(data.errors);
				}, 'json');
				return false;
			});
		});
	</script>
</head>
<body>
	<div class="container">
		<div class="row-fluid">
	    	<div class="span12">
	        	<div class="span6">
	            	<div class="area">
	                    <form class="form-horizontal" action="users/login" method="post" id="login">
	                        <div class="heading">
	                            <h4 class="form-heading">Sign In</h4>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label" for="email">email</label>
	                            <div class="controls">
	                                <input type="text" id="email" name="email">
	                                <input type="hidden" name="form_action" value="login">
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label" for="password">Password</label>
	                            <div class="controls">
	                                <input type="password" id="password" name="password">
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <div class="controls">
	                                <button type="submit" class="btn btn-success">Sign In</button>
	                            </div>
	                        </div>	
	                        <div id="login_notify"></div>
	                    </form>	
					</div>                           
	            </div>
	            <div class="span6">
	            	<div class="area">
	                    <form class="form-horizontal" id="create_user" action="users/create_user" method="post">
	                        <div class="heading">
	                            <h4 class="form-heading">Sign Up</h4>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label" for="first_name">First Name</label>
	                            <div class="controls">
	                                <input type="text" id="first_name" name="first_name">
	                                <input type="hidden" name="form_action" value="create_user">
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label" for="last_name">Last Name</label>
	                            <div class="controls">
	                                <input type="text" id="last_name" name="last_name">
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label" for="email">Email</label>
	                            <div class="controls">
	                                <input type="text" id="email" name="email">
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label" for="password">Password</label>
	                            <div class="controls">
	                                <input type="password" id="password" name="password">
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label" for="password_confirmation">Confirm Password</label>
	                            <div class="controls">
	                                <input type="password" id="password_confirmation" name="password_confirmation">
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <div class="controls">
	                                <button type="submit" class="btn btn-success">Sign Up</button>
	                            </div>
	                        </div>	
	                        <div id="notify"></div>
	                    </form>	
					</div>                            
	            </div>
	        </div>
	    </div>
	</div>
</body>
</html>
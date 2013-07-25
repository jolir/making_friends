<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.add_friend').submit(function(){
				var form = $(this);
				$.post(form.attr('action'), form.serialize(), function(data){
					console.log(data);
					if(data.status)
						form.children('.btn').replaceWith("<button type='submit' class='btn btn-primary' disabled>Friend Invite Sent</button>");
					else
						$("#notify").html(data.errors);
				}, 'json');
				return false;
			});
		});
	</script>
</head>
<body>
	<div class="navbar navbar-inverse">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="#" name="top">Brand Name</a>
				<div class="nav-collapse collapse">
					<ul class="nav">
						<li><a href="#"><i class="icon-home icon-white"></i> Home</a></li>
						<li class="divider-vertical"></li>
						<li class="active"><a href="#"><i class="icon-file icon-white"></i> Dashboard</a></li>
						<li class="divider-vertical"></li>
					</ul>
					<div class="btn-group pull-right">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="icon-user"></i> <?= $logged_in_user['first_name']; ?>	<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?= base_url(); ?>logout"><i class="icon-share"></i> Logout</a></li>
						</ul>
					</div>
				</div>
				<!--/.nav-collapse -->
			</div>
			<!--/.container-fluid -->
		</div>
		<!--/.navbar-inner -->
	</div>
	<!--/.navbar -->
	<div id="wrapper" style="width: 960px; margin:0px auto;">
		<h4>Notifications:</h4>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Friend Request</th>
					<th>Action</th>
				</tr>
			</thead>
		</table>

		<h4>People you may want to add as friend:</h4>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
<? 	foreach($users as $key => $user) 
	{ ?>

				<tr>
					<td><?= $user['first_name']; ?> <?= $user['last_name']; ?></td>
					<td><?= $user['email']; ?></td>
					<td>
<?  	if(isset($friends[$key]) && $friends[$key]['friend_id'] == $user['id'])
    	{ ?>
    					<button type='submit' class='btn btn-primary' disabled>Friend Invite Sent</button>
<? 		} 
		else 
		{ ?>
						<form action="<?= base_url(); ?>friends/add_friend" method="post" class="add_friend">
							<input type="hidden" name="form_action" value="add_friend">
							<input type="hidden" name="user_id" value="<?= $logged_in_user['user_id']; ?>">
							<input type="hidden" name="friend_id" value="<?= $user['id']; ?>">
							<button type="submit" class="btn btn-primary">Add as Friend</button>
						</form>
<?  	} ?>	
					</td>
				</tr>
<? 	} ?>
			</tbody>
		</table>
	</div>
	<? var_dump($friends); var_dump($users); ?>
</body>
</html>
						

	
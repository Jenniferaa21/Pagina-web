
<?php
session_start();
include('include/config.php');

	if(isset($_POST['submit']))
	{
		$sql=mysqli_query($con,"SELECT password FROM  admin where password='".md5($_POST['password'])."' && username='".$_SESSION['alogin']."'");
		$num=mysqli_fetch_array($sql);
		if($num>0)
		{
			 $con=mysqli_query($con,"update admin set password='".md5($_POST['newpassword'])."', updationDate='$currentTime' where username='".$_SESSION['alogin']."'");
			$_SESSION['msg']="Password Changed Successfully !!";
		}
		else
		{
			$_SESSION['msg']="Old Password not match !!";
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Actualizar Contraseña</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	<script type="text/javascript">
function valid()
{
if(document.chngpwd.password.value=="")
{
alert("Current Password Filed is Empty !!");
document.chngpwd.password.focus();
return false;
}
else if(document.chngpwd.newpassword.value=="")
{
alert("New Password Filed is Empty !!");
document.chngpwd.newpassword.focus();
return false;
}
else if(document.chngpwd.confirmpassword.value=="")
{
alert("Confirm Password Filed is Empty !!");
document.chngpwd.confirmpassword.focus();
return false;
}
else if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
</head>
<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="span3">
					<div class="sidebar">
						<ul class="widget widget-menu unstyled">
							<li>
								<a class="collapsed" data-toggle="collapse" href="#togglePages">
									<i class="menu-icon icon-cog"></i>
									<i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>
									Administrar pedidos
								</a>
								<ul id="togglePages" class="collapse unstyled">
									<li>
										<a href="todays-orders.php">
											<i class="icon-tasks"></i>
											Pedidos de hoy
												  <?php
												$f1="00:00:00";
												$from=date('Y-m-d')." ".$f1;
												$t1="23:59:59";
												$to=date('Y-m-d')." ".$t1;
												 $result = mysqli_query($con,"SELECT * FROM orders where orderDate Between '$from' and '$to'");
												$num_rows1 = mysqli_num_rows($result);
												{
												?>
											<b class="label orange pull-right"><?php echo htmlentities($num_rows1); ?></b>
											<?php } ?>
										</a>
									</li>
									<li>
										<a href="pending-orders.php">
											<i class="icon-tasks"></i>
											Pedidos pendientes
										<?php	
										$status='Delivered';									 
										$ret = mysqli_query($con,"SELECT * FROM orders where orderStatus!='Delivered'");
										$num = mysqli_num_rows($ret);
										{?><b class="label orange pull-right"><?php echo htmlentities($num); ?></b>
										<?php } ?>
										</a>
									</li>
									<li>
										<a href="delivered-orders.php">
											<i class="icon-inbox"></i>
											Pedidos entregados
										<?php	
											$status='Delivered';									 
										$rt = mysqli_query($con,"SELECT * FROM orders where orderStatus='Delivered'");
										$num1 = mysqli_num_rows($rt);
										{?><b class="label green pull-right"><?php echo htmlentities($num1); ?></b>
										<?php } ?>

										</a>
									</li>
								</ul>
							</li>
							
							<li>
								<a href="manage-users.php">
									<i class="menu-icon icon-group"></i>
									Administrar usuarios
								</a>
							</li>
						</ul>


						<ul class="widget widget-menu unstyled">
                                <li><a href="category.php"><i class="menu-icon icon-tasks"></i> Crear Categoria </a></li>
                                <li><a href="subcategory.php"><i class="menu-icon icon-tasks"></i>Sub Categoria </a></li>
                                <li><a href="insert-product.php"><i class="menu-icon icon-paste"></i>Insertar Producto </a></li>
                                <li><a href="manage-products.php"><i class="menu-icon icon-table"></i>Administrar Productos </a></li>
                        
                            </ul><!--/.widget-nav-->

						<ul class="widget widget-menu unstyled">
							<li><a href="user-logs.php"><i class="menu-icon icon-tasks"></i>Usuarios Logs</a></li>
							
							<li>
								<a href="logout.php">
									<i class="menu-icon icon-signout"></i>
									Cerrar Sesión
								</a>
							</li>
						</ul>

					</div><!--/.sidebar-->
				</div><!--/.span3-->	
				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Admin | Cambiar contraseña</h3>
							</div>
							<div class="module-body">

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>
									<br />

			<form class="form-horizontal row-fluid" name="chngpwd" method="post" onSubmit="return valid();">
									
<div class="control-group">
<label class="control-label" for="basicinput">Contraseña actual</label>
<div class="controls">
<input type="password" placeholder="Ingresa tu contraseña actual"  name="password" class="span8 tip" required>
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Nueva contraseña</label>
<div class="controls">
<input type="password" placeholder="Ingresa tu nueva contraseña"  name="newpassword" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Confirma contraseña nueva</label>
<div class="controls">
<input type="password" placeholder="Confirma tu contraseña nueva"  name="confirmpassword" class="span8 tip" required>
</div>
</div>




										

										<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Guardar</button>
											</div>
										</div>
									</form>
							</div>
						</div>

						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>	
		</div>
	</div>
			
<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
</body>
<?php  ?>
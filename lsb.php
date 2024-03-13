<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_GET['username'])) {
    $username = $_GET['username'];
}
$childDesc = isset($_GET['childDesc']) ? urldecode($_GET['childDesc']) : '';

?>


<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="AR">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Dashboard - Sameh - drd <?php echo $username; ?>
</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="assets/css/line-awesome.min.css">
		
		<!-- Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
	
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper" >
		
			<!-- Header -->
            <?php include_once("includes/header.php"); ?>
			<!-- /Header -->
			
			<!-- Sidebar -->
            <?php include_once("includes/sidebar.php");?>
			<!-- /Sidebar -->
			
	
		
<!-- Page Wrapper -->
<div class="page-wrapper">
			
			<!-- Page Content -->
			<div class="content container-fluid">
			
				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title">Welcome <?php echo $username;?>!</h3>
							<ul class="breadcrumb">
<?php
// Retrieve parameters from the URL
$childDesc = urldecode($_GET['childDesc']);

// Display the fetched data
echo '<li class="breadcrumb-item active" >' . htmlspecialchars($childDesc, ENT_QUOTES, 'UTF-8') . '</li>';

// You can use $childID and $childDesc in your page as needed.
?>							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->			
        
		<div class="row">
		<?php include_once("includes/card/lsb.php");?>

</div>

		<!-- /Main Wrapper -->
		<div class="row">
		<div class="col-md-12 d-flex">
							<div class="card card-table flex-fill">
								<div class="card-header">
								<div class="float-left">
          <a href="includes/downlode/lsb.php">  <button class="btn btn-primary">تنزيل البيانات</button> </a>
        </div>
									<h3 class="card-title mb-0" align="right"><?php echo htmlspecialchars($childDesc, ENT_QUOTES, 'UTF-8')   ?></h3>
								
								</div>
								<div class="card-body">
								<div class="card-body">
				<!-- table-drd -->
				<?php include_once("includes/table/lsb.php");?>

			<!-- /table-drd -->
			
							</div>
								
							</div>
						</div>
					</div>
				
		

       
		
		<!-- javascript links starts here -->
		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="assets/js/jquery.slimscroll.min.js"></script>
		
		<!-- Chart JS -->
		<script src="assets/plugins/morris/morris.min.js"></script>
		<script src="assets/plugins/raphael/raphael.min.js"></script>
		<script src="assets/js/chart.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		<!-- javascript links ends here  -->
    </body>
</html>
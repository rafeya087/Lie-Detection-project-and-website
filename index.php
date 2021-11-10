<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
	<header role="banner">
	  <h1>Arduino Based Lie Detector</h1>
	  <ul class="utilities">
	    <li class="logout warn"><a href="logout.php">Log Out</a></li>
	  </ul>
	</header>

	<nav role="navigation">
	  <ul class="main">
	    <li><a href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
	    <li><a href="arduino/index.php"><i class="fa fa-book" aria-hidden="true"></i> Check Results</a></li>
	    <!-- <li><a href="employee/index.php"><i class="fa fa-briefcase" aria-hidden="true"></i> Manage Employees</a></li>
	    <li><a href="intern/index.php"><i class="fa fa-suitcase" aria-hidden="true"></i> Manage Interns</a></li>
	    <li><a href="#"><i class="fa fa-credit-card" aria-hidden="true"></i> Manage Expenses</a></li>
	    <li><a href="account/index.php"><i class="fa fa-user" aria-hidden="true"></i> Manage Accounts</a></li>
	    <li><button class="dropdown-btn"><i class="fa fa-file" aria-hidden="true"></i> Report
	    <i class="fa fa-caret-down"></i>
	  </button>
	  <div class="dropdown-container">
	    <a href="report/student/index.php"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;Student</a>
	    <a href="report/employee/index.php"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;Employee</a>
	    <a href="report/intern/index.php"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;Intern</a>
	    <a href="#"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;Expense</a>
	  </div></li> -->

	  <!-- <li><button class="dropdown-btn"><i class="fa fa-user" aria-hidden="true"></i> Accounts
	    <i class="fa fa-caret-down"></i>
	  </button>
	  <div class="dropdown-container">
	    <a href="account/staff/index.php">Staff</a>
	    <a href="#">Others</a>
	  </div></li> -->
	  </ul>
	</nav>

	<main role="main">
		<section class="panel important">
		<h2>Hello Admin</h2>
		<ul>
		<li>Here you can check whether the person is lying or not based on their heart rate, temperature and persipiration</li>
		<li>You can also view/delete individual records</li>
		</ul>
	</section>
	  <section class="panel">
	    <h2>Hassan Tahawar</h2>
		<div style="display:flex;padding:10px">
		<img src="image/hassanImage.jpg" height="200px" />
		<span style="margin-left:10px">
			<li>2016-ag-7926</li>
			<li>BS-Software Engineering</li>
			<li>8th Semester</li>
		</span>
		</div>
	  </section>
    <section class="panel ">
	    <h2>M. Abdul Rafey</h2>
	    <div style="display:flex;padding:10px">
		<img src="image/abdulrafey.jpeg" height="200px" />
		<span style="margin-left:10px">
			<li>2016-ag-7960</li>
			<li>BS-Software Engineering</li>
			<li>8th Semester</li>
		</span>
		</div>
	</section>

	</main>
	<footer role="contentinfo">Admin Panel by Hassan Tahawar and Abdul Rafey</footer>

	<script>
	//* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
	var dropdown = document.getElementsByClassName("dropdown-btn");
	var i;

	for (i = 0; i < dropdown.length; i++) {
	  dropdown[i].addEventListener("click", function() {
	    this.classList.toggle("active");
	    var dropdownContent = this.nextElementSibling;
	    if (dropdownContent.style.display === "block") {
	      dropdownContent.style.display = "none";
	    } else {
	      dropdownContent.style.display = "block";
	    }
	  });
	}
	</script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
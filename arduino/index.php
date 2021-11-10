<?php 
  $mysqli = mysqli_connect('localhost', 'root', '', 'arduino');
  // Get the total number of records from our table "arduino".
  $total_pages = $mysqli->query('SELECT COUNT(*) FROM arduino')->fetch_row()[0];

  // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
  $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

  // Number of results to show on each page.
  $num_results_on_page = 15;
  if ($stmt = $mysqli->prepare('SELECT * FROM arduino ORDER BY name LIMIT ?,?')) {
    // Calculate the page to get the results we need from our table.
    $calc_page = ($page - 1) * $num_results_on_page;
    $stmt->bind_param('ii', $calc_page, $num_results_on_page);
    $stmt->execute(); 
    // Get the results...
    $result = $stmt->get_result();
    $stmt->close();
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style/style.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <style>
    table tr td:last-child a{
      margin-right: 15px;
    }
      .pagination {
      list-style-type: none;
      padding: 10px 0;
      display: inline-flex;
      justify-content: space-between;
      box-sizing: border-box;
    }
    .pagination li {
      box-sizing: border-box;
      padding-right: 10px;
    }
    .pagination li a {
      box-sizing: border-box;
      background-color: #e2e6e6;
      padding: 8px;
      text-decoration: none;
      font-size: 12px;
      font-weight: bold;
      color: #616872;
      border-radius: 4px;
    }
    .pagination li a:hover {
      background-color: #d4dada;
    }
    .pagination .next a, .pagination .prev a {
      text-transform: uppercase;
      font-size: 12px;
    }
    .pagination .currentpage a {
      background-color: #518acb;
      color: #fff;
    }
    .pagination .currentpage a:hover {
      background-color: #518acb;
    }
  </style>
  <style type="text/css">
    /* Formatting search box */
    .search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
  <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
  </script>
</head>
<body>
	<header role="banner">
  <h1>Arduino Based Lie Detector</h1>
  <ul class="utilities">
    <li class="logout warn"><a href="../logout.php">Log Out</a></li>
  </ul>
</header>

<nav role="navigation">
  <ul class="main">
    <li><a href="../index.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
    <li><a href="index.php"><i class="fa fa-book" aria-hidden="true"></i>Check Results</a></li>
    <!-- <li><a href="index.php"><i class="fa fa-briefcase" aria-hidden="true"></i> Manage Employees</a></li>
    <li><a href="../intern/index.php"><i class="fa fa-suitcase" aria-hidden="true"></i> Manage Interns</a></li>
    <li><a href="#"><i class="fa fa-credit-card" aria-hidden="true"></i> Manage Expenses</a></li>
    <li><a href="../account/index.php"><i class="fa fa-user" aria-hidden="true"></i> Manage Accounts</a></li>
    <li><button class="dropdown-btn"><i class="fa fa-file" aria-hidden="true"></i> Report
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a href="../report/student/index.php">Student</a>
        <a href="../report/employee/index.php">Employee</a>
        <a href="../report/intern/index.php">Intern</a>
        <a href="#">Expense</a>
      </div>
    </li> -->
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
    <div class="page-header clearfix">
                        <h2 class="pull-left">Test Details</h2>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM arduino";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Temperature</th>";
                                        echo "<th>Heartbeat</th>";
                                        echo "<th>Humidity</th>";
                                        echo "<th>Result</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['temperature'] . "</td>";
                                        echo "<td>" . $row['heartbeat'] . "</td>";
                                        echo "<td>" . $row['humidity'] . "</td>";
                                        echo "<td>" . $row['result'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><i class='fa fa-eye' aria-hidden='true'></i></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><i class='fa fa-trash' aria-hidden='true'></i></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                    <?php if (ceil($total_pages / $num_results_on_page) > 0): ?>
    <ul class="pagination">
      <?php if ($page > 1): ?>
      <li class="prev"><a href="index.php?page=<?php echo $page-1 ?>">Prev</a></li>
      <?php endif; ?>

      <?php if ($page > 3): ?>
      <li class="start"><a href="index.php?page=1">1</a></li>
      <li class="dots">...</li>
      <?php endif; ?>

      <?php if ($page-2 > 0): ?><li class="page"><a href="index.php?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
      <?php if ($page-1 > 0): ?><li class="page"><a href="index.php?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php endif; ?>

      <li class="currentpage"><a href="index.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>

      <?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page"><a href="index.php?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
      <?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page"><a href="index.php?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php endif; ?>

      <?php if ($page < ceil($total_pages / $num_results_on_page)-2): ?>
      <li class="dots">...</li>
      <li class="end"><a href="index.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
      <?php endif; ?>

      <?php if ($page < ceil($total_pages / $num_results_on_page)): ?>
      <li class="next"><a href="index.php?page=<?php echo $page+1 ?>">Next</a></li>
      <?php endif; ?>
    </ul>
    <?php endif; ?>
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
<?php
  include 'connect.php';

  $course_group=$_GET['value'];

  switch ($course_group) {
    case 'bscs':
      $table= 'course_list_bscs';
      break;
    
    case 'bsse':
      $table= 'course_list_bsse';
      break;
    
    case 'mcs':
      $table= 'course_list_mcs';
      break;
    
    default:
      # code...
      break;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Course - Courses</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Course Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/courses_styles.css">
<link rel="stylesheet" type="text/css" href="styles/courses_responsive.css">
</head>
<style type="text/css">
  h2{
    color: black;
  }
  .page_section{
    padding-top: 8px;
  }
</style>
<body>

<div class="super_container">

  <!-- Header -->

  <header class="header d-flex flex-row">
    <div class="header_content d-flex flex-row align-items-center">
      <!-- Logo -->
      <div class="logo_container">
        <div class="logo">
          <img src="images/logo.png" alt="">
          <span>course</span>
        </div>
      </div>

      <!-- Main Navigation -->
      <nav class="main_nav_container">
        <div class="main_nav">
          <ul class="main_nav_list">
            <li class="main_nav_item"><a href="index.html">home</a></li>
            <li class="main_nav_item"><a href="#">about us</a></li>
            <li class="main_nav_item"><a href="#">courses</a></li>
            <li class="main_nav_item"><a href="elements.html">elements</a></li>
            <li class="main_nav_item"><a href="news.html">news</a></li>
            <li class="main_nav_item"><a href="contact.html">contact</a></li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="header_side d-flex flex-row justify-content-center align-items-center">
      <img src="images/phone-call.svg" alt="">
      <span>+43 4566 7788 2457</span>
    </div>

    <!-- Hamburger -->
    <div class="hamburger_container">
      <i class="fas fa-bars trans_200"></i>
    </div>

  </header>
  
  <!-- Menu -->
  <div class="menu_container menu_mm">

    <!-- Menu Close Button -->
    <div class="menu_close_container">
      <div class="menu_close"></div>
    </div>

    <!-- Menu Items -->
    <div class="menu_inner menu_mm">
      <div class="menu menu_mm">
        <ul class="menu_list menu_mm">
          <li class="menu_item menu_mm"><a href="index.html">Home</a></li>
          <li class="menu_item menu_mm"><a href="#">About us</a></li>
          <li class="menu_item menu_mm"><a href="#">Courses</a></li>
          <li class="menu_item menu_mm"><a href="elements.html">Elements</a></li>
          <li class="menu_item menu_mm"><a href="news.html">News</a></li>
          <li class="menu_item menu_mm"><a href="contact.html">Contact</a></li>
        </ul>

        <!-- Menu Social -->
        
        <div class="menu_social_container menu_mm">
          <ul class="menu_social menu_mm">
            <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-pinterest"></i></a></li>
            <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
            <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-instagram"></i></a></li>
            <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-twitter"></i></a></li>
          </ul>
        </div>

        <div class="menu_copyright menu_mm">Colorlib All rights reserved</div>
      </div>

    </div>

  </div>
  
  <!-- Home -->

  <div class="home">
    <div class="home_background_container prlx_parent">
      <div class="home_background prlx" style="background-image:url(images/courses_background.jpg)"></div>
    </div>
    <div class="home_content">
      <h1>Courses</h1>
    </div>
  </div>

  <!-- Popular -->

  <div class="popular page_section">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="section_title text-center">
            <h1><?php echo strtoupper($course_group); ?> Courses</h1>
            <h2><i>BSSE</i></h2>
          </div>
        </div>
      </div>

<?php
    $selectSQL="SELECT * FROM course_list_bsse ORDER BY semester ASC";
      /*$selectSQL="SELECT bsse_b15_res.course_id,bsse_b15_res.total_marks,bsse_b15_res.marks_obt, course_list_bsse.semester, course_list_bsse.course_name FROM bsse_b15_res INNER JOIN course_list_bsse ON bsse_b15_res.course_id=course_list_bsse.course_id WHERE bsse_b15_res.seat_no='$seat_no' AND course_list_bsse.semester<'$sem' ORDER BY course_list_bsse.semester DESC ";*/
  # Execute the SELECT Query
  if( !( $selectRes = mysql_query( $selectSQL ) ) ){
    echo 'Retrieval of data from Database Failed - #'.mysql_errno().': '.mysql_error();
  }else{
    ?>
    <center>
  <table border="2" id="myTable">
      <thead>
      <tr style="background-color:#fff; color: #000;">
        <th style="padding:5px;">Course ID</th>
        <th style="padding:5px;">Course Name</th>
        <th style="padding:5px;">Course Initials</th>
        <th style="padding:5px;">Credit Hours</th>
      </tr>
      </thead>
      <tbody>
      <?php
        if( mysql_num_rows( $selectRes )==0 ){
          echo '<tr style="border:0; background-color:#fff; color: #000;"><td colspan="4">No Rows Returned</td></tr>';
        }
        else{
          $prevSem=NULL;
        while( $row = mysql_fetch_assoc( $selectRes ) ){
          if($prevSem!=($row['semester']) || $prevSem==NULL){
            echo "<tr style=\"border:0; background-color:#000; color: #fff;\"><th colspan=\"4\"><h3  align=\"center\" style=\"margin:0; padding:2px;\"><b>Semester : {$row['semester']}<b></h3></th></tr>";
          }
            echo "<tr style=\"background-color:#fff; color: #000;\">
            <td style=\"padding:2px;\">{$row['course_id']}</td>
            <td style=\"padding:2px;\">{$row['course_name']}</td>";
            echo "<td style=\"padding:2px;\">{$row['course_init']}</td>
            <td style=\"padding:2px;\">{$row['credit_hours']}</td></tr>";
            
          $prevSem=$row['semester'];
        }
      }
    ?>
    </tbody>
  </table></center>
<?php
  }

?>
      
    </div>    
  </div>

<!-- bscs -->
<div class="popular page_section">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="section_title text-center">
            
            <h2><i>BSCS</i></h2>
          </div>
        </div>
      </div>

<?php
    $selectSQL="SELECT * FROM course_list_bscs ORDER BY semester ASC";
      /*$selectSQL="SELECT bsse_b15_res.course_id,bsse_b15_res.total_marks,bsse_b15_res.marks_obt, course_list_bsse.semester, course_list_bsse.course_name FROM bsse_b15_res INNER JOIN course_list_bsse ON bsse_b15_res.course_id=course_list_bsse.course_id WHERE bsse_b15_res.seat_no='$seat_no' AND course_list_bsse.semester<'$sem' ORDER BY course_list_bsse.semester DESC ";*/
  # Execute the SELECT Query
  if( !( $selectRes = mysql_query( $selectSQL ) ) ){
    echo 'Retrieval of data from Database Failed - #'.mysql_errno().': '.mysql_error();
  }else{
    ?>
    <center>
  <table border="2" id="myTable">
      <thead>
      <tr style="background-color:#fff; color: #000;">
        <th style="padding:5px;">Course ID</th>
        <th style="padding:5px;">Course Name</th>
        <th style="padding:5px;">Course Initials</th>
        <th style="padding:5px;">Credit Hours</th>
      </tr>
      </thead>
      <tbody>
      <?php
        if( mysql_num_rows( $selectRes )==0 ){
          echo '<tr style="border:0; background-color:#fff; color: #000;"><td colspan="4">No Rows Returned</td></tr>';
        }
        else{
          $prevSem=NULL;
        while( $row = mysql_fetch_assoc( $selectRes ) ){
          if($prevSem!=($row['semester']) || $prevSem==NULL){
            echo "<tr style=\"border:0; background-color:#000; color: #fff;\"><th colspan=\"4\"><h3  align=\"center\" style=\"margin:0; padding:2px;\"><b>Semester : {$row['semester']}<b></h3></th></tr>";
          }
            echo "<tr style=\"background-color:#fff; color: #000;\">
            <td style=\"padding:2px;\">{$row['course_id']}</td>
            <td style=\"padding:2px;\">{$row['course_name']}</td>";
            echo "<td style=\"padding:2px;\">{$row['course_init']}</td>
            <td style=\"padding:2px;\">{$row['credit_hours']}</td></tr>";
            
          $prevSem=$row['semester'];
        }
      }
    ?>
    </tbody>
  </table></center>
<?php
  }

?>
      
    </div>    
  </div>

  <!-- mcs-->
  <div class="popular page_section">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="section_title text-center">
            
            <h2><i>MCS</i></h2>
          </div>
        </div>
      </div>

<?php
    $selectSQL="SELECT * FROM course_list_mcs ORDER BY semester ASC";
      /*$selectSQL="SELECT bsse_b15_res.course_id,bsse_b15_res.total_marks,bsse_b15_res.marks_obt, course_list_bsse.semester, course_list_bsse.course_name FROM bsse_b15_res INNER JOIN course_list_bsse ON bsse_b15_res.course_id=course_list_bsse.course_id WHERE bsse_b15_res.seat_no='$seat_no' AND course_list_bsse.semester<'$sem' ORDER BY course_list_bsse.semester DESC ";*/
  # Execute the SELECT Query
  if( !( $selectRes = mysql_query( $selectSQL ) ) ){
    echo 'Retrieval of data from Database Failed - #'.mysql_errno().': '.mysql_error();
  }else{
    ?>
    <center>
  <table border="2" id="myTable">
      <thead>
      <tr style="background-color:#fff; color: #000;">
        <th style="padding:5px;">Course ID</th>
        <th style="padding:5px;">Course Name</th>
        <th style="padding:5px;">Course Initials</th>
        <th style="padding:5px;">Credit Hours</th>
      </tr>
      </thead>
      <tbody>
      <?php
        if( mysql_num_rows( $selectRes )==0 ){
          echo '<tr style="border:0; background-color:#fff; color: #000;"><td colspan="4">No Rows Returned</td></tr>';
        }
        else{
          $prevSem=NULL;
        while( $row = mysql_fetch_assoc( $selectRes ) ){
          if($prevSem!=($row['semester']) || $prevSem==NULL){
            echo "<tr style=\"border:0; background-color:#000; color: #fff;\"><th colspan=\"4\"><h3  align=\"center\" style=\"margin:0; padding:2px;\"><b>Semester : {$row['semester']}<b></h3></th></tr>";
          }
            echo "<tr style=\"background-color:#fff; color: #000;\">
            <td style=\"padding:2px;\">{$row['course_id']}</td>
            <td style=\"padding:2px;\">{$row['course_name']}</td>";
            echo "<td style=\"padding:2px;\">{$row['course_init']}</td>
            <td style=\"padding:2px;\">{$row['credit_hours']}</td></tr>";
            
          $prevSem=$row['semester'];
        }
      }
    ?>
    </tbody>
  </table></center>
<?php
  }

?>
      
    </div>    
  </div>
  <!-- Footer -->

  <footer class="footer">
    <div class="container">
      
      <!-- Newsletter -->

      <div class="newsletter">
        <div class="row">
          <div class="col">
            <div class="section_title text-center">
              <h1>Subscribe to newsletter</h1>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col text-center">
            <div class="newsletter_form_container mx-auto">
              <form action="post">
                <div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-center">
                  <input id="newsletter_email" class="newsletter_email" type="email" placeholder="Email Address" required="required" data-error="Valid email is required.">
                  <button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">Subscribe</button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>

      <!-- Footer Content -->

      <div class="footer_content">
        <div class="row">

          <!-- Footer Column - About -->
          <div class="col-lg-3 footer_col">

            <!-- Logo -->
            <div class="logo_container">
              <div class="logo">
                <img src="images/logo.png" alt="">
                <span>course</span>
              </div>
            </div>

            <p class="footer_about_text">In aliquam, augue a gravida rutrum, ante nisl fermentum nulla, vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor fermentum, tempor lacus.</p>

          </div>

          <!-- Footer Column - Menu -->

          <div class="col-lg-3 footer_col">
            <div class="footer_column_title">Menu</div>
            <div class="footer_column_content">
              <ul>
                <li class="footer_list_item"><a href="index.html">Home</a></li>
                <li class="footer_list_item"><a href="#">About Us</a></li>
                <li class="footer_list_item"><a href="#">Courses</a></li>
                <li class="footer_list_item"><a href="news.html">News</a></li>
                <li class="footer_list_item"><a href="contact.html">Contact</a></li>
              </ul>
            </div>
          </div>

          <!-- Footer Column - Usefull Links -->

          <div class="col-lg-3 footer_col">
            <div class="footer_column_title">Usefull Links</div>
            <div class="footer_column_content">
              <ul>
                <li class="footer_list_item"><a href="#">Testimonials</a></li>
                <li class="footer_list_item"><a href="#">FAQ</a></li>
                <li class="footer_list_item"><a href="#">Community</a></li>
                <li class="footer_list_item"><a href="#">Campus Pictures</a></li>
                <li class="footer_list_item"><a href="#">Tuitions</a></li>
              </ul>
            </div>
          </div>

          <!-- Footer Column - Contact -->

          <div class="col-lg-3 footer_col">
            <div class="footer_column_title">Contact</div>
            <div class="footer_column_content">
              <ul>
                <li class="footer_contact_item">
                  <div class="footer_contact_icon">
                    <img src="images/placeholder.svg" alt="https://www.flaticon.com/authors/lucy-g">
                  </div>
                  Blvd Libertad, 34 m05200 Arévalo
                </li>
                <li class="footer_contact_item">
                  <div class="footer_contact_icon">
                    <img src="images/smartphone.svg" alt="https://www.flaticon.com/authors/lucy-g">
                  </div>
                  0034 37483 2445 322
                </li>
                <li class="footer_contact_item">
                  <div class="footer_contact_icon">
                    <img src="images/envelope.svg" alt="https://www.flaticon.com/authors/lucy-g">
                  </div>hello@company.com
                </li>
              </ul>
            </div>
          </div>

        </div>
      </div>

      <!-- Footer Copyright -->

      <div class="footer_bar d-flex flex-column flex-sm-row align-items-center">
        <div class="footer_copyright">
          <span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
        </div>
        <div class="footer_social ml-sm-auto">
          <ul class="menu_social">
            <li class="menu_social_item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
            <li class="menu_social_item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
            <li class="menu_social_item"><a href="#"><i class="fab fa-instagram"></i></a></li>
            <li class="menu_social_item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li class="menu_social_item"><a href="#"><i class="fab fa-twitter"></i></a></li>
          </ul>
        </div>
      </div>

    </div>
  </footer>

</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/scrollTo/jquery.scrollTo.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/courses_custom.js"></script>

</body>
</html>
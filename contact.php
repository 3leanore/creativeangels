<?php require('inc-public-pre-doctype.php'); ?>
<?php require(PATH . '/inc-email-encryption-function.php'); ?>
<?php
  // Create SQL statement to fetch all records from tblcontactdetails
  $sql_contact_details = "SELECT * FROM tblcontactdetails";

  //Connect to MYSQL Server
  require(PATH . '/inc-conn.php');

  //Execute SQL statement
  $rs_contact_details = mysqli_query($vconn_creativeangels, $sql_contact_details);

  //Create associative Array
  $rs_contact_details_rows = mysqli_fetch_assoc($rs_contact_details);

  // Function for printing out error messages
  function errorMsg($keyName, $label) {

    if(isset($_GET[$keyName]) && $_GET[$keyName] === '') {

      return "<div class='warning_msg'>Please enter " . $label . ".</div>";

    } elseif (isset($_GET['recaptcha']) && $_GET['recaptcha'] === 'fail') {

      return "<div class='warning_msg'>Please complete the recaptcha to conform tha you are not a robot</div>";

    } elseif (isset($_GET['kemail']) && $_GET['kemail'] === '') {

      return "<div class='warning_msg'>Please provide an email address. This is so that we can reply to your message.</div>";

    }
  } // End of function errorMsg

  // Displays values already entered in for input field
  function displayTxt($keyValue){

    if(isset($_GET[$keyValue]) && $_GET[$keyValue] !== '') {

      return $_GET[$keyValue];

    } //End if statement

  } // End of function displayTxt
?>
<!DOCTYPE html>
<html>
  <head>

    <!--==================== HEAD CONTENTS ======================-->
    <?php require( PATH . '/inc-public-head-content.php'); ?>
    <title>Creative Angels | Contact Us</title>

  </head>
  <body>

    <!-- Website wrapper -->
    <div class="site-wrapper">

      <!--========================== HEADER ======================-->
      <?php require( PATH . '/inc-public-header.php'); ?>

      <!--===================== CONTENT WRAPPER ===================-->
      <div class="content-wrapper lav-skin">

        <!--===================== MAIN CONTENT ====================-->
        <section class="main-content-wrapper col-2-3">


         <!-- WRITE TO US ================================================-->
         <article>

           <h2>Write to us</h2>

           <form method="post" action="write-to-us-process.php">

             <label for="txtName">Name</label>
             <input type="text" name="txtName" value="<?php echo displayTxt('kname'); ?>">

             <label for="txtEmail">*Email</label>
             <?php echo errorMsg('kemail', 'email'); ?>
             <input type="email" name="txtEmail" value="<?php echo displayTxt('kemail'); ?>">

             <label for="txtMessage">Message</label>
             <?php echo errorMsg('kmsg', 'message'); ?>
             <textarea class="large-textarea" name="txtMessage" placeholder="Message goes here"><?php echo displayTxt('kmsg'); ?></textarea><br>

             <?php echo errorMsg('recaptcha', 'recaptcha'); ?>
             <div class="g-recaptcha" data-sitekey="6LfaticTAAAAAPvR8kVhcToBvbZn8Rxw6-EsHW_p"></div>

             <input class="cta" type="submit" value="Send Message" >

           </form>

         </article>

         <!-- CONTACT DETAILS ======================================-->
         <article>

           <h2>Contact Us</h2>
   					<p>
   						<?php
   						if ($rs_contact_details_rows['cemail'] !== 'na'){

   							$email = $rs_contact_details_rows['cemail'];
   							echo '<a href="mailto:' . escapeHex_email($email) . '"><i class="fa fa-envelope-o"></i> ' . escapeHexEntity_email($email) . '</a>';

   						}
   						?>
   					</p>

   					<?php do { ?>
   						<div class="location wide-half">

   							<!-- city -->
   							<h4><i class="fa fa-map-marker"></i> <?php echo $rs_contact_details_rows['ccity']; ?></h4>

   							<!-- Contact person -->
   							<p><?php echo $rs_contact_details_rows['ccontactpersonname'] . ' ' . $rs_contact_details_rows['ccontactpersonsurname'] . '<br>'; ?></p>

   							<!-- Landline -->
   							<p><?php if ($rs_contact_details_rows['clandline'] !== "na") { echo $rs_contact_details_rows['clandline']; } else { echo ""; } ?></p>

   							<!-- Address -->
   							<p><?php if ($rs_contact_details_rows['caddress1'] === 'na' || $rs_contact_details_rows['caddress2'] === 'na' || $rs_contact_details_rows['caddress3'] === 'na' || $rs_contact_details_rows['csuburb'] === 'na') {

   								echo $rs_contact_details_rows['ccity'];

   							} elseif ($rs_contact_details_rows['caddress1'] !== 'na' || $rs_contact_details_rows['caddress2'] !== 'na' || $rs_contact_details_rows['caddress3'] !== 'na' || $rs_contact_details_rows['csuburb'] !== 'na') {
   								echo $rs_contact_details_rows['caddress1'] . ', ' . $rs_contact_details_rows['caddress2'] . ', ' . $rs_contact_details_rows['caddress3'] . ', ' . $rs_contact_details_rows['csuburb'] . ', ' . $rs_contact_details_rows['ccity'];
   							} ?>
   						</p>

   					</div>

   					<!-- Display details of both durban and cape town details -->
   					<?php } while ($rs_contact_details_rows = mysqli_fetch_assoc($rs_contact_details)) ?>

   					<!-- Email -->
   					<p> <?php
   					if ($rs_contact_details_rows['cemail'] !== 'na'){

   						$email = $rs_contact_details_rows['cemail'];
   						echo '<a href="mailto:' . escapeHex_email($email) . '">' . escapeHexEntity_email($email) . '</a>';

   					} else {
   						echo 'Not Available';
   					}
   					?></p>

         <div class="clearfix"></div>
       </article>


         <article>

           <h2>Find Us</h2>

           <iframe id="google-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4651.1734042333555!2d31.060058322215795!3d-29.722072062586683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa5f8fb4184204bcb!2siL+PALAZZO!5e0!3m2!1sen!2sza!4v1471332410192" frameborder="0" style="border:0" allowfullscreen></iframe>

         </article>

       </section>

       <!--========================= SIDEBAR ========================-->
       <?php require( PATH . '/inc-public-sidebar.php'); ?>

       <div class="clearfix"></div>
      </div>


     <!--========================== FOOTER ========================-->
     <?php require( PATH . '/inc-public-footer.php'); ?>

    </div>

    <script src="js/custom.js" charset="utf-8"></script>

  </body>
</html>

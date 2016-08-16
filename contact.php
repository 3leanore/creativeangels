<?php require('inc-public-pre-doctype.php'); ?>
<?php require('inc-email-encryption-function.php'); ?>
<?php
  // Creates session security code
    $_SESSION['svSecurity'] = sha1(date('YmdHis'));

     // Create SQL statement to fetch all records from tblcontactdetails
     $sql_contact_details = "SELECT * FROM tblcontactdetails";

     //Connect to MYSQL Server
     require('inc-conn.php');

     //Execute SQL statement
     $rs_contact_details = mysqli_query($vconn_creativeangels, $sql_contact_details);

     //Create associative Array
     $rs_contact_details_rows = mysqli_fetch_assoc($rs_contact_details);

 ?>
<!DOCTYPE HTML>
<html>
<head>

	<!-- HEAD CONTENT -->
	<?php require('inc-public-head-content.php'); ?>

<script src="js/hamburger-icon-animate.js" charset="utf-8"></script>
	<link rel="stylesheet" href="css/hamburger-icon-animate.css">

	<title>Creative Angels | Contact us</title>
</head>

<body>

	<!-- WRAPPER -->
	<section id="wrapper">

		<!-- HEADER -->
		<?php require('inc-public-header.php'); ?>

		<!-- NAVBAR WIDESCREEN -->
		<?php require('inc-public-navbar-widescreen.php'); ?>

		<!-- NAVBAR MOBILE-->
		<?php require('inc-public-navbar-mobile.php'); ?>

		<!-- CONTENT CONTAINER MAIN-->
		<section id="content_container">

			<!-- CONTENT CONTAINER LEFT -->
			<section id="content_left">

				<!-- CONTENT CONTAINER RIGHT ARTICLE 1 -->
				<article id="content_left_article_1">

					<h2>CONTACT US</h2>

					<br>
					<br>

					<p>
						<?php
						if ($rs_contact_details_rows['cemail'] !== 'na'){

							$email = $rs_contact_details_rows['cemail'];
							echo '<a href="mailto:' . escapeHex_email($email) . '">' . escapeHexEntity_email($email) . '</a>';

						}
						?>
					</p>

					<?php do { ?>
						<div class="location">

							<!-- city -->
							<h4><?php echo $rs_contact_details_rows['ccity']; ?></h4>
							<br>
							<br>

							<!-- Contact person -->
							<p><?php echo $rs_contact_details_rows['ccontactpersonname'] . ' ' . $rs_contact_details_rows['ccontactpersonsurname'] . '<br>'; ?></p>
							<br>

							<!-- Landline -->
							<p><?php if ($rs_contact_details_rows['clandline'] !== "na") { echo $rs_contact_details_rows['clandline'] . '<br><br>'; } else { echo ""; } ?></p>

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


				</article>

				<!-- CONTENT CONTAINER RIGHT ARTICLE 1 -->
        <!-- WRITE TO US FORM -->
				<article id="content_left_article_2">
					<h1>WRITE TO US</h1>

					<p> <?php
					if ($rs_contact_details_rows['cemail'] !== 'na'){

						$email = $rs_contact_details_rows['cemail'];
						echo '<a href="mailto:' . escapeHex_email($email) . '">' . escapeHexEntity_email($email) . '</a>';

					}
					?></p>

          <form method="post" action="write-to-us-process.php">
            <label for="txtName">Name</label>
            <input type="text" name="txtName">

            <br><br>

            <label for="txtEmail">*Email</label>
            <input type="email" name="txtEmail">

            <label for="txtMessage">Message</label>
            <textarea name="txtMessage" placeholder="Message goes here"></textarea>

            <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">

            <?php
              require_once('recaptchalib.php');
              $publickey = "6LfaticTAAAAAPvR8kVhcToBvbZn8Rxw6-EsHW_p"; // you got this from the signup page
              echo recaptcha_get_html($publickey);
            ?>

            <input type="submit" value="Send Message" >

          </form>



				</article>

				<article id="content_left_article_3">
					<h1>FIND US</h1>

					<br>
					<br>

          <iframe id="google-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4651.1734042333555!2d31.060058322215795!3d-29.722072062586683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa5f8fb4184204bcb!2siL+PALAZZO!5e0!3m2!1sen!2sza!4v1471332410192" frameborder="0" style="border:0" allowfullscreen></iframe>
				</article>

			</section>

			<!-- RIGHT SIDEBAR -->
				<?php require('inc-public-right-sidebar.php'); ?>

				<div class="clear_float"></div>

		</section>




		</section>

		<div class="clear_float"></div>

		<!-- FOOTER -->
		<?php require('inc-public-footer.php'); ?>

		<div class="clear_float"></div>

	</section>

	<script src="js/jquery.min.js" charset="utf-8"></script>
	<script>
		hamburgerIcon({
			showMenu: function() {
				$('#mobile_nav').slideDown();
			},
			hideMenu: function() {
				$('#mobile_nav').slideUp();
			}
		});

	</script>

	</script>

</body>
</html>

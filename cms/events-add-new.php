<?php require('inc-cms-pre-doctype.php'); ?>
<?php
$_SESSION['svSecurity'] = sha1(date('YmdHis'));
?>
<?php
// Function for printing out error messages
function errorMsg($keyName, $label) {

  // PHP checks whether certain keys have been returned with values in the GET Global Super Array, if it has then echo the value into the input field
  if(isset($_GET[$keyName]) && $_GET[$keyName] === '') {

    return "<div class='warning_msg'>Please enter " . $label . ".</div>";

  } //end if statement

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
    <!-- Head contents -->
    <?php require('inc-cms-head-content.php'); ?>

  </head>
  <body>
    <!-- PAGE WRAPPER -->
    <div id="page-wrapper">

      <!-- SIDEBAR MAIN MENU -->
      <?php require('inc-cms-sidebar.php'); ?>

        <!-- RIGHT COLUMN MAIN CONTENT CONTAINER -->
      <section class="right-content-wrapper">

        <!-- HEADER -->
        <header class="base">

          <!-- Branding container -->
          <?php require('inc-cms-branding-container.php'); ?>

          <!-- Page title -->
          <div class="page-header">
            <h2>Add New Event</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <!--#################### ADD NEW FORM #########################-->

          <form id="form" class="form" action="events-add-process.php" method="post" enctype="multipart/form-data">

            <!-- EVENT TITLE -->
            <label>Event Title</label>

            <!-- Displays warning message above empty field -->
            <?php echo errorMsg('ktitle', 'title'); ?>

            <input type="text" name="txtTitle" autocomplete="off" autofocus value="<?php echo displayTxt('ktitle'); ?>" required="">

            <!-- DESCRIPTION -->
            <label>Description</label>

            <?php echo errorMsg('kdescription', 'description'); ?>

            <textarea name="txtDescription" required=""><?php echo displayTxt('kdescription'); ?></textarea>

            <!-- DATE -->
            <label>Date <span class="fa fa-calendar"></span></label>

            <?php echo errorMsg('kdate', 'date'); ?>
            <input type="date" name="txtDate" value="<?php echo displayTxt('kdate'); ?>" required="">

            <!-- LOCATION -->
            <label>Location <span class="fa fa-map-marker"></span></label>

            <?php echo errorMsg('klocation', 'location'); ?>
            <input type="text" name="txtLocation" value="<?php echo displayTxt('klocation'); ?>" required="">

            <!-- TICKETS -->
            <label>Tickets <span class="fa fa-ticket"></span></label>

            <p>Where can people get tickets and how much would they cost.</p>

            <?php echo errorMsg('ktickets', 'ticket information'); ?>
            <input type="text" name="txtTickets" value="<?php echo displayTxt('ktickets'); ?>" required="">

            <!-- LINK TO FACEBOOK EVENT PAGE -->
            <label>Event Url <span class="fa fa-link"></span></label>

            <?php echo errorMsg('klink', 'link'); ?>
            <input type="url" name="txtLink" value="<?php echo displayTxt('klink'); ?>">

            <!-- IMAGES FOR EVENT -->
            <label>Upload Images <span class="fa fa-picture-o"></span></label>

            <?php echo errorMsg('kimg', 'image'); ?>
            <input type="file" name="img[]" multiple="">

            <p><small>Logo size may not exceed 2Mb  and must have either a .jpg or .jpeg file extension</small></p>

            <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">


            <!-- Button set -->
            <div class="button-set">

              <!-- submit form -->
              <button type="submit" name="btnAddNew">Save <span class="fa fa-check"></span></button>

              <a class="button danger-btn" href="events-display.php" name="btnCancel">Cancel <span class="fa fa-times"></span></a>

            </div>

          </form>

        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
  </body>
</html>

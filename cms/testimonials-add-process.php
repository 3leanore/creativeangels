<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// check if the form was submitted
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && $_SERVER['REQUEST_METHOD'] == 'POST') {

  $validation = 0;
  ini_set('memory_limit', '128M');

  include_once('inc-fn-sanitize.php');

  $vContributor = sanitize('txtContributor');
  $vTestimonial = sanitize('txtTestimonial');

  //------------------------- IMAGE UPLOAD --------------------------------

  include('inc-fn-img-upload.php');

  $vImg = '';
  $vImg = img_upload('txtImg', '../assets/uploads/testimonials/large/');
  $vImgThumb = img_upload('txtImg', '../assets/uploads/testimonials/large/', 180);

  if(!$vImg || !$vImgThumb) {
    $vImg = 'na';
  }

  // ------------------------ VALIDATION -----------------------------------
  if($vContributor && $vTestimonial) {
    // Validation passed
    require('inc-conn.php');
    require('inc-function-escapestring.php');

    // insert query
    $sql_insert = sprintf("INSERT INTO tbltestimonials (tcontributor, ttestimonial, timg) VALUES (%s, %s, %s)",
      escapestring($vconn_creativeangels, $vContributor, 'text'),
      escapestring($vconn_creativeangels, $vTestimonial, 'text'),
      escapestring($vconn_creativeangels, $vImg, 'text')
    );

    // Execute insert statement
    $vinsert_results = mysqli_query($vconn_creativeangels, $sql_insert);

    if($vinsert_results) {

      header('Location: testimonials-display.php');
      exit();

    } else {
      header('Location: signout.php');
      exit();

    } // DB end

  } else {

    $qs = '?kval=failed';
    $qs .= '&kcontributor=' . $vContributor;
    $qs .= '&vtestimonial=' . $vTestimonial;

    header('location: testimonials-add-new.php' . $qs);
    exit();
  } // Validation end


} else {
  header('location: signout.php');
  exit();
}

?>

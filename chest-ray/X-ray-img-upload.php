<?php

require_once('Model-API.php');

if(isset($_POST['submit-img'])){
    $extension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
    $dst_fname =  getcwd() .'/X-ray-images/' . time() . uniqid(rand()) . '.' . $extension;
    $dst_fname = str_replace('\\', '/', $dst_fname);
    move_uploaded_file($_FILES["img"]["tmp_name"],  $dst_fname);
    $result =classify_image($dst_fname);
} else {
    header("Location:chest-x-ray.php");
    exit();
}

?>



<!DOCTYPE html>
<html>
    <head>
        <title>predictive-care</title>
        <link rel="stylesheet" href="css/x_ray_img.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/all.min.css">
    
    </head>
    <body>
       <div class="chest_img">
            <div class="img_chest wow fadeInLeftBig" data-wow-delay="0.3s">
        <h1 style="text-align: center;">CHEST-X-RAY RESULT</h1>
       <table class=" wow fadeInLeftBig" data-wow-delay="0.3s">
  <thead>
    <tr>
      <th scope="col" style="text-align: center;">Result</th>
      <th scope="col" style="text-align: center;"><?php echo $result['class_name'] ?></th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      
       <th style="text-align: center;">Probability of NORMAL</th>
        <td style="text-align: center;"><?php echo $result['prob_NORMAL'] ?></td>
     
    </tr>
    <tr>
      
        <th style="text-align: center;">Probability of PNEUMONIA </th>
                <td style="text-align: center;"><?php echo $result['prob_PNEUMONIA'] ?></td>
    </tr>
    
  </tbody>
</table>
<div class="space"></div>
<a href="chest-x-ray.php">Upload Another Image</a>
<a href="../home.php">Done</a>
        </div>
       
</div>

<script src="js/wow.min.js"></script>
        <script>
          new WOW().init();
          </script>
        
       
    </body>
</html>
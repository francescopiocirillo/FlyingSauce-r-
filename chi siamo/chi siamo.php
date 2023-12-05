<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="chi siamo.css">
    <title>Chi siamo</title>
</head>
<body>
    <?php //require '../base/nav.php' ?>

    <!-- div per contenere uno slider per le slides -->
    <div class="slider">
      <!-- div per contenere le varie slides che scorrono -->
      <div class="slides">
        <!-- pulsanti per scorrere le slides -->
        <input type="radio" name="radio-btn" id="r1">
        <input type="radio" name="radio-btn" id="r2">
        <input type="radio" name="radio-btn" id="r3">
        <input type="radio" name="radio-btn" id="r4">

        <!-- le varie slides -->
        <div class="slide1">
          <img src="../media/chi_siamo1.jpg" alt="">
        </div>
        <div class="slide2">
          <img src="../media/chi_siamo2.jpg" alt="">
        </div>
        <div class="slide3">
          <img src="../media/chi_siamo3.png" alt="">
        </div>
        <div class="slide4">
          <img src="../media/chi_siamo4.jpg" alt="">
        </div>

        <div class="navigation-auto">
          <div class="auto-btn1"></div>
          <div class="auto-btn2"></div>
          <div class="auto-btn3"></div>
          <div class="auto-btn4"></div>
        </div>

        <div class="navigation-manual">
          <label for="radio1" class="manual-btn1"></label>
          <label for="radio2" class="manual-btn2"></label>
          <label for="radio3" class="manual-btn3"></label>
          <label for="radio4" class="manual-btn4"></label>
        </div>

      </div>
    </div>

</body>
</html>

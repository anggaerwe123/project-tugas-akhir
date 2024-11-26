<?php include 'session.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Style -->
     <link rel="stylesheet" href="style.css">

    <!-- Icon -->
    <link rel="icon" href="../images/logo.png">
     
    <title>WeKresss</title>
  </head>
  <body>
    
  <!-- Header -->
<?php include 'header.php'; ?>
    <!-- Akhir Header -->

    <!-- Container -->
     <div class="container-fluid pt-5 pb-5 mb-5">
        <div class="container">
          <div class="text-center">
          <h3>Umpan Balik</h3>
          <p>Silahkan kirim umpan balik anda jika anda berlangganan untuk kami</p>
          </div>
            <div class="card shadow box-area">

                <div class="card-header d-flex">
                  <img src="images/logo.png" width="50" alt="" srcset="">
                  <div class="ms-auto my-2">
                    Feedback
                  </div>
                </div>
                
                
                <div class="card-body pt-5 pb-5">
                <form action="../source/kirim_feedback.php" method="POST">
                <div class="form-group mb-3">
                    <label for="komentar">Komentar</label>
                    <textarea class="form-control" id="komentar" name="komentar" placeholder="Masukkan Komentar" style="height: 200px;"></textarea>
                </div>
                
                <div class="mb-3">
                <label for="komentar">Rating</label>
                <div class="rateyo" id= "rating" data-rateyo-rating="4" data-rateyo-num-stars="5" data-rateyo-score="3"></div>
                <span class='result'>0</span>
                <input type="hidden" name="rating">
                </div>

    <button type="submit" class="btn btn-primary" title="Kirim Feedback">Kirim Umpan Balik</button>
    </div>

</form>

                </div>

            </div>
        </div>
    </div>

     <br>
     <br>
     <br>
     <br>
     <br>
     <br>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script>


    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });

</script>
  </body>
</html>
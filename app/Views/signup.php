<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page Design</title>

    <!--bootstrap links-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <!--css link-->
    <link rel="stylesheet" href="<?php echo base_url()  ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url()  ?>/css/responsive.css">
    <!--google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!--owl slider link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

</head>

<body>

    <!--signup section start hare-->
    <section class="Signup_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="Signup_textsc">
                        <div class="Signup_lefttxtbox">
                            <a href="<?php echo base_url('/')  ?>">
                                <img src="<?php echo base_url('images/15.jpg') ?>" alt="singupimg" class="Signup_img">
                            </a>
                        </div>
                        <div class="Signup_righttxtbox">
                            <h3>Sign Up</h3>
                            <?php if (isset($validation)) :  ?>
                                <div class="col-12">
                                    <div class="alert alert-danger" role="alert">
                                        <?= $validation->listErrors()   ?>
                                    </div>
                                </div>
                            <?php endif  ?>
                            <?php if (isset($Flash_message)) :  ?>
                                <div class="col-12">
                                    <div class="alert alert-success" role="alert">
                                        Congratulations! Your Registration is Successfully
                                    </div>
                                </div>
                            <?php endif  ?>
                            <form class="Signup_formsc" method="post" action="/signup">
                                <input type="text" placeholder="First Name" class="Signup_input" name="firstname" value="<?= set_value('firstname')  ?>">
                                <input type="text" placeholder="Last Name" class="Signup_input" name="lastname" value="<?= set_value('lastname')  ?>">
                                <input type="email" placeholder="Email" class="Signup_input" name="email" value="<?= set_value('email')  ?>">
                                <input type="password" placeholder="Password" class="Signup_input" name="password" value="<?= set_value('password')  ?>">
                                <input type="password" placeholder="Password" class="Signup_input" name="passconf" value="<?= set_value('passconf')  ?>">
                                <button class="Signup_formbtn">Sign Up</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--signup section end hare-->

    <!--bootstrap links-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <!--owl slider link-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


</body>

</html>
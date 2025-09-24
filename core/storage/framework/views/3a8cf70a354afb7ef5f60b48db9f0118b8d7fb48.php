<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <meta name="theme-color" content="#2196f3">
    <meta name="author" content="DexignZone"/>
    <meta name="keywords" content=""/>
    <meta name="robots" content=""/>
    <meta name="description" content="Foodia - Food Restaurant Mobile App Template ( Bootstrap 5 + PWA )"/>
    <meta property="og:title" content="Foodia - Food Restaurant Mobile App Template ( Bootstrap 5 + PWA )"/>
    <meta property="og:description" content="Foodia - Food Restaurant Mobile App Template ( Bootstrap 5 + PWA )"/>
    <meta property="og:image" content="https://makaanlelo.com/tf_products_007/foodia/xhtml/social-image.png"/>
    <meta name="format-detection" content="telephone=no">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(url('')); ?>/assets/assets/images/favicon.png"/>

    <!-- Title -->
    <title>ACELOGS MARKET PLACE</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo e(url('')); ?>/assets/assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('')); ?>/assets/assets/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&family=Roboto+Slab:wght@100;300;500;600;800&display=swap"
        rel="stylesheet">

</head>
<body class="bg-white">
<div class="page-wraper">

    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Preloader end-->

    <!-- Page Content -->
    <div class="page-content">

        <!-- Banner -->
        <div class="banner-wrapper">

            <div class="container inner-wrapper">
                <a href="/">
                    <img src="<?php echo e(url('')); ?>/assets/assets/images/logo.svg" width="300" height="250">
                </a>
                <p class="mb-0">Verify Code</p>
            </div>


        </div>
        <!-- Banner End -->
        <div class="account-box">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-7 col-xl-5">
                        <div class="d-flex justify-content-center">
                            <div class="verification-code-wrapper">

                                <?php if($errors->any()): ?>
                                    <div class="alert alert-danger">
                                        <ul>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <?php if(session()->has('message')): ?>
                                    <div class="alert alert-success">
                                        <?php echo e(session()->get('message')); ?>

                                    </div>
                                <?php endif; ?>
                                <?php if(session()->has('error')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e(session()->get('error')); ?>

                                    </div>
                                <?php endif; ?>

                                <div class="verification-area">
                                    <form action="<?php echo e(route('user.password.verify.code')); ?>" method="POST"
                                          class="submit-form">
                                        <?php echo csrf_field(); ?>
                                        <p class="mb-3"><?php echo app('translator')->get('A 6 digit verification code sent to your email address'); ?>
                                            : <?php echo e(showEmailAddress($email)); ?></p>
                                        <input type="hidden" name="email" value="<?php echo e($email); ?>">

                                        <label>Verification Code</label>
                                        <input type="text" name="code" id="verification-code" class="form-control overflow-hidden my-2 mb-4" required autocomplete="off">

                                        <div class="form-group my-3">
                                            <button type="submit" class="btn btn-block" style="background: linear-gradient(90deg, #0F0673 0%, #B00BD9 100%); color: white;"><?php echo app('translator')->get('Submit'); ?></button>
                                        </div>

                                        <div class="form-group">
                                            <?php echo app('translator')->get('Please check including your Junk/Spam Folder. if not found, you can'); ?>
                                            <a href="<?php echo e(route('user.password.request')); ?>"
                                               class="text--base"><?php echo app('translator')->get('Try to send again'); ?></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Page Content End -->

<!--**********************************
    Scripts
***********************************-->
<script src="<?php echo e(url('')); ?>/assets/assets/js/jquery.js"></script>
<script src="<?php echo e(url('')); ?>/assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo e(url('')); ?>/assets/assets/js/settings.js"></script>
<script src="<?php echo e(url('')); ?>/assets/assets/js/custom.js"></script>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/project/aacelogs/core/resources/views/templates/basic/user/auth/passwords/code_verify.blade.php ENDPATH**/ ?>
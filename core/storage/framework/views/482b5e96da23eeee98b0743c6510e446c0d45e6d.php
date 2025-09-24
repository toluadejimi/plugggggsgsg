<?php $__env->startSection('content'); ?>


    <style>
        div#social-links {
            margin: 0 auto;
            max-width: 500px;
        }
        div#social-links ul li {
            display: inline-block;
        }
        div#social-links ul li a {
            padding: 10px;
            border: 1px solid #fff;
            margin: 2.5px;
            font-size: 20px;
            color: #222;
            background-color: #6778ff;
            border-radius: 10px;
            color: white;
        }
    </style>

    <div class="dashboard-body__content">

    <!-- Page Content -->

        <?php if($errors->any()): ?>
            <div class="alert alert-danger my-4">
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
            <div class="alert alert-danger mt-2">
                <?php echo e(session()->get('error')); ?>

            </div>
        <?php endif; ?>

    <div class="">
            <div class="d-flex justify-content-center my-4">
                <img class="my-2"
                    src="<?php echo e(getImage(getFilePath('product') . '/' . $product->image, getFileSize('product'))); ?>" width="100px" height="100px">
            </div>
    </div>

        <div class="dashboard-body__item my-2">
        <div class="">
            <div class="detail-content">
                <div class="flex-1">
                    <h4><?php echo e(__($product->name)); ?></h4>
                    <p> <?php echo $product->description; ?></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6 d-flex justify-content-start">
                    <h6 class="">NGN<?php echo e(number_format($product->price)); ?>/Pcs</h6>
                </div>

                <div class="col-6 d-flex justify-content-end" style="color: #0a0e26">
                    <button type="button" style="background: #0a0e26; border-color: #0F0673; color: #0a0e26" class="btn text-dark btn-sm"> <?php echo e(number_format($product->in_stock)); ?> pcs in
                        stock
                    </button>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-6 d-flex justify-content-start">
                    <button style="background-color: #4d4d4d; color: white" class="btn"
                            onclick="decrementQuantity()">-
                    </button>
                    <span class="p-2" id="quantity">1</span>
                    <button style="background-color: #110248; color: white" class="btn"
                            onclick="incrementQuantity()">+
                    </button>
                </div>

                <div class="col-6 d-flex justify-content-end">
                    <button type="button"
                            style="background: linear-gradient(90deg, #0F0673 0%, #B00BD9 100%); color:#ffffff;"
                            class="btn btn-main btn-sm w-70 pill">NGN<span id="total">10.00</span></button>

                </div>
            </div>
            <hr>

            <div class="col-12 mt-3">
                <h6  class="mb-3">Share product</h6>
               <span class=""><?php echo $shareComponent; ?> </span>
            </div>



            <form action="<?php echo e(route('user.deposit.insert')); ?>" method="POST">
                <?php echo csrf_field(); ?>




                <input type="text" hidden id="quantityInput" name="qty" value="1">
                <input type="text" hidden name="id" value="<?php echo e($product->id); ?>">
                <input type="text" hidden type="text" name="payment" value="wallet">
                <input type="text" hidden name="gateway" value="250">


                <div class="card my-5">
                    <div class="card-body">

                        <div class="card-title mt-3 text-center">
                            <h6>Disclaimer</h6>

                        </div>


                        <div class="text-center">
                          <p>By purchasing any product, you agree that you are fully aware of these
                                terms/conditions and agree to follow them! 👉🏽<a href="#" data-bs-toggle="modal" data-bs-target="#TermsModal"> TERMS AND
                                    CONDITIONS</a></p>

                        </div>


                    </div>
                </div>



                <button type="button" class="btn btn--danger btn--gradi btn--shadow w-100 btn-lg userStatus" >
                    <i class="las la-wallet"></i><?php echo app('translator')->get('Remove Fund'); ?>
                </button>


                <div id="TermsModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                 Terms and Condition
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="las la-times"></i>
                                </button>
                            </div>

                            <div class="modal-body">
                                <p class="text-center">
                                    Don’t use our product to harm other people , bullying on social networks, comment spam, threats, etc and to commit other illegal actions – fraud, extortion, data theft, etc.
                                    <br/><br/>We do not support scam/fraud activities, so <span class="text-danger">DO NOT USE OUR PRODUCTS FOR ILLEGAL ACTIVITIES .</span>
                                </p>
                            </div>




                        </div>
                    </div>
                </div>




                <div class="container">


                        <?php if($product->in_stock > 0): ?>
                        <button type="submit"
                                style="background: linear-gradient(90deg, #0F0673 0%, #B00BD9 100%); color:#ffffff;"
                                class="btn btn-main btn-lg w-100 pill">
                            <svg class="cart me-1" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18.1776 17.8443C16.6362 17.8428 15.3854 19.0912 15.3839 20.6326C15.3824 22.1739 16.6308 23.4247 18.1722 23.4262C19.7136 23.4277 20.9643 22.1794 20.9658 20.638C20.9658 20.6371 20.9658 20.6362 20.9658 20.6353C20.9644 19.0955 19.7173 17.8473 18.1776 17.8443Z"
                                    fill="white"/>
                                <path
                                    d="M23.1278 4.47973C23.061 4.4668 22.9932 4.46023 22.9251 4.46012H5.93181L5.66267 2.65958C5.49499 1.46381 4.47216 0.574129 3.26466 0.573761H1.07655C0.481978 0.573761 0 1.05574 0 1.65031C0 2.24489 0.481978 2.72686 1.07655 2.72686H3.26734C3.40423 2.72586 3.52008 2.82779 3.53648 2.96373L5.19436 14.3267C5.42166 15.7706 6.66363 16.8358 8.12528 16.8405H19.3241C20.7313 16.8423 21.9454 15.8533 22.2281 14.4747L23.9802 5.74121C24.0931 5.15746 23.7115 4.59269 23.1278 4.47973Z"
                                    fill="white"/>
                                <path
                                    d="M11.3404 20.5158C11.2749 19.0196 10.0401 17.8418 8.54244 17.847C7.0023 17.9092 5.80422 19.2082 5.86645 20.7484C5.92617 22.2262 7.1283 23.4008 8.60704 23.4262H8.67432C10.2142 23.3587 11.4079 22.0557 11.3404 20.5158Z"
                                    fill="white"/>
                            </svg>
                            BUY NOW
                        </button>

                        <?php else: ?>
                            <button type="submit"
                                    style="background: linear-gradient(90deg, #0F0673 0%, #B00BD9 100%); color:#ffffff;"
                                    disabled
                                    class="btn btn-main btn-lg w-100 pill">
                                <svg class="cart me-1" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18.1776 17.8443C16.6362 17.8428 15.3854 19.0912 15.3839 20.6326C15.3824 22.1739 16.6308 23.4247 18.1722 23.4262C19.7136 23.4277 20.9643 22.1794 20.9658 20.638C20.9658 20.6371 20.9658 20.6362 20.9658 20.6353C20.9644 19.0955 19.7173 17.8473 18.1776 17.8443Z"
                                        fill="white"/>
                                    <path
                                        d="M23.1278 4.47973C23.061 4.4668 22.9932 4.46023 22.9251 4.46012H5.93181L5.66267 2.65958C5.49499 1.46381 4.47216 0.574129 3.26466 0.573761H1.07655C0.481978 0.573761 0 1.05574 0 1.65031C0 2.24489 0.481978 2.72686 1.07655 2.72686H3.26734C3.40423 2.72586 3.52008 2.82779 3.53648 2.96373L5.19436 14.3267C5.42166 15.7706 6.66363 16.8358 8.12528 16.8405H19.3241C20.7313 16.8423 21.9454 15.8533 22.2281 14.4747L23.9802 5.74121C24.0931 5.15746 23.7115 4.59269 23.1278 4.47973Z"
                                        fill="white"/>
                                    <path
                                        d="M11.3404 20.5158C11.2749 19.0196 10.0401 17.8418 8.54244 17.847C7.0023 17.9092 5.80422 19.2082 5.86645 20.7484C5.92617 22.2262 7.1283 23.4008 8.60704 23.4262H8.67432C10.2142 23.3587 11.4079 22.0557 11.3404 20.5158Z"
                                        fill="white"/>
                                </svg>
                                Out of Stock
                            </button>
                        <?php endif; ?>



                    </div>
            </form>

        </div>


    </div>
    </div>
    </div>
    <!-- Page Content End -->


    <!-- Footer -->
    
    <!-- Footer End -->

    </div>


    <!--**********************************
    Scripts
    ***********************************-->

    <script>
        // Variables to track quantity and price
        let quantity = 1;
        const price = <?php echo e($product->price); ?>;

        // Functions to increment and decrement quantity
        function incrementQuantity() {
            quantity++;
            updateView();
        }

        function decrementQuantity() {
            if (quantity > 1) {
                quantity--;
                updateView();
            }
        }

        // Function to update the view with new quantity and total
        function updateView() {
            const quantityElement = document.getElementById("quantity");
            const totalElement = document.getElementById("total");
            const quantityInput = document.getElementById("quantityInput");

            const total = (quantity * price).toFixed(2);

            quantityElement.textContent = quantity;
            totalElement.textContent = total;
            quantityInput.value = quantity;
        }

        // Function to submit quantity to the server
        function submitQuantity() {
            const quantityInput = document.getElementById("quantityInput");
            alert("Quantity submitted: " + quantityInput.value);
            // You can send the quantityInput.value to the server here
        }

        // Initialize the view
        updateView();
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/project/loggsplug/core/resources/views/templates/basic/product_details.blade.php ENDPATH**/ ?>
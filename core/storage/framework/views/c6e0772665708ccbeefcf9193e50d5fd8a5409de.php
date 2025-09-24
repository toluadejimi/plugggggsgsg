<?php $__env->startSection('content'); ?>



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <p class="text-center mt-2"><?php echo app('translator')->get('You have requested'); ?> <b
                                                class="text-success"><?php echo e(showAmount($data['amount'])); ?> <?php echo e(__($general->cur_text)); ?></b>
                                            , <?php echo app('translator')->get('Please pay'); ?>
                                            <b class="text-success"><?php echo e(showAmount($data['final_amo']) .' '.$data['method_currency']); ?> </b> <?php echo app('translator')->get('for successful payment'); ?>
                                        </p>
                                        <h5 class="text-center mb-4"><?php echo app('translator')->get('Please follow the instruction below'); ?></h5>

                                        <p class="my-4 text-center"><?php echo  $data->gateway->description ?></p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                <form id="myForm" action="<?php echo e(route('user.deposit.manual.update')); ?>" method="POST"
                                      enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>


                                    <div class="row mb-3">

                                        <label class="my-3">Sender Name</label>
                                        <input class="form-control" name="user_name">

                                        <label class="my-3">Debit Screenshot</label>
                                        <input type="file" name="receipt" class="btn btn-default"
                                               style="background: #e9e9e9; color: rgb(58, 160, 255);">

                                        <div class="footer fixed">
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


                                            <div class="container">
                                                <button type="submit"
                                                        style="background: linear-gradient(90deg, #0F0673 0%, #B00BD9 100%); color:#ffffff;"
                                                        id="submitButton"
                                                        class="btn btn-primary text-start w-100 btn-rounded">
                                                    <svg class="cart me-4" width="16" height="16" viewBox="0 0 18 18"
                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M17.5158 2.01275C17.9478 0.81775 16.7898 -0.34025 15.5948 0.0927503L0.989804 5.37475C-0.209196 5.80875 -0.354196 7.44475 0.748804 8.08375L5.4108 10.7828L9.5738 6.61975C9.76241 6.43759 10.015 6.3368 10.2772 6.33908C10.5394 6.34135 10.7902 6.44652 10.9756 6.63193C11.161 6.81734 11.2662 7.06815 11.2685 7.33035C11.2708 7.59255 11.17 7.84515 10.9878 8.03375L6.8248 12.1968L9.5248 16.8587C10.1628 17.9617 11.7988 17.8158 12.2328 16.6178L17.5158 2.01275Z"
                                                            fill="white"/>
                                                    </svg>
                                                    PAY NOW
                                                    <span class="spinner"></span>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>


        <script>
            document.getElementById('myForm').addEventListener('submit', function(event) {
                var submitButton = document.getElementById('submitButton');
                var spinner = submitButton.querySelector('.spinner');

                // Prevent form submission
                event.preventDefault();

                // Disable the button
                submitButton.disabled = true;

                // Show the spinner
                spinner.style.display = 'inline-block';

                // Simulate submission delay (remove setTimeout in actual implementation)
                setTimeout(function() {
                    // Re-enable the button
                    submitButton.disabled = true;

                    // Hide the spinner
                    spinner.style.display = 'none';

                    document.getElementById('myForm').submit();
                    // You can add code to submit the form data here

                }, 2000); // 2000 milliseconds = 2 seconds (adjust as needed)
            });
        </script>


    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate.'layouts.nofooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/project/aacelogs/core/resources/views/templates/basic/user/payment/manual.blade.php ENDPATH**/ ?>
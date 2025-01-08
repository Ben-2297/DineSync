<div>
    <section class="home" id="home">
        <div class="main-container">
            <div class="content-bx">
                <h3>Today's New on Menu</h3>
                <h1>Appetizing in every bite</h1>
                <p>Delicious food for more than a decade!</p>
                <a href="<?php echo e(route('order')); ?>"><button>Order Now</button></a>
                <div class="menu-card">
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="card">
                            <img src="<?php echo e(url('storage/photo/'.$prod->photo)); ?>" alt="" class="dis">
                            <h4>$<?php echo e($prod->price); ?></h4>
                            <h5><?php echo e($prod->title); ?></h5>
                            <p><?php echo e($prod->description); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="card">
                            <img src="<?php echo e(asset('noimage.png')); ?>" alt="" class="dis">
                            <h4>$##.##</h4>
                            <h5>Sample</h5>
                            <p>Sample</p>
                        </div>
                        <div class="card">
                            <img src="<?php echo e(asset('noimage.png')); ?>" alt="" class="dis">
                            <h4>$##.##</h4>
                            <h5>Sample</h5>
                            <p>Sample</p>
                        </div>
                        <div class="card">
                            <img src="<?php echo e(asset('noimage.png')); ?>" alt="" class="dis">
                            <h4>$##.##</h4>
                            <h5>Sample</h5>
                            <p>Sample</p>
                        </div>
                        <div class="card">
                            <img src="<?php echo e(asset('noimage.png')); ?>" alt="" class="dis">
                            <h4>$##.##</h4>
                            <h5>Sample</h5>
                            <p>Sample</p>
                        </div>
                        <div class="card">
                            <img src="<?php echo e(asset('noimage.png')); ?>" alt="" class="dis">
                            <h4>$##.##</h4>
                            <h5>Sample</h5>
                            <p>Sample</p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="btn-scroll">
                    <i class='bx bxs-left-arrow-circle'></i>
                    <i class='bx bxs-right-arrow-circle' ></i>
                </div>
            </div>
            <div class="dish-bx">
                <?php if(!empty($pro->photo)): ?>
                    <img src="<?php echo e(url('storage/photo/'.$pro->photo)); ?>" alt="" id="poster">
                <?php else: ?>
                    <img src="<?php echo e(asset('noimage.png')); ?>" alt="" id="poster">
                <?php endif; ?>
            </div>
        </div>
    </section>
</div><?php /**PATH D:\Dynamic Website Project\SAWMS\SAROS-orderSYS\resources\views/livewire/homepage/home-section.blade.php ENDPATH**/ ?>
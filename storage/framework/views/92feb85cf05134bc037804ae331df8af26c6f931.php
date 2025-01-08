<div>
    <section class="order" id="order">
		<div class="center-text">
			<h3>Order Queue</h3>
		</div>

		<div wire:poll.keep-alive class="order-display" style="display: flex; justify-content: center; align-item: center; border-radius: 30px">
            <div class="order-content">
                <div class="order-text">
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="box-order">
                        <div class="box-order-content">
                            <div class="box-order-img">
                                <img src="<?php echo e(url('storage/photo/'.$order->product->photo)); ?>">
                            </div>
                            
                            <div class="order-text">
                                <h6>#<?php echo e($orders->firstItem() + $index); ?><h6>
                                <h4><?php echo e($order->chef->fname); ?> <?php echo e($order->chef->lname); ?></h4>
                                <p>Orders Id: <?php echo e($order->id); ?></p>
                                <p>Status Update: <?php echo e($order->updated_at); ?></p>
                                <p>Quantity: <?php echo e($order->quantity); ?> <?php echo e($order->type); ?></p>
                                <p>Total Price: <?php echo e($order->total); ?></p>
                                <h6>Orders Status: <?php echo e($order->status); ?></h6>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="box-order">
                        <div class="box-order-content">
                            <div class="box-order-img">
                                <img src="<?php echo e(asset('noimage.png')); ?>">
                            </div>
                            
                            <div class="order-text">
                                <h1>You don't have order today</h1>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
	</section>
</div><?php /**PATH D:\Dynamic Website Project\SAWMS\SAROS-orderSYS\resources\views/livewire/homepage/order-section.blade.php ENDPATH**/ ?>
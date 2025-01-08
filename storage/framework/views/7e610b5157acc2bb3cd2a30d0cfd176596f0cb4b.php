<div>
    <section class="menu" id="menu">
		<div class="center-text">
			<h3>Food Menu</h3>
			<h2>Delicious food</h2>
		</div>

		<div class="center-text1">
			<div style="display: flex; justify-content: space-between; padding: 2% 20%">
				<button wire:click="filterMenu('specialty')" style="background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;"><span>Specialty</span></button>
				<span>|</span>
				<button wire:click="filterMenu('pork')" style="background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;"><span>Pork</span></button>
				<span>|</span>
				<button wire:click="filterMenu('beef')" style="background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;"><span>Beef</span></button>
				<span>|</span>
				<button wire:click="filterMenu('chicken')" style="background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;"><span>Chicken</span></button>
				<span>|</span>
				<button wire:click="filterMenu('seafood')" style="background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;"><span>Seafood</span></button>
				<span>|</span>
				<button wire:click="filterMenu('vegetables')" style="background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;"><span>Vegetables</span></button>
				<span>|</span>
				<button wire:click="filterMenu('noodles')" style="background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;"><span>Noodles</span></button>
				<span>|</span>
				<button wire:click="filterMenu('desert')" style="background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;"><span>Desert</span></button>
			</div>
		</div>

		<div wire:poll.keep-alive class="menu-content">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="box">
				<div class="box-content">
					<div class="box-img">
						<img src="<?php echo e(url('storage/photo/'.$prod->photo)); ?>" alt="">
					</div>

					<div class="box-text">
						<h4><?php echo e($prod->title); ?></h4>
						<p><?php echo e($prod->description); ?></p>
						<div class="bottom-contents">
							<?php if(Auth::check() && Auth::user()->role === 'user'): ?>
								<?php if(DB::table('carts')->where('customer_id', DB::table('customers')->where('customer_id' , auth()->user()->id)->pluck('id'))->where('product_id', $prod->id)->exists()): ?>
									<li style="background: #7dd87d; border-radius: 50%; height: 4rem; width: 4rem; transition: 1s linear;"><a href="" wire:click.prevent="addtoCart(<?php echo e($prod->id); ?>)" class='bx bxs-cart' style="line-height: 4rem; font-size: 2rem; color: #ffffff; display: flex; justify-content: center;"></a></li>
								<?php else: ?>
									<li><a href="" wire:click.prevent="addtoCart(<?php echo e($prod->id); ?>)" class='bx bxs-cart'></a></li>
								<?php endif; ?>
							<?php endif; ?>
							<h6>$<?php echo e($prod->price); ?></h6>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
			<div class="box">
				<div class="box-content">
					<div class="box-img">
						<img src="<?php echo e(asset('noimage.png')); ?>" alt="">
					</div>

					<div class="box-text">
						<h4>Sample</h4>
						<p>Sample</p>
						<div class="bottom-content">
							<h6>$##.##</h6>
						</div>
					</div>
				</div>
			</div>
			<div class="box">
				<div class="box-content">
					<div class="box-img">
						<img src="<?php echo e(asset('noimage.png')); ?>" alt="">
					</div>

					<div class="box-text">
						<h4>Sample</h4>
						<p>Sample</p>
						<div class="bottom-content">
							<h6>$##.##</h6>
						</div>
					</div>
				</div>
			</div>
			<div class="box">
				<div class="box-content">
					<div class="box-img">
						<img src="<?php echo e(asset('noimage.png')); ?>" alt="">
					</div>

					<div class="box-text">
						<h4>Sample</h4>
						<p>Sample</p>
						<div class="bottom-content">
							<h6>$##.##</h6>
						</div>
					</div>
				</div>
			</div>
			<div class="box">
				<div class="box-content">
					<div class="box-img">
						<img src="<?php echo e(asset('noimage.png')); ?>" alt="">
					</div>

					<div class="box-text">
						<h4>Sample</h4>
						<p>Sample</p>
						<div class="bottom-content">
							<h6>$##.##</h6>
						</div>
					</div>
				</div>
			</div>
            <?php endif; ?>
		</div>
	</section>
</div>
<?php /**PATH D:\Dynamic Website Project\SAWMS\SAROS-orderSYS\resources\views/livewire/homepage/menu-section.blade.php ENDPATH**/ ?>
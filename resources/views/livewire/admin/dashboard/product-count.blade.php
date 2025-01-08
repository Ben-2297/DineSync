<div class="col-lg-3 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <div class="d-flex justify-content-between">
            <h3 wire:poll.keep-alive>{{ $productCount }}</h3>
            
            <select wire:change="getproductCount($event.target.value)" style="height: 2rem; outline: 2px solid transparent;" class="px-1 rounded border-0">
                <option value="">All</option>
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
            </select>
        </div>

        <p>Foods</p>
      </div>
    </div>
</div>

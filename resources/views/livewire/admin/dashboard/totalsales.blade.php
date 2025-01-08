<div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>
    
                <div class="info-box-content" wire:poll.keep-alive>
                <span class="info-box-text">Total Sales</span>
                <span class="info-box-number">{{ $TotalSales }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
    
                <div class="info-box-content" wire:poll.keep-alive>
                <span class="info-box-text">Today Sales</span>
                <span class="info-box-number">{{ $TodaySales }}</span>
                </div>
            </div>
        </div>
    
        <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>
    
                <div class="info-box-content" wire:poll.keep-alive>
                <span class="info-box-text">Yesterday Sales</span>
                <span class="info-box-number">{{ $YesterdaySales }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>
    
                <div class="info-box-content" wire:poll.keep-alive>
                <span class="info-box-text">Monthly Sales</span>
                <span class="info-box-number">{{ $MonthySales }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-shopping-cart"></i></span>
        
                <div class="info-box-content" wire:poll.keep-alive>
                    <span class="info-box-text">Yearly Sales</span>
                    <span class="info-box-number">{{ $YearSales }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Counter</div>

                <div class="card-body">
                    <div class="col-6">
                        <button wire:click="increment">+</button>
                        <h1>{{ $count }}</h1>
                        <button wire:click="decrement">-</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

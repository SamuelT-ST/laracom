<div class="row">
    <div class="col mr-3">
        @include('admin.order.components.left-elements')
    </div>
    <div class="col">
        <div class="card">
            @include('admin.order.components.right-elements')
        </div>
    </div>
</div>

<div class="row card">
    <div class="card-header">

    </div>

    <div class="card-body">
        @include('admin.order.components.products')
    </div>

</div>

@include('admin.order.components.add-new-customer-modal')


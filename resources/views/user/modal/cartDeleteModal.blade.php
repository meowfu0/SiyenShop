<!-----MODAL TO DELETE ITEM IN CART IT ALSO PASSES ID     --->
<div class="modal fade  delete_modal" id="deleteModal-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center flex-column text-center">
                <img src="{{ asset('images/check.png') }}" style="height: 70px; width:70px; display:none;" alt="Cart Logo">
                <p class="fw-semibold fs-5 mt-3">Are you sure you want to remove this item?</p>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-end mb-2">
                <button type="button" class="btn btn-outline-primary btn-md w-25" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger btn-md w-25" id="delete_items" data-id="{{ $item->id }}">Delete</button>
            </div>
        </div>
    </div>
</div>




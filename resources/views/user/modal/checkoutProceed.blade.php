
<!------------------MODAL FOR PROCEED CHECKOUT BUTTON------->

<div class="modal fade" id="ModalProceed" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered p-5">
    <div class="modal-content">
      <div class="modal-header border-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex justify-content-center">
        <p class="fw-semibold fs-6">Proceed to Checkout?</p>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-outline-primary btn-md w-25" data-bs-dismiss="modal">No</button>
        <a href="{{ route('checkOutPage') }}" class="btn btn-primary btn-md w-25">Yes</a>
      </div>
    </div>
  </div>
</div>



 







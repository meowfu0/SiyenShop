<div class="modal fade" id="ModalProceedPayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex justify-content-center">
        <p class="fw-semibold fs-5">Are the given information correct?</p>
      </div>
      <div class="modal-footer border-0">
        
        <!-- Form to handle "Yes" -->
        <form action="{{ route('payment') }}" method="POST" class="d-flex w-50 gap-1">
          @csrf
          <input type="hidden" name="id" value="{{ $id }}">
          <button type="button" class="btn btn-outline-primary btn-md w-75" data-bs-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary btn-md w-75">Yes</button>
        </form>

      </div>
    </div>
  </div>
</div>
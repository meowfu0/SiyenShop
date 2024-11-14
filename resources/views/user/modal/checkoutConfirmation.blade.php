
<div class="modal fade" id="ModalConfirmed" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
       <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  ---->
      </div>
      <div class="modal-body d-flex justify-content-center align-items-center flex-column text-center">
    <img src="{{ asset('images/check.png') }}" style="height: 70px; width:70px;" alt="Cart Logo">
    <p class="fw-semibold fs-6 mt-3">Your order has been confirmed!</p>
</div>
      <div class="modal-footer border-0 d-flex justify-content-center mb-2">
      <!------need to change the route to the homepage--> 
        <a href="{{route('home')}}" class="btn btn-outline-primary btn-md"style="width:170px;" >Return To Homepage
        </a>
        <a href="{{route('mypurchases')}}" class="btn btn-primary btn-md" style="width:160px;">View order</a>
      </div>
    </div>
  </div>
</div>
 



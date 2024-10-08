<!-- Modal -->
<div class="modal fade" id="modal_profile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_profile_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modal_profile_label">{{__('dog.show.registered_by')}}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @include('dogs.partials.adopters_card', ['with_potential' => false])
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
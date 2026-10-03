<div class="modal fade" id="add_modal">
  <form @if(isset($route)) data-route="{!!$route!!}" @endif @if(isset($route_function)) data-route_function="{!!$route_function!!}" @endif class="ajax_validate_form" enctype="multipart/form-data" method="post" id="{!!$id!!}">
    <div class="modal-dialog @if(isset($modal_class)) {!!$modal_class!!} @endif">
      <div class="modal-content">
        <div class="modal-header bg-body-secondary">
          <h4 class="modal-title">{!!$title!!}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body bg-light-subtle">
          @yield('modal_body_add_component')
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('page.cancel')}}</button>
          <button type="submit" class="btn btn-primary">{{__('page.submit')}}</button>
        </div>
      </div>

    </div>
  </form>
</div>

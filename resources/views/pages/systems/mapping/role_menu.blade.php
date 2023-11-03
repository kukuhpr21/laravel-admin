@extends('base')
@section('title', "Mapping Role Menu")
@section('content')
<h4 class="fw-bold py-3 mb-4">
    @yield('title')
</h4>
@include('partials/toasts')
<div class="col-md-12 mb-4 mb-md-0">
    <div class="card">
      <form id="form" class="browser-default-validation" method="POST" action="{{ route('view-mapping-role-menu') }}">
      @csrf
        <div class="card-header">
          <div class="col-md-4 mb-3">
            <label class="form-label">Role</label>
            <select id="role" name="role" class="form-select @error('role_selected') is-invalid @enderror"
            onchange="this.form.submit()">
              <option value="">Choice Role</option>
              @foreach ($roles as $item)
                <option value="{{ $item->id }}" {{  (isset($role) && $role == $item->id) ? 'selected="selected"' : ''}}>
                    {{ $item->name }}</option>
              @endforeach
            </select>
            <div class="invalid-feedback">@error('role_selected') {{ $message }} @enderror</div>
          </div>
      </form>
      <form id="form" class="browser-default-validation" method="POST" action="{{ route('create-mapping-role-menu') }}">
      @csrf
          <input type="text" id="role_selected" name="role_selected" value="{{ isset($role) ? $role : '' }}" hidden>
          <div class="col-md-4 mb-3">
            <label class="form-label">Menu</label>
            <select id="menus" name="menus[]" class="form-select @error('menus') is-invalid @enderror"
            multiple="multiple" data-placeholder="Choice Menu">
              @if ($menus)
                @foreach ($menus as $item)
                <option value="{{ $item->id }}"
                  @php
                   foreach ($menu_selected as $subItem) {
                    if ($subItem->menu_id == $item->id) {
                      echo 'selected';
                      break;
                    }
                   }
                  @endphp
                  >{{ $item->name }}</option>
                @endforeach
              @endif
            </select>
            <div class="invalid-feedback">@error('menus') {{ $message }} @enderror</div>
          </div>
          <div class="row-md-2 mb-3">
            <button type="submit" class="btn btn-primary">Update</button>

          </div>
        </div>
      </form>
      <form id="form"  class="" method="POST" action="{{ route('reset-mapping-role-menu') }}">
        @csrf
        <div class="col-md-4 mb-3 px-4">
            <input type="text" id="reset_role_selected" name="reset_role_selected" value="{{ isset($role) ? $role : '' }}" hidden>
            <button type="submit" class="btn btn-danger">Reset</button>
        </div>
      </form>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <label class="form-label">
                <strong>Base Menu</strong>
              </label>
            </div>
            <div class="row">
              <div id="base_menu">
                @php
                    echo $base_menu;
                @endphp
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <label class="form-label">
                <strong>Mappig Menu</strong>
              </label>
            </div>
            <div class="row">
              <div id="menu_role">
                @php
                    echo (isset($menu_role)) ? $menu_role : '';
                @endphp
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('add-js')
    <script>
      initTreeMenu('base_menu');
      initTreeMenu('menu_role');
      initBSMultiSelect('menus');
    </script>
@endsection

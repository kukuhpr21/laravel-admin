@extends('base')
@section('title', "Create Menu")
@section('content')
<h4 class="fw-bold py-3 mb-4">
    @yield('title')
</h4>
<div class="row">
  <div class="col-md-6 mb-4 mb-md-0">
      <div class="card">
          <h5 class="card-header">
              <a href="{{ route('menus') }}" type="button" class="btn rounded-pill btn-icon btn-outline-primary">
                  <span class="tf-icons bx bx-arrow-back"></span>
              </a>
          </h5>
        <div class="card-body">

          @include('partials/toasts')

          <form class="browser-default-validation" method="POST" action="{{ route('create-menu') }}">
            @csrf
            <div class="mb-3">
              <label class="form-label">Type</label>
              <select id="parent" name="parent" class="form-select">
                <option value="#">Default Parent</option>
                @foreach ($menu_parents as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Link</label>
                <input type="text" class="form-control @error('link') is-invalid @enderror" name="link">
                <div class="form-text">Default value '#' </div>
                <div class="invalid-feedback">@error('link') {{ $message }} @enderror</div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Icon</label>
                <input type="text" class="form-control @error('icon') is-invalid @enderror" name="icon">
                <div class="form-text">Default value '#' </div>
                <div class="invalid-feedback">@error('icon') {{ $message }} @enderror</div>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Order</label>
                <input type="text" class="form-control @error('order') is-invalid @enderror" name="order">
                <div class="form-text">Default value '0' </div>
                <div class="invalid-feedback">@error('order') {{ $message }} @enderror</div>
              </div>
            </div>
            <div class="row">
              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
  </div>
  <div class="col-md-6 mb-4 mb-md-0">
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
</div>
@endsection
@section('add-js')
<script src="{{ asset('assets/js/pages/menus/create.js') }}"></script>
@endsection

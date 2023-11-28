@extends('base')
@section('title', "Create Role")
@section('content')
<h4 class="fw-bold py-3 mb-4">
    @yield('title')
</h4>
<div class="col-md-4 mb-4 mb-md-0">
    <div class="card">
        <h5 class="card-header">
            <a href="{{ route('roles') }}" type="button" class="btn rounded-pill btn-icon btn-outline-primary">
                <span class="tf-icons bx bx-arrow-back"></span>
            </a>
        </h5>
      <div class="card-body">

        @include('partials/toasts')

        <form class="browser-default-validation" method="POST" action="{{ route('create-role') }}">
           @csrf
          <div class="mb-3">
            <label class="form-label" for="basic-default-name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
            <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
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
@endsection
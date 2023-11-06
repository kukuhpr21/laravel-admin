@extends('base')
@section('title', "List Role")
@section('content')
<h4 class="fw-bold py-3 mb-4">
    @yield('title')
</h4>
@include('partials/toasts')
<div class="card">
  <div class="card-header">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a href="{{ route('create-role') }}">
        <span class="btn btn-primary">
          <i class="bx bx-plus me-sm-2"></i>
          Add New Record
        </span>
      </a>
    </div>
  </div>
  <div class="table-responsive text-nowrap">
    <table id="table" class="display table table-bordered table-striped table-hover">
      <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @php
            $counter = 0;
        @endphp

        @foreach ($datas as $item)

            @php
                $counter++;
            @endphp

            <tr>
                <td>{{ $counter }}</td>
                <td>{{ $item->name }}</td>
                <td align="center">
                  <div class="dropdown">
                    <button type="button"
                    class="btn btn-outline-primary p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('edit-role', ['id' => $item->id]) }}">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                        </a>
                        <a class="dropdown-item"
                        href="javascript:void(0);"
                        onclick="confirmDelete('{{ $item->name }}', '{{ route('delete-role', ['id' => $item->id]) }}')">
                            <i class="bx bx-trash me-1"></i> Delete
                        </a>
                    </div>
                  </div>
                </td>
            </tr>

        @endforeach

      </tbody>
    </table>
  </div>
</div>
@endsection
@section('add-js')
<script>
    initDatatable('table');
</script>
@endsection

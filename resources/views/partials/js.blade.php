{{-- Core JS --}}
{{-- build:js assets/vendor/js/core.js --}}
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables/datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
{{-- End Build --}}

{{-- Popper JS --}}
<script src="{{ asset('assets/js/popper.js') }}"></script>

{{-- Main JS --}}
<script src="{{ asset('assets/js/main.js') }}"></script>

{{-- Page JS --}}
@if (!empty(session()))    
{{-- <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('assets/js/ui-modals.js') }}"></script> --}}
@endif

{{-- Place this tag in your head or just before your close body tag --}}
<script async defer src="{{ asset('assets/js/buttons.js') }}"></script>
<script src="{{ asset('assets/js/select2.full.js') }}"></script>

{{-- JS Tree --}}
<script src="{{ asset('assets/js/jstree.js') }}"></script>

{{-- BS Multiselect --}}
<script src="{{ asset('assets/js/BSMultiSelect.js') }}" ></script>

{{-- Utils JS  Always On The Bottom--}}
<script src="{{ asset('assets/js/utils.js') }}" ></script>
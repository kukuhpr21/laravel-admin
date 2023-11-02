@include('partials/head')

  <body>

    @if (empty(session('id')))
        <div class="container-xxl">

            @yield('content')

        </div>
    @else    
        {{-- Layout Wrapper --}}
        <div class="layout-wrapper layout-content-navbar">

            <div class="layout-container">
            
                {{-- include sidebar --}}
                @include('partials/sidebar')

                {{-- Layout Page --}}
                <div class="layout-page">

                    {{-- include navbar --}}
                    @include('partials/navbar')

                    {{-- Content Wrapper  --}}
                    <div class="content-wrapper">

                        {{-- Content --}}
                        <div class="container-xxl flex-grow-1 container-p-y">

                            @yield('content')

                        </div>
                        {{-- Content --}}

                        {{-- include footer --}}
                        @include('partials/footer')

                        <div class="content-backdrop fade"></div>
                    </div>
                    {{-- Content Wrapper  --}}

                </div>
                {{-- Layout Page --}}
            </div>

            {{-- Overlay --}}
            <div class="layout-overlay layout-menu-toggle"></div>

        </div>
        {{-- Layout Wrapper --}}
    @endif

    {{-- Modal Confirm --}}
    @include('partials/modal_confirm')
    
    {{-- JS --}}
    @include('partials/js')

    @yield('add-js')
  </body>
</html>

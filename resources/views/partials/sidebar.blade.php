@inject('menu', 'App\Http\Controllers\MenuController')
{{-- Sidebar --}}
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ redirect('dashboard') }}" class="app-brand-link">
            <span class="app-brand-text menu-text ms-2">{{ env('APP_NAME') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        {{ $menu->getCacheMenu(Request::segments()) }}
    </ul>
</aside>
{{-- Sidebar --}}

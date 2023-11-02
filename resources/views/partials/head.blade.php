<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets/') }}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ env('APP_NAME') }} - @yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.svg') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,
      700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
    class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" class="template-customizer-theme-css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}"/>

    <!-- Page CSS -->
    @if (!empty(session()))
        <!-- Page -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
    @endif
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('assets/js/config.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap-5-theme.css') }}" />

    {{-- JS Tree --}}
    <link rel="stylesheet" href="{{ asset('assets/css/jstree.css') }}" />

    {{-- BS Multiselect --}}
    <link rel="stylesheet" href="{{ asset('assets/css/BSMultiSelect.css') }}" />

    <style>
      div.dataTables_filter, div.dataTables_length, div.dataTables_info, div.dataTables_paginate {
        padding: 20px;
      }
      div.dataTables_wrapper div.dataTables_scrollBody {
        min-height: 500px;
      }
    </style>
  </head>

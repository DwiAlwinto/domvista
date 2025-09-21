<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0
* @link https://tabler.io
* Copyright 2018-2025 The Tabler Authors
* Copyright 2018-2025 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
	<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
	<link rel="icon" type="image/x-icon" href="{{ asset('logo/domlog.png') }}">
	<title>DOMVISTA</title>

	
	<!-- CSS files -->
<link href="/vendor/admin/dist/css/tabler.min.css?1738096685" rel="stylesheet"/>
	<link href="/vendor/admin/dist/css/tabler-flags.min.css?1738096685" rel="stylesheet"/>
	<link href="/vendor/admin/dist/css/tabler-socials.min.css?1738096685" rel="stylesheet"/>
	<link href="/vendor/admin/dist/css/tabler-payments.min.css?1738096685" rel="stylesheet"/>
	<link href="/vendor/admin/dist/css/tabler-vendors.min.css?1738096685" rel="stylesheet"/>
	<link href="/vendor/admin/dist/css/tabler-marketing.min.css?1738096685" rel="stylesheet"/>
	<link href="/vendor/admin/dist/css/demo.min.css?1738096685" rel="stylesheet"/>
	
	{{-- icons tabler --}}
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css"/>


	{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
	
	
	{{-- untuk js pencarian --}}
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<style>
		@import url('https://rsms.me/inter/inter.css');
	</style>

	<meta name="csrf-token" content="{{ csrf_token() }}">
	

	
</head>
	<!-- Tambahkan stack scripts di sini -->
    @stack('scripts')

<body>
    
	


<script src="/vendor/admin/dist/js/demo-theme.min.js?1738096685"></script>

<div class="page">
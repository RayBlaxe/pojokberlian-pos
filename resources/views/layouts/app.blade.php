<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <title>@yield('title', 'Pojok Berlian - Point of Sales System')</title>
    <meta name="description" content="@yield('description', 'Professional Point of Sales (POS) system for Pojok Berlian. Manage inventory, process sales, and print thermal receipts with ease.')">
    <meta name="keywords" content="POS, Point of Sales, Inventory Management, Thermal Receipt, Sales System, Pojok Berlian">
    <meta name="author" content="Pojok Berlian">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('title', 'Pojok Berlian - POS System')">
    <meta property="og:description" content="@yield('description', 'Professional Point of Sales system for inventory and sales management')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        
        .pos-header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 1rem 0;
            margin-bottom: 2rem;
        }
        
        .item-card {
            transition: transform 0.2s ease-in-out;
            cursor: pointer;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .item-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        
        .cart-item {
            background: white;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 0.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #495057 0%, #6c757d 100%);
            border: none;
            color: white;
        }
        
        .btn-gradient:hover {
            background: linear-gradient(135deg, #343a40 0%, #495057 100%);
            color: white;
        }
        
        .receipt-container {
            background: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .thermal-receipt {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            line-height: 1.2;
            width: 80mm;
            margin: 0 auto;
            background: white;
            padding: 10px;
        }
        
        .thermal-receipt .center {
            text-align: center;
        }
        
        .thermal-receipt .bold {
            font-weight: bold;
        }
        
        .thermal-receipt .dashed-line {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }
        
        @media print {
            body * {
                visibility: hidden;
            }
            
            .thermal-receipt, .thermal-receipt * {
                visibility: visible;
            }
            
            .thermal-receipt {
                position: absolute;
                left: 0;
                top: 0;
                width: 80mm;
                margin: 0;
                box-shadow: none;
            }
            
            .no-print {
                display: none !important;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark pos-header">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('pos.index') }}">
                <img src="{{ asset('favicon.svg') }}" alt="Pojok Berlian Logo" width="32" height="32" class="me-2">
                Pojok Berlian - POS System
            </a>
            
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('pos.index') }}">
                    <i class="fas fa-home me-1"></i>
                    POS
                </a>
                <a class="nav-link" href="{{ route('items.index') }}">
                    <i class="fas fa-box me-1"></i>
                    Items
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    @yield('scripts')
</body>
</html>

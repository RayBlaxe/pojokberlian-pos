@extends('layouts.app')

@section('title', 'Business Settings - Pojok Berlian')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cog me-2"></i>
                        Business Settings
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Current Logo Display -->
                        <div class="mb-3">
                            <label class="form-label">Current Logo</label>
                            <div class="text-center mb-3">
                                @if(str_starts_with($settings->logo_path, 'logos/'))
                                    <img src="{{ Storage::url($settings->logo_path) }}" alt="Current Logo" width="80" height="80" class="border rounded">
                                @else
                                    <img src="{{ asset($settings->logo_path) }}" alt="Current Logo" width="80" height="80" class="border rounded">
                                @endif
                            </div>
                        </div>

                        <!-- Logo Upload -->
                        <div class="mb-3">
                            <label for="logo" class="form-label">Upload New Logo</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                            <div class="form-text">Supported formats: JPEG, PNG, JPG, GIF, SVG. Max size: 2MB</div>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Business Name -->
                        <div class="mb-3">
                            <label for="business_name" class="form-label">Business Name</label>
                            <input type="text" class="form-control @error('business_name') is-invalid @enderror" 
                                   id="business_name" name="business_name" value="{{ old('business_name', $settings->business_name) }}" required>
                            @error('business_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="2" required>{{ old('address', $settings->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- City -->
                        <div class="mb-3">
                            <label for="city" class="form-label">City, Province</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                   id="city" name="city" value="{{ old('city', $settings->city) }}" required>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone', $settings->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Footer Message -->
                        <div class="mb-3">
                            <label for="footer_message" class="form-label">Receipt Footer Message</label>
                            <textarea class="form-control @error('footer_message') is-invalid @enderror" 
                                      id="footer_message" name="footer_message" rows="3" required>{{ old('footer_message', $settings->footer_message) }}</textarea>
                            <div class="form-text">This message will appear at the bottom of receipts</div>
                            @error('footer_message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('pos.index') }}" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-arrow-left me-1"></i>
                                Back to POS
                            </a>
                            <button type="submit" class="btn btn-gradient">
                                <i class="fas fa-save me-2"></i>
                                Update Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Preview Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-eye me-2"></i>
                        Receipt Preview
                    </h5>
                </div>
                <div class="card-body">
                    <div class="receipt-container">
                        <div class="thermal-receipt">
                            <div class="center" style="margin-bottom: 10px;">
                                @if(str_starts_with($settings->logo_path, 'logos/'))
                                    <img src="{{ Storage::url($settings->logo_path) }}" alt="Logo Preview" width="40" height="40" style="display: block; margin: 0 auto;">
                                @else
                                    <img src="{{ asset($settings->logo_path) }}" alt="Logo Preview" width="40" height="40" style="display: block; margin: 0 auto;">
                                @endif
                            </div>
                            
                            <div class="center bold">
                                {{ $settings->business_name }}
                            </div>
                            <div class="center">
                                {{ $settings->address }}<br>
                                {{ $settings->city }}<br>
                                Telp: {{ $settings->phone }}
                            </div>
                            
                            <div class="dashed-line"></div>
                            
                            <div class="center">
                                RECEIPT #12345
                            </div>
                            <div class="center">
                                {{ date('M d, Y H:i:s') }}
                            </div>
                            
                            <div class="dashed-line"></div>
                            
                            <div>
                                Sample Item<br>
                                1 x Rp 25,000
                                <span style="float: right;">Rp 25,000</span>
                            </div>
                            
                            <div class="dashed-line"></div>
                            
                            <div class="bold">
                                TOTAL: 
                                <span style="float: right;">Rp 25,000</span>
                            </div>
                            
                            <div class="dashed-line"></div>
                            
                            <div class="center">
                                {!! nl2br(e($settings->footer_message)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Employee Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <h1>Employee Dashboard</h1>
        <p class="text-muted">Welcome back, {{ auth()->user()->name }}!</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Welcome Message</h5>
            </div>
            <div class="card-body">
                <h4>Hello, {{ auth()->user()->name }}!</h4>
                <p class="lead">Welcome to your employee dashboard. Here you can access your work-related information and tools.</p>
                
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Note:</strong> As an employee, you have access to your personal dashboard and work-related features. 
                    Contact your administrator if you need additional permissions.
                </div>
            </div>
        </div>

        {{-- <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-grid">
                            <button class="btn btn-outline-primary btn-lg mb-3" disabled>
                                <i class="fas fa-tasks me-2"></i>
                                View Tasks
                                <small class="d-block text-muted">Coming Soon</small>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-grid">
                            <button class="btn btn-outline-success btn-lg mb-3" disabled>
                                <i class="fas fa-clock me-2"></i>
                                Time Tracking
                                <small class="d-block text-muted">Coming Soon</small>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-grid">
                            <button class="btn btn-outline-info btn-lg mb-3" disabled>
                                <i class="fas fa-calendar me-2"></i>
                                Schedule
                                <small class="d-block text-muted">Coming Soon</small>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-grid">
                            <button class="btn btn-outline-warning btn-lg mb-3" disabled>
                                <i class="fas fa-file-alt me-2"></i>
                                Reports
                                <small class="d-block text-muted">Coming Soon</small>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Your Profile</h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center" 
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-user fa-2x text-white"></i>
                    </div>
                </div>
                
                <div class="text-center">
                    <h5>{{ auth()->user()->name }}</h5>
                    <p class="text-muted">{{ auth()->user()->email }}</p>
                    <span class="badge bg-primary">{{ auth()->user()->role->label() }}</span>
                </div>

                <hr>

                <div class="small">
                    <p><strong>Member Since:</strong><br>{{ auth()->user()->created_at->format('M d, Y') }}</p>
                    <p><strong>Last Updated:</strong><br>{{ auth()->user()->updated_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        {{-- <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Notifications</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-light text-center" role="alert">
                    <i class="fas fa-bell-slash text-muted"></i>
                    <p class="mb-0 text-muted">No new notifications</p>
                </div>
            </div>
        </div> --}}
    </div>
</div>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

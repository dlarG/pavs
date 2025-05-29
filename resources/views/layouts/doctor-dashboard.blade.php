<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard - PAVS Clinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #36b9cc;
            --accent-color: #1cc88a;
            --dark-color: #2e3a59;
            --light-color: #f8f9fc;
            --sidebar-width: 250px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: #f5f7fb;
            color: var(--dark-color);
            overflow-x: hidden;
        }
        
        /* Main Layout Structure */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(to bottom, var(--primary-color), #2a5bd7);
            color: white;
            position: fixed;
            height: 100vh;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-header img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 15px;
        }
        
        .sidebar-header h4 {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }
        
        .sidebar-header p {
            opacity: 0.8;
            font-size: 0.9rem;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s;
            position: relative;
            font-weight: 500;
        }
        
        .nav-link:hover, .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--accent-color);
        }
        
        .nav-link i {
            margin-right: 12px;
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }
        
        .nav-link .badge {
            margin-left: auto;
            background: var(--accent-color);
        }
        
        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: all 0.3s;
        }
        
        /* Top Navigation */
        .top-navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 0 20px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .toggle-btn {
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: var(--dark-color);
            cursor: pointer;
        }
        
        .search-bar {
            position: relative;
            max-width: 400px;
            width: 100%;
        }
        
        .search-bar input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border-radius: 30px;
            border: 1px solid #e0e0e0;
            background: #f8f9fc;
            transition: all 0.3s;
        }
        
        .search-bar input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.2);
            border-color: var(--primary-color);
        }
        
        .search-bar i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0a0a0;
        }
        
        .nav-icons {
            display: flex;
            align-items: center;
        }
        
        .nav-icon {
            position: relative;
            margin-left: 20px;
            font-size: 1.2rem;
            color: var(--dark-color);
            cursor: pointer;
        }
        
        .nav-icon .badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--secondary-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            margin-left: 25px;
            cursor: pointer;
        }
        
        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }
        
        .user-profile .name {
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .user-profile .role {
            font-size: 0.8rem;
            opacity: 0.7;
        }
        
        /* Content Area */
        .content-wrapper {
            padding: 20px;
        }
        
        .welcome-card {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .welcome-card h2 {
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .welcome-card p {
            opacity: 0.9;
            max-width: 600px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 1.5rem;
        }
        
        .stat-info {
            flex: 1;
        }
        
        .stat-info .number {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .stat-info .label {
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .card-section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .section-title {
            font-weight: 600;
            font-size: 1.2rem;
            color: var(--dark-color);
        }
        
        .view-all {
            color: var(--primary-color);
            font-weight: 500;
            text-decoration: none;
        }
        
        .appointment-table {
            width: 100%;
        }
        
        .appointment-table th {
            background: #f8f9fc;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: var(--dark-color);
            border-bottom: 1px solid #eaeaea;
        }
        
        .appointment-table td {
            padding: 15px;
            border-bottom: 1px solid #eaeaea;
        }
        
        .appointment-table tr:last-child td {
            border-bottom: none;
        }
        
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-pending {
            background: rgba(255, 193, 7, 0.2);
            color: #e0a800;
        }
        
        .status-confirmed {
            background: rgba(40, 167, 69, 0.2);
            color: #28a745;
        }
        
        .status-canceled {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }
        
        .pet-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }
        
        .action-btn {
            padding: 5px 10px;
            border-radius: 5px;
            background: rgba(78, 115, 223, 0.1);
            color: var(--primary-color);
            border: none;
            transition: all 0.3s;
        }
        
        .action-btn:hover {
            background: var(--primary-color);
            color: white;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }
            
            .sidebar .nav-text {
                display: none;
            }
            
            .sidebar-header h4, .sidebar-header p {
                display: none;
            }
            
            .main-content {
                margin-left: 70px;
            }
            
            .sidebar .nav-link {
                justify-content: center;
                padding: 15px;
            }
            
            .sidebar .nav-link i {
                margin-right: 0;
                font-size: 1.4rem;
            }
            
            .sidebar .nav-link .badge {
                position: absolute;
                top: 5px;
                right: 5px;
            }
        }
        
        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .nav-icons .user-profile .name,
            .nav-icons .user-profile .role {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('imgs/cute.png') }}" alt="PAVS Clinic">
                <h4>Dr. {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h4>
                <p>Veterinarian</p>
            </div>
            
            <div class="sidebar-menu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{route('doctor.dashboard')}}" class="nav-link {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('doctor.appointments.index')}}" class="nav-link {{ request()->routeIs('doctor.appointments.*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check"></i>
                            <span class="nav-text">Appointments</span>
                            @php
                                $pendingAppointments = \App\Models\Appointment::where('status', 'pending')->count();
                            @endphp
                            @if($pendingAppointments > 0)
                                <span class="badge">{{ $pendingAppointments }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('doctor.staff.index')}}" class="nav-link {{ request()->routeIs('doctor.staff.*') ? 'active' : '' }}">
                            <i class="fas fa-users"></i>
                            <span class="nav-text">Staff Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('doctor.profile.show')}}" class="nav-link {{ request()->routeIs('doctor.profile.*') ? 'active' : '' }}">
                            <i class="fas fa-user"></i>
                            <span class="nav-text">Profile</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('doctor.reports.index') }}" class="nav-link {{ request()->routeIs('doctor.reports.*') ? 'active' : '' }}">
                            <i class="fas fa-chart-line"></i>
                            <span class="nav-text">Reports</span>
                        </a>
                    </li> --}}
                </ul>
            </div>
            <div style="position: absolute; bottom: 10px; width: 100%;">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('auth.logout') }}" class="nav-link"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="nav-text">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navigation -->
            <nav class="top-navbar">
                <div>
                    <button class="toggle-btn">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search...">
                </div>
                
                <div class="nav-icons">
                    <div class="nav-icon">
                        <i class="fas fa-bell"></i>
                        <span class="badge">3</span>
                    </div>
                    <div class="nav-icon">
                        <i class="fas fa-envelope"></i>
                        <span class="badge">7</span>
                    </div>
                    
                    <div class="user-profile dropdown">
                        <div class="d-flex align-items-center" data-bs-toggle="dropdown">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ Storage::url(Auth::user()->profile_picture) }}" class="rounded-circle" width="40" height="40" alt="Profile Picture">
                            @else
                                <img src="{{ asset('imgs/cute.png') }}" class="rounded-circle" width="40" height="40" alt="Default Picture">
                            @endif
                            <div>
                                <div class="name">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</div>
                                <div class="role">Veterinarian</div>
                            </div>
                            <i class="fas fa-chevron-down ms-2"></i>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <!-- Content Area -->
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.querySelector('.toggle-btn').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            
            if (sidebar.style.width === '70px' || sidebar.style.width === '') {
                sidebar.style.width = '250px';
                mainContent.style.marginLeft = '250px';
            } else {
                sidebar.style.width = '70px';
                mainContent.style.marginLeft = '70px';
            }
        });
        
        // Add active class to clicked nav items
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                document.querySelectorAll('.nav-link').forEach(item => {
                    item.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
        
        // Initialize dropdowns
        const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        const dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        });
    </script>
</body>
</html>
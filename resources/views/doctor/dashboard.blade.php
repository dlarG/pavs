@extends('layouts.doctor-dashboard')

@section('content')
    @php
        use App\Models\Appointment;
        use Illuminate\Support\Carbon;

        $today = Carbon::today()->toDateString();
        $todaysAppointments = Appointment::whereDate('appointment_date', $today)
            ->orderBy('appointment_time')
            ->get();
        $todaysAppointmentsCount = $todaysAppointments->count();
    @endphp

    <div class="welcome-card">
        <h2>Welcome back, Dr. {{ Auth::user()->lastname }}!</h2>
        @if($todaysAppointmentsCount === 0)
            <p>You have no appointments scheduled for today.</p>
        @elseif($todaysAppointmentsCount === 1)
            @php
                $next = $todaysAppointments->first();
            @endphp
            <p>You have 1 appointment scheduled for today. Your appointment is with {{ $next->pet_name ?? 'a pet' }} at {{ \Carbon\Carbon::parse($next->appointment_time)->format('g:i A') }}.</p>
        @else
            @php
                $next = $todaysAppointments->first();
            @endphp
            <p>You have {{ $todaysAppointmentsCount }} appointments scheduled for today. Your next appointment is with {{ $next->pet_name ?? 'a pet' }} at {{ \Carbon\Carbon::parse($next->appointment_time)->format('g:i A') }}.</p>
        @endif
    </div>
    
    <div class="stats-grid">
        @php
            $today = Carbon::today()->toDateString();
            $todaysAppointmentsCount = Appointment::whereDate('appointment_date', $today)
            ->where('status', 'confirmed')
            ->count();
        @endphp
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(78, 115, 223, 0.1); color: var(--primary-color);">
            <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-info">
            <div class="number">{{ $todaysAppointmentsCount }}</div>
            <div class="label">Today's Appointments</div>
            </div>
        </div>
        
        @php
            use App\Models\User;
            $activeStaffCount = User::where('role', 'staff')->where('is_active', '1')->count();
        @endphp
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
            <i class="fas fa-user-injured"></i>
            </div>
            <div class="stat-info">
            <div class="number">{{ $activeStaffCount }}</div>
            <div class="label">Active Staffs</div>
            </div>
        </div>
        
        @php
            $pendingAppointmentsCount = Appointment::where('status', 'pending')->count();
        @endphp
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(220, 53, 69, 0.1); color: #dc3545;">
            <i class="fas fa-file-medical"></i>
            </div>
            <div class="stat-info">
            <div class="number">{{ $pendingAppointmentsCount }}</div>
            <div class="label">Pending Appointments</div>
            </div>
        </div>
        
        @php
            $petsTreatedCount = Appointment::where('status', 'completed')
            ->whereIn('service', ['surgery', 'emergency'])
            ->count();
        @endphp
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(54, 185, 204, 0.1); color: var(--secondary-color);">
            <i class="fas fa-paw"></i>
            </div>
            <div class="stat-info">
            <div class="number">{{ $petsTreatedCount }}</div>
            <div class="label">Pets Treated</div>
            </div>
        </div>
    </div>
    
    @php
        $today = Carbon::today()->toDateString();
        $appointments = Appointment::whereDate('appointment_date', $today)->get();
    @endphp

    <div class="card-section">
        <div class="section-header">
            <h3 class="section-title">Today's Appointments</h3>
            <a href="{{route('doctor.appointments.index')}}" class="view-all">View All</a>
        </div>
        
        <div class="table-responsive">
            @if($appointments->isEmpty())
                <div class="p-4 text-center text-muted">No appointments for today.</div>
            @else
            <table class="appointment-table">
                <thead>
                    <tr>
                        <th>Pet & Owner</th>
                        <th>Time</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('imgs/' . ($appointment->pet->image ?? 'default.jpg')) }}" alt="Pet" class="pet-avatar">
                                <div>
                                    <div style="font-weight: 800;">{{ $appointment->pet_name ?? 'Unknown' }} </div>
                                    <div class="small text-muted">{{ $appointment->user->firstname }} {{ $appointment->user->lastname }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</td>
                        <td>{{ $appointment->service ?? 'N/A' }}</td>
                        <td>
                            <span class="status-badge status-{{ strtolower($appointment->status) }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
    <div class="row mt-4">
        @php
            $tomorrow = Carbon::tomorrow()->toDateString();
            $upcomingAppointments = Appointment::whereDate('appointment_date', '>', $today)
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->limit(5)
            ->get();
        @endphp
        <div class="col-lg-6">
            <div class="card-section">
            <div class="section-header">
                <h3 class="section-title">Upcoming Appointments</h3>
                <a href="#" class="view-all">View Calendar</a>
            </div>
            <div class="table-responsive">
                @if($upcomingAppointments->isEmpty())
                <div class="p-4 text-center text-muted">No upcoming appointments.</div>
                @else
                <table class="appointment-table">
                <thead>
                    <tr>
                    <th>Pet</th>
                    <th>Date & Time</th>
                    <th>Service</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($upcomingAppointments as $appointment)
                    <tr>
                    <td>
                        <div class="d-flex align-items-center">
                        <img src="{{ asset('imgs/' . ($appointment->pet->image ?? 'default.jpg')) }}" alt="Pet" class="pet-avatar">
                        <div>{{ $appointment->pet_name ?? 'Unknown' }}</div>
                        </div>
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d') }},
                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                    </td>
                    <td>{{ $appointment->service ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                @endif
            </div>
            </div>
        </div>
    </div>
@endsection
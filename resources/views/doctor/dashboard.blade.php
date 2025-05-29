@extends('layouts.doctor-dashboard')

@section('content')
    <div class="welcome-card">
        <h2>Welcome back, Dr. {{ Auth::user()->lastname }}!</h2>
        <p>You have 5 appointments scheduled for today. Your next appointment is with Max the Golden Retriever at 10:30 AM.</p>
    </div>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(78, 115, 223, 0.1); color: var(--primary-color);">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-info">
                <div class="number">24</div>
                <div class="label">Today's Appointments</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
                <i class="fas fa-user-injured"></i>
            </div>
            <div class="stat-info">
                <div class="number">142</div>
                <div class="label">Active Patients</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(220, 53, 69, 0.1); color: #dc3545;">
                <i class="fas fa-file-medical"></i>
            </div>
            <div class="stat-info">
                <div class="number">32</div>
                <div class="label">Pending Reports</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(54, 185, 204, 0.1); color: var(--secondary-color);">
                <i class="fas fa-paw"></i>
            </div>
            <div class="stat-info">
                <div class="number">76</div>
                <div class="label">Pets Treated</div>
            </div>
        </div>
    </div>
    
    <div class="card-section">
        <div class="section-header">
            <h3 class="section-title">Today's Appointments</h3>
            <a href="#" class="view-all">View All</a>
        </div>
        
        <div class="table-responsive">
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
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('imgs/dog.jpg') }}" alt="Dog" class="pet-avatar">
                                <div>
                                    <div>Max (Golden Retriever)</div>
                                    <div class="small text-muted">John Smith</div>
                                </div>
                            </div>
                        </td>
                        <td>10:30 AM</td>
                        <td>Vaccination</td>
                        <td><span class="status-badge status-confirmed">Confirmed</span></td>
                        <td>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('imgs/cat.jpg') }}" alt="Cat" class="pet-avatar">
                                <div>
                                    <div>Whiskers (Persian)</div>
                                    <div class="small text-muted">Emma Johnson</div>
                                </div>
                            </div>
                        </td>
                        <td>11:15 AM</td>
                        <td>Dental Checkup</td>
                        <td><span class="status-badge status-confirmed">Confirmed</span></td>
                        <td>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('imgs/dog2.jpg') }}" alt="Dog" class="pet-avatar">
                                <div>
                                    <div>Rocky (Siberian Husky)</div>
                                    <div class="small text-muted">Michael Brown</div>
                                </div>
                            </div>
                        </td>
                        <td>1:45 PM</td>
                        <td>Surgery Consultation</td>
                        <td><span class="status-badge status-pending">Pending</span></td>
                        <td>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('imgs/rabbit.jpg') }}" alt="Rabbit" class="pet-avatar">
                                <div>
                                    <div>Snowball (Holland Lop)</div>
                                    <div class="small text-muted">Sarah Davis</div>
                                </div>
                            </div>
                        </td>
                        <td>3:30 PM</td>
                        <td>General Checkup</td>
                        <td><span class="status-badge status-confirmed">Confirmed</span></td>
                        <td>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-6">
            <div class="card-section">
                <div class="section-header">
                    <h3 class="section-title">Recent Patients</h3>
                    <a href="#" class="view-all">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="appointment-table">
                        <thead>
                            <tr>
                                <th>Pet</th>
                                <th>Owner</th>
                                <th>Last Visit</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('imgs/dog.jpg') }}" alt="Dog" class="pet-avatar">
                                        <div>Max</div>
                                    </div>
                                </td>
                                <td>John Smith</td>
                                <td>May 28, 2023</td>
                                <td><span class="status-badge status-confirmed">Active</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('imgs/cat.jpg') }}" alt="Cat" class="pet-avatar">
                                        <div>Whiskers</div>
                                    </div>
                                </td>
                                <td>Emma Johnson</td>
                                <td>May 26, 2023</td>
                                <td><span class="status-badge status-confirmed">Active</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('imgs/parrot.jpg') }}" alt="Parrot" class="pet-avatar">
                                        <div>Rio</div>
                                    </div>
                                </td>
                                <td>David Wilson</td>
                                <td>May 24, 2023</td>
                                <td><span class="status-badge status-pending">Follow-up</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card-section">
                <div class="section-header">
                    <h3 class="section-title">Upcoming Appointments</h3>
                    <a href="#" class="view-all">View Calendar</a>
                </div>
                <div class="table-responsive">
                    <table class="appointment-table">
                        <thead>
                            <tr>
                                <th>Pet</th>
                                <th>Date & Time</th>
                                <th>Service</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('imgs/dog2.jpg') }}" alt="Dog" class="pet-avatar">
                                        <div>Rocky</div>
                                    </div>
                                </td>
                                <td>May 30, 10:00 AM</td>
                                <td>Post-Surgery Check</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('imgs/cat2.jpg') }}" alt="Cat" class="pet-avatar">
                                        <div>Luna</div>
                                    </div>
                                </td>
                                <td>May 30, 2:30 PM</td>
                                <td>Vaccination</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('imgs/hamster.jpg') }}" alt="Hamster" class="pet-avatar">
                                        <div>Nibbles</div>
                                    </div>
                                </td>
                                <td>May 31, 9:15 AM</td>
                                <td>General Checkup</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
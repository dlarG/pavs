@extends('layouts.doctor-dashboard')

@section('content')
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">Staff Management</h2>
        <a href="{{ route('doctor.staff.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add New Staff
        </a>
    </div>

    <div class="card-section">
        <div class="table-responsive">
            <table class="appointment-table">
                <thead>
                    <tr>
                        <th>Staff Member</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staffMembers as $staff)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-md bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                    {{ substr($staff->firstname, 0, 1) }}{{ substr($staff->lastname, 0, 1) }}
                                </div>
                                <div>
                                    <div><strong>{{ $staff->firstname }} {{ $staff->lastname }}</strong></div>
                                    <div class="small text-muted">Staff ID: {{ $staff->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $staff->email }}</td>
                        <td>{{ $staff->phone ?? 'N/A' }}</td>
                        <td>
                            <span class="status-badge status-confirmed">Active</span>
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('doctor.staff.show', $staff->id) }}" 
                                    class="action-btn me-2" 
                                    title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('doctor.staff.edit', $staff->id) }}" 
                                    class="action-btn me-2" 
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('doctor.staff.destroy', $staff->id) }}" 
                                    method="POST" 
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="action-btn text-danger border-0 bg-transparent" 
                                        title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this staff member?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $staffMembers->links() }}
        </div>
        
        @if($staffMembers->isEmpty())
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="fas fa-users-slash fa-3x text-secondary"></i>
            </div>
            <h4 class="text-muted">No Staff Members Found</h4>
            <p class="text-muted">You haven't added any staff members yet.</p>
            <a href="{{ route('doctor.staff.create') }}" class="btn btn-primary mt-3">
                <i class="fas fa-plus me-2"></i> Add New Staff
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
    .avatar {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }
</style>
@endsection
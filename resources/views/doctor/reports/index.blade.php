@extends('layouts.doctor-dashboard')

@section('content')
<div class="content-wrapper">
    <div class="mb-4">
        <h2>Reports</h2>
    </div>

    {{-- Filters --}}
    <div class="card p-3 mb-4">
        <form id="reportForm" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="report_type" class="form-label">Report Type</label>
                <select id="report_type" name="report_type" class="form-select" required>
                    <option value="appointment">Appointment Report</option>
                    <option value="staff">Staff Report</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" id="start_date" name="start_date" class="form-control" 
                         value="{{ now()->subDays(6)->format('Y-m-d') }}" required>
            </div>
            <div class="col-md-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control" 
                        value="{{ now()->format('Y-m-d') }}" required>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success w-100">
                    <i class="fas fa-chart-line me-1"></i> Generate Report
                </button>
            </div>
        </form>
    </div>

    {{-- Chart --}}
    <div class="card p-4">
        <canvas id="reportChart" height="100"></canvas>
    </div>

    {{-- Export --}}
    <div class="mt-3 text-end">
        <a href="{{ route('doctor.reports.export') }}" class="btn btn-primary">
            <i class="fas fa-file-pdf me-1"></i> Export PDF
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let chart;

function renderChart(labels = [], data = [], label = 'Appointments') {
    const ctx = document.getElementById('reportChart').getContext('2d');
    if (chart) chart.destroy(); // Destroy old chart
    chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: label,
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
}

// Default render on page load
renderChart({!! json_encode($data['dates']) !!}, {!! json_encode($data['totals']) !!});

// Handle form submission
document.getElementById('reportForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const form = new FormData(this);

    fetch("{{ route('doctor.reports.index') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest' // Ensures Laravel treats it as AJAX
        },
        body: form
    })
    .then(res => {
        if (!res.ok) {
            return res.text().then(text => { throw new Error(text) });
        }
        return res.json();
    })
    .then(data => {
        renderChart(data.labels, data.values, data.label);
    })
    .catch(error => {
        console.error('Error fetching report:', error);
        alert('Failed to generate report.');
    });
});
</script>
@endsection

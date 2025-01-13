@extends('layouts.app')

@section('content')
<h1>Welcome To Film-Bazaar Portal</h1>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5>Total Films: {{ $totalFilms }}</h5>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5>Total Film Makers: {{ $totalFilmMakers }}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5>Total Film Buyer: {{ $totalFilmBuyers }}</h5>
            </div>
        </div>
    </div>
   

</div>

<canvas id="weeklyGraph" width="400" height="200"></canvas>

<div class="mt-4">
    <h3>Sector-wise Film Makers and Film Buyers</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sector</th>
                <th>Film Makers</th>
                <th>Film Buyers</th>
                <th>Film </th>
            </tr>
        </thead>
        <tbody>
            @foreach($sectorWiseData as $data)
                <tr>
                    <td>{{ $data['sector'] }}</td>
                    <td>{{ $data['filmMakers'] }}</td>
                    <td>{{ $data['filmBuyers'] }}</td>
                    <td>{{ $data['film'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('weeklyGraph').getContext('2d');
    const weeklyGraph = new Chart(ctx, {
        type: 'bar', // Bar chart
        data: {
            labels: @json($dates),
            datasets: [
                {
                    label: 'Films',
                    data: @json($filmCounts),
                    backgroundColor: 'rgba(54, 162, 235, 0.8)', // Blue color
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Film Makers',
                    data: @json($filmMakerCounts),
                    backgroundColor: 'rgba(255, 99, 132, 0.8)', // Red color
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Film Buyers',
                    data: @json($filmBuyerCounts), // Film Buyers data
                    backgroundColor: 'rgba(75, 192, 192, 0.8)', // Green color
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Count'
                    },
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
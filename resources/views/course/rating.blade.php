@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Course ratings</h1>
                </div>

                <div class="mt-3">
                    <h3>{{ $course->title }}</h3>
                    <p>Total ratings: {{ $totalRatings }}</p>
                </div>

                <canvas id="graph"></canvas>
            </div>
        </div>
    </div>
    <script>
        const attendees = @json($course->attendees);
        const totalRatings = @json($totalRatings);
        const colorData = ['#fa555f', '#2fc195', '#007bfd'];
        const ratings = {};
        const colors = [];

        attendees.forEach(({ rate }) => {
            if (!ratings[rate]) {
                ratings[rate] = 0;
                colors.push(colorData[rate]);
            }
            ratings[rate] += 1;
        });

        const c = document.getElementById('graph');
        const ctx = c.getContext('2d');
        const graph = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: Object.keys(ratings),
                datasets: [{
                    data: Object.values(ratings),
                    backgroundColor: colors
                }]
            },
            options: {
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, { datasets, labels }) {
                            const { index } = tooltipItem;
                            const { data } = datasets[0];

                            return `${labels[index]}: ${(data[index] / totalRatings * 100).toFixed(2)}%`
                        }
                    }
                }
            }
        });
    </script>
@endsection
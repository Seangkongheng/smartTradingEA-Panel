<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Live Teaching</title>
    @vite('resources/css/app.css')
    {{-- this is Link Style Css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('images/websit_logo.png') }}" type="image/x-icon">
    {{-- this is link google icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search" />
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js"></script>
</head>
<body>




@include('backEnd.login.includes.body')



    {{-- start script chart javascript --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- end script chart javascript --}}
    <script src="{{ asset('js/scriptwebsite.js') }}"></script>
    <script src="{{ asset('js/scriptanimation.js') }}"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const secondChartctx = document.getElementById('mysecondChart').getContext('2d');
        const lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Visitors',
                    data: [30, 45, 28, 60, 3, 70],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Monthly Visitors'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Second Chart
        const secondChart = new Chart(secondChartctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Visitors',
                    data: [30, 65, 28, 600, 10, 58],
                    fill: false,
                    borderColor: 'rgb(255, 159, 64)', // Different color for distinction
                    tension: 0.3
                }]
            },
            options: {
                responsive: true, // Makes the chart responsive
                maintainAspectRatio: false, // Allows the chart to resize freely
                plugins: {
                    title: {
                        display: true,
                        text: 'Monthly Visitors - Chart 2'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    </footer>
</body>
</html>

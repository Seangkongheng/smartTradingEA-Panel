    {{-- start script chart javascript --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    @stack('scripts')
    </footer>
    </body>

    </html>

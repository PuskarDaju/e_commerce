@extends('admin.adminLayout')

@section('mainContents')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <h1>Monthly Sales</h1>
    <canvas id="salesBarChart" width="400" height="200"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Data passed from the controller
            const labels = @json($chartLabels); // Month names
            const data = @json($chartData);     // Sales totals
    
            new Chart(document.getElementById('salesBarChart'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Sales Amount ($)',
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        datalabels: {
                            anchor: 'end', // Position at the end of the bar
                            align: 'start', // Align the label above the bar
                            // formatter: (value) => {
                            //     if (value !== null && !isNaN(value)) {
                            //         return `₹${parseFloat(value).toFixed(2)}`;
                            //     }
                            //     return '₹0.00';
                            // // },
                            // font: {
                            //     weight: 'bold',
                            //     size: 12
                            // },
                            // color: 'black' // Label text color
                        }
                    },
                    // scales: {
                    //     y: {
                    //         beginAtZero: true,
                    //         title: {
                    //             display: true,
                    //             text: 'Sales Amount (₹)'
                    //         }
                    //     },
                    //     x: {
                    //         title: {
                    //             display: true,
                    //             text: 'Months'
                    //         }
                    //     }
                    // }
                },
                // plugins: [ChartDataLabels] // Enable datalabels plugin
            });
        });
    </script>
    
    
@endsection

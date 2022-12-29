$(document).ready(function() {
$.ajax({
        type: "GET",
        url: "/api/game",
        dataType: "json",
        success: function (data) {
            
            var ctx = $("#c1");
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.label,
                    datasets: [{
                        label: 'Top Seller Game ( Total Game Bought)',
                        data: data.data,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgb(255,0,0)',
                            'rgb(255,0,255)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                },
            });

        },
        error: function (error) {
            console.log(error);
        }
    });

$.ajax({
        type: "GET",
        url: "/api/genre",
        dataType: "json",
        success: function (data) {
            console.log(data);
            
            var ctx = $("#c2");
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.label,
                    datasets: [{
                        label: 'Game Total number by Catergory',
                        data: data.data,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgb(255,0,0)',
                            'rgb(255,0,255)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                },
            });

        },
        error: function (error) {
            console.log(error);
        }
    });

$.ajax({
        type: "GET",
        url: "/api/customer",
        dataType: "json",
        success: function (data) {
            console.log(data);
            
            var ctx = $("#c3");
            var myBarChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.label,
                    datasets: [{
                        label: 'Platform Game Total',
                        data: data.data,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgb(255,0,0)',
                            'rgb(255,0,255)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                },
            });

        },
        error: function (error) {
            console.log(error);
        }
    });

});
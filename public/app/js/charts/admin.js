$(function () {
    
    new Chart("pie", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            responsive: true,
        },
    });
    
    new Chart("cate", {
        type: "horizontalBar", // Changed from "polarArea" to "horizontalBar"
        data: {
            labels: Object.keys(categories),
            datasets: [{
                label: "Categories", // Adding a label for clarity
                backgroundColor: randomColor(Object.keys(categories).length), // This function needs to be defined or adjusted to generate colors
                data: Object.values(categories),
            }]
        },
        options: {
            responsive: true,
            scales: {
                xAxes: [{ // For horizontal bar, xAxes is used to configure the axis for the bars
                    ticks: {
                        beginAtZero: true
                    }
                }],
                yAxes: [{ // Configures the axis for labels
                    ticks: {
                        autoSkip: false // Prevents skipping of labels if too many categories
                    }
                }]
            }
        },
    });
    
    new Chart("type", {
        type: "polarArea",
        data: {
            labels: Object.keys(types),
            datasets: [{
                label: "Analytics",
                backgroundColor: randomColor(Object.keys(types).length), // Ensure this generates an array of colors
                data: Object.values(types),
            }]
        },
        options: {
            responsive: true,
            scale: {
                ticks: {
                    beginAtZero: true
                }
            }
        },
    });
    
    new Chart("customers", {
        type: "bar",
        data: {
            datasets: [
                {
                    label: "Active",
                    backgroundColor: "#72CF4A",
                    data: customers.active,
                },
                {
                    label: "Deactive",
                    backgroundColor: "#E41111",
                    data: customers.deactive,
                },
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                callbacks: {
                    title: function () {
                        return '';
                    },
                },
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        },
    });
    
});
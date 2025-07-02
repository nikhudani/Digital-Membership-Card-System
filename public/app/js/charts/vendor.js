$(function () {
    
    new Chart("cate", {
        type: "polarArea",
        data: {
            labels: Object.keys(categories),
            datasets: [{
                backgroundColor: randomColor(Object.keys(categories).length),
                data: Object.values(categories),
            }]
        },
        options: {
            responsive: true,
        },
    });
    
    new Chart("type", {
        type: "bar",
        data: {
            labels: Object.keys(types),
            datasets: [{
                label: "Analytics",
                backgroundColor: "#5A98EB",
                borderColor: "#5A98EB",
                borderWidth: 1,
                hoverBackgroundColor: "#5A98EB",
                hoverBorderColor: "#5A98EB",
                data: Object.values(types),
            }]
        },
        options: {
            responsive: true,
        },
    });
    
});
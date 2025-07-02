
function randomColor(total) {
    var letters = '0123456789ABCDEF';
    var colors = [];
    for (var c = 0; c < total; c++) {
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        colors.push(color);
    }
    return colors;
}

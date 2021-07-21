function resultat(value)
{
    if (value === '1') {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var dates = this.responseText;
                var months = dates.split(" ");
                var today = new Date();
                var d;
                var month;

                var itemValue = [0, 0, 0, 0, 0, 0];
                var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

                let itemName = [];
                for (var i = 5; i >= 0; i -= 1) {
                    d = new Date(today.getFullYear(), today.getMonth() - i, 1);
                    month = monthNames[d.getMonth()];
                    itemName.push(month);
                }

                for (var i = 0; i < months.length ; i++) {
                    // il faut associer les chiffres aux bons mois ce n'est pas encore bon
                    for (var j = 0; j < itemValue.length; j++) {
                        if (monthNames[parseInt(months[i]) - 1] === itemName[j]) {
                            itemValue[j] += 1;
                        }
                    }
                }

                var xScale;
                var yScale;
                var y;
                // values of each item on the graph
                var canvas = document.getElementById('canvas2');
                var context = canvas.getContext('2d');
                context.clearRect(0, 0, context.canvas.width, context.canvas.height);
                // Non-fill type drawings are not cleared out with clearRect
                context.canvas.width = context.canvas.width;

                // intialize values for each variables
                var sections = 6;
                var Val_Max = months.length - 2;
                var stepSize = 1;
                var columnSize = 50;
                var rowSize = 60;
                var margin = 10;
                var header = "Nombre d'utilisateurs";

                context.fillStyle = "#000";

                yScale = (canvas.height - columnSize - margin) / (Val_Max);
                xScale = (canvas.width - rowSize) / (sections + 1);

                context.strokeStyle = "#000"; // background black lines
                context.beginPath();
                // column names
                context.font = "17px Arial";
                context.fillText(header, 0, columnSize - margin-5);
                // draw lines in the background
                context.font = "14px Helvetica";
                let count = 0;

                for (let scale = Val_Max; scale >= 0; scale = scale - stepSize) {
                    y = columnSize + (yScale * count * stepSize);
                    context.fillText(scale, margin, y + margin-5);
                    context.moveTo(rowSize, y);
                    context.lineTo(canvas.width, y);
                    count++;
                }

                context.stroke();

                // print names of each data entry
                context.font = "20 pt Verdana";
                context.textBaseline = "bottom";
                for (let i = 0; i < 7; i++) {
                    computeHeight(itemValue[i]);
                    context.fillText(itemName[i], xScale * (i + 1), y - margin);
                }

                // shadow for graph's bar lines with color and offset

                context.fillStyle = "#ff8e29";
                context.shadowColor = 'rgba(128,128,128, 0.5)';

                // translate to bottom of graph  in order to match the data
                context.translate(0, canvas.height - margin);
                context.scale(xScale, -1 * yScale);

                // draw each graph bars
                for (let i = 0; i < 7; i++) {
                    context.fillRect(i + 1, 0, 0.3, itemValue[i]);
                }

                function computeHeight(value) {
                    y = canvas.height - value * yScale;
                }
            }
        };
        xmlhttp.open("GET", "getdate", true); // enlever le .php pour le serveur
        xmlhttp.send();
    }
    else if(value === '2'){
        var canvas = document.getElementById('canvas2');
        var context = canvas.getContext('2d');
        context.clearRect(0, 0, context.canvas.width, context.canvas.height);
        // Non-fill type drawings are not cleared out with clearRect
        context.canvas.width = context.canvas.width;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var dates = this.responseText;
                var years = dates.split(" ");
                var today = new Date();
                var d;
                var year;

                var itemValue = [0, 0, 0, 0, 0, 0];


                let itemName = [];
                for (var i = 5; i >= 0; i -= 1) {
                    d = new Date(today.getFullYear()-i, today.getMonth() , 1);
                    year = d.getFullYear();
                    itemName.push(year);
                }
                console.log(itemName);
                for (var i = 0; i < years.length ; i++) {
                    // il faut associer les chiffres aux bons mois ce n'est pas encore bon
                    for (var j = 0; j < itemValue.length; j++) {
                        if (parseInt(years[i])  === itemName[j]) {
                            itemValue[j] += 1;
                        }
                    }
                }

                var xScale;
                var yScale;
                var y;
                // values of each item on the graph
                var canvas = document.getElementById('canvas2');
                var context = canvas.getContext('2d');

                // intialize values for each variables
                var sections = 6;
                var Val_Max = years.length ;
                var stepSize = 2;
                var columnSize = 50;
                var rowSize = 60;
                var margin = 10;
                var header = "Nombre d'utilisateurs";

                context.fillStyle = "#000";

                yScale = (canvas.height - columnSize - margin) / (Val_Max);
                xScale = (canvas.width - rowSize) / (sections + 1);

                context.strokeStyle = "#000"; // background black lines
                context.beginPath();
                // column names
                context.font = "17px Arial";
                context.fillText(header, 0, columnSize - margin-5);
                // draw lines in the background
                context.font = "14px Helvetica";
                let count = 0;

                for (let scale = Val_Max; scale >= 0; scale = scale - stepSize) {
                    y = columnSize + (yScale * count * stepSize);
                    context.fillText(scale, margin, y + margin-5);
                    context.moveTo(rowSize, y);
                    context.lineTo(canvas.width, y);
                    count++;
                }

                context.stroke();

                // print names of each data entry
                context.font = "20 pt Verdana";
                context.textBaseline = "bottom";
                for (let i = 0; i < 7; i++) {
                    computeHeight(itemValue[i]);
                    context.fillText(itemName[i], xScale * (i + 1), y - margin);
                }

                // shadow for graph's bar lines with color and offset

                context.fillStyle = "#ff8e29";
                context.shadowColor = 'rgba(128,128,128, 0.5)';

                // translate to bottom of graph  in order to match the data
                context.translate(0, canvas.height - margin);
                context.scale(xScale, -1 * yScale);

                // draw each graph bars
                for (let i = 0; i < 7; i++) {
                    context.fillRect(i + 1, 0, 0.3, itemValue[i]);
                }

                function computeHeight(value) {
                    y = canvas.height - value * yScale;
                }
            }
        };
        xmlhttp.open("GET", "getyear", true); // enlever le .php pour le serveur
        xmlhttp.send();
    }
}


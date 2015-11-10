<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="jquery.qtip.css">
    <style>
        .Orange{
            background-color: orange;
        }
        .Red{
            background-color: red;
        }
        .myCustomClass{
            width: 800px;
            height: 700px;
            
        }
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://qtip2.com/v/stable/jquery.qtip.js"></script>
    <script src="http://support.nec.co.id/pi/jaguar/graph/highchart/highstock.js"></script>
    <script src="http://support.nec.co.id/pi/jaguar/graph/highchart/modules/exporting.js"></script>

  
<script>
$(function () {
    var seriesOptions = [],
        seriesCounter = 0,
 
        names = ['Baseline_OA','MOS_Forecast','MOS','RFS_Forecast', 'ON_Air_Forcast','Actual_OA', 'NMS_Forecast', 'NMS', 'FATP_Forecast', 'FATP', 'Traff_Migr_Forecast', 'Traff_Migr'], 
//names = ['Baseline_OA','Actual_OA'],

        // create the chart when all data is loaded
        createChart = function () {

            $('#container').highcharts( 'StockChart',{
title: {
    text: 'Grafik perencanaan & realitas Proyek Jaguar'
},
subtitle: {
    text: 'Klik tiap item di kotak legend kanan untuk show/hide item'
},
        plotOptions: {
            series: {               
                point: { 
                    events: {
                        click: function (event) {
                           // console.log(this);
                            ChartList_getData(this.series.name, this.x);
                        }
                    }
                }
                
            }
        },
       legend: {
            enabled: true,
            align: 'right',
            backgroundColor: '#FCFFC5',
            borderColor: 'black',
            borderWidth: 2,
            layout: 'vertical',
            verticalAlign: 'top',
            y: 100,
            shadow: true
        },
                rangeSelector: {
                    inputEnabled: $('#container').width() > 480,
                    selected: 4
                },

                yAxis: {
                    labels: {
			text: 'Couter: hop'}
                    },

                tooltip: {
                    pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>'
                },

                series: seriesOptions
            });
        };

    $.each(names, function (i, name) {

        $.getJSON('http://support.nec.co.id/pi/jaguar/graph/highchart/daily_total_graph_Jaguar_' + name.toLowerCase() + '.php',    function (data) {

            seriesOptions[i] = {
                name: name,
                data: data
            };

            // As we're loading the data asynchronously, we don't know what order it will arrive. So
            // we keep a counter and create the chart when all the data is loaded.
            seriesCounter += 1;

            if (seriesCounter === names.length) {
                createChart();
            }
        });
    });
    
//    $('body').on('mouseover', '.recordRow', function(event) {
    // Bind the qTip within the event handler
//    console.log(event.currentTarget.id);
//        $(this).qtip({
  //          overwrite: false, // Make sure the tooltip won't be overridden once created
    //        content: 'I get bound to all my selector elements, past, present and future!',
      //      show: {
        //        event: event.type, // Use the same show event as the one that triggered the event handler
          //      ready: true // Show the tooltip as soon as it's bound, vital so it shows up the first time you hover!
//            }
//        }, event); // Pass through our original event to qTip
//    });
    
    /* qTip2 call below will grab this JSON and use the firstName as the content */
    $('body').on('click', '.recordRow', function(event) {
        $(this).qtip({
            content: {
                text: function(event, api) {
                    $.ajax({
                        url: 'http://support.nec.co.id/pi/jaguar/graph/highchart/Daily_total_progressJaguar_getDetail.php', // URL to the JSON file
                        type: 'POST', // POST or GET
                        dataType: 'json', // Tell it we're retrieving JSON
                        data: {
                            id: $(this).attr('id') // Pass through the ID of the current element matched by '.selector'
                        },
                    })
                    .then(function(data) {
                        /* Process the retrieved JSON object
                         *    Retrieve a specific attribute from our parsed
                         *    JSON string and set the tooltip content.
                         */
                        var content = simpleArray2dfull(data[0]);

                        // Now we set the content manually (required!)
                        api.set('content.text', content);
                    }, function(xhr, status, error) {
                        // Upon failure... set the tooltip content to the status and error value
                        api.set('content.text', status + ': ' + error);
                    });

                    return 'Loading...'; // Set some initial loading text
                }
            },
            position: {
                target: [300,40]
            },
            style: {
                classes: 'myCustomClass'
            }
        }, event);
    });

});


function ChartList_getData(name,date){
    $.post('http://support.nec.co.id/pi/jaguar/graph/highchart/Daily_total_progressJaguar_gap_data.php',{name:name, date:formatDate(date)},function(result){
        $("#listItem").html(simpleArray2d(result, name, date));
    //    if (result.success){
    //        console.log(result);
    //        $("#listItem").append(simpleArray2d(result));
            
    //    } else {
    //        console.log('error post');
    //    }
    },'json');
}

function simpleArray2d(target, name, date){

    var i=0;
    var arr = '<br>' + name + ' on ' + formatDate(date) + '<table id="listDetail">';
    $.each(target, function(item){
            arr += '<tr class="recordRow ' + this.Progress_Color + '" id="' + this.progress_id + '">';
            //console.log('setiap item:\r\n');
            //console.log(this);
            arr += '<td class="dgID" id=' + this.progress_id + '">'+ this.HOP_ID +'</td>';
            arr += '<td class="dgVal">' + this.Actual_Hop_Link_Name + '</td>';
            arr += '<td class="dgVal">' + this.Progress_Gap + '</td>';
            arr += '<td class="dgVal">' + this.Last_Status + '</td>';

            arr += '</tr>';
           i++;
        });
       arr += '</table>';
        return arr;
}

function simpleArray2dfull(target){
    console.log(target);
    var arr = '<table>';
	var i=0;
        $.each(target, function(key, val){
	if( i%2 == 0){
		arr += '<tr>';
	}
            arr += '<td class="datagrid-key">' + key + '</td>';
            arr += '<td class="datagrid-val ' + key + '">' + val + '</td>';
        if( i%2 == 1){
		arr += '</tr>';
	}
       i++; 

	});
	arr += '</table>';

    return arr;
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
   </script>
</head>
<html>
   <body>
<p>  
        <a href="/"> HOME!</a>

        </p>

	<div id="content">
      	<div id="container" style="width: 100%; height: 400px;"></div>
        <div id="listItem"></div>
	</div>
   </body>
</html>


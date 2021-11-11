<script>
$(document).ready(function() {
	getcsvdata();
	getelectionresult();
});

function reloadreport(){
	//getpage('election_result_chart2.php','content');
	getelectionresult();
	getelectionchart();
	getcsvdata();
}	

function getcsvdata(){
	var data = $('#chartdata_election_results').val();
	var array_data = data.split(";");
	var chart_array = [];
	var series = new Array();
	
	for(var i=0; i<array_data.length; i++){
		var chart_array_inner = array_data[i].split(",");
		//chart_array.push(chart_array_inner);
		series[i] = [chart_array_inner[0],   parseFloat(chart_array_inner[1])];
		//document.writeln(chart_array_inner[0]+" - "+chart_array_inner[1]);
	}

// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Browser market shares. January, 2018'
    },
    subtitle: {
        text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
    },
    xAxis: {
        type: 'category'
    },
     yAxis: {
        title: {
            text: 'Total percent market share'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    "series": [
        {
            "name": "Browsers",
            "colorByPoint": true,
            "data": [
                {
                    "name": "Chrome",
                    "y": 62.74,
                    "drilldown": "Chrome"
                },
               
               
            ]
        }
    ],
    
});

});

</script>
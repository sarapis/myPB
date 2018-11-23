<script>
    var cost_reports = <?php echo(json_encode($cost_reports)) ?>;

    // console.log(cost_reports);
    var chart = AmCharts.makeChart("chartdiv_cost", {
        "hideCredits":true,
        "type": "serial",
        "theme": "light",
        "legend": {
            "equalWidths": false,
            "position": "top",
            "valueAlign": "left",
            "valueWidth": 10,
        },
        "dataProvider": [
            {
            "category": "0-$99,999",
            "Complete": @if(isset($cost_reports['0-$99,999']['Complete'])) {{ $cost_reports['0-$99,999']['Complete']}} @else 0 @endif,
            "In process": @if(isset($cost_reports['0-$99,999']['In process'])) {{ $cost_reports['0-$99,999']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($cost_reports['0-$99,999']['Lost vote'])) {{ $cost_reports['0-$99,999']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($cost_reports['0-$99,999']['Project Status Needed'])) {{ $cost_reports['0-$99,999']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "100k-$199,999",
            "Complete": @if(isset($cost_reports['100k-$199,999']['Complete'])) {{ $cost_reports['100k-$199,999']['Complete']}} @else 0 @endif,
            "In process": @if(isset($cost_reports['100k-$199,999']['In process'])) {{ $cost_reports['100k-$199,999']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($cost_reports['100k-$199,999']['Lost vote'])) {{ $cost_reports['100k-$199,999']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($cost_reports['100k-$199,999']['Project Status Needed'])) {{ $cost_reports['100k-$199,999']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "200k-$299,999",
            "Complete": @if(isset($cost_reports['200k-$299,999']['Complete'])) {{ $cost_reports['200k-$299,999']['Complete']}} @else 0 @endif,
            "In process": @if(isset($cost_reports['200k-$299,999']['In process'])) {{ $cost_reports['200k-$299,999']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($cost_reports['200k-$299,999']['Lost vote'])) {{ $cost_reports['200k-$299,999']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($cost_reports['200k-$299,999']['Project Status Needed'])) {{ $cost_reports['200k-$299,999']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "300k-$399,999",
            "Complete": @if(isset($cost_reports['300k-$399,999']['Complete'])) {{ $cost_reports['300k-$399,999']['Complete']}} @else 0 @endif,
            "In process": @if(isset($cost_reports['300k-$399,999']['In process'])) {{ $cost_reports['300k-$399,999']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($cost_reports['300k-$399,999']['Lost vote'])) {{ $cost_reports['300k-$399,999']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($cost_reports['300k-$399,999']['Project Status Needed'])) {{ $cost_reports['300k-$399,999']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "400k-$499,999",
            "Complete": @if(isset($cost_reports['400k-$499,999']['Complete'])) {{ $cost_reports['400k-$499,999']['Complete']}} @else 0 @endif,
            "In process": @if(isset($cost_reports['400k-$499,999']['In process'])) {{ $cost_reports['400k-$499,999']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($cost_reports['400k-$499,999']['Lost vote'])) {{ $cost_reports['400k-$499,999']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($cost_reports['400k-$499,999']['Project Status Needed'])) {{ $cost_reports['400k-$499,999']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "500k-$599,999",
            "Complete": @if(isset($cost_reports['500k-$599,999']['Complete'])) {{ $cost_reports['500k-$599,999']['Complete']}} @else 0 @endif,
            "In process": @if(isset($cost_reports['500k-$599,999']['In process'])) {{ $cost_reports['500k-$599,999']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($cost_reports['500k-$599,999']['Lost vote'])) {{ $cost_reports['500k-$599,999']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($cost_reports['500k-$599,999']['Project Status Needed'])) {{ $cost_reports['500k-$599,999']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "600k-$699,999",
            "Complete": @if(isset($cost_reports['600k-$699,999']['Complete'])) {{ $cost_reports['600k-$699,999']['Complete']}} @else 0 @endif,
            "In process": @if(isset($cost_reports['600k-$699,999']['In process'])) {{ $cost_reports['600k-$699,999']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($cost_reports['600k-$699,999']['Lost vote'])) {{ $cost_reports['600k-$699,999']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($cost_reports['600k-$699,999']['Project Status Needed'])) {{ $cost_reports['600k-$699,999']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "700k-$799,999",
            "Complete": @if(isset($cost_reports['700k-$799,999']['Complete'])) {{ $cost_reports['700k-$799,999']['Complete']}} @else 0 @endif,
            "In process": @if(isset($cost_reports['700k-$799,999']['In process'])) {{ $cost_reports['700k-$799,999']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($cost_reports['700k-$799,999']['Lost vote'])) {{ $cost_reports['700k-$799,999']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($cost_reports['700k-$799,999']['Project Status Needed'])) {{ $cost_reports['700k-$799,999']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "800k-$899,999",
            "Complete": @if(isset($cost_reports['800k-$899,999']['Complete'])) {{ $cost_reports['800k-$899,999']['Complete']}} @else 0 @endif,
            "In process": @if(isset($cost_reports['800k-$899,999']['In process'])) {{ $cost_reports['800k-$899,999']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($cost_reports['800k-$899,999']['Lost vote'])) {{ $cost_reports['800k-$899,999']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($cost_reports['800k-$899,999']['Project Status Needed'])) {{ $cost_reports['800k-$899,999']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "900k-$999,999",
            "Complete": @if(isset($cost_reports['900k-$999,999']['Complete'])) {{ $cost_reports['900k-$999,999']['Complete']}} @else 0 @endif,
            "In process": @if(isset($cost_reports['900k-$999,999']['In process'])) {{ $cost_reports['900k-$999,999']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($cost_reports['900k-$999,999']['Lost vote'])) {{ $cost_reports['900k-$999,999']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($cost_reports['900k-$999,999']['Project Status Needed'])) {{ $cost_reports['900k-$999,999']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "$1,000,000+",
            "Complete": @if(isset($cost_reports['$1,000,000+']['Complete'])) {{ $cost_reports['$1,000,000+']['Complete']}} @else 0 @endif,
            "In process": @if(isset($cost_reports['$1,000,000+']['In process'])) {{ $cost_reports['$1,000,000+']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($cost_reports['$1,000,000+']['Lost vote'])) {{ $cost_reports['$1,000,000+']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($cost_reports['$1,000,000+']['Project Status Needed'])) {{ $cost_reports['$1,000,000+']['Project Status Needed']}} @else 0 @endif
            }
         ],
        "valueAxes": [{
            "stackType": "regular",
            "axisAlpha": 0,
            "gridAlpha": 0.2,
            "title": "Number of Projects"
        }],
        "graphs": [{
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 1,
            // "labelText": "[[value]]",
            "lineAlpha": 1,
            "title": "Complete",
            "type": "column",
            "color": "#000000",
            "lineColor": "#8ec73d",
            "fixedColumnWidth": 20,
            "valueField": "Complete"
        }, {
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 1,
            // "labelText": "[[value]]",
            "lineAlpha": 1,
            "title": "In process",
            "type": "column",
            "color": "#000000",
            "lineColor": "#ffeb00",
            "fixedColumnWidth": 20,
            "valueField": "In process"
        }, {
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 1,
            // "labelText": "[[value]]",
            "lineAlpha": 1,
            "title": "Lost vote",
            "type": "column",
            "color": "#000000",
            "lineColor": "#d3272d",
            "fixedColumnWidth": 20,
            "valueField": "Lost vote"
        }, {
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 1,
            // "labelText": "[[value]]",
            "lineAlpha": 1,
            "title": "Project Status Needed",
            "type": "column",
            "color": "#000000",
            "lineColor": "#c1c1c1",
            "fixedColumnWidth": 20,
            "valueField": "Project Status Needed"
        }],
        "rotate": true,
        "categoryField": "category",
        "categoryAxis": {
            "gridPosition": "start",
            "axisAlpha": 0.3,
            "gridAlpha": 0,
            "gridThickness" : 0,
            "position": "left",
            "title": "Project Cost"
        },
        "export": {
            "enabled": true
         }
    });
</script>
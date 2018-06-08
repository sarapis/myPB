<script>
    var cost_reports = <?php print_r(json_encode($cost_reports)) ?>;


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
        
        @foreach ($cost_reports as $key => $value)
            {

            "category": "{{ $key }}".replace(/&amp;/g, '&'),
            "Complete": @if(isset($value['Complete'])) {{ $value['Complete']}} @else 0 @endif,
            "In process": @if(isset($value['In process'])) {{ $value['In process']}} @else 0 @endif,
            "Not funded": @if(isset($value['Not funded'])) {{ $value['Not funded']}} @else 0 @endif,
            "Project Status Needed": @if(isset($value['Project Status Needed'])) {{ $value['Project Status Needed']}} @else 0 @endif
            },    
        @endforeach
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
            "title": "Not funded",
            "type": "column",
            "color": "#000000",
            "lineColor": "#d3272d",
            "fixedColumnWidth": 20,
            "valueField": "Not funded"
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
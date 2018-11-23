<script>
    var vote_reports = <?php print_r(json_encode($vote_reports)) ?>;

    // console.log(vote_reports);

    var chart = AmCharts.makeChart("chartdiv_vote", {
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
            "category": "Unknown",
            "Complete": @if(isset($vote_reports['unknown']['Complete'])) {{ $vote_reports['unknown']['Complete']}} @else 0 @endif,
            "In process": @if(isset($vote_reports['unknown']['In process'])) {{ $vote_reports['unknown']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($vote_reports['unknown']['Lost vote'])) {{ $vote_reports['unknown']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($vote_reports['unknown']['Project Status Needed'])) {{ $vote_reports['unknown']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "1-499",
            "Complete": @if(isset($vote_reports['1-499']['Complete'])) {{ $vote_reports['1-499']['Complete']}} @else 0 @endif,
            "In process": @if(isset($vote_reports['1-499']['In process'])) {{ $vote_reports['1-499']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($vote_reports['1-499']['Lost vote'])) {{ $vote_reports['1-499']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($vote_reports['1-499']['Project Status Needed'])) {{ $vote_reports['1-499']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "500-999",
            "Complete": @if(isset($vote_reports['500-999']['Complete'])) {{ $vote_reports['500-999']['Complete']}} @else 0 @endif,
            "In process": @if(isset($vote_reports['500-999']['In process'])) {{ $vote_reports['500-999']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($vote_reports['500-999']['Lost vote'])) {{ $vote_reports['500-999']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($vote_reports['500-999']['Project Status Needed'])) {{ $vote_reports['500-999']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "1,000-1,499",
            "Complete": @if(isset($vote_reports['1000-1499']['Complete'])) {{ $vote_reports['1000-1499']['Complete']}} @else 0 @endif,
            "In process": @if(isset($vote_reports['1000-1499']['In process'])) {{ $vote_reports['1000-1499']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($vote_reports['1000-1499']['Lost vote'])) {{ $vote_reports['1000-1499']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($vote_reports['1000-1499']['Project Status Needed'])) {{ $vote_reports['1000-1499']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "1,500-1,999",
            "Complete": @if(isset($vote_reports['1500-1999']['Complete'])) {{ $vote_reports['1500-1999']['Complete']}} @else 0 @endif,
            "In process": @if(isset($vote_reports['1500-1999']['In process'])) {{ $vote_reports['1500-1999']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($vote_reports['1500-1999']['Lost vote'])) {{ $vote_reports['1500-1999']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($vote_reports['1500-1999']['Project Status Needed'])) {{ $vote_reports['1500-1999']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "2,000-2,499",
            "Complete": @if(isset($vote_reports['2000-2499']['Complete'])) {{ $vote_reports['2000-2499']['Complete']}} @else 0 @endif,
            "In process": @if(isset($vote_reports['2000-2499']['In process'])) {{ $vote_reports['2000-2499']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($vote_reports['2000-2499']['Lost vote'])) {{ $vote_reports['2000-2499']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($vote_reports['2000-2499']['Project Status Needed'])) {{ $vote_reports['2000-2499']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "2,500-2,999",
            "Complete": @if(isset($vote_reports['2500-2999']['Complete'])) {{ $vote_reports['2500-2999']['Complete']}} @else 0 @endif,
            "In process": @if(isset($vote_reports['2500-2999']['In process'])) {{ $vote_reports['2500-2999']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($vote_reports['2500-2999']['Lost vote'])) {{ $vote_reports['2500-2999']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($vote_reports['2500-2999']['Project Status Needed'])) {{ $vote_reports['2500-2999']['Project Status Needed']}} @else 0 @endif
            },
            {
            "category": "3,000+",
            "Complete": @if(isset($vote_reports['3000+']['Complete'])) {{ $vote_reports['3000+']['Complete']}} @else 0 @endif,
            "In process": @if(isset($vote_reports['3000+']['In process'])) {{ $vote_reports['3000+']['In process']}} @else 0 @endif,
            "Lost vote": @if(isset($vote_reports['3000+']['Lost vote'])) {{ $vote_reports['3000+']['Lost vote']}} @else 0 @endif,
            "Project Status Needed": @if(isset($vote_reports['3000+']['Project Status Needed'])) {{ $vote_reports['3000+']['Project Status Needed']}} @else 0 @endif
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
            "fixedColumnWidth": 25,
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
            "fixedColumnWidth": 25,
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
            "fixedColumnWidth": 25,
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
            "fixedColumnWidth": 25,
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
            "autoWrap": true,
            "twoLineMode" : true,
            "title": "Number of Votes"
        },
        "export": {
            "enabled": true
         }
    });
</script>
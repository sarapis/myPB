<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style type="text/css">
    body{
        padding-top: 0px !important;
    }
    #chartdiv_category {
        width       : 100%;
        height      : 300px;
        font-size   : 11px;
    }
    #chartdiv_vote {
        width       : 100%;
        height      : 300px;
        font-size   : 11px;
    } 
    #chartdiv_cost {
        width       : 100%;
        height      : 300px;
        font-size   : 11px;
    }

    #chartdiv_agency {
      width: 100%;
      height: 300px;
      font-size: 11px;
    }

    .amcharts-pie-slice {
      transform: scale(1);
      transform-origin: 50% 50%;
      transition-duration: 0.3s;
      transition: all .3s ease-out;
      -webkit-transition: all .3s ease-out;
      -moz-transition: all .3s ease-out;
      -o-transition: all .3s ease-out;
      cursor: pointer;
      box-shadow: 0 0 30px 0 #000;
    }

    .amcharts-pie-slice:hover {
      transform: scale(1.1);
      filter: url(#shadow);
    }                               
    #map{
        z-index: 1 !important;
        height: 400px !important;
        display: block !important;
    }
    ul#ui-id-1 {
        width: 260px !important;
    }
    #tab_sort{
        display: none !important;
    }
    .nav.nav-tabs.nav-tabs-line.ui-tabs-nav.ui-corner-all.ui-helper-reset.ui-helper-clearfix.ui-widget-header{
        display: none;
    }
    </style>
    <style>
        html{height:100%;}
        body{height:100%; width:210mm; margin:0 auto; font-size:12pt; margin:0 auto; padding:0; color:#00535B; font-family:Arial, sans-serif;}
        .wrapper{padding:10px;}
        img{width: 100%;}
        .copy{margin-bottom:5px; text-align: right;}
        .copy a{font-size:8pt; color:#666; text-decoration:none;}
        .map{border:3px solid; border-width:3px 0; margin-bottom: 40px;}
        #chart1{position: absolute;top: 330px;width: 100mm;}
        #chart2{position: absolute;top: 330px;right:0;width: 100mm;}
        #chart3{position: absolute;top: 680px;width: 100mm;}
        #chart4{position: absolute;top: 680px;right:0;width: 100mm;}
        .logo{width: 2.5em;vertical-align: unset;}
        h1{font-size:1em; text-transform: uppercase; font-weight:bold; margin:0; margin:0.5em 0; color:#555;}
        h4{font-size:0.8em;text-align: center; text-transform: uppercase; font-weight:normal; margin:0; margin:0.5em 0; color:#555;}
        h2{text-align: center; font-size:2em; font-weight:normal; margin:0; margin:0 0 1em; color:#222;}
        span{font-size:0.95em; font-weight:normal;margin:0; margin:0 0 1em;color:#222;}
        footer{position:absolute; left:0; bottom:0; width:100%; text-align: center; padding:10px 0; margin-top:80px;}
        footer a{color:#0099cc;}
      </style>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDo-Ba1uQA_-eQ0zAA-ymOSrfrakLUZsHo">
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.9/gmaps.min.js"></script>
</head>
<body>
    <div class="wrapper">

        <div class="title">
            <div style="display: inline-block;">
                <img class="logo" src="http://pb.flospaces.org/images/myPB.png">
            </div>
            <div style="display: inline-block;margin-right:5mm;">
                <h1>Program Report</h1>
                <h1>{!! date('m/d/Y') !!}</h1>
            </div>
            <div style="display: inline-block;">
                <h1>FILTERED BY @if($status!='') Status: <span>{{$status}}</span> @endif @if($category!='') Category: <span>{{$category}}</span> @endif @if($city!='') City: <span>{{$city}}</span> @endif</h1>
                <h1> Cost: <span>${{$price_min}}-${{$price_max}}</span> Year of Vote: <span>{{$year_min}}-{{$year_max}}</span> Vote: <span>{{$vote_min}}-{{$vote_max}}</span></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
               <div class="print-show" id="map"></div>
                  
            </div>
            <div id="chart1" class="text-align">

                <h4>PROJECTS BY CATEGORY</h4>

                <div id="chartdiv_category"></div>                   
              

            </div>
            <div id="chart2" class="text-align">

                <h4>PROJECTS BY COST</h4>
          
                <div id="chartdiv_cost"></div>                   
                    
            </div>
            <div id="chart3" class="text-align">              

                <h4>PROJECTS BY VOTE</h4>

                <div id="chartdiv_vote"></div>                   

            </div>
            <div id="chart4" class="text-align">

                <h4>PROJECTS BY AGENCY</h4>
    
                <div id="chartdiv_agency"></div>                   
                  
            </div>
        </div>

        <footer>
          {!! $pdf_footer !!}
        </footer>
    </div>
    <form action="/download_pdf" method="post" id="download_form" style="display: none;">
        @csrf
        <input type="text" id="hidden_projects" name="projects">
        <input type="submit" name="submit" id="download_submit">

    </form>
    <script>
     $(document).ready(function () {
        var address_district = <?php echo json_encode($address_district); ?>;
        if( address_district != ''){
        
            $('#btn-district span').html("District: "+address_district);
            $('#btn-district span').attr('ajax_text',"District: "+address_district);
            $('#btn-district').show();
        };
    });
    </script>
    <script>

        var locations = <?php print_r(json_encode($limit_maps)) ?>;

        var sumlat = 0.0;
        var sumlng = 0.0;
        for(var i = 0; i < locations.length; i ++)
        {
            sumlat += parseFloat(locations[i].latitude);
            sumlng += parseFloat(locations[i].longitude);

        }

        var avglat = sumlat/locations.length;
        var avglng = sumlng/locations.length;

      

        if(!avglat){
            avglat = 40.730981;
            avglng = -73.998107
        }

        // var mymap = new GMaps({
        //   el: '#map',
        //   lat: avglat,
        //   lng: avglng,
        //   zoom:13
        // });

        

        
        var marker = [];
        var c = 0;  

        $.each( locations, function(index, value ){
            var icon;
            var statusicon;
            var statuscolor;
            var statuslabel;
            if(value.project_status_category == "Complete"){
                
                statusicon = 'http://pb.flospaces.org/images/icon/completed-map-pin.png';
            }
            else if(value.project_status_category == "Project Status Needed"){
                
                statusicon = 'http://pb.flospaces.org/images/icon/status-needed-map-pin.png';
            
            }
            else if(value.project_status_category == "Lost vote"){
                
                statusicon = 'http://pb.flospaces.org/images/icon/not-funded-map-pin.png';
              
            }
            else{
                
                statusicon = 'http://pb.flospaces.org/images/icon/in-progress-map-pin.png';
            
            }

            marker[c] = {
                lat: value.latitude,
                lng: value.longitude,
                icon: statusicon
            }
            console.log(c, marker[c]);
            c ++;
       });
        
            console.log(marker,c);
            url = GMaps.staticMapURL({
              size: [1200, 200],
              lat: avglat,
              lng: avglng,
              zoom:10,
              markers: marker
            });
            url += '&key=AIzaSyDo-Ba1uQA_-eQ0zAA-ymOSrfrakLUZsHo';
            $('<img/>').attr('src', url)
              .appendTo('#map');
        

        
    </script>
   
    <script>
        var category_reports = <?php print_r(json_encode($category_reports)) ?>;

        var chart = AmCharts.makeChart("chartdiv_category", {
            "hideCredits":true,
            "type": "serial",
            "theme": "light",
            "dataProvider": [
            
            @foreach ($category_reports as $key => $value)
                {

                "category": "{{ $key }}".replace(/&amp;/g, '&'),
                "Complete": @if(isset($value['Complete'])) {{ $value['Complete']}} @else 0 @endif,
                "In process": @if(isset($value['In process'])) {{ $value['In process']}} @else 0 @endif,
                "Lost vote": @if(isset($value['Lost vote'])) {{ $value['Lost vote']}} @else 0 @endif,
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
                "balloonText": "<b>[[title]]</b><br><span style='font-size:10px'>[[category]]: <b>[[value]]</b></span>",
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
                "balloonText": "<b>[[title]]</b><br><span style='font-size:10px'>[[category]]: <b>[[value]]</b></span>",
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
                "balloonText": "<b>[[title]]</b><br><span style='font-size:10px'>[[category]]: <b>[[value]]</b></span>",
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
                "balloonText": "<b>[[title]]</b><br><span style='font-size:10px'>[[category]]: <b>[[value]]</b></span>",
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
                "title": "Project Category"
            },
            "export": {
                "enabled": true
             }
        });
    </script>
    <script>
        var vote_reports = <?php print_r(json_encode($vote_reports)) ?>;

        // console.log(vote_reports);

        var chart = AmCharts.makeChart("chartdiv_vote", {
            "hideCredits":true,
            "type": "serial",
            "theme": "light",
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
                "autoWrap": true,
                "twoLineMode" : true,
                "title": "Number of Votes"
            },
            "export": {
                "enabled": true
             }
        });
    </script>
    <script>
        var cost_reports = <?php echo(json_encode($cost_reports)) ?>;

        // console.log(cost_reports);
        var chart = AmCharts.makeChart("chartdiv_cost", {
            "hideCredits":true,
            "type": "serial",
            "theme": "light",
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
                "fixedColumnWidth": 15,
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
                "fixedColumnWidth": 15,
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
                "fixedColumnWidth": 15,
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
                "fixedColumnWidth": 15,
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
    <script>

        var chart = AmCharts.makeChart("chartdiv_agency", {
            "hideCredits":true,
            "type": "serial",
            "theme": "light",
            "dataProvider": [
            
            @foreach ($output as $key => $value)
                {

                "category": "{{ $value['key'] }}".replace(/&amp;/g, '&'),
                "Complete": @if(isset($value['Complete'])) {{ $value['Complete']}} @else 0 @endif,
                "In process": @if(isset($value['In process'])) {{ $value['In process']}} @else 0 @endif,
                "Lost vote": @if(isset($value['Lost vote'])) {{ $value['Lost vote']}} @else 0 @endif,
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
                "fixedColumnWidth": 15,
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
                "fixedColumnWidth": 15,
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
                "fixedColumnWidth": 15,
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
                "fixedColumnWidth": 15,
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
                "title": "Implementing Agency"
                // "ignoreAxisWidth": true,
                //  "autoWrap": true
            },
            "marginLeft": 140,
            "export": {
                "enabled": true
             }
        });
    </script>
</body>
</html>
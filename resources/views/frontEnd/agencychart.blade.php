<script>
var agency_reports = <?php echo(json_encode($agency_reports)) ?>;

console.log(agency_reports);

var chart = AmCharts.makeChart("chartdiv_agency", {
  "hideCredits":true,
  "type": "pie",
  "startDuration": 0,
  "theme": "light",
  "addClassNames": false,
  // "legend":{
  //  	"position":"right",
  //   "marginRight":100,
  //   "autoMargins":false
  // },
  "innerRadius": "30%",
  "defs": {
    "filter": [{
      "id": "shadow",
      "width": "200%",
      "height": "200%",
      "feOffset": {
        "result": "offOut",
        "in": "SourceAlpha",
        "dx": 1000,
        "dy": 0
      },
      "feGaussianBlur": {
        "result": "blurOut",
        "in": "offOut",
        "stdDeviation": 5
      },
      "feBlend": {
        "in": "SourceGraphic",
        "in2": "blurOut",
        "mode": "normal"
      }
    }]
  },
  "dataProvider": [
  @foreach ($agency_reports as $key => $value)
    {
      "country": "{{$value['agency_name']}}",
      'litres': @if(isset($value['projects'])) {{ count(explode(',', $value['projects'])) }} @else 0 @endif
    },    
  @endforeach
 ],
  "valueField": "litres",
  "titleField": "country",
  "export": {
    "enabled": true
  }
});

chart.addListener("init", handleInit);

chart.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});

function handleInit(){
  chart.legend.addListener("rollOverItem", handleRollOver);
}

function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}
</script>
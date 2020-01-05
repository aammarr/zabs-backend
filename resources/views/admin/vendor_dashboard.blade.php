@extends('layouts.backend')

@section('content')
<?php
    $vendor_id = Auth::user()->vendor_id;

    $user = DB::table('users as u')
                ->where('u.deleted_at',null)
                ->select('u.*')
                ->get();

    $categories = DB::table('category as c')
                ->where('c.deleted_at',null)
                ->where('c.vendor_id',$vendor_id)
                ->select('c.*')
                ->get();

    $products = DB::table('products as p')
                ->where('p.deleted_at',null)
                ->where('p.vendor_id',$vendor_id)
                ->select('p.*')
                ->get();

    $orders = DB::table('orders as o')
                ->where('o.deleted_at',null)
                ->where('o.vendor_id',$vendor_id)
                ->select('o.*')
                ->get();

    $messages = DB::table('contact_us as cu')
                ->where('cu.deleted_at',null)
                ->where('cu.vendor_id',$vendor_id)
                ->select('cu.*')
                ->get();
    $dataPoints = array( 
                array("label"=>"Users", "y"=>count($user)),
                array("label"=>"Products", "y"=>count($products)),
                array("label"=>"Categories", "y"=>count($categories)),
                array("label"=>"Messages", "y"=>count($messages)),
                array("label"=>"Orders", "y"=>count($orders))
            );

?>


<script>
window.onload = function() {
 

// <!-- pie chart --> 
var chart1 = new CanvasJS.Chart("chartContainer1", {
    animationEnabled: true,
    title: {
        text: "Inventory"
    },
    subtitles: [{
        text: "Till Now"
    }],
    data: [{
        type: "pie",
        yValueFormatString: "#,##0.00\"%\"",
        indexLabel: "{label} ({y})",
        dataPoints: <?php  echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
});




// <!-- coloumn chart -->
var chart2 = new CanvasJS.Chart("chartContainer2", {
    animationEnabled: true,
    theme: "light2",
    title:{
        text: "Total Numbers"
    },
    axisY: {
        title: "Numbers"
    },
    data: [{
        type: "column",
        yValueFormatString: "#,##0.## ",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
});

// <!-- line chart -->
var chart3 = new CanvasJS.Chart("chartContainer3", {
    animationEnabled: true,
    theme: "light2",
    title:{
        text: "Order"
    },
    axisX:{
        valueFormatString: "DD MMM",
        crosshair: {
            enabled: true,
            snapToDataPoint: true
        }
    },
    axisY: {
        title: "Number of Product",
        crosshair: {
            enabled: true
        }
    },
    toolTip:{
        shared:true
    },  
    legend:{
        cursor:"pointer",
        verticalAlign: "bottom",
        horizontalAlign: "left",
        dockInsidePlotArea: true,
        itemclick: toogleDataSeries
    },
    data: [{
        type: "line",
        showInLegend: true,
        name: "Total Orders",
        markerType: "square",
        xValueFormatString: "DD MMM, YYYY",
        color: "#F08080",
        dataPoints: [
            { x: new Date(2017, 0, 3), y: 650 },
            { x: new Date(2017, 0, 4), y: 700 },
            { x: new Date(2017, 0, 5), y: 710 },
            { x: new Date(2017, 0, 6), y: 658 },
            { x: new Date(2017, 0, 7), y: 734 },
            { x: new Date(2017, 0, 8), y: 963 },
            { x: new Date(2017, 0, 9), y: 847 },
            { x: new Date(2017, 0, 10), y: 853 },
            { x: new Date(2017, 0, 11), y: 869 },
            { x: new Date(2017, 0, 12), y: 943 },
            { x: new Date(2017, 0, 13), y: 970 },
            { x: new Date(2017, 0, 14), y: 869 },
            { x: new Date(2017, 0, 15), y: 890 },
            { x: new Date(2017, 0, 16), y: 930 }
        ]
    },
    {
        type: "line",
        showInLegend: true,
        name: "Order Product",
        lineDashType: "dash",
        dataPoints: [
            { x: new Date(2017, 0, 3), y: 510 },
            { x: new Date(2017, 0, 4), y: 560 },
            { x: new Date(2017, 0, 5), y: 540 },
            { x: new Date(2017, 0, 6), y: 558 },
            { x: new Date(2017, 0, 7), y: 544 },
            { x: new Date(2017, 0, 8), y: 693 },
            { x: new Date(2017, 0, 9), y: 657 },
            { x: new Date(2017, 0, 10), y: 663 },
            { x: new Date(2017, 0, 11), y: 639 },
            { x: new Date(2017, 0, 12), y: 673 },
            { x: new Date(2017, 0, 13), y: 660 },
            { x: new Date(2017, 0, 14), y: 562 },
            { x: new Date(2017, 0, 15), y: 643 },
            { x: new Date(2017, 0, 16), y: 570 }
        ]
    }]
});


function toogleDataSeries(e){
    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    } else{
        e.dataSeries.visible = true;
    }
    chart.render();
}


//calling charts
chart1.render();
chart2.render();
// chart3.render();
 
}
</script>



<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Your application's dashboard.
                </div>
                <body>
                    <div id="chartContainer1" style="height: 400px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                </body>
                <body>
                    <div id="chartContainer2" style="height: 400px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                </body>
                <body>
                    <div id="chartContainer3" style="height: 370px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                </body>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.backend')

@section('content')

<?php
    $vendor_id = Auth::user()->vendor_id;
 
    $user = DB::table('users as u')
                ->where('u.of_vendor',$vendor_id)
                ->where('u.deleted_at',null)
                ->select('u.*')
                ->get();

    $categories = DB::table('category as c')
                ->where('c.vendor_id',$vendor_id)
                ->where('c.deleted_at',null)
                ->select('c.*')
                ->get();

    $products = DB::table('products as p')
                ->where('p.vendor_id',$vendor_id)
                ->where('p.deleted_at',null)
                ->select('p.*')
                ->get();

    $orders = DB::table('orders as o')
                ->where('o.vendor_id',$vendor_id)
                ->where('o.deleted_at',null)
                ->select('o.*')
                ->get();

    $messages = DB::table('contact_us as cu')
                ->where('cu.vendor_id',$vendor_id)
                ->where('cu.deleted_at',null)
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
<!-- coloumn chart -->
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer2", {
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
        yValueFormatString: "#,##0.## tonnes",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();
 
}
</script>

<!-- pie chart -->
<script>
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer1", {
    animationEnabled: true,
    title: {
        text: "Usage Share of Desktop Browsers"
    },
    subtitles: [{
        text: "November 2017"
    }],
    data: [{
        type: "pie",
        yValueFormatString: "#,##0.00\"%\"",
        indexLabel: "{label} ({y})",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();
 
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
                    <div id="chartContainer1" style="height: 350px; width: 50%;"></div>
                        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                </body>
                <body>
                    <div id="chartContainer2" style="height: 350px; width: 50%;"></div>
                        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                </body>
            </div>
        </div>
    </div>
</div>
@endsection

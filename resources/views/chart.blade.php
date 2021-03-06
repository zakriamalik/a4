 <?php
 # Display file to show charts for loan scenarios
 # Reference: Used the code from the following site
 # http://canvasjs.com/php-charts/
 # Loading up for loop arrays for the charts via loop (no calcs or logic)
 for($j = 1; $j <= $loanMonths; $j++) {
      $array_pmtNo[$j];
      $array_date[$j];
      $array_loan[$j];
      $array_interest[$j];
      $array_principal[$j];
      $array_loanBalance[$j];
      $dataPoints[] = array("y" => $array_loan[$j], "label" => $array_date[$j]);
      $dataPoints2[] = array("y" => $array_interest[$j], "label" => $array_date[$j]);
      $dataPoints3[] = array("y" => $array_principal[$j], "label" => $array_date[$j]);
}

 ?>

  {{--Div to show and hide via Java Script--}}
  <div id="chartContainer"></div>

    {{--Java script for chart--}}
    <script type="text/javascript">

        $(function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "theme1",
                animationEnabled: true,
                title: {
                    text: "Loan balance by month"
                },
                data: [
                {
                    type: "column",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>

                }
                ]
            });
            chart.render();
        });
    </script>

  {{--Div to show and hide via Java Script--}}
  <div id="chartContainer2"></div>

     {{--Java script for chart 2--}}
     <script type="text/javascript">

         $(function () {
             var chart = new CanvasJS.Chart("chartContainer2", {
                 theme: "theme1",
                 animationEnabled: true,
                 title: {
                     text: "Loan Interest by month"
                 },
                 data: [
                 {
                     type: "line",
                     dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>

                 }
                 ]
             });
             chart.render();
         });
     </script>

  {{--Div to show and hide via Java Script--}}
  <div id="chartContainer3"></div>

    {{--Java script for chart 3--}}
    <script type="text/javascript">

        $(function () {
            var chart = new CanvasJS.Chart("chartContainer3", {
                theme: "theme1",
                animationEnabled: true,
                title: {
                    text: "Loan Principal by month"
                },
                data: [
                {
                    type: "line",
                    dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>

                }
                ]
            });
            chart.render();
        });
    </script>
    {{--Reference: Leveraged Charrt Code from this site -> http://canvasjs.com/php-charts/ --}}

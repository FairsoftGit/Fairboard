<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <h1>Home</h1>
    <section class="row text-center placeholders">
        <div class="col-6 col-sm-3 placeholder">
            <div id="char_account_status"></div>
        </div>
    </section>
</main>
<script>
    $( document ).ready(function() {
        $('.navLinkFairboard').addClass('active');
    });
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // Load google charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Status', ''],
            ['Actief', <?php echo $accountStatusArray[1];?>],
            ['Inactief', <?php echo $accountStatusArray[0] - $accountStatusArray[1];?>]
        ]);

        // Optional; add a title and set the width and height of the chart
        var options = {'title':'Account status', 'width':400, 'height':300};

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.PieChart(document.getElementById('char_account_status'));
        chart.draw(data, options);
    }
</script>
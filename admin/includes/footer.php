  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- text -->
    <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>

    <script src="./js/scripts.js"></script>

     <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Photos',      <?php echo Photo::count_all();?>],
          ['Users',  <?php echo User::count_all();;?>],
          ['Comments', <?php echo Comment::count_all();;?>]
        ]);

        var options = {
          legend:'none',
          pieSliceText:'label',
          title: 'My Daily Activities',
          backgroundColor:'transparent',
          slices:{
            0: { color: 'green' },
            1: { color: 'orange' },
            2: { color: 'red' }
          }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

</body>

</html>

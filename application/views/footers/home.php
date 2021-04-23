        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <!--Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>-->
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/Chart.js/dist/Chart.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>gentelella-master/build/js/custom.min.js"></script>

    <!-- Chart.js -->
    <script>
      Chart.defaults.global.legend = {
        enabled: false
      };

      // Doughnut chart
      var ctx = document.getElementById("canvasDoughnut");
      var data = {
        labels: [
          "<?php echo $activesections[0]['name']; ?> ",
          "<?php echo $activesections[1]['name']; ?> ",
          "<?php echo $activesections[2]['name']; ?> ",
          "<?php echo $activesections[3]['name']; ?> ",
          "<?php echo $activesections[4]['name']; ?> "
        ],
        datasets: [{
          data: [
			<?php echo $activesections[0]['count']; ?>,
			<?php echo $activesections[1]['count']; ?>,
			<?php echo $activesections[2]['count']; ?>,
			<?php echo $activesections[3]['count']; ?>,
			<?php echo $activesections[4]['count']; ?>
			],
          backgroundColor: [
            "rgba(52,152,219,0.88)",
            "rgba(38,185,154,0.88)",
            "rgba(243,156,18,0.88)",
            "rgba(231,76,60,0.88)",
            "rgba(46,109,164,0.88)"
          ],
          hoverBackgroundColor: [
            "rgba(92,172,226,0.88)",
            "rgba(81,199,174,0.88)",
            "rgba(245,175,65,0.88)",
            "rgba(235,111,98,0.88)",
            "rgba(87,138,182,0.88)"
          ]

        }]
      };

      var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: data
      });	  
    </script>
    <!-- /Chart.js -->
  </body>
</html>
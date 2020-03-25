(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.my_custom_behavior = {
    attach: function (context, settings) {
      let data = drupalSettings.cdp_stats;
      chartRender(data);
    }
  }
})(jQuery, Drupal, drupalSettings);


function chartRender(cdp) {
  var ctx = document.getElementById('cdpTimeChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: cdp,
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
};
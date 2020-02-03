<?php
require_once '../util/main.php';
require_once 'util/valid_admin.php';
include ('view/header.php');
include ('view/side-menu.php');
?>
<div class="ap_main_parent">
    <div class="ap_graph_parent">
        <div class="ap_graph_cont">
            <div id="embed-api-auth-container" style="display: none"></div>
            <div id="chart-container"></div>
            <div id="chart-container2"></div>
            <div id="chart-container3"></div>
            <div id="chart-container4"></div>
            <div id="chart-container7"></div>
            <div id="chart-container5"></div>
            <div id="chart-container6"></div>
            <div id="view-selector-container"></div>
        </div>
    </div>

</div>

<script>

gapi.analytics.ready(function() {

  /**
   * Authorize the user immediately if the user has already granted access.
   * If no access has been created, render an authorize button inside the
   * element with the ID "embed-api-auth-container".
   */
  gapi.analytics.auth.authorize({
    container: 'embed-api-auth-container',
    clientid: '975369410881-s4f9tsmo4g1fusv0dqt8kmo2t9gcm8ji.apps.googleusercontent.com'
  });


  /**
   * Create a new ViewSelector instance to be rendered inside of an
   * element with the id "view-selector-container".
   */
  var viewSelector = new gapi.analytics.ViewSelector({
    container: 'view-selector-container'
  });

  // Render the view selector to the page.
  viewSelector.execute();


  /**
   * Create a new DataChart instance with the given query parameters
   * and Google chart options. It will be rendered inside an element
   * with the id "chart-container".
   */
  var dataChart = new gapi.analytics.googleCharts.DataChart({
    query: {
      metrics: 'ga:sessions',
      dimensions: 'ga:date',
      'start-date': '30daysAgo',
      'end-date': 'yesterday'
    },
    chart: {
      container: 'chart-container',
      type: 'LINE',
      options: {
        width: '10%'
      }
    }
  });
  
  var dataChart2 = new gapi.analytics.googleCharts.DataChart({
   query: {
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
      'metrics': 'ga:sessions,ga:users',
      'dimensions': 'ga:date'
    },
    chart: {
      'container': 'chart-container2',
      'type': 'LINE',
      'options': {
        'width': '80%'
      }
    }
  });
  
   var dataChart3 = new gapi.analytics.googleCharts.DataChart({
   query: {
      metrics: 'ga:sessions',
      dimensions: 'ga:country',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
      'max-results': 6,
      sort: '-ga:sessions'
    },
    chart: {
      'container': 'chart-container3',
      'type': 'PIE',
      'options': {
        'width': '40%',
        'pieHole': 4/9,
      }
    }
  });
  
  var dataChart4 = new gapi.analytics.googleCharts.DataChart({
   query: {
      metrics: 'ga:sessions',
      dimensions: 'ga:city',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
      'max-results': 6,
      sort: '-ga:sessions'
    },
    chart: {
      'container': 'chart-container4',
      'type': 'PIE',
      'options': {
        'width': '40%',
        'pieHole': 4/9,
      }
    }
  });
  
  var dataChart5 = new gapi.analytics.googleCharts.DataChart({
    query: {
      'ids': 'ga:100367422', // <-- Replace with the ids value for your view.
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
      'metrics': 'ga:sessions,ga:users,ga:NewUsers',
      'dimensions': 'ga:date'
    },
    chart: {
      'container': 'chart-container5',
      'type': 'COLUMN',
      'options': {
        'width': '45%'
      }
    }
  });
  
  var dataChart6 = new gapi.analytics.googleCharts.DataChart({
    query: {
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
      metrics: 'ga:sessions',
      dimensions: 'ga:city',
    },
    chart: {
      'container': 'chart-container6',
      'type': 'GEO',
      'options': {
        'width': '50%'
      }
    }
  });
  
  var dataChart7 = new gapi.analytics.googleCharts.DataChart({
   query: {
      metrics: 'ga:sessions',
      dimensions: 'ga:region',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
      'max-results': 6,
      sort: '-ga:sessions'
    },
    chart: {
      'container': 'chart-container7',
      'type': 'PIE',
      'options': {
        'width': '40%',
        'pieHole': 4/9,
      }
    }
  });


  /**
   * Render the dataChart on the page whenever a new view is selected.
   */
  viewSelector.on('change', function(ids) {
    dataChart.set({query: {ids: ids}}).execute();
    dataChart2.set({query: {ids: ids}}).execute();
    dataChart3.set({query: {ids: ids}}).execute();
    dataChart4.set({query: {ids: ids}}).execute();
    dataChart5.set({query: {ids: ids}}).execute();
    dataChart6.set({query: {ids: ids}}).execute();
    dataChart7.set({query: {ids: ids}}).execute();
  });

});
</script>
<?php include ('view/footer.php'); ?>






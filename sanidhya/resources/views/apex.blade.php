@include("inc_sanidhya.header")

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
     
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                
                <div class="col-12 col-sm-10">
                  <h3>Welcome 
                    {{ ucwords(session('rexkod_admin_user_type')) }} | {{ session('rexkod_admin_user_name') }}
                  </h3>
                </div>

                <div class="col-12 col-sm-2">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"> 
                    <li class="breadcrumb-item">Dashboard
                  </li>
                  </ol>
                </div>

              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
         
          <div class="container-fluid general-widget">
            <div class="row">
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Total Events</h6>
                        <h4 class="mb-0 counter">{{$data['events_total']}}</h4>
                      </div>
                      <svg class="fill-secondary" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        
                        <path d="M25.4062 0V11.4859C31.2498 12.1433 35.8642 16.7579 36.5232 22.5938H48C47.2954 10.5189 37.4829 0.704531 25.4062 0Z"></path>
                        <path d="M14.1556 31.8558C12.4237 29.6903 11.3438 26.9823 11.3438 24C11.3438 17.5025 16.283 12.1958 22.5938 11.4859V0C10.0492 0.731813 0 11.2718 0 24C0 30.0952 2.39381 35.6398 6.14897 39.8624L14.1556 31.8558Z"></path>
                        <path d="M47.9977 25.4062H36.5143C35.8044 31.717 30.4977 36.6562 24.0002 36.6562C21.0179 36.6562 18.3099 35.5763 16.1444 33.8444L8.13779 41.851C12.3604 45.6062 17.905 48 24.0002 48C36.7284 48 47.2659 37.9508 47.9977 25.4062Z"></path>
                      </svg>
                    </div>
                    <div class="progress-widget">
                      <div class="progress sm-progress-bar progress-animate">
                        <div class="progress-gradient-secondary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Total Passes</h6>
                        <h4 class="mb-0 counter">{{$data['pass_total']}}</h4>
                      </div>
                    

                      <svg class="fill-warning" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        
                        <path d="M25.4062 0V11.4859C31.2498 12.1433 35.8642 16.7579 36.5232 22.5938H48C47.2954 10.5189 37.4829 0.704531 25.4062 0Z"></path>
                        <path d="M14.1556 31.8558C12.4237 29.6903 11.3438 26.9823 11.3438 24C11.3438 17.5025 16.283 12.1958 22.5938 11.4859V0C10.0492 0.731813 0 11.2718 0 24C0 30.0952 2.39381 35.6398 6.14897 39.8624L14.1556 31.8558Z"></path>
                        <path d="M47.9977 25.4062H36.5143C35.8044 31.717 30.4977 36.6562 24.0002 36.6562C21.0179 36.6562 18.3099 35.5763 16.1444 33.8444L8.13779 41.851C12.3604 45.6062 17.905 48 24.0002 48C36.7284 48 47.2659 37.9508 47.9977 25.4062Z"></path>
                      </svg>
                     
                    </div>
                    <div class="progress-widget">
                      <div class="progress sm-progress-bar progress-animate">
                        <div class="progress-gradient-success" role="progressbar" style="width: 60%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Total Used</h6>
                        <h4 class="mb-0 counter">{{$data['pass_used']}}</h4>
                      </div>
                      <svg class="fill-info" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        
                        <path d="M25.4062 0V11.4859C31.2498 12.1433 35.8642 16.7579 36.5232 22.5938H48C47.2954 10.5189 37.4829 0.704531 25.4062 0Z"></path>
                        <path d="M14.1556 31.8558C12.4237 29.6903 11.3438 26.9823 11.3438 24C11.3438 17.5025 16.283 12.1958 22.5938 11.4859V0C10.0492 0.731813 0 11.2718 0 24C0 30.0952 2.39381 35.6398 6.14897 39.8624L14.1556 31.8558Z"></path>
                        <path d="M47.9977 25.4062H36.5143C35.8044 31.717 30.4977 36.6562 24.0002 36.6562C21.0179 36.6562 18.3099 35.5763 16.1444 33.8444L8.13779 41.851C12.3604 45.6062 17.905 48 24.0002 48C36.7284 48 47.2659 37.9508 47.9977 25.4062Z"></path>
                      </svg>
                      
                    </div>
                    <div class="progress-widget">
                      <div class="progress sm-progress-bar progress-animate">
                        <div class="progress-gradient-primary" role="progressbar" style="width: 48%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Total Unused</h6>
                        <h4 class="mb-0 counter">{{$data['pass_unused']}}</h4>
                      </div>
                      <svg class="fill-success" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        
                        <path d="M25.4062 0V11.4859C31.2498 12.1433 35.8642 16.7579 36.5232 22.5938H48C47.2954 10.5189 37.4829 0.704531 25.4062 0Z"></path>
                        <path d="M14.1556 31.8558C12.4237 29.6903 11.3438 26.9823 11.3438 24C11.3438 17.5025 16.283 12.1958 22.5938 11.4859V0C10.0492 0.731813 0 11.2718 0 24C0 30.0952 2.39381 35.6398 6.14897 39.8624L14.1556 31.8558Z"></path>
                        <path d="M47.9977 25.4062H36.5143C35.8044 31.717 30.4977 36.6562 24.0002 36.6562C21.0179 36.6562 18.3099 35.5763 16.1444 33.8444L8.13779 41.851C12.3604 45.6062 17.905 48 24.0002 48C36.7284 48 47.2659 37.9508 47.9977 25.4062Z"></path>
                      </svg>
                    </div>
                    <div class="progress-widget">
                      <div class="progress sm-progress-bar progress-animate">
                        <div class="progress-gradient-danger" role="progressbar" style="width: 48%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-xl-4 col-md-12 box-col-4">
                <div class="card">
                  
                      <div>
                        <canvas id="myChart"></canvas>
                        <br>
                      </div>

                      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                      <script>
                        const ctx = document.getElementById('myChart');

                        new Chart(ctx, {
                          type: 'doughnut',
                        data: {
                          datasets: [
                            {
                              data: [{{$data['pass_total']}}, {{$data['pass_used']}}, {{$data['pass_unused']}}],
                              backgroundColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                              ],
                            },
                          ],
                          labels: ['All', 'Used', 'Unused'],
                        },
                        options: {
                          plugins: {
                            datalabels: {
                              formatter: (value) => {
                                return value + '%';
                              },
                            },
                          },
                        }
                        });
                      </script>
                </div>
              </div>

              <div class="col-xl-8 col-md-12 box-col-8">
                <div class="card" style="padding:20px">
                  

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


<canvas id="myChart2" style="width:100%;max-width:600px"></canvas>

<script>
var xValues = ["Total Passes", "Used Passes","Unused Passed"];
var yValues = [{{$data['pass_total']}},{{$data['pass_used']}},{{$data['pass_unused']}}];
var barColors = ["#ffc500", "#ff8819",""];

new Chart("myChart2", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "All Events"
    }
  }
});
</script>


                </div>
              </div>
            
          


            </div>
          </div>
     
          <!-- Container-fluid Ends-->
        </div>
  

        @include("inc_sanidhya.footer")



<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/datatable/datatables/datatable.custom.js"></script>
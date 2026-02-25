<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title ?? 'Dashboard' }} | Starter Kits</title>
  @include('admin.partials.style')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('admin.includes.preloader')

    @include('frontend.includes.header')



    @yield('content')

  <!-- /.content-wrapper -->
  @include('admin.includes.footer')

  {{-- @include('admin.includes.modals.alert') --}}
</div>

<!-- REQUIRED SCRIPTS -->
@include('admin.partials.script')
@include('admin.includes.noty')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>

        const xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
        const yValues = [55, 49, 44, 24, 15];
        const barColors = ["red", "green","blue","orange","brown"];

        new Chart("myChart", {
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
            text: "World Wine Production 2018"
            }
        }
        });

        // var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
        // var yValues = [55, 49, 44, 24, 15];
        // var barColors = [
        // "#b91d47",
        // "#00aba9",
        // "#2b5797",
        // "#e8c3b9",
        // "#1e7145"
        // ];

        // new Chart("myChart1", {
        // type: "doughnut",
        // data: {
        //     labels: xValues,
        //     datasets: [{
        //     backgroundColor: barColors,
        //     data: yValues
        //     }]
        // },
        // options: {
        //     title: {
        //     display: true,
        //     text: "World Wide Wine Production 2018"
        //     }
        // }
        // });

</script>
</body>
</html>

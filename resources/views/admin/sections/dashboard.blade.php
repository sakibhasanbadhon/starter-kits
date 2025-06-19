@extends('admin.layouts.app')

@section('content')
<div class="row">
    <!-- Card for Total Users -->
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-secondary shadow-sm">
            <div class="card-header text-center font-weight-bold">Total Users</div>
            <div class="card-body">
                <h5 class="card-title text-center display-4">50</h5>
            </div>
        </div>
    </div>

    <!-- Card for Total Tickets -->
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-secondary shadow-sm">
            <div class="card-header text-center font-weight-bold">Total Tickets</div>
            <div class="card-body">
                <h5 class="card-title text-center display-4">10</h5>
            </div>
        </div>
    </div>

    <!-- Card for Total Subscribers -->
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-secondary shadow-sm">
            <div class="card-header text-center font-weight-bold">Total Subscribers</div>
            <div class="card-body">
                <h5 class="card-title text-center display-4">100</h5>
            </div>
        </div>
    </div>
    <!-- Card for Total Subscribers -->
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-secondary shadow-sm">
            <div class="card-header text-center font-weight-bold">Total Post</div>
            <div class="card-body">
                <h5 class="card-title text-center display-4">25</h5>
            </div>
        </div>
    </div>
</div>

<br>
  <div class="row">
    <div class="col-md-12">
        <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
    </div>
    <div class="col-md-12">
        {{-- <canvas id="myChart1" style="width:100%;max-width:600px"></canvas> --}}
    </div>
  </div>
@endsection

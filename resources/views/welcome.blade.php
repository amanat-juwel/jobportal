@extends('layouts.master')

@section('content')

<div class="row">
<div class="col-sm-12">
    <h3>Latest Job Posts</h3> 
  <div class="row">
  	@foreach($job_posts as $key=>$data)
    <div class="col-sm-4">
        <div class="panel panel-default">
         <div class="panel-heading">{{ $data->job_title }}</div>
          <div class="panel-body">
            <p><i class="fa fa-institution"></i> {{ $data->job_title }}</p>
            <p><strong>Description:</strong> {{ $data->job_description }}</p>
            <p><i class="fa fa-money"></i> {{ $data->salary }}</p>
            <p><i class="fa fa-map-marker"></i> {{ $data->location }}, {{ $data->country }}</p>
            <button class="btn btn-default brn-sm pull-right">Apply Now</button>
          </div>
        </div>
    </div>
    @endforeach
  </div>
</div>
</div>

@endsection
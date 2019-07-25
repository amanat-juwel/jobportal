@extends('layouts.master')

@section('content')

<div class="row">
<div class="col-sm-12">
    <h3>Latest Job Posts</h3> 
  <div class="row jobPost">
  	@foreach($job_posts as $key=>$data)
    <div class="col-sm-4">
        <div class="panel panel-default">
         <div class="panel-heading">{{ $data->job_title }}</div>
          <div class="panel-body">
            <p><i class="fa fa-institution"></i> {{ $data->job_title }}</p>
            <p><strong>Description:</strong> {{ $data->job_description }}</p>
            <p><i class="fa fa-money"></i> {{ $data->salary }}</p>
            <p><i class="fa fa-map-marker"></i> {{ $data->location }}, {{ $data->country }}</p>
			@if(Auth::user()!=null)
            <button class="applyBtn btn btn-default brn-sm pull-right" data-id="{{ $data->id }}">Apply Now</button>
			@endif
          </div>
        </div>
    </div>
    @endforeach
  </div>
</div>
</div>

@endsection

@section('script')

<script>
	
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $('.jobPost').delegate('.applyBtn', 'click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        $.ajax({
            type : 'post',
            url : '{{url("/user/apply-for-job")}}',
            data : { 'id': id  },
            success:function(response){
            	if(response.response_code == 102){
            		Swal.fire({
				      //position: 'top-end',
				      type: 'success',
				      title: 'Success',
				      showConfirmButton: false,
				      timer: 3000
				    })
            	}
            	else if(response.response_code == 101){
            		Swal.fire({
				      //position: 'top-end',
				      type: 'info',
				      title: 'You have already applied for this job.',
				      showConfirmButton: false,
				      timer: 3000
				    })
            	}
            	else if(response.response_code == 100){
            		Swal.fire({
				      //position: 'top-end',
				      type: 'error',
				      title: 'Please upload your resume first, You will be redirected to your profile in a moment.',
				      showConfirmButton: false,
				      timer: 4000
				    })
            		var PROFILE_URL = "{{url('/profile')}}";

            		setTimeout(function(){
            			window.location.replace(PROFILE_URL)
					},4000); 

            	}
                console.log(response)
            }
        });
    });

</script>

@endsection
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
        Swal.fire({
	      //position: 'top-end',
	      type: 'success',
	      title: 'Success',
	      showConfirmButton: false,
	      timer: 3000
	    })
        $.ajax({
            type : 'post',
            url : '{{url("/sub-category-edit")}}',
            data : { 'id': id },
            success:function(data){
                $('#sub_cata_id_1').val(data.id);
                $('#cata_id_1').val(data.cata_id);
                $('#sub_cata_name_1').val(data.name);
                $('#sub_cata_details_1').val(data.description);
                $('#save').val('Update');
                $('#update_sub_category').modal('show');
            }
        });
    });

</script>

@endsection
@extends('layouts.master')

@section('content')

<div class="row">
<div class="col-sm-12">
    <h3>Profile</h3> 
  <div class="row">
  	<div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          Current Profile
        </div>
        <div class="panel-body">
          <p><strong>First Name: </strong>{{ $user->first_name }}</p>
          <p><strong>Last Name: </strong>{{ $user->last_name }}</p>
          <p><strong>Profile Picture: </strong> @if(!empty($user->profile_picture))<img src="{{ asset($user->profile_picture) }}" class="img-responsive">@endif</p>
          <p><strong>Resume: </strong> @if(!empty($user->resume)) <a href="{{ url($user->resume) }}" download=""> Download</a>@endif</p>
          @php $skils_array = explode(',' , $user->skills); @endphp

          <p><strong>Skills: </strong>  @foreach($skils_array as $skill)<span class="badge">{{ $skill }}</span>@endforeach</p>
        </div>
      </div> 
    </div>

    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          Update Profile
        </div>
        <div class="panel-body">
          <form action="{{ url('/user/'.$user->id) }}" method="post" enctype="multipart/form-data">
                    
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="form-group">
                <label>First Name *</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" required="">
                @if ($errors->has('first_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group">
                <label>Last Name *</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" required="">
                @if ($errors->has('last_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group">
                <label>Profile Picture</label>
                <input type="file" class="custom-file-input" name="profile_picture" accept="image/*">
                @if ($errors->has('profile_picture'))
                    <span class="help-block">
                        <strong>{{ $errors->first('profile_picture') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group">
                <label>Resume (PDF/DOC)</label>
                <input type="file" class="custom-file-input" name="resume" accept=".doc,.pdf">
                @if ($errors->has('resume'))
                    <span class="help-block">
                        <strong>{{ $errors->first('resume') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group">
                <label>Skills [Add skills using comma seperator. Eg: Laravel,VueJs,Javascript]</label>
                <input type="text" class="form-control" id="skills" name="skills" value="{{ $user->skills }}" required="">
                @if ($errors->has('skills'))
                    <span class="help-block">
                        <strong>{{ $errors->first('skills') }}</strong>
                    </span>
                @endif
              </div>

            <button type="submit" class="btn btn-danger">Update</button>
               
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- PROFILE UPDATE MODAL START -->

<!-- PROFILE UPDATE MODAL END -->

@endsection
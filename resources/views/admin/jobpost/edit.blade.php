@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Create Job Post</strong> </div>

                <div class="panel-body">
                    <form action="{{ url('/jobpost/'.$job_post->id) }}" method="post">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                      <div class="form-group">
                        <label>Job Title</label>
                        <input type="text" class="form-control" id="job_title" name="job_title" value="{{ $job_post->job_title }}" required="">
                        @if ($errors->has('job_title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('job_title') }}</strong>
                            </span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label>Job Description</label>
                        <textarea class="form-control" rows="5" id="job_description" name="job_description" >{{ $job_post->job_description }}</textarea>
                        @if ($errors->has('job_description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('job_description') }}</strong>
                            </span>
                        @endif
                       
                      </div>
                      <div class="form-group">
                        <label>Salary</label>
                        <input type="text" class="form-control" id="salary" name="salary" value="{{ $job_post->salary }}" required="">
                        @if ($errors->has('salary'))
                            <span class="help-block">
                                <strong>{{ $errors->first('salary') }}</strong>
                            </span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label>Location</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ $job_post->location }}" required="">
                        @if ($errors->has('location'))
                            <span class="help-block">
                                <strong>{{ $errors->first('location') }}</strong>
                            </span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label>Country</label>
                        <input type="text" class="form-control" id="country" name="country" value="{{ $job_post->country }}" required="">
                        @if ($errors->has('country'))
                            <span class="help-block">
                                <strong>{{ $errors->first('country') }}</strong>
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
@endsection
@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Welcome : <strong>{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</strong></p>
                    <p>Your joined  : {{ Auth::user()->created_at->diffForHumans() }} </p>
                </div>
            </div>
        </div>
        
        @if(count($applications) > 0)
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Applicants ({{ count($applications) }})</strong> </div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Applicant Info</th>
                                <th>Skills</th>
                                <th>Image</th>
                                <th>Resume</th>
                                <th>Post Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $key=>$data)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    {{ $data->user->first_name.' '.$data->user->last_name }}<br>
                                    {{ $data->user->email }}
                                </td>
                                @php $skils_array = explode(',' , $data->user->skills); @endphp
                                <td>@foreach($skils_array as $skill)<span class="badge">{{ $skill }}</span>@endforeach</td>
                                <td><img src="{{ asset($data->user->profile_picture) }}" height="80px" width="80px"></td>
                                <td><a href="{{ url($data->user->resume) }}" download=""> Download</a></td>
                                <td>{{ $data->jobpost->job_title }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $applications->links() }}
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Job Lists</strong> <a href="{{url('jobpost/create')}}" class="btn btn-primary btn-sm">Create</a></div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Salary</th>
                                <th>Location</th>
                                <th>Country</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($job_posts as $key=>$data)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $data->job_title }}</td>
                                <td>{{ $data->job_description }}</td>
                                <td>{{ $data->salary }}</td>
                                <td>{{ $data->location }}</td>
                                <td>{{ $data->country }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>
                                    <a class="btn btn-info btn-xs" href="{{ url('/jobpost/'.$data->id.'/edit') }}">Edit</a>

                                    <form action="{{ url('/jobpost/'.$data->id) }}" method="post" style="display:inline-block">
                                        {{ method_field('DELETE') }} {{ csrf_field() }}
                                        <button class="delete btn btn-danger btn-xs"  onclick="return confirm('Are you sure you want to delete this jobpost?');"  >
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
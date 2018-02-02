@extends('backLayout.app')
@section('title')
Page
@stop

@section('content')

    <h1>Pages <a href="{{ url('pages/create') }}" class="btn btn-primary pull-right btn-sm">Add New Page</a></h1>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tblpages">
            <thead>
                <tr>
                    <th>ID</th><th>Name</th><th>Title</th><th>Body</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($pages as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ url('pages', $item->id) }}">{{ $item->name }}</a></td><td>{{ $item->title }}</td><td>{{ $item->body }}</td>
                    <td>
                        <a href="{{ url('pages/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">Update</a> 
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['pages', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#tblpages').DataTable({
            columnDefs: [{
                targets: [0],
                visible: false,
                searchable: false
                },
            ],
            order: [[0, "asc"]],
        });
    });
</script>
@endsection
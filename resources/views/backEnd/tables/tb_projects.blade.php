@extends('backLayout.app')
@section('title')
Datasync
@stop

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Datasync</h2>
        <div class="clearfix"></div>  
      </div>
      <div class="x_content">

        <table class="table table-striped jambo_table bulk_action" id="tblUsers">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Table Name</th>
                    <th class="text-center">Table Source</th>
                    <th class="text-center">Total Records</th>
                    <th class="text-center">Last Synced</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
              @foreach($airtables as $key => $airtable)
                <tr>
                  <td class="text-center">{{$key+1}}</td>
                  <td class="text-center">{{$airtable->name}}</td>
                  <td class="text-center">PBNYC PT Airtable</td>
                  <td class="text-center">{{$airtable->records}}</td>
                  <td class="text-center">{{$airtable->syncdate}}</td> 
                  <td class="text-center">
                    <button class="badge sync_now" style="background: #00a65a;">Sync Now</button>
                    <button class="badge" style="background: #f39c12;"><a href="tb_{!! strtolower($airtable->name) !!}" style="color: white;">View Table</a></button>
                  </td>
                </tr>
              @endforeach             
            </tbody>
        </table>
        {!! $projects->links() !!}
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')

@endsection

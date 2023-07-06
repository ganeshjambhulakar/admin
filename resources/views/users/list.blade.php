@extends('layout')
@section('content')
<div class="card-body">
    <table class="table table-bordered table-responsive">
        <?php $url = config('base_url');?>
        @if ($message = Session::get('msg'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        @if(session()->get("ROLE") == 'ADMIN')
        <button class="btn btn-info my-4">
            <a href='{{ url("$url/users/register") }}' class="text-white">Add New User</a>
        </button>
       @endif
        <div class="row d-flex">
            <tr class="text-center"><td colspan="5"> <h2>Users</h2></td></tr>
            <tr>
                <td style="width: 2%"> Sr.No. </td>
                <td style="width: 30%"> Name </td>
                <td style="width: 10%"> Email </td>
                <td style="width: 10%"> Created At </td>
                @if(session()->get("ROLE") == 'ADMIN')
                <td style="width: 15%"> Action</td>
                @endif
            </tr>
            <?php $i = 1; ?>
            @foreach($data as $arr)
            <tr>
            <td style="width: 2%"> {{$i++}} </td>
                <td style="width: 30%"> {{$arr->name}} </td>
                <td style="width: 10%">{{$arr->email}} </td>
                <td style="width: 10%;text-transform:capitalize;">{{$arr->created_at}} </td>
                @if(session()->get("ROLE") == 'ADMIN')
                <td style="width: 15%">
                    <div>
                    <button class="btn btn-info " data-toggle="tooltip"  title="Edit"> <a  href="{{config('base_url')}}/users/{{$arr->id}}/edit"><i class="far fa-edit text-white"></i></a> </button>
                    <button class="btn btn-danger " data-toggle="tooltip"  title="Delete"> <a  href="{{config('base_url')}}/users/delete/{{$arr->id}}"><i class="far fa-trash-alt text-white"></i></a> </button>
                    </div>
                </td>
                @endif
            </tr>
            @endforeach
    </table>
    {{ $data->links() }}

</div>
<style>
    i {
        color: black;
        margin: 0 5px;
    }
</style>
@endsection
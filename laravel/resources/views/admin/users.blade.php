@extends('templates.admin')
@section('content')
    <h1>Users</h1>
    <table class="table-striped" id="users-table" width="100%">
        <thead>
        <tr>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>ROLE</th>
            <th>CREATED AT</th>
            <th>DELETED</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
@endsection
@section('footer')
    @parent
    <script>
    $(
        function () {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('admin.getUsers')}}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'deleted_at', name: 'deleted_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            $('#users-table').on('click','.btn-danger',function(ele) {
                ele.preventDefault();
                var urlUsers = $(this).attr('href');
                //alert(urlUsers);
                var tr = this.parentNode.parentNode;
                //alert(tr);
                $.ajax(
                    urlUsers,
                    {
                        data:{
                            //'_token':'{{csrf_token()}}'
                            '_token' :  Laravel.csrfToken
                        },
                        method: 'DELETE',
                        complete: function (resp) {
                            //alert(resp.responseText);
                            console.error(resp+'---resp');
                            if (resp.responseText == 1) {
                                tr.parentNode.removeChild(tr);
                                //tr.remove();
                                //alert(resp.responseText);
                                //$(li).remove();
                            } else {
                                alert('Problem contacting server');
                            }
                        }
                    }
                )
            });
        }
    )
    </script>
@endsection

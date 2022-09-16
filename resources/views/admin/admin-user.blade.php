@extends('admin.layout.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Users</h5>
            <div>
                <button class="btn btn-primary btnAdd">Add User</button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Index</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $k => $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->isAdmin===1? 'Admin' : 'User' }}</td>
                                <td>
                                    <button class="btn btn-warning btnEdit">Edit</button>
                                    <a href="/admin/user/delete/{{ $user->id }}"><button class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Add user model --}}
    <div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/admin/user/add">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" name="name" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Email:</label>
                            <input type="text" name="email" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Password:</label>
                            <input type="password" name="password" class="form-control" id="recipient-name">
                        </div>
                        <div style="margin-top: 30px;">
                            <select class="form-select" name="user_type[]" aria-label="Default select example">
                                <option selected>Select user type</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    {{-- Edit user model --}}
    <div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/admin/user/update" id="editForm">
                        @csrf
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" name="name" id="editName" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Email:</label>
                            <input type="text" name="email" id="editEmail" class="form-control" id="recipient-name">
                        </div>
                        <div style="margin-top: 30px;">
                            <select class="form-select" name="user_type[]" id="editIsAdmin" aria-label="Default select example">
                                <option selected>Select user type</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.btnAdd').on('click', function() {
                $('#addModel').modal('show')
            })

            $('.close').on('click', function() {
                $('#addModel').modal('hide')
            })

            $('.btnEdit').on('click', function(e) {
                let elements = e.target.parentElement.parentElement.children;

                // console.log(elements[0].textContent, elements[1].textContent);

                $('#editId').val(elements[0].textContent);
                $('#editName').val(elements[1].textContent);
                $('#editEmail').val(elements[2].textContent);
                $('#editIsAdmin').val(elements[3].textContent);

                $('#editModel').modal('show')
            })

            $('.close').on('click', function() {
                $('#editModel').modal('hide')
            })
        });
    </script>
@endsection

@extends('admin.layout.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Tags</h5>
            <div>
                <button class="btn btn-primary btnAdd">Add Tag</button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Index</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($tags as $k => $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->name }}</td>
                                <td>
                                    <button class="btn btn-warning btnEdit">Edit</button>
                                    <a href="/admin/tag/delete"><button class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Add tag model --}}
    <div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/admin/tag/add">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" name="name" class="form-control" id="recipient-name">
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

    {{-- Edit tag model --}}
    <div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/admin/tag/update" id="editForm">
                        @csrf
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" name="name" id="editName" class="form-control" id="recipient-name">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
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

                $('#editModel').modal('show')
            })

            $('.close').on('click', function() {
                $('#editModel').modal('hide')
            })
        });
    </script>
@endsection

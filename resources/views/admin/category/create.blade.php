@extends('admin.layout.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('category.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="card">
            <form action="" method="post" id="categoryForm" name="categoryForm">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email">Slug</label>
                                <input type="text" name="slug" id="slug" readonly class="form-control" placeholder="Slug">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="email">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="pb-5 pt-3">
            <button class="btn btn-primary" type="submit">Create</button>
            <a href="{{route('category.index')}}" class=" btn btn-outline-dark ml-3">Cancel</a>
        </div>
        </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection

@section('customJs')
<script>
    $("#categoryForm").submit(function(event) {
        event.preventDefault();

        var element = $(this);

        $.ajax({
            url: '{{route("category.store")}}',
            type: 'post',
            data: element.serializeArray(),
            datatype: 'json',
            success: function(response) {
                if (response["status" == true]) {
                    $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                } else {
                    var errors = response['errors'];
                    if (errors['name']) {
                        $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
                    } else {
                        $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                    if (errors['slug']) {
                        $("#slug").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug']);
                    } else {
                        $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

                    }
                }

            },
            error: function(kqXHR, exception) {
                error('Something went wrong');
            }
        });

    });
    $("#name").change(function() {
        element = $(this);
        $.ajax({
            url: '{{route("admin.category.getslug")}}',
            type: 'get',
            data: {
                title: element.val()
            },
            datatype: 'json',
            success: function(response) {
                if (response["status"] == true) {
                    $("#slug").val(response["slug"]);
                }
            }
        });
    });
</script>
@endsection
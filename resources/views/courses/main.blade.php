@extends('layouts.themes.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Courses</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Student</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
    @include('layouts.partials.alerts')
            <div class="card">
                <div class="card-header">
                    <div class="div">
                        <div class="row">

                            <div class="col">
                                <h3 class="card-title">Course List</h3>
                            </div>

                            <div class="col text-right">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#addCourse">Add Course</button>

                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#addUserModal">Add User</button>

                            </div>
                        </div>
                    </div>



                </div>

                <div class="card-body">
                    <table class="table table-bordered table-hover" id="table1">
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course_list as $course)
                                <tr>
                                    <td>{{ $course->crsName }}</td>
                                    <td>{{ $course->status_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </section>

    <div class="modal fade" id="addCourse" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('course.add') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="usr_fname" class="form-label">Course Name</label>
                            <input type="text" class="form-control" name="course_name" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('students.add') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="usr_fname" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="usr_name" name="usr_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="usr_lname" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="usr_phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="usr_phone" name="usr_phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="profile" class="form-label">Profile</label>
                            <input type="file" class="form-control" name="profile" accept=".png,.jpeg,.img,.jpg"
                                required>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

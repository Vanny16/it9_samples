@extends('layouts.themes.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Students</h1>
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
                                <h3 class="card-title">Users List</h3>
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

<div class="row">
    <div class="col-md-6">
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Line Chart – Students Created per Month</h3>
            </div>
            <div class="card-body">
                <canvas id="studentsLineChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Bar Chart – Students Created per Month</h3>
            </div>
            <div class="card-body">
                <canvas id="studentsBarChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Pie Chart – Share per Month</h3>
            </div>
            <div class="card-body">
                <canvas id="studentsPieChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>



                <div class="card-body">
                    <table class="table table-bordered table-hover" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Role</th>

                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usr_list as $usr)
                                <tr>
                                    <td>{{ $usr->usr_id }}</td>
                                    <td>{{ $usr->usr_lname }}, {{ $usr->usr_fname }} {{ $usr->usr_mname }}</td>
                                    <td>{{ $usr->usr_phone }}</td>
                                    <td>{{ $usr->role }}</td>

                                    <td class="text-center">
                                        <button class="btn btn-transparent btn-danger" data-toggle="modal"
                                            data-target="#deact_user{{ $usr->usr_id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="deact_user{{ $usr->usr_id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="addUserModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title">Deactivate User</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('students.deactivate',[$usr->usr_id]) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    Are you sure you want to Deactivate  <strong> {{ $usr->usr_lname }}, {{ $usr->usr_fname }} {{ $usr->usr_mname }}</strong>

                                                        {{-- <input type="hidden" class="form-control" name="usr_id" value="{{  $usr->usr_id  }}"
                                                            required> --}}

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Confirm Delete</button>

                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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

    <script>
    const monthLabels = @json($studentsByDate->pluck('month_label'));
    const monthValues = @json($studentsByDate->pluck('total'));

    // LINE CHART
    new Chart(document.getElementById('studentsLineChart'), {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Students Created',
                data: monthValues,
                borderColor: 'blue',
                backgroundColor: 'lightblue',
                fill: true,
                tension: 0.3,
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // BAR CHART
    new Chart(document.getElementById('studentsBarChart'), {
        type: 'bar',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Students Created',
                data: monthValues,
                backgroundColor: 'rgba(0, 123, 255, 0.5)',
                borderColor: 'blue',
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // PIE CHART
    new Chart(document.getElementById('studentsPieChart'), {
        type: 'pie',
        data: {
            labels: monthLabels,
            datasets: [{
                data: monthValues,
                backgroundColor: [
                    '#007bff', '#28a745', '#ffc107', '#dc3545',
                    '#6f42c1', '#17a2b8', '#fd7e14', '#20c997',
                    '#6610f2', '#6c757d', '#adb5bd', '#0d6efd'
                ],
            }]
        },
        options: {
            responsive: true,
        }
    });
</script>



@endsection

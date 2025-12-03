@extends('layouts.themes.main')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Widgets</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Widgets</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="card mx-auto p-4 py-5 shadow">
        <div class="mb-4 text-center">
            <a href="https://student.umindanao.edu.ph">
                <img alt="UM STUDENT PORTAL MAIN" src="https://student.umindanao.edu.ph/assets/images/brand/logo/logo.svg"
                    style="height: 80px;">
            </a>
        </div>
        <div class="h3 mb-4 text-center">
            <a href="#ChangeCampus">
                Main Campus
            </a>
        </div>


        <form action="https://student.umindanao.edu.ph/login" autocomplete="off" method="post">

            <div class="overflow-hidden rounded border shadow-sm">
                <div class="d-block">
                    <div class="input-group">
                        <input class="form-control rounded-0 border-0 px-3 py-4" name="login"
                            placeholder="Student ID Number or Email" required="" type="text" value="">
                    </div>
                </div>
                <div class="d-block border-top">
                    <input class="form-control rounded-0 border-0 px-3 py-4" name="password" placeholder="Password"
                        required="" type="password">
                </div>
            </div>
            <div class="mb-4 mt-2">

                <button class="btn btn-primary btn-block py-1" type="submit">
                    <span class="d-block font-weight-bold py-2">
                        Login<i class="fa fa-arrow-right ml-2"></i>
                    </span>
                </button>
            </div>

            <input type="hidden" name="_token" value="Gm4SAgms7g6aoNertVmtHoZa4QqfrzWPdGjtUzXb" autocomplete="off">
        </form>

        <div class="d-flex align-items-center">
            <span class="flex-fill border-top"></span>
            <span class="px-3"><small class="text-muted d-block">OR</small></span>
            <span class="flex-fill border-top"></span>
        </div>

        <div class="mt-4">
            <a class="btn btn-block border bg-white p-0" href="https://student.umindanao.edu.ph/guest/sign-in/google">
                <span class="d-flex">
                    <span class="border-right px-3 py-2">
                        <span class="d-block py-1">
                            <img src="https://student.umindanao.edu.ph/svg/google.svg" style="width: 19px;">
                        </span>
                    </span>
                    <span class="flex-fill py-2 text-center">
                        <span class="d-block font-weight-bold py-1">
                            Sign-in with Google
                        </span>
                    </span>
                </span>
            </a>
        </div>

        <div class="mt-2">
            <a class="btn btn-block border bg-white p-0" href="https://student.umindanao.edu.ph/guest/sign-in/fb">
                <span class="d-flex">
                    <span class="border-right px-3 py-2">
                        <span class="d-block py-1">
                            <img src="https://student.umindanao.edu.ph/svg/facebook.svg" style="width: 19px;">
                        </span>
                    </span>
                    <span class="flex-fill py-2 text-center">
                        <span class="d-block font-weight-bold py-1">
                            Sign-in with Facebook
                        </span>
                    </span>
                </span>
            </a>
        </div>

        <div class="mt-4 text-center">
            <small>
                If you have received an access code sent via SMS or given to you by the admission officer,
                please <a class="font-weight-bold bg-primary rounded-lg p-2 text-white" data-target="#access-code-modal"
                    data-toggle="modal" href="#">
                    <i class="fas fa-external-link-alt"></i>
                    click here to create
                    your password</a>.
            </small>
        </div>


        <a class="btn btn-link" href="https://student.umindanao.edu.ph/password/reset">
            <small> Forgot Your Password?</small>
        </a>
    </div>
    <!-- /.content -->

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
@endsection

@extends('layouts.admin')
@section('content')
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header" id="top">
                            <h2 class="pageheader-title">All Users</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="section-block" id="basicform">
                            <h3 class="section-title">All Users</h3>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <table id="users" class="display" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>S #</th>
                                        <th>Name</th>
                                        <th>Phone #</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 0;
                                    if(!empty($users)) {?>
                                    @foreach($users as $user)
                                        <?php $i++ ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->get_meta('phone', 'N/A') }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role_name }}</td>
                                            <td>
                                                <ul class="actions">
                                                    <li><a href="{{ route('user.edit', ['id' => $user->id]) }}"><span><i class="fa fa-edit"></i></span></a></li>
                                                    <li><a href="{{ route('user.editPassword', ['id' => $user->id]) }}"><span title="Change Password"><i class="fa fa-key"></i></span></a></li>

                                                    <li>
                                                        <form id="delete-category" method="post" action="{{ route('user.delete', ['id' => $user->id]) }}">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit"><span><i class="fa fa-trash"></i></span></button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

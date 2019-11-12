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
                            <h2 class="pageheader-title">Products</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">All Purchases</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="section-block" id="basicform">
                            <h3 class="section-title">Supplies</h3>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <table id="products" class="display" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>S#</th>
                                        <th>Supplies Id</th>
                                        <th>Supplier Name</th>
                                        <th>Approved</th>
{{--                                        <th>Quantity</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($supplies as $key => $value)
                                        <tr>
                                            <td>{{ $key +1 }}</td>
                                            <td>{{ $value->id}}</td>
                                            <td>{{ $value->supplier_name}}</td>
                                            <td>
                                                @if($value->verfied == 0)
                                                <ul class="actions">
                                                    <li>
                                                        <a href="{{ route('supplies.verified', ['id' => $value->id]) }}"><span><i
                                                                        class="fa fa-check"></i></span></a>
                                                    </li>

                                                </ul>
                                                @else
                                                Verified
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

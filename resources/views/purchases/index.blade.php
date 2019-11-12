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
                            <h3 class="section-title">Products</h3>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <table id="products" class="display" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>S#</th>
                                        <th>Supplier Name</th>
                                        <th>Approved</th>
{{--                                        <th>Quantity</th>--}}
                                        <th>Date</th>
{{--                                        <th>Image</th>--}}
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($supplies as $key => $value)
                                        <tr>
                                            <td>{{ $key +1 }}</td>
                                            <td>{{ $value->supplier_name}}</td>
                                            @if($value->verified == 0)
                                            <td>False</td>
                                            @else
                                                <td>True</td>
                                            @endif
                                                {{--                                            <td>{{ $product->qty }}</td>--}}
                                            <td>{{ $value->created_at }}</td>
{{--                                            <td>--}}
{{--                                                <img src="{{ asset('storage/'. $product->image) }}"--}}
{{--                                                     class="img-responsive" width="100" height="100"/>--}}
{{--                                            </td>--}}
                                            <td>
                                                <ul class="actions">
                                                    <li>
                                                        <a href="{{ route('supplies.view', ['id' => $value->id]) }}"><span><i
                                                                        class="fa fa-eye"></i></span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('supplies.delete', ['id' => $value->id]) }}"><span><i
                                                                    class="fa fa-trash"></i></span></a>
                                                    </li>


                                                </ul>
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

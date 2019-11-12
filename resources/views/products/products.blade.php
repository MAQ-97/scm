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
                                        <li class="breadcrumb-item active" aria-current="page">All Products</li>
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
                                        <th>Category Id</th>
                                        <th>Manufacturer Id</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Manufacturer_date</th>
                                        <th>Expire_date</th>
                                        <th>Batch_no</th>
{{--
    <th>Image</th>--}}
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 0; ?>
                                    @foreach($products as $product)
                                        <?php $i++ ?>
                                        <tr>
                                            <td>{{ $i }}</td>

                                            <td>{{ $product->category_id }}</td>
                                            <td>{{ $product->manufacturer_id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->quantity }}</td>

{{--                                            <td>{{ $product->qty }}</td>--}}
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->manu_date }}</td>
                                            <td>{{ $product->exp_date }}</td>
                                            <td>{{ $product->batch_no }}</td>

{{--                                            <td>--}}
{{--                                                <img src="{{ asset('storage/'. $product->image) }}"--}}
{{--                                                     class="img-responsive" width="100" height="100"/>--}}
{{--                                            </td>--}}
                                            <td>
                                                <ul class="actions">
                                                    <li>
                                                        <a href="{{ route('product.edit', ['id' => $product->id]) }}"><span><i
                                                                        class="fa fa-edit"></i></span></a></li>
                                                    <li>
                                                        <form id="delete-category" method="post" action="{{ route('product.delete', ['id' => $product->id]) }}">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit"><span><i class="fa fa-trash"></i></span></button>
                                                        </form>
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

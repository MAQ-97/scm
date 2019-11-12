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
                            <h2 class="pageheader-title">Add Product</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{ route('products.list') }}" class="breadcrumb-link">Products</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="section-block" id="basicform">
                            <h3 class="section-title">Add Product</h3>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul style="margin: 0">
                                            @foreach($errors->all() as $err)
                                                <li>{{ $err }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('product.create') }}" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Name</label>
                                                <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Select Category</label>
                                                <br/>
                                                <select class="form-control" id="category" name="category_id" required>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Select Maunfacturer</label>
                                                <br/>
                                                <select class="form-control" name="manufacturer_id" id="sub_category" required>
                                                    @foreach($manufacturers as $manufacturer)
                                                        <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Quantity</label>
                                                <input type="text" class="form-control" name="quantity" id="" value="{{old('qunatity')}}" required>
                                            </div>
                                        </div>
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Price</label>
                                                <input type="text" class="form-control" name="price" value="{{old('price')}}" required></input>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Manufacuter Date</label>
                                                <input type="date" class="form-control" name="manu_date" value="{{old('manu_date')}}" required></input>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Expire Date</label>
                                                <input type="date" class="form-control" name="exp_date" value="{{old('expire_date')}}" required></input>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Batch No</label>
                                                <input type="text" class="form-control" name="b atch_no" value="{{old('batch_no')}}" required></input>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="_method" value="POST">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Create Product">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

    @endsection

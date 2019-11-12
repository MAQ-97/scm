@extends('layouts.admin')
@section('content')
    <style>
        .card h3{
            margin-left: 13%;
        }
    </style>
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header" id="top">
                            <h2 class="pageheader-title">Purchase Report</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item" aria-current="page">Purchase</li>
                                        <li class="breadcrumb-item active" aria-current="page">Purchase Report
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="report">
                        <div class="section-block" id="basicform">
                            <h3 class="section-title center-block" style="text-align: center;">ERP</h3>
                            <h3 class="section-title center-block" style="text-align: center;">Purchase Report</h3>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <button class="printBtn">Print Report</button>
                                <table id="report" class="display" style="width:100%;border:1px solid black">
                                    <h3 style="text-align: center;">File No:{{$purchase->batch_name}}</h3>
                                    <h3 style="text-align: center;">Date:{{$purchase->date}}</h3>
                                    <thead style="border-bottom: 1px solid black;">
                                    <tr>
                                        <th style="font-size: 14px ;font-weight: bold; border-right: 1px solid black; ">S.no</th>
                                        <th style="font-size: 14px ;font-weight: bold;  border-right: 1px solid black;">Color Code</th>
                                        <th style="font-size: 14px ;font-weight: bold;  border-right: 1px solid black;">Product Name</th>
                                        <th style="font-size: 14px ;font-weight: bold;  border-right: 1px solid black;">Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($purchase->ProductColorPurchases as $key => $value)
                                        {{--                                        {{dd($report)}}--}}
                                        <tr>
                                            <td style="border-right: 1px solid black;">{{$key +1}}</td>
                                            <td style="border-right: 1px solid black;">{{$value->color_code}}</td>
                                            <td style="border-right: 1px solid black;">{{$value->product_name}}</td>
                                            <td style="border-right: 1px solid black;">{{$value->quantity}}</td>
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
@section('script')
    <script>
        function printData() {
            var divToPrint = document.getElementById("report");
            $(divToPrint).find('.dataTables_length').remove();
            $(divToPrint).find('.printBtn').remove();
            $(divToPrint).find('#products_filter').remove();
            $(divToPrint).find('#products_info').remove();
            $(divToPrint).find('#products_paginate').remove();
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.opener.location.reload();
            newWin.close();
        }

        $('.printBtn').click(function (e) {
            // e.preventDefault();
            printData();
        });

    </script>
@endsection

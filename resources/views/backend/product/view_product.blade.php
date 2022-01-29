@extends('admin.admin_master')
@section('admin')


<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Categories</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Tables</li>
                            <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Products List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name En</th>
                                        <th>Product Name Ur</th>
                                        <th>Quantity</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td><img src="{{ asset($product->product_thumbnail) }}" style="width: 60px; height: 50px;"></td>
                                        <td>{{$product->product_name_en}}</td>
                                        <td>{{$product->product_name_urdu}}</td>
                                        <td>{{$product->product_qty}}</td>
                                        <td width="30%">
                                            <a href="" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="" class="btn btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                        <!-- route('edit_product',$product->id)
                                        route('delete_product',$product->id) -->
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

@endsection
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
            <!-- ----------ADD Category------------ -->
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{route('update_category')}}" enctype="multipart/form-data" novalidate>
                                @csrf
                                <input name="id" type="hidden" value="{{ $category->id }}">
                                <div class="col-6">
                                    <div class="form-group">
                                        <h5>Category Name English<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="category_name_en" value="{{$category->category_name_en}}" class="form-control">
                                            @error('category_name_en')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <h5>Category Name Urdu<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="category_name_urdu" value="{{$category->category_name_urdu}}" class="form-control">
                                            @error('category_name_urdu')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <h5>Category Icon<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="category_icon" value="{{$category->category_icon}}" class="form-control">
                                            @error('category_icon')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info m-5" value="Update Category">
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

@endsection
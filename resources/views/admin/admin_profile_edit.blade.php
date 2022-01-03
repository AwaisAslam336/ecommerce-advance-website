@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">

    <section class="content">
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Admin Profile</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="POST" action="{{route('admin_profile_update')}}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <h5>User Name<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" value="{{$adminData->name}}" class="form-control" required data-validation-required-message="This field is required">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <h5>User Email<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="email" name="email" value="{{$adminData->email}}" class="form-control" required data-validation-required-message="This field is required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <h5>Profile Picture <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="photo" id="image" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <img id="show_image" src="{{(!empty($adminData->photo)) ?
                                         url('upload/admin_images/'.$adminData->photo) : url('upload/no_image.jpg') }}" width="100px" ; height="100px" ;>
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Update">
                            </div>

                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#show_image').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
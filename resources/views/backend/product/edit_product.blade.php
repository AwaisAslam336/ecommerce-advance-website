@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Product</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="POST" action="{{ route('update_product') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <!--1st Row -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Select Brand <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="brand_id" class="form-control">
                                                        <option value="" selected disabled>Select Brand</option>
                                                        @foreach($brands as $brand)
                                                        <option value="{{$brand->id}}" {{$brand->id == $product->brand_id ? 'selected':''}}>
                                                            {{$brand->brand_name_en}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('brand_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Select Category <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" class="form-control">
                                                        <option value="" selected disabled>Select Category</option>
                                                        @foreach($categories as $category)
                                                        <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected':''}}>
                                                            {{$category->category_name_en}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Select SubCategory <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subcategory_id" class="form-control">
                                                        <option value="" selected disabled>Select SubCategory</option>
                                                        @foreach($subcategories as $subcategory)
                                                        <option value="{{$subcategory->id}}" {{$subcategory->id == $product->subcategory_id ? 'selected':''}}>
                                                            {{$subcategory->subcategory_name_en}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('subcategory_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!--2nd Row -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Select Sub-SubCategory <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subsubcategory_id" class="form-control">
                                                        <option value="" selected disabled>Select Sub-SubCategory</option>
                                                        @foreach($subsubcategories as $subsubcategory)
                                                        <option value="{{$subsubcategory->id}}" {{$subsubcategory->id == $product->subsubcategory_id ? 'selected':''}}>
                                                            {{$subsubcategory->subsubcategory_name_en}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('subsubcategory_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Name English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_en" class="form-control" value="{{$product->product_name_en}}">
                                                    @error('product_name_en')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Name Urdu <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_urdu" class="form-control" value="{{$product->product_name_urdu}}">
                                                    @error('product_name_urdu')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!--3rd Row -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Code<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_code" class="form-control" value="{{$product->product_code}}">
                                                    @error('product_code')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Quantity<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_qty" class="form-control" value="{{$product->product_qty}}">
                                                    @error('product_qty')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Tags English<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_en" value="{{$product->product_tags_en}}" data-role="tagsinput" class="form-control">
                                                    @error('product_tags_en')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!--4th Row -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Tags Urdu<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_urdu" value="{{$product->product_tags_urdu}}" data-role="tagsinput" class="form-control">
                                                    @error('product_tags_urdu')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Size English<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_en" value="{{$product->product_size_en}}" data-role="tagsinput" class="form-control">
                                                    @error('product_size_en')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Size Urdu<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_urdu" value="{{$product->product_size_urdu}}" data-role="tagsinput" class="form-control">
                                                    @error('product_size_urdu')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!--5th Row -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Color English<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_en" class="form-control" value="{{$product->product_color_en}}" data-role="tagsinput">
                                                    @error('product_color_en')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Color Urdu<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_urdu" class="form-control" value="{{$product->product_color_urdu}}" data-role="tagsinput">
                                                    @error('product_color_urdu')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <!--6th Row -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Selling Price<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="selling_price" value="{{$product->selling_price}}" class="form-control">
                                                    @error('selling_price')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Discount Price<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="discount_price" value="{{$product->discount_price}}" class="form-control">
                                                    @error('discount_price')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <!--7th Row -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Short Description English<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_descp_en" class="form-control">
                                                        {!! $product->short_descp_en !!}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Short Description Urdu<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_descp_urdu" class="form-control" placeholder="پروڈکٹ کے بارے میں مختصر تفصیل درج کریں...">
                                                        {!! $product->short_descp_urdu !!}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <!--8th Row -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Long Description English<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor1" name="long_descp_en" rows="10" cols="80">
                                                    {!! $product->long_descp_en !!}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Long Description Urdu<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor2" name="long_descp_urdu" rows="10" cols="80">
                                                    {!! $product->long_descp_en !!}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_2" name="hot_deals" value="1"
                                                                 {{$product->hot_deals==1 ? 'checked':''}}>
                                                        <label for="checkbox_2">Hot Deals</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_3" name="featured" value="1"
                                                                {{$product->featured==1 ? 'checked':''}}>
                                                        <label for="checkbox_3">Featured</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_4" name="special_offer" value="1"
                                                                {{$product->special_offer==1 ? 'checked':''}}>
                                                        <label for="checkbox_4">Special Offer</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_5" name="special_deals" value="1"
                                                                {{$product->special_deals==1 ? 'checked':''}}>
                                                        <label for="checkbox_5">Special Deals</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Add Product">
                            </div>
                        </form>
                    </div>
                </div>
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
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/subsubcategory/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append(
                                '<option value="' + value.id + '">' + value.subcategory_name_en + '</option>'
                            );
                        });

                        // loading sub-subcategories for the first time
                        var subcategory_id = $('select[name="subcategory_id"]').val();
                        if (subcategory_id) {
                            $.ajax({
                                url: "{{ url('/subsubcategory/sub-subcategory/ajax') }}/" + subcategory_id,
                                type: "GET",
                                dataType: "json",
                                success: function(data) {
                                    var d = $('select[name="subsubcategory_id"]').empty();
                                    $.each(data, function(key, value) {
                                        $('select[name="subsubcategory_id"]').append(
                                            '<option value="' + value.id + '">' + value.subsubcategory_name_en + '</option>'
                                        );
                                    });
                                }
                            })
                        } else {
                            alert('danger');
                        }

                    }
                })
            } else {
                alert('danger');
            }
        });
    });
    $(document).ready(function() {
        $('select[name="subcategory_id"]').on('change', function() {
            var subcategory_id = $('select[name="subcategory_id"]').val();
            if (subcategory_id) {
                $.ajax({
                    url: "{{ url('/subsubcategory/sub-subcategory/ajax') }}/" + subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subsubcategory_id"]').append(
                                '<option value="' + value.id + '">' + value.subsubcategory_name_en + '</option>'
                            );
                        });
                    }
                })
            } else {
                alert('danger');
            }
        });
    });
</script>

<script type="text/javascript">
    function mainThumbUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThumb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


<script>
    $(document).ready(function() {
        $('#multiImg').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(80)
                                    .height(80); //create image element 
                                $('#preview_img').append(img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>

@endsection
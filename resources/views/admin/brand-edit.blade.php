@extends('layouts.admin')
@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="fs-4 fw-bolder text-black">Brand Information</h5>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.brand.add') }}">Brands</a></li>
            <li class="breadcrumb-item active text-black-50" aria-current="page">Edit Brands</li>
        </ol>
    </nav>
</div>

<form method="POST" enctype="multipart/form-data" action="{{ route('admin.brand.update') }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $brand->id }}">
    <div class="wg-box">
        <div class="row">
            <div class="col-md-3  mt-3">
                <label for="brandName" class="form-label fw-bolder">Brand Name <span
                        class="text-danger">*</span></label>
            </div>
          
            <div class="col-md-9 mt-3">
                <input type="text" class="input-field w-100" placeholder="Brand name" name="name"
                    id="brandName" value={{ $brand->name }}>
                    @error('name')<span class="alert alert-danger text-center">{{ $message }}</span>  
                    @enderror
            </div>
            <div class="col-md-3 mt-3">
                <label for="brandSlug" class="form-label fw-bolder"> Brand Slug <span
                        class="text-danger">*</span></label>
            </div>
            <div class="col-md-9 mt-3">
                <input type="text" class="input-field w-100" placeholder="Brand Slug" name="slug"
                    id="brandSlug" value={{ $brand->slug }}>
                    @error('slug')<span class="alert alert-danger text-center">{{ $message }}</span>  
                    @enderror
            </div>
            <div class="col-md-3 mt-3">
                <label for="myFile" class="form-label fw-bolder">Upload Image <span
                        class="text-danger">*</span></label>
            </div>
            <div class="col-md-9 mt-3">
                <div class="d-flex align-items-center flex-wrap gap-4">                
                    <div class="image-input drage-area">
                        <div class=" icon text-primary mb-2 ">
                            <i class="fa-solid fa-cloud-arrow-up icon-upload fa-3x"></i>
                        </div>
                        <input type="file" name='image' id="myFile" hidden>
                        <span class="text-image text-black-50">Drop your image here or</span>
                        <span class="text-image text-black-50">select <span
                                class="button text-primary">click to browse</span></span>
                    </div>
                    @if($brand->image)
                    <div class="item" id="imgpreview">
                        <img src="{{ asset("uploads/brands") }}/{{ $brand->image }}" alt="" class="effect8">
                    </div>
                    @endif
                </div>
                @error('image')<span class="alert alert-danger text-center">{{ $message }}</span>  
                @enderror
            </div>
            <div class="col-md-3 mt-3">
                <div></div>
            </div>
            <div class="col-md-9 mt-3">
                <input class="btn btn-primary f-14 fw-bolder px-5" type="submit" value="Save">
            </div>

        </div>
    </div>
</form>

@endsection
@push('script')
<script>
    $(function(){
        $("#myFile").on('change',function(e){
            const photoInp=$('#myFile');
            const[file]=this.files;
            if(file){
                $("#imgpreview img").attr('src',URL.createObjectURL(file));
                $('#imgpreview').show();
            }
        });
        $("input[name='name']").on("change",function()
        {
            $("input[name='slug']").val(StringToSlug($(this).val()));
        });
    });
    function StringToSlug(Text){
        return Text.toLowerCase()
        .replace(/[^\w]+/g,"")
        .replace(/ + /g,"-");
    }
</script>    
@endpush
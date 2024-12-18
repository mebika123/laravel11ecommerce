@extends('layouts.admin')
@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="fs-4 fw-bolder text-black">Slide</h5>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.slides') }}">Slides</a></li>
            <li class="breadcrumb-item active text-black-50" aria-current="page">New Slide</li>
        </ol>
    </nav>
</div>

<form action="{{ route('admin.slide.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="wg-box">
    <div class="row">
        <div class="col-md-3  mt-3">
            <label for="tagline" class="form-label fw-bolder"> Tagline <span
                    class="text-danger">*</span></label>
        </div>
        <div class="col-md-9 mt-3">
            <input type="text" class="input-field w-100" placeholder="Tagline" name="tagline"
                id="tagline" value="{{ old('tagline') }}">
                @error('tagline')<span class="alert alert-danger text-center">{{ $message }}</span>  
                @enderror
        </div>
        <div class="col-md-3 mt-3">
            <label for="title" class="form-label fw-bolder"> Title <span
                    class="text-danger">*</span></label>
        </div>
        <div class="col-md-9 mt-3">
            <input type="text" class="input-field w-100" placeholder="Title" name="title"
                id="title" value="{{ old('title') }}">
                @error('title')<span class="alert alert-danger text-center">{{ $message }}</span>  
                @enderror
        </div>
        <div class="col-md-3 mt-3">
            <label for="subtitle" class="form-label fw-bolder"> Subtitle <span
                    class="text-danger">*</span></label>
        </div>
        <div class="col-md-9 mt-3">
            <input type="text" class="input-field w-100" placeholder="Subtitle" name="subtitle"
                id="subtitle" value="{{ old('subtitle') }}">
                @error('subtitle')<span class="alert alert-danger text-center">{{ $message }}</span>  
                @enderror
        </div>
        <div class="col-md-3 mt-3">
            <label for="link" class="form-label fw-bolder"> Link <span
                    class="text-danger">*</span></label>
        </div>
        <div class="col-md-9 mt-3">
            <input type="text" class="input-field w-100" placeholder="Link" name="link"
                id="link" value="{{ old('link') }}">
                @error('link')<span class="alert alert-danger text-center">{{ $message }}</span>  
                @enderror
        </div>
        <div class="col-md-3 mt-3">
            <label for="" class="form-label fw-bolder">Upload Image <span
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
                <div class="item" id="imgpreview" style="display: none">
                    <img src="" alt="" class="effect8">
                </div>
            </div>
            @error('image')<span class="alert alert-danger text-center">{{ $message }}</span>  
            @enderror
        </div>
        <div class="col-md-3 mt-3">
            <label for="status" class="form-label fw-bolder"> Status</label>
        </div>
        <div class="col-md-9 mt-3">
            <select name="status" id="status" class="input-field w-100">
                <option >Select</option>
                <option value="1" @if(old('status') == '1') selected @endif >Active</option>
                <option value="0" @if(old('status') == '0') selected @endif >Inactive</option>
            </select>
            @error('status')<span class="alert alert-danger text-center">{{ $message }}</span>  
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
    });


    </script>
@endpush
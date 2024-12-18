@extends('layouts.admin')
@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@endpush
@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="fs-4 fw-bolder text-black">Slider</h5>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active text-black-50" aria-current="page">Slides</li>
        </ol>
    </nav>
</div>

<div class="wg-box">
    <div class=" row  justify-content-between align-items-content mb-3">
        <div class="col-5">
            <div class="position-relative search-bar d-none d-lg-block">
                <input type="text" name="search" id="search" placeholder="Search Here...">
                <i class="fa-solid fa-search"></i>
            </div>
        </div>
        <div class="col-2">
            <a href="{{ route('admin.slide.add') }}" class="btn btn-outline-primary w-100 py-2">+ Add new</a>
        </div>
    </div>
    <div class="wg-table">
        <div class="table-responsive">
            @if(Session::has('status'))
            <p class="alert alert-success">{{ Session::get('status') }}</p>
        @endif
            <table class="table table-striped table-bordered details-table">
                <thead>
                    <tr>
                        <th class="text-start">#</th>
                        <th>Image</th>
                        <th>Tagline</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($slides as $slide )
                        <tr>
                        <td>{{ $slide->id }}</td>
                        <td >
                            <div class="slide-img" style="
                            height: 124px;
                        ">
                                <img src="{{ asset('uploads/slides') }}/{{ $slide->image }}" alt="{{ $slide->title }}">

                            </div>
                        </td>
                        <td>{{ $slide->tagline }}</td>
                        <td>{{ $slide->title }}</td>
                        <td>{{ $slide->subtitle }}</td>
                        <td>{{ $slide->link }}</td>
                        <td>
                            <div class="d-flex align-item-center gap-3">
                                    <a href="{{ route('admin.slide.edit',['id'=>$slide->id]) }}">
                                        <i class="fa-solid fa-pen text-success"></i>
                                    </a>
                                    <form action="{{ route('admin.slide.delete',['id'=>$slide->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="delete">
                                            <i class="fa-regular fa-trash-can text-danger"></i>
                                        </a>
                                    </form>
                                </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="d-flex align-items-center justify-content-between flex-wrap gap3 wgp-pagnation">
            {{ $slides->links('pagination::bootstrap-5') }}
        </div>
        </div>
</div>
@endsection
@push('script')
<!-- Include SweetAlert v1 CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script>
    $(function(){
        $('.delete').on('click',function(e){
            e.preventDefault();
            var form = $(this).closest('form');
            swal({
                title: "Are you sure?",
                text: "You want to delete this file",
                type: "warning",  // In SweetAlert v1, `type` works
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
            }, function(isConfirm){
                if (isConfirm) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
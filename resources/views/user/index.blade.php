@extends('layouts.app')
@section('content')
<section class="main mt-5">
    <div class="container">
       <h2>My Account</h2>
       <div class="row align-item-center">
        @include('user.usernav')
        <div class="col-lg-6">
          <div class="page-text-content my-5">
            <p>Hello <strong>User</strong></p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae.
            </p>
          </div>
        </div>
       </div>
    </div>
  </section>
@endsection
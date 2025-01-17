@extends('layouts.app')

@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>My Profile</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="/my-profile">My Profile</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form class="row login_form" action="/my-profile" method="POST" id="contactForm"
                        novalidate="novalidate">
                        @csrf
                        <div class="col-md-12 form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                value="{{ auth()->user()->name }}">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                value="{{ auth()->user()->email }}">
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="primary-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
{{-- @section('scripts')
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        @if (session('success'))
            Toast.fire({
                icon: "success",
                title: @json(session('success'))
            });
        @endif
    </script>
@endsection --}}

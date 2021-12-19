@extends('home.layout')

@section('title', "Register")

@section('stylesheets')
<style>
    .red-str {
        color: red;
    }

</style>

{{-- <!--  jQuery --> --}}
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

{{-- <!-- Bootstrap Date-Picker Plugin --> --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
@endsection

@section('content')

<div class="job_details_area">

    <div class="container">


        <div class="row justify-content-center">
            <div class="col-lg-6">
                @if (Session::has('success'))

                <div class="alert alert-success" role="alert">
                    <strong>Success:</strong> {{ Session::get('success') }}
                </div>

                @elseif (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    <strong>Errors:</strong>
                    <ul>
                        @foreach (Session::get('error') as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (count($errors) > 0)

                <div class="alert alert-danger" role="alert">
                    <strong>Errors:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

                @endif
                <div class="apply_job_form white-bg">
                    <h3 style="text-align:center" class="mb-30">Register Akun Student</h3>
                    <form method="POST" action="{{ route('auth.register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-10">
                            <label for="email" class="">{{ __('Email') }}</label><span class="red-str"> *</span>
                            <input type="email" name="email" placeholder="Alamat email" value="{{  old('email')  }}"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Alamat email'" required
                                class="single-input">
                        </div>
                        <div class="mt-10">
                            <label for="password" class="">{{ __('Password') }}</label><span class="red-str"> *</span>
                            <input type="password" name="password" placeholder="Password"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required
                                class="single-input">
                        </div>
                        <div class="mt-10">
                            <label for="password_confirmation" class="">{{ __('Konfirmasi Password') }}</label><span
                                class="red-str"> *</span>
                            <input type="password" name="password_confirmation" placeholder="Password"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required
                                class="single-input">
                        </div>

                        <div class="mt-10 mb-5">
                            <label for="name" class="">{{ __('Nama') }}</label><span class="red-str"> *</span>
                            <input type="text" name="name" placeholder="Nama Lengkap" value="{{  old('name')  }}"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nama Lengkap'" required
                                class="single-input">
                        </div>

                        <div class="input-group-icon mt-10">
                            <div class="col-lg">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        {{ __('Daftar') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-4">
                        <div class="col text-center">
                            Sudah punya akun? <a href="{{ route('auth.showLogin') }}">Login disini!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    $(function () {
        $(".datepicker").datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
        });
    });

    $('#berkas_verifikasi').change(function (e2) {
        var fileName2 = e2.target.files[0].name;
        // dd(fileName2);
        $('#idberkas').html(fileName2);
    });

</script>
@endsection

@extends('dashboard.layout')

@section('title', 'Masukkan Buku')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Masukkan Buku Baru</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">masukkan Buku</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

{{-- main content --}}
<section class="content">
    {{-- <div class="alert alert-success" role="alert">
        <strong>Success:</strong> "Default"
    </div> --}}
            @if (Session::has('success'))

				<div class="alert alert-success" role="alert">
					<strong>Success:</strong> {{ Session::get('success') }}
				</div>
            @elseif ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                </div>
            @endif
			{{-- @if (count($errors) > 0)

				<div class="alert alert-danger" role="alert">
					<strong>Errors:</strong>
					<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
					</ul>
				</div>

			@endif --}}
    <div class="container-fluid">
        <form method="POST" role="form" id="quickForm" action="{{ route('book.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Data Buku</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Judul</label>
                            <input type="text" name="title" class="form-control" id="inputName" placeholder="Nama Buku">
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Pengarang</label>
                            <textarea type="text" name="author" class="form-control" id="inputDescription" placeholder="nama Pengarang"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="">{{ __('Cover Buku') }}</label><span
                                class="red-str">*</span>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload"
                                            aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="cover_image" id="cover_image"
                                        aria-describedby="inputGroupFileAddon03">
                                    <label class="custom-file-label" id="idlogo" for="logo">Upload Cover Buku</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="submitbtn btn btn-primary">Submit</button>
                    </div>

                </div>
            </div>
        </div>
        </form>
    </div>
</section>
@endsection

@section('scripts')
{{-- jquery-validation --}}
<script src="{{ asset('dashboard_resources') }}/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ asset('dashboard_resources') }}/plugins/jquery-validation/additional-methods.min.js"></script>
<script type="application/javascript">
    $('#cover_image').change(function (e) {
        var fileName = e.target.files[0].name;
        // dd(fileName);
        $('#idlogo').html(fileName);
    });
</script>



@endsection

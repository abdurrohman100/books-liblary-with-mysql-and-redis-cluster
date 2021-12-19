@extends('dashboard.layout')

@section('title', 'Masukkan Buku')

@section('stylesheets')
{{-- as --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Buku</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Edit Buku</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

{{-- main content --}}
<section class="content">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            <strong>Success:</strong> {{ Session::get('success') }}
        </div>
    @elseif($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Cover Buku</h3>
                    </div>

                    <div class="card-body">
                        <div class="container">
                            <img src="{{ asset('storage'.$buku->cover_image) }}" alt="{{ $buku->cover_image }}" style="max-width: 100%; max-height: 100%;">
                        </div>
                    </div>
                    <div class="card-footer">
                        <form
                            action="{{ route('book.destroy', ['book' => $buku->b_id]) }}"
                            onsubmit="return confirm('Are you sure?');" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button class="btn btn-danger" type="submit">Hapus Buku</button>
                        </form>

                    </div>

                </div>
            </div>
            <div class="col-lg-8">
                <form method="POST" role="form" id="quickForm"
                    action="{{ route('book.update', ['book' => $buku->b_id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data Buku</h3>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Judul</label>
                                <input type="text" value="{{ $buku->title }}" name="title" class="form-control"
                                    id="inputName" placeholder="Nama Buku">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Pengarang</label>
                                <input type="text" value="{{ $buku->author }}" name="author" class="form-control"
                                    id="inputName" placeholder="Nama Buku">
                            </div>
                            <div class="form-group">
                                <label for=""
                                    class="">{{ __('Cover Buku (Kosongkan jika tidak ingin diganti)') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload"
                                                aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="cover_image" id="cover_image"
                                            aria-describedby="inputGroupFileAddon03">
                                        <label class="custom-file-label" id="idlogo" for="logo">Upload Cover Buku
                                            Baru</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="submitbtn btn btn-primary">Submit</button>
                        </div>

                    </div>
            </div>
            </form>

        </div>

    </div>
</section>
@endsection

@section('scripts')
{{-- jquery-validation --}}
<script src="{{ asset('dashboard_resources') }}/plugins/jquery-validation/jquery.validate.min.js">
</script>
<script src="{{ asset('dashboard_resources') }}/plugins/jquery-validation/additional-methods.min.js">
</script>
<script type="application/javascript">
    $('#cover_image').change(function (e) {
        var fileName = e.target.files[0].name;
        // dd(fileName);
        $('#idlogo').html(fileName);
    });
</script>



@endsection

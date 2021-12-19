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
                        <table class="table table-bordered table-responsive-sm">
                            <thead>
                            <tr>
                                <th>Cover</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th width="200px">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($buku as $mentoring)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage'.$mentoring->cover_image) }}" alt="{{$mentoring->cover_image    }}" width="70" height="100">
                                    </td>
                                    <td>{{ $mentoring->title }}</td>
                                    <td>{{ $mentoring->author }}</td>
                                    <td>
                                        <a href="{{ route('book.edit', ['book' => $mentoring->b_id]) }}" type="button" class="btn btn-sm btn-block btn-warning" style="border: 2px solid; border-radius: 40px;" >
                                            Edit Buku
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>    
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

@extends("Home.layout")

@section('title', "Job Portal")

@section('stylesheets')
<style>
    .img-logo {
        display: block;
        max-width: 52px;
        max-height: 52px;
        width: auto;
        height: auto;
    }
    div.single_jobs {

    }
</style>
@endsection

@section('content')

    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{ $book->title }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="job_details_area">
        <div class="container">
        @if (Session::has('success'))

				<div class="alert alert-success" role="alert">
					<strong>Success:</strong> {{ Session::get('success') }}
				</div>

            @elseif (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
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
            <div class="row">
                <div class="col-lg-8">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="thumb">
                                    <img src="{{ asset('storage'.$book->cover_image) }}" alt="" class="img-logo">
                                </div>
                                <div class="jobs_conetent">
                                    <a><h4>{{ $book->title }}</h4></a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-pencil"></i> {{ $book->author }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Judul</h4>
                            <p>{{ $book->title }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Pengarang</h4>
                            <p>{{ $book->author}}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Jumlah peminjaman</h4>
                            <p>{{ $count }}</p>
                        </div>
                        
                    </div>

                    @if( session('login') == true and $res == null)
                    <div class="apply_job_form white-bg">
                        <form action="{{route("borrowing",['id' => $book->b_id]) }}" method="POST" enctype="multipart/form-data">
					    {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="submit_btn">
                                        <button class="boxed-btn3 w-100" type="submit">Pinjam</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @elseif(session('login') == true and $res != null)
                    <div class="apply_job_form white-bg">
                         
                        <form action="{{route("returning",['id' => $book->b_id]) }}" method="POST" enctype="multipart/form-data">
					    {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="submit_btn">
                                        <button class="boxed-btn3 w-100" type="submit">Kembalikan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @else 
                    <form method="GET" action="{{route("auth.showLogin")}}" class="mb-4">
                        <div class="submit_btn mt-5">
                            <button type="submit" class="boxed-btn3 w-100">
                                {{ __('Login sebagai utuk melakukan peminjaman!') }}
                            </button>
                        </div>
                    </form>
                    @endif

                    
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="job_sumary">
                                <div class="summery_header">
                                    <h3>Cover Buku</h3>
                                </div>
                                <div class="job_content">
                                    <div class="container">
                                        <img src="{{ asset('storage'.$book->cover_image) }}" alt="" class="img-logo" style="max-width: 100%; max-height: 100%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
<script type="application/javascript">
	$('#cv').change(function(e){
		var fileName = e.target.files[0].name;
		$('.custom-file-label').html(fileName);
	});
</script>
@endsection
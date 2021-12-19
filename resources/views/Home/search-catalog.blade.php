@extends("Home.layout")


@section('title', "Catalog")

@section('stylesheets')

@endsection


@section('content')


<div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>{{ $count }} Buku Tersedia untuk anda</h3>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="job_listing_area plus_padding" style="padding-top: 30px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="recent_joblist_wrap">
                    <div class="recent_joblist white-bg ">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <h3>Buku tersedia</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="job_lists m-0">
                    <div class="row">
                        @foreach($books as $j)
                            <div class="col-lg-12 col-md-12">
                                <div class="single_jobs white-bg d-flex justify-content-between">
                                    <div class="jobs_left d-flex align-items-center">
                                        <div class="thumb my-auto">
                                            <img src="{{ asset('storage'.$j->cover_image) }}"
                                                alt="" class="img-logo" style="max-width: 100%; max-height: 100%;">
                                        </div>
                                        <div class="jobs_conetent">
                                            <a href="{{ route('buku', ['id' => $j->b_id]) }}">
                                                <h4>{{ $j->title }}</h4>
                                            </a>
                                            <div class="links_locat d-flex align-items-center">
                                                <p style="margin-bottom: 2px;">{{ $j->author }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jobs_right">
                                        <div class="apply_now">
                                            <a href="{{ route('buku', ['id' => $j->b_id]) }}"
                                                class="boxed-btn3">Pinjam Sekarang</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            {{ $books->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
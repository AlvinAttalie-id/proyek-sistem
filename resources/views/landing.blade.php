@extends('layouts.user_type.guest')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item">
                    <div class="page-header min-vh-75 m-3 border-radius-xl"
                        style="background-image: url('https://images.unsplash.com/photo-1537511446984-935f663eb1f4?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1920&amp;q=80');">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 my-auto">
                                    <h4 class="text-white mb-0 fadeIn1 fadeInBottom">Pricing Plans</h4>
                                    <h1 class="text-white fadeIn2 fadeInBottom">Work with the rockets</h1>
                                    <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">Wealth creation is an
                                        evolutionarily recent positive-sum game. Status is an old zero-sum game. Those
                                        attacking
                                        wealth creation are often just seeking status.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="page-header min-vh-75 m-3 border-radius-xl"
                        style="background-image: url('https://images.unsplash.com/photo-1543269865-cbf427effbad?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1920&amp;q=80');">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 my-auto">
                                    <h4 class="text-white mb-0 fadeIn1 fadeInBottom">Our Team</h4>
                                    <h1 class="text-white fadeIn2 fadeInBottom">Work with the best</h1>
                                    <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">Free people make free choices.
                                        Free choices mean you get unequal outcomes. You can have freedom, or you can have
                                        equal
                                        outcomes. You can’t have both.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item active">
                    <div class="page-header min-vh-75 m-3 border-radius-xl"
                        style="background-image: url('https://images.unsplash.com/photo-1552793494-111afe03d0ca?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1920&amp;q=80');">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 my-auto">
                                    <h4 class="text-white mb-0 fadeIn1 fadeInBottom">Office Places</h4>
                                    <h1 class="text-white fadeIn2 fadeInBottom">Work from home</h1>
                                    <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">You’re spending time to save
                                        money
                                        when you should be spending money to save time.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="min-vh-75 position-absolute w-100 top-0">
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon position-absolute bottom-50" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon position-absolute bottom-50" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
        <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
            <section class="pt-3 pb-4" id="count-stats">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 mx-auto py-3">
                            <div class="row">
                                <div class="col-md-4 position-relative">
                                    <div class="p-3 text-center">
                                        <h1 class="text-gradient text-primary"><span id="state1"
                                                countto="70">70</span>+</h1>
                                        <h5 class="mt-3">Coded Elements</h5>
                                        <p class="text-sm font-weight-normal">From buttons, to inputs, navbars, alerts or
                                            cards, you are covered</p>
                                    </div>
                                    <hr class="vertical dark">
                                </div>
                                <div class="col-md-4 position-relative">
                                    <div class="p-3 text-center">
                                        <h1 class="text-gradient text-primary"> <span id="state2"
                                                countto="15">15</span>+</h1>
                                        <h5 class="mt-3">Design Blocks</h5>
                                        <p class="text-sm font-weight-normal">Mix the sections, change the colors and
                                            unleash your creativity</p>
                                    </div>
                                    <hr class="vertical dark">
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 text-center">
                                        <h1 class="text-gradient text-primary" id="state3" countto="4">4</h1>
                                        <h5 class="mt-3">Pages</h5>
                                        <p class="text-sm font-weight-normal">Save 3-4 weeks of work when you use our
                                            pre-made pages for your website</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        {{-- About Us --}}

        <div class="card card-body shadow-xl-blur mx-3 mx-md-4 mt-4">

            <section class="py-7">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="row justify-content-start">
                                <div class="col-md-6">
                                    <div class="info">
                                        <i class="material-icons text-3xl text-gradient text-info mb-3">public</i>
                                        <h5>Fully integrated</h5>
                                        <p>We get insulted by others, lose trust for those We get back freezes</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info">
                                        <i class="material-icons text-3xl text-gradient text-info mb-3">payments</i>
                                        <h5>Payments functionality</h5>
                                        <p>We get insulted by others, lose trust for those We get back freezes</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-start mt-4">
                                <div class="col-md-6">
                                    <div class="info">
                                        <i class="material-icons text-3xl text-gradient text-info mb-3">apps</i>
                                        <h5>Prebuilt components</h5>
                                        <p>We get insulted by others, lose trust for those We get back freezes</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info">
                                        <i class="material-icons text-3xl text-gradient text-info mb-3">3p</i>
                                        <h5>Improved platform</h5>
                                        <p>We get insulted by others, lose trust for those We get back freezes</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 ms-auto mt-lg-0 mt-4">
                            <div class="card">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <a class="d-block blur-shadow-image">
                                        <img src="https://images.unsplash.com/photo-1544717302-de2939b7ef71?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1950&amp;q=80"
                                            alt="img-colored-shadow" class="img-fluid border-radius-lg">
                                    </a>
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="font-weight-normal">
                                        <a href="javascript:;">Get insights on Search</a>
                                    </h5>
                                    <p class="mb-0">
                                        Website visitors today demand a frictionless user expericence — especially when
                                        using search. Because of the hight standards.
                                    </p>
                                    <button type="button" class="btn bg-gradient-info btn-sm mb-0 mt-3">Find out
                                        more</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="pb-5 position-relative bg-gradient-dark mx-n3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 text-start mb-5 mt-5">
                            <h3 class="text-white z-index-1 position-relative">The Executive Team</h3>
                            <p class="text-white opacity-8 mb-0">There’s nothing I really wanted to do in life that I
                                wasn’t able to get good at. That’s my skill.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="card card-profile mt-4">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 mt-n5">
                                        <a href="javascript:;">
                                            <div class="p-3 pe-md-0">
                                                <img class="w-100 border-radius-md shadow-lg"
                                                    src="../assets/img/team-3.jpg" alt="image">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-12 my-auto">
                                        <div class="card-body ps-lg-0">
                                            <h5 class="mb-0">Emma Roberts</h5>
                                            <h6 class="text-info">UI Designer</h6>
                                            <p class="mb-0">Artist is a term applied to a person who engages in an
                                                activity deemed to be an art.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="card card-profile mt-lg-4 mt-5">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 mt-n5">
                                        <a href="javascript:;">
                                            <div class="p-3 pe-md-0">
                                                <img class="w-100 border-radius-md shadow-lg"
                                                    src="../assets/img/bruce-mars.jpg" alt="image">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-12 my-auto">
                                        <div class="card-body ps-lg-0">
                                            <h5 class="mb-0">William Pearce</h5>
                                            <h6 class="text-info">Boss</h6>
                                            <p class="mb-0">Artist is a term applied to a person who engages in an
                                                activity deemed to be an art.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-6 col-12">
                            <div class="card card-profile mt-4 z-index-2">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 mt-n5">
                                        <a href="javascript:;">
                                            <div class="p-3 pe-md-0">
                                                <img class="w-100 border-radius-md shadow-lg"
                                                    src="../assets/img/team-1.jpg" alt="image">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-12 my-auto">
                                        <div class="card-body ps-lg-0">
                                            <h5 class="mb-0">Ivana Flow</h5>
                                            <h6 class="text-info">Athlete</h6>
                                            <p class="mb-0">Artist is a term applied to a person who engages in an
                                                activity deemed to be an art.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="card card-profile mt-lg-4 mt-5 z-index-2">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 mt-n5">
                                        <a href="javascript:;">
                                            <div class="p-3 pe-md-0">
                                                <img class="w-100 border-radius-md shadow-lg"
                                                    src="../assets/img/ivana-square.jpg" alt="image">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-12 my-auto">
                                        <div class="card-body ps-lg-0">
                                            <h5 class="mb-0">Marquez Garcia</h5>
                                            <h6 class="text-info">JS Developer</h6>
                                            <p class="mb-0">Artist is a term applied to a person who engages in an
                                                activity deemed to be an art.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="pt-4 pb-6" id="count-stats">
                <div class="container mt-4">
                    <div class="row justify-content-center text-center">
                        <div class="col-md-3">
                            <h1 class="text-gradient text-info" id="state1" countto="5234">5,234</h1>
                            <h5>Projects</h5>
                            <p>Of “high-performing” level are led by a certified project manager</p>
                        </div>
                        <div class="col-md-3">
                            <h1 class="text-gradient text-info"><span id="state2" countto="3400">3,400</span>+</h1>
                            <h5>Hours</h5>
                            <p>That meets quality standards required by our users</p>
                        </div>
                        <div class="col-md-3">
                            <h1 class="text-gradient text-info"><span id="state3" countto="24">24</span>/7</h1>
                            <h5>Support</h5>
                            <p>Actively engage team members that finishes on time</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="my-5 pt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <h4>Be the first to see the news</h4>
                            <p class="mb-4">
                                Your company may not be in the software business,
                                but eventually, a software company will be in your business.
                            </p>
                            <div class="row">
                                <div class="col-4 ps-0">
                                    <a type="button" class="btn btn-outline-success btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#addModal">
                                        Tambah Data
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 ms-auto">
                            <div class="position-relative">
                                <img class="max-width-50 w-100 position-relative z-index-2"
                                    src="../assets/img/profile.png" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        {{-- End Section About --}}

        {{-- Project Section --}}
        <div class="container-fluid py-4">
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-1">Projects</h6>
                        <p class="text-sm">Architects design houses</p>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-start row ">
                            <div class="col-xl-3 col-md-6 mb-xl-3">
                                <div class="card card-blog card-plain">
                                    <div class="position-relative">
                                        <a class="d-block shadow-xl border-radius-xl">
                                            <img src="../assets/img/home-decor-1.jpg" alt="img-blur-shadow"
                                                class="img-fluid shadow border-radius-xl">
                                        </a>
                                    </div>
                                    <div class="card-body px-1 pb-0">
                                        <p class="text-gradient text-dark mb-2 text-sm">Project #2</p>
                                        <a href="javascript:;">
                                            <h5>
                                                Modern
                                            </h5>
                                        </a>
                                        <p class="mb-4 text-sm">
                                            As Uber works through a huge amount of internal management turmoil.
                                        </p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="{{ url('detail') }}" type="button" class="btn btn-outline-info btn-sm mb-0">View
                                                Project</a>
                                            
                                            <a type="button" class="btn btn-outline-success btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#addModal">
                                                Tambah Data
                                            </a>
                                            
                                            <div class="avatar-group mt-2">
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Elena Morison">
                                                    <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Ryan Milly">
                                                    <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Nick Daniel">
                                                    <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                                                    <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<!-- Modal -->
<!-- Add Data Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    @csrf
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="nilai1" class="form-control-label">Penilaian Pegawai</label>
                            <div class="form-group">
                                <select name="nilai1" class="form-control" id="nilai1" required>
                                    <option value="5">Sangat Bagus</option>
                                    <option value="4">Bagus</option>
                                    <option value="3">Cukup</option>
                                    <option value="2">Kurang Bagus</option>
                                    <option value="1">Tidak Bagus</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="nilai1" class="form-control-label">Penilaian Kegiatan</label>
                            <div class="form-group">
                                <select name="nilai1" class="form-control" id="nilai1" required>
                                    <option value="5">Sangat Bagus</option>
                                    <option value="4">Bagus</option>
                                    <option value="3">Cukup</option>
                                    <option value="2">Kurang Bagus</option>
                                    <option value="1">Tidak Bagus</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="nilai1" class="form-control-label">Penilaian Program</label>
                            <div class="form-group">
                                <select name="nilai1" class="form-control" id="nilai1" required>
                                    <option value="5">Sangat Bagus</option>
                                    <option value="4">Bagus</option>
                                    <option value="3">Cukup</option>
                                    <option value="2">Kurang Bagus</option>
                                    <option value="1">Tidak Bagus</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="keterangan" class="form-control-label">Keterangan</label>
                            <div class="form-group">
                                <textarea name="keterangan" class="form-control" id="keterangan" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-0 flex flex-wrap justify-content-between pt-3">
                        <button type="submit" class="btn bg-gradient-primary btn-sm">
                            <i class="ti ti-save"></i> Save
                        </button>
                        <button type="reset" class="btn bg-gradient-success btn-sm">
                            <i class="ti ti-printer"></i> Clear
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

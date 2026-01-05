<style>
    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #000000;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        margin: 0 auto;
    }
</style>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">{{ $slot }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">

                </div>
            </div>
            <ul class="navbar-nav  justify-content-end">

                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>

                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user text-lg me-sm-1"></i>
                        <span class="d-sm-inline d-none">
                            {{ Auth::user()->name ?? 'Guest' }}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <div class="row">
                            <div class="col-12 text-center mb-3 mt-2">
                                <div class="avatar">
                                    <i class="fa fa-user fa-3x text-primary"></i>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <b>{{ Auth::user()->name ?? 'Guest' }}</b> <br>
                                <em class="text-muted">
                                    {{ Auth::user()->username ?? 'No Username' }}
                                </em>
                            </div>

                            <hr class="mt-4">

                            <form method="POST" action="{{ route('logout') }}" class="col-12 text-center mt-1">
                                @csrf
                                <button type="submit" class="btn btn-link text-danger p-0 border-0">
                                    <i class="fa-solid fa-door-open text-danger"></i>
                                    <span class="text-danger mx-2">Log Out</span>
                                </button>
                            </form>
                        </div>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

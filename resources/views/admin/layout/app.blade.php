<!DOCTYPE html>
<html dir="ltr" lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="robots" content="noindex,nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('assets/admin/plugins/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/style.min.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .sidebar-link.active, .breadcrumb-item a{
            color: #27A746 !important;
        }
        .sidebar-link.active i{
            color: #27A746 !important;
        }
        .sidebar-link:hover{
            color: #27A746 !important;
        }
        .sidebar-link:hover i{
            color: #27A746 !important;
        }
        .page-breadcrumb .page-title {
            color: #27A746;
        }
        .coll-but.active .coll-ik{
            transform : rotate( -180deg );
        }
        a.icon-bts{
            color:#c4c4c4;
        }
        a.icon-bts:hover{
            color: #27A746;
        }
        button.icon-bts{
            color:#c4c4c4;
            display: inline;
            padding: 0;
            margin: 0;
            background:transparent;
            border: none;
            outline: none;
        }
        button.icon-bts:hover{
            color: #27A746;
        }
        label.form-label sup{
            color:red;
        }
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #e9ecef !important;
            border-radius: 2px !important;
            font-size:14px !important;
        }
        .card .card-body .select2  span {
            font-size: 14px !important;
            font-weight: 300;
        }
    </style>
</head>
<body>
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <header class="topbar" data-navbarbg="skin6" style="background:#0b2641;">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header" data-logobg="skin6" style="padding:10px 15px;">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="homepage" style="width:75%;" />
                </a>
            </div>
            <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                <ul class="navbar-nav me-auto mt-md-0 ">
                    <li class="nav-item hidden-sm-down"></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Администратор</a>
                        <ul class="dropdown-menu hide-menu" aria-labelledby="navbarDropdown" style="padding:10px 10px;">
                            <li class="nav-item hidden-sm-down">Ссылка</li>
                            <li class="nav-item hidden-sm-down">
                                <a href="{{ route('logout') }}">Выйти</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <div class="scroll-sidebar">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.home') }}" aria-expanded="false">
                            <i class="me-3 far fas fa-home fa-fw" aria-hidden="true"></i><span class="hide-menu">Главная</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link coll-but" data-bs-toggle="collapse" href="#collapseExample" role="button" onclick="return false" aria-expanded="false" aria-controls="collapseExample">
                            <i class="me-3 far fas fa-newspaper fa-fw" aria-hidden="true"></i>
                            <span class="hide-menu">Новости</span>
                            <i class="me-3 far fas fa-angle-down fa-fw coll-ik" aria-hidden="true"></i>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <ul>
                                <li>
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('news.index') }}">
                                        <i class="me-3 far fas fa-caret-right fa-fw" aria-hidden="true"></i><span class="hide-menu">Новости</span></a>
                                </li>
                                <li>
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('categories.index') }}">
                                        <i class="me-3 far fas fa-caret-right fa-fw" aria-hidden="true"></i><span class="hide-menu">Категории</span></a>
                                </li>
                                <li>
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('tags.index') }}">
                                        <i class="me-3 far fas fa-caret-right fa-fw" aria-hidden="true"></i><span class="hide-menu">Тэги</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('pages.index') }}" aria-expanded="false">
                            <i class="me-3 far fas fa-paste fa-fw" aria-hidden="true"></i><span class="hide-menu">Страницы</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('questions.index') }}" aria-expanded="false">
                            <i class="me-3 far fas fa-comments fa-fw" aria-hidden="true"></i><span class="hide-menu">Вопрос - Ответ</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link coll-but" data-bs-toggle="collapse" href="#collapseExample1" role="button" onclick="return false" aria-expanded="false" aria-controls="collapseExample">
                            <i class="me-3 far fas fa-book fa-fw" aria-hidden="true"></i>
                            <span class="hide-menu">Справочники</span>
                            <i class="me-3 far fas fa-angle-down fa-fw coll-ik" aria-hidden="true"></i>
                        </a>
                        <div class="collapse" id="collapseExample1">
                            <ul>
                                <li>
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('industry-groups.index') }}">
                                        <i class="me-3 far fas fa-caret-right fa-fw" aria-hidden="true"></i><span class="hide-menu">Группы отраслей</span></a>
                                </li>
                                <li>
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('industries.index') }}">
                                        <i class="me-3 far fas fa-caret-right fa-fw" aria-hidden="true"></i><span class="hide-menu">Отрасли</span></a>
                                </li>
                                <li>
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('specializations.index') }}">
                                        <i class="me-3 far fas fa-caret-right fa-fw" aria-hidden="true"></i><span class="hide-menu">Специализации</span></a>
                                </li>
                                <li>
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('employment-types.index') }}">
                                        <i class="me-3 far fas fa-caret-right fa-fw" aria-hidden="true"></i><span class="hide-menu">Типы занятости</span></a>
                                </li>
                                <li>
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('expertise.index') }}">
                                        <i class="me-3 far fas fa-caret-right fa-fw" aria-hidden="true"></i><span class="hide-menu">Опыт работы</span></a>
                                </li>
                                <li>
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('schedules.index') }}">
                                        <i class="me-3 far fas fa-caret-right fa-fw" aria-hidden="true"></i><span class="hide-menu">График работы</span></a>
                                </li>
                                <li>
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('formats.index') }}">
                                        <i class="me-3 far fas fa-caret-right fa-fw" aria-hidden="true"></i><span class="hide-menu">Формат работы</span></a>
                                </li>
                                <li>
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('cities.index') }}">
                                        <i class="me-3 far fas fa-caret-right fa-fw" aria-hidden="true"></i><span class="hide-menu">Города, регионы</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>



                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('clear.all') }}" aria-expanded="false">
                            <i class="me-3 far fa-clock fa-fw" aria-hidden="true"></i><span class="hide-menu">Очистить кэш</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="2" aria-expanded="false">
                            <i class="me-3 fa fa-user" aria-hidden="true"></i><span class="hide-menu">Profile</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="3" aria-expanded="false">
                            <i class="me-3 fa fa-table" aria-hidden="true"></i><span class="hide-menu">Table</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="4" aria-expanded="false">
                            <i class="me-3 fa fa-font" aria-hidden="true"></i><span class="hide-menu">Icon</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="5" aria-expanded="false">
                            <i class="me-3 fa fa-globe" aria-hidden="true"></i><span class="hide-menu">Google Map</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="6" aria-expanded="false">
                            <i class="me-3 fa fa-columns" aria-hidden="true"></i><span class="hide-menu">Blank</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="7" aria-expanded="false">
                            <i class="me-3 fa fa-info-circle" aria-hidden="true"></i><span class="hide-menu">Error 404</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <div class="page-wrapper">
    @yield('content')
        <footer class="footer text-center">
            © 2021 Monster Admin by <a href="https://www.wrappixel.com/">wrappixel.com</a>
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
</div>
<script src="{{ asset('assets/admin/plugins/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('assets/admin/js/waves.js') }}"></script>
<script src="{{ asset('assets/admin/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
@stack('scripts')
<x-toastr />
<script src="{{ asset('assets/admin/js/pages/dashboards/dashboard1.js') }}"></script>
</body>
</html>


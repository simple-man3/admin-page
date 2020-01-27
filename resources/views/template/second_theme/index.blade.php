@extends(\App\Helpers\Helper::usingTheme('header'))

@section('content')

    <div class="container">
        <div class="col-12 d-flex justify-content-center" style="padding-top: 20px">
            <div class="row w-75" style="display: flex;flex-wrap: wrap">
                <div class="col-6">
                    <p class="logo_text">
                        Cover
                    </p>
                </div>
                <div class="col-6 d-flex justify-content-end menu">
                    <ul>
                        <li class="active">
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <a href="#">Features</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center wrap">
                    <div class="text-center">
                        <p class="title">
                            Cover your page.
                        </p>
                        <p class="description">
                            Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.
                        </p>
                        <a href="#">Learn more</a>
                    </div>
                </div>
                <div class="col-12">
                    <footer class="d-flex justify-content-center">
                        Created by Bootstrap 4
                    </footer>
                </div>
            </div>
        </div>
    </div>

@endsection

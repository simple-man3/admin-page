@extends(Helper::usingTheme('header'))

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 bg_carousel">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <div>
                                <div class="wrap_carousel_title">
                                    <p>
{{--                                        {{$arResult->title}}--}}
                                    </p>
                                </div>
                                <div class="wrap_anons_text">
                                    <p>
{{--                                        {!! Helper::cutText($arResult->content,143,'...') !!}--}}
                                    </p>
                                    <a href="#">See more...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends(Helper::usingTheme('header'))

@section('content')
    {{--Просто секция хз с чем--}}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 bg_carousel">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <div>
                                <div class="wrap_carousel_title">
                                    <p>
                                        {{$arResult->title}}
                                    </p>
                                </div>
                                <div class="wrap_anons_text">
                                    <p>
                                        {!! Helper::cutText($arResult->content,143,'...') !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="padding-top: 30px">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row wrap_block_under_poster w-100" style="display: flex;flex-wrap: wrap">
                                <div class="col-8 col_block_under_poster">
                                    <div>
                                        <h3>
                                            <b>
                                                {{$arCategoryFirstBlock->name}}
                                            </b>
                                        </h3>
                                        <p class="title_shit">
                                            {{$arCategoryFirstBlock->content->first()->title}}
                                        </p>
                                        <p>
                                            {!! $arCategoryFirstBlock->content->first()->content !!}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-center align-items-center col_block_under_poster_another">
                                    JUST TEXT
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row w-100 wrap_block_under_poster" style="display: flex;flex-wrap: wrap">
                                <div class="col-8 col_block_under_poster">
                                    <div>
                                        <h3>
                                            <b>
                                                {{$arCategorySecondBlock->name}}
                                            </b>
                                        </h3>
                                        <p class="title_shit">
                                            {{$arCategorySecondBlock->content->first()->title}}
                                        </p>
                                        <p>
                                            {!! $arCategorySecondBlock->content->first()->content !!}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-center align-items-center col_block_under_poster_another">
                                    JUST TEXT
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--Секция с блогом--}}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="wrap_title">
                        <h3>{{$arGreatePeople->name}}</h3>
                    </div>
                    @foreach($arGreatePeople->content as $arItem)
                        <div class="wrap_content_help">
                            <h5>
                                {{$arItem->title}}
                            </h5>
                            <p>
                                {!! $arItem->content !!}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

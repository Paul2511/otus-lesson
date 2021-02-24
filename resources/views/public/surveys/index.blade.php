@extends("layouts.app")

@section("first_screen_content")
    <p class="h1">Доступные опросы</p>
    <p class="mt-4"></p>
@endsection

@section("first_screen_image")
@endsection

@section("content")
    @include("components.first_screen")

    <div class="container py-5 d-flex flex-column flex-grow-1">
        <div class="row">
            <div class="col-12">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($surveys as $survey)
                        <tr>
                            <th scope="row">{{ $survey->id }}</th>
                            <td><a href="{{ $survey->publicUrl()  }}">{{ $survey->name }}</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <div class="mt-16 pager-wrapper">{{$surveys->links()}}</div>
            </div>
        </div>
    </div>
@endsection

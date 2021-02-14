@extends('layouts.app')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">{{ __('Инструмент запоминания иностранных слов') }}</h1>
            <p class="lead text-muted">Поможет вам выучить больше новых слов слова</p>
            <p>
                <a href="{{ route('home', App::getLocale()) }}" class="btn btn-primary my-2">{{ __('Начать тренировку') }}</a>
                <a href="{{ route(\App\Services\Dictionaries\Providers\Routes::DICTIONARIES_INDEX, App::getLocale()) }}" class="btn btn-secondary my-2">{{ __('Добавить слова') }}</a>
            </p>
        </div>
    </section>

    <div class="container">
        <h2>Как запоминать слова эффективно</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ullamcorper velit eu vestibulum malesuada.
            Nam lobortis libero est, nec luctus purus commodo volutpat. Sed consequat imperdiet augue, eget auctor nulla
            tincidunt non. Etiam nec lacinia ex, tristique blandit nisi. Cras pulvinar nec urna a pulvinar. Morbi
            sollicitudin sollicitudin elit, ut faucibus orci ultricies non. Cras pellentesque feugiat tempor. Etiam quam
            tellus, sagittis sed ex ullamcorper, tincidunt placerat enim. Nulla ornare, lorem ut lobortis vulputate,
            lacus dui ultricies risus, vel dapibus erat ipsum in eros. Nam gravida enim eget diam dapibus, sed bibendum
            odio mollis. Integer blandit mollis lectus, sit amet posuere tellus malesuada non. Morbi quis aliquet nisl.
            Donec libero leo, ultrices vel pulvinar in, vulputate eu velit. Curabitur fringilla porttitor elit sit amet
            tincidunt. Quisque efficitur efficitur lectus, in fermentum elit venenatis ac.</p>
        <p>Proin vel velit nibh. Sed quis mi condimentum, congue quam sit amet, porttitor quam. Aliquam tellus velit,
            dignissim a vulputate egestas, ultrices non erat. Pellentesque tristique lectus lacus, vitae egestas nulla
            sollicitudin ac. Nam nunc leo, aliquam faucibus magna ac, finibus convallis felis. Cras luctus volutpat
            erat, eu consectetur tellus lacinia vel. Curabitur at mi in dolor lobortis pharetra vitae eget purus. Donec
            egestas in ipsum sit amet faucibus. Cras suscipit volutpat nunc sed imperdiet.</p>
        <p>Aliquam augue ante, rhoncus vitae mi at, pharetra maximus augue. Integer ac eros ornare, posuere metus non,
            tristique dolor. Vivamus et elit porttitor, lacinia magna eget, pretium est. Mauris nec eros at arcu
            fermentum dapibus non id diam. Nunc scelerisque bibendum imperdiet. Quisque condimentum dictum dui vel
            dapibus. Vestibulum eu velit eros. Nullam sed nulla in nulla aliquet lacinia ac non nunc. Curabitur a dui
            eget sapien iaculis maximus. Donec tincidunt nulla eget sodales semper. Integer egestas tempus erat sit amet
            consequat. Praesent pretium sem quam, quis venenatis lectus ultricies quis. Proin eleifend facilisis
            pretium.</p>
    </div>
@endsection

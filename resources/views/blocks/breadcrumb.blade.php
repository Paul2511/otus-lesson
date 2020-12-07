<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($links as $name => $link)
                <li class="breadcrumb-item"><a href="{{ $link }}">{{ $name }}</a></li>
            @endforeach

            @if($current)
                <li class="breadcrumb-item active" aria-current="page">{{ $current }}</li>
            @endif
        </ol>
    </nav>
</div>

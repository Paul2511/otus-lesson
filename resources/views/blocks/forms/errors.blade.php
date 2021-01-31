@if($errors->all())
    <div class="bg-red-300 p-5 rounded">
        @foreach ($errors->all() as $error)
            <li class="text-red-700">{{ $error }}</li>
        @endforeach
    </div>
@endif

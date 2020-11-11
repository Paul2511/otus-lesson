<div class="card" style="width: 18rem;">
    <div class="card-header">
        {{ __('profile.user_info') }} <button class="btn btn-primary">{{ __('profile.btn_change') }}</button>
    </div>
    <?php
        $information = [
            [
                'name' => __('profile.name'),
                'prop' => 'Artem'
            ],
            [
                'name' => __('profile.email'),
                'prop' => 'artem@mail.ru'
            ],
            [
                'name' => __('profile.phone'),
                'prop' => '+7 (909) 909 90 99'
            ]
        ];
    ?>
    <ul class="list-group list-group-flush">
        @foreach($information as $info)
            <li class="list-group-item">{{ $info['name'] }}: {{ $info['prop'] }}</li>
        @endforeach

    </ul>
</div>

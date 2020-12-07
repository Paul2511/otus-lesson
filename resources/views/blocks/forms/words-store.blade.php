<div class="container mt-3">
    <div class="row justify-content-left">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Добавить слово') }}</div>

                <div class="card-body">
                    <form action="{{ route('words.store') }}"
                          method="POST">
                        @csrf
                        <input type="hidden"
                               name="dictionary_id"
                               value="{{ $dictionary_id }}">
                        <div class="form-group">
                            <label for="foreignWord">{{ __('Слово на иностранном языке') }}</label>
                            <input type="text"
                                   class="form-control"
                                   id="foreignWord"
                                   name="value"
                                   placeholder="{{ __('Введите слово') }}">
                        </div>

                        <div class="form-group">
                            <label for="translationWord">{{ __('Перевод слова') }}</label>
                            <input type="text"
                                   class="form-control"
                                   id="translationWord"
                                   name="translation"
                                   placeholder="{{ __('Введите перевод') }}">
                        </div>

                        <div class="form-group">
                            <label for="">{{ __('Контекст использования') }}</label>
                            <input type="text"
                                   class="form-control mt-1"
                                   id=""
                                   aria-describedby="contextWordHelp"
                                   name="context"
                                   placeholder="{{ __('Введите контекст') }}">
                            <input type="text"
                                   class="form-control mt-1"
                                   id=""
                                   aria-describedby="contextWordHelp"
                                   placeholder="{{ __('Введите контекст') }}">
                            <button type="button"
                                    class="btn btn-primary mt-1">{{ __('Добавить контекст') }}
                            </button>
                            <small id="contextWordHelp"
                                   class="form-text text-muted">{{ __('Пример использования слова на иностранном языке') }}</small>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Добавить слово') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

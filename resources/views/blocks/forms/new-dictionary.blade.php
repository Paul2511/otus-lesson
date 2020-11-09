<div class="container mt-3">
    <div class="row justify-content-left">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Добавить словарь') }}</div>

                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="foreignWord">{{ __('Название словаря') }}</label>
                            <input type="text"
                                   class="form-control"
                                   id="foreignWord"
                                   placeholder="{{ __('Введите название') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Добавить словарь') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

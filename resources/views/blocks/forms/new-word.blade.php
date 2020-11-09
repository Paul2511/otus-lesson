<div class="container mt-3">
    <div class="row justify-content-left">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Добавить слово</div>

                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="foreignWord">Слово на иностранном языке</label>
                            <input type="text"
                                   class="form-control"
                                   id="foreignWord"
                                   placeholder="Введите слово">
                        </div>

                        <div class="form-group">
                            <label for="translationWord">Перевод слова</label>
                            <input type="text"
                                   class="form-control"
                                   id="translationWord"
                                   placeholder="Введите перевод">
                        </div>

                        <div class="form-group">
                            <label for="">Контекст использования</label>
                            <input type="text"
                                   class="form-control mt-1"
                                   id=""
                                   aria-describedby="contextWordHelp"
                                   placeholder="Введите контекст">
                            <input type="text"
                                   class="form-control mt-1"
                                   id=""
                                   aria-describedby="contextWordHelp"
                                   placeholder="Введите контекст">
                            <button type="button"
                                    class="btn btn-primary mt-1">Добавить контекст
                            </button>
                            <small id="contextWordHelp"
                                   class="form-text text-muted">Пример использования слова на иностранном
                                языке</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Добавить слово</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

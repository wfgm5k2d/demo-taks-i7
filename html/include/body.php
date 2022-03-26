<div class="container  mt-5">

    <form method="POST">
        <fieldset>
            <legend>Доменное имя</legend>
            <div class="form-floating mb-3 mt-3">
                <input type="text"
                       class="form-control has-validation"
                       id="domain"
                       placeholder="domain.ru или domain.su или домен.рф или xn--d1acufc.xn--p1ai"
                       name="domain"
                       required>
                <label for="domain">domain.ru или домен.рф</label>
            </div>
        </fieldset>

        <div>
            <div class="row gx-5">
                <div class="col">
                    <fieldset class="mt-5">
                        <legend>Домен</legend>
                        <div class="form-floating">
                            <textarea class="form-control"
                                      placeholder="Введите свой комментарий"
                                      id="floatingTextareaComment"
                                      name="comment"
                                      required></textarea>
                            <label for="floatingTextareaComment">Комментарий</label>
                        </div>

                        <div class="form-floating mt-3">
                        <textarea class="form-control"
                                  placeholder="Описание (международное)"
                                  id="floatingTextareaCommentWorld"
                                  name="description"
                                  required></textarea>
                            <label for="floatingTextareaCommentWorld">Описание (международное)</label>
                        </div>
                    </fieldset>
                </div>
                <div class="col">
                    <fieldset class="mt-5">
                        <legend>Автоматические операции</legend>
                        <div class="row g-3 align-items-end">
                            <div class="col-auto">
                                <label class="form-check-label"for="autoRenewal">Автопродление</label>
                            </div>
                            <div class="col-auto">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="autoRenewal"
                                       name="autorenewal">
                            </div>
                            <div class="col-auto">
                            <span id="passwordHelpInline" class="form-text">
                                с даты начала периода продления
                            </span>
                            </div>
                        </div>
                        <div class="row g-3 align-items-end">
                            <div class="col-auto">
                                <label class="form-check-label" for="autoParking">Автопарковка</label>
                            </div>
                            <div class="col-auto">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="autoParking"
                                       name="autoparking">
                            </div>
                            <div class="col-auto">
                            <span id="passwordHelpInline" class="form-text">
                                с даты истечения срока регистрации
                            </span>
                            </div>
                        </div>
                        <div class="row g-3 align-items-end">
                            <div class="col-auto">
                                <label class="form-check-label" for="testZone">Тестирование зоны</label>
                            </div>
                            <div class="col-auto">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="testZone"
                                       name="testzone">
                            </div>
                            <div class="col-auto">
                            <span id="passwordHelpInline" class="form-text">
                                при делегировании домена
                            </span>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

        <fieldset class="mt-5">
            <legend>Делегирование</legend>
            <div class="form-check mb-3">
                <label class="form-check-label" for="delegate">
                    Делегирование
                </label>
                <input class="form-check-input"
                       type="checkbox"
                       id="delegate"
                       name="delegate">
            </div>
            <mark>Name-серверы по одному на строку, IP-адреса через пробел</mark>
            <div class="form-floating mt-2">
                <textarea class="form-control"
                          placeholder="имена name-серверов"
                          id="nameServer"
                          title="Введите имена name-серверов, по одному на строку; для субординатных name-серверов необходимо через пробел указать их IP-адреса"
                          name="nameserver"></textarea>
                <label for="nameServer">Имена name-серверов</label>
            </div>
        </fieldset>

        <button type="submit" class="btn btn-success mt-5">Создать</button>
    </form>
</div>
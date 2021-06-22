<?php
/**
 * Created by Isxoqjon Axmedov.
 * WEB site: https://www.ninja.uz
 * Date: 5/26/2021
 * Time: 9:47 AM
 * Project name: shop
 */

?>

<div id="installment_form_vue" class="container px-0 py-0">
    <article class="box mx-auto" style="max-width: 900px;">
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                    aria-hidden="true">×</span></button>
        <h4 class="text-center mt-3">Купить товар в рассрочку</h4>
        <p class="text-muted text-center">Введите первоночальный взнос и срок рассрочки, чтоб расчитать
            рассрочку</p> <!---->
        <div class="form-group mx-auto" style="max-width: 380px;"><label>Первоначальный взнос (можно
                увеличить по желанию)</label> <input type="text" class="form-control"> <small
                    class="form-text text-muted">Минимальная сумма: 703 000 сум</small></div> <!---->
        <div class="form-group mx-auto" style="max-width: 380px;"><label>Срок рассрочки, месяц.</label>
            <div class="switch-toggle-radio"><input id="month-3" type="radio" value="3"
                                                    checked="checked" class="deal_discount_type"> <label
                        for="month-3">3 мес.</label> <input id="month-4" type="radio" value="4"
                                                            class="deal_discount_type"> <label
                        for="month-4">4 мес.</label> <input id="month-5" type="radio" value="6"
                                                            class="deal_discount_type"> <label
                        for="month-5">6 мес.</label> <input id="month-6" type="radio" value="9"
                                                            class="deal_discount_type"> <label
                        for="month-6">9 мес.</label>
                <button class="button" style="border: none;"></button>
            </div>
        </div>
        <div class="mb-4 d-flex bg rounded mx-auto" style="max-width: 400px;">
            <div class="col-6 p-3 border-right"><p class="mb-0">Ежемесесячный платеж:</p>
                <div class="price mb-0 h5">742 000 сум</div>
            </div>
            <div class="col-6 p-3"><p class="mb-0">Общая сумма</p>
                <div class="price mb-0 h5">2 929 000 сум</div>
            </div>
        </div>
        <input type="hidden" name="_token" value="0nkFfITzc5NMSarPf4QVznylSZ49ZEwwd9BhoqT6">
        <p class="text-warning text-center">Нажмите кнопку купить для оформление заказа.</p>
        <p class="mb-4 text-center">
            <button class="btn btn-primary">Оформит в рассрочку</button>
        </p>
    </article>
</div> <!-- container .//  -->


/**
 * Function for making XMLHttp requests
 * @param settings - settings object with keys:
 *  - method - request method
 *  - url - request url
 *  - success - success callback
 *  - error - error callback
 */
function request (settings) {
    let xhr = new XMLHttpRequest();
    let url = settings.url || '';
    const method = settings.method || 'GET';
    const success = settings.success || function (response) {};
    const error = settings.error || function (response) {};

    xhr.open(method, url, true);
    xhr.onload = function () {
        if ((xhr.status >= 200 && xhr.status <= 299) || (xhr.status >= 400 && xhr.status <= 499)) {
            success(this);
        }
        if ((xhr.status >= 500 && xhr.status <= 599)) {
            error(this);
        }
    }
    xhr.onerror = function () {
        error(this);
    }
    try {
        xhr.send(settings.body ? settings.body : null);
    } catch (err) {
        error(this);
    }
}

document.addEventListener("DOMContentLoaded", (event) => {
    //#region init circle list
    document.querySelectorAll('.circle-list').forEach((circleList, index) => {
        let circleItems = circleList.querySelectorAll('.circle-item');
        const arc = 2 * Math.PI * (1 / circleItems.length);
        const radius = 50;
        for( let i = 0; i < circleItems.length; ++i ) {
            let circle = circleItems[i];
            const angle = i * arc;
            const x = radius * Math.cos(angle);
            const y = radius * Math.sin(angle);
            circle.style.left = `${50 + x}%`;
            circle.style.top = `${50 + y}%`;
        }
    });
    //#endregion
    //#region init toggler
    iziToast.settings({
        timeout: 2000,
        resetOnHover: true,
        transitionIn: 'flipInX',
        transitionOut: 'flipOutX',
        position: 'topRight',
    });
    //#endregion
});

document.addEventListener('click', (e) => {
    //#region handle click on home goods
    if (e.target.closest('.good-container')) {
        const params = new URLSearchParams([
            ["type", e.target.closest('.good-container').dataset.type],
            ["id", e.target.closest('.good-container').dataset.id]
        ]);
        request({
            method: 'get',
            url: `/good-category?${params.toString()}`,
            success: function (response) {
                const goodPayment = document.querySelector('#goodModal');
                goodPayment.querySelector("[data-modal-body]").innerHTML = response.response;
                goodPayment.classList.add('show');
            },
            error: function (response) {
                console.error(response);
            },
        });
        return;
    }
    //#endregion
    // #paymentDetailsModal
    if (e.target.closest('.good-wrapper')) {
        const params = new URLSearchParams([
            ["type", e.target.closest('.good-wrapper').dataset.type],
            ["id", e.target.closest('.good-wrapper').dataset.id]
        ]);
        request({
            method: 'get',
            url: `/good?${params.toString()}`,
            success: function (response) {
                const paymentDetailsModal = document.querySelector('#paymentDetailsModal');
                paymentDetailsModal.querySelector("[data-modal-body]").innerHTML = response.response;
                paymentDetailsModal.classList.add('show');

                const goodPayment = document.querySelector('#goodModal');
                goodPayment.classList.toggle('hide');
                goodPayment.classList.toggle('show');
            },
            error: function (response) {
                console.error(response);
            },
        });
        return;
    }

    if (e.target.closest('[data-paymentmethod]')) {
        e.target.closest('form[data-form]').querySelector('input[name="paymentMethod"]').value = e.target.closest('[data-paymentmethod]').dataset.paymentmethod;
        e.target.closest('form[data-form]').querySelector('input[name="paymentType"]').value = e.target.closest('[data-paymenttype]').dataset.paymenttype;
        e.target.closest('form[data-form]').requestSubmit();
    }
});

document.addEventListener('submit', (e) => {
    const STEP = {
        STEP_GOOD_DETAILS: 1,
        STEP_CHOOSE_PAYMENT: 2,
    };
    if (e.target.dataset.form !== undefined) {
        e.preventDefault();
        e.stopImmediatePropagation();
        let formData = new FormData(e.target);
        request({
            method: 'post',
            url: `/buy-good`,
            body: formData,
            success: function (response) {
                const responseData = JSON.parse(response.response);
                if (responseData.step !== undefined) {
                    e.target.querySelector('input[name="step"]').value = responseData.step;
                }
                if (responseData.step === STEP.STEP_CHOOSE_PAYMENT) {
                    e.target.querySelector("#details-info").classList.toggle('hidden');
                    e.target.querySelector("#payment-info").classList.toggle('hidden');
                }
                //#region process errors
                if (response.status === 422) {
                    for (const field in responseData) {
                        if (e.target.querySelector(`[name="${field}"]`).parentElement.querySelector('.error')) {
                            e.target.querySelector(`[name="${field}"]`).parentElement.querySelector('.error').innerHTML = responseData[field][0];
                        }
                        iziToast.error({title: 'Ошибка', message: responseData[field][0]});
                    }
                }
                //#endregion
            },
            error: function (response) {
            },
        });
    }
    return false;
});

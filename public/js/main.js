/**
 * Function for making XMLHttp requests
 * @param settings - settings object with keys:
 *  - method - request method
 *  - url - request url
 *  - success - success callback
 *  - error - error callback
 */
async function request (settings) {
    let url = settings.url || '';
    const method = settings.method || 'GET';
    const success = settings.success || function (response) {};
    const error = settings.error || function (response) {};
    let response = await new Promise((resolve, reject) => {
        try {
            let xhr = new XMLHttpRequest();
            xhr.open(method, url, true);
            xhr.send(settings.body ? settings.body : null);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if ((xhr.status >= 200 && xhr.status <= 299) || (xhr.status >= 400 && xhr.status <= 499)) {
                        success(this);
                    }
                    if ((xhr.status >= 500 && xhr.status <= 599)) {
                        error(this);
                    }
                    resolve(true);
                }
            };
        } catch (e) {
            reject(e.toString());
        }
    });
}


/**
 * Copies selected text into buffer
 * @param text
 */
function copyTextToClipboard(text) {
    var textArea = document.createElement("textarea");
    textArea.style.position = 'fixed';
    textArea.style.top = 0;
    textArea.style.left = 0;
    textArea.style.width = '2em';
    textArea.style.height = '2em';
    textArea.style.padding = 0;
    textArea.style.border = 'none';
    textArea.style.outline = 'none';
    textArea.style.boxShadow = 'none';
    textArea.style.background = 'transparent';
    textArea.value = text;
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    try {
        var successful = document.execCommand('copy');
    } catch (err) {

    }
    document.body.removeChild(textArea);
}

const STEP = {
    STEP_GOOD_DETAILS: 1,
    STEP_CHOOSE_PAYMENT: 2,
    STEP_REDIRECT_TO_BUYING: 3,
};

document.addEventListener("DOMContentLoaded", (event) => {
    //#region init circle list
    document.querySelectorAll('.circle-list').forEach((circleList, index) => {
        let circleItems = circleList.querySelectorAll('.circle-item');
        const arc = 2 * Math.PI * (1 / circleItems.length);
        const radius = 50;
        const offset = -1;
        for( let i = 0; i < circleItems.length; ++i ) {
            let circle = circleItems[i];
            const angle = (i + offset) * arc;
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

    if (e.target.closest('[data-back-to]')) {
        e.preventDefault();
        const currentStep = Number(document.querySelector("[name=step]").value);
        var prevStep = document.querySelector("[data-form=good]").querySelector(`[data-step="${currentStep - 1}"]`);
        if (prevStep != null) {
            document.querySelector("[data-form=good]").querySelector(`[data-step="${currentStep}"]`).classList.add('hidden');
            prevStep.classList.remove('hidden');
            document.querySelector("[name=step]").value = currentStep - 1;
        } else {
            var currentGoodCategoryType = document.querySelector("[data-form=good] [name='categoryType']").value;
            if (currentGoodCategoryType == 1 || currentGoodCategoryType == 2) {
                document.querySelector("#goodModal").classList.toggle('show');
            } else {
                document.querySelector("#paymentDetailsModal").classList.toggle('show');
                setTimeout(() => {
                    document.querySelector("#goodModal").classList.toggle('show');
                }, 100);
            }
        }
        return false;
    }

    //#region handle click on open modal link
    if (e.target.attributes['data-load-modal'] && e.target.attributes['data-load-modal'].value) {
        e.preventDefault();
        const modalView = document.querySelector(`#${e.target.attributes['data-load-modal'].value}`);
        request({
            method: 'get',
            url: e.target.href,
            success: function (response) {
                modalView.querySelector("[data-modal-body]").innerHTML = response.response;
                modalView.classList.add('show');
            },
            error: function (response) {
                console.error(response);
            },
        });
        return false;
    }
    //#endregion

    //#region accordion handler
    if (e.target.classList.contains('accordion')) {
        e.target.classList.toggle("active");
        var panel = e.target.nextElementSibling;
        if (panel.style.maxHeight){
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    }
    //#endregion
    //#redion header app name click
    if(e.target.id === 'header_app_name') {
        e.preventDefault();
        copyTextToClipboard(e.target.dataset.ip);
        return false;
    }
    //#endregion
});

document.addEventListener('input', (e) => {
    if (e.target.id === 'good_count') {
        var regex = /[0-9]|\./;
        var pricePerOne = e.target.dataset.priceOne;
        var count = e.target.value;
        if(!regex.test(e.target.value) || !regex.test(pricePerOne) ) {
            pricePerOne = "0";
            count = "0";
        }
        document.querySelector('#total_price').textContent = (Number.parseInt(count) * Number.parseFloat(pricePerOne)) + '';
    }
});

document.addEventListener('change', (e) => {
    if (e.target.dataset['changeHandler'] && typeof window[e.target.dataset['changeHandler']] != 'undefined') {
        window[e.target.dataset['changeHandler']](e.target);
    }
});

document.addEventListener('submit', (e) => {
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
                if (response.status === 200) {
                    if (responseData.error) {
                        iziToast.error({title: 'Ошибка', message: responseData.error});
                    }
                    if (responseData.step !== undefined) {
                        e.target.querySelector('input[name="step"]').value = responseData.step;
                    }
                    if (responseData.step === STEP.STEP_CHOOSE_PAYMENT) {
                        e.target.querySelector("#details-info").classList.toggle('hidden');
                        e.target.querySelector("#payment-info").classList.toggle('hidden');
                    }
                    if (responseData.step === STEP.STEP_REDIRECT_TO_BUYING && responseData.data.pageUrl) {
                        window.location.href = responseData.data.pageUrl;
                    }
                }
                //#region process validation errors
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
                console.error(response);
            },
        });
    }
    return false;
});

/**
 *
 * @param $target
 */
function subscriptionChange ($target) {
    document.querySelector(`[data-id="total_price"]`).textContent = $target.dataset.price;
}

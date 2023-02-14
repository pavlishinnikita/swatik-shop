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
        success(this);
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
        let angle = 360-90, angleOffset = 360 / circleItems.length;
        for( let i = 0; i < circleItems.length; ++i ) {
            let circle = circleItems[i];
            circle.style.transform = `rotate(${angle}deg) translate(${circleList.clientWidth / 2}px) rotate(-${angle}deg)`;
            angle += angleOffset;
        }
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
            url: `/good?${params.toString()}`,
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
        request({
            method: 'get',
            url: `/buy-good`,
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
});

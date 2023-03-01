

import './vendor';
import './libs/tom-select/tom-select.js';

/*--------------------------------------------------------------
# Functions
--------------------------------------------------------------*/
window.select = (el, all = false) => {
    if (el) {
        el = el.trim()
        if (all) {
            return [...document.querySelectorAll(el)]
        } else {
            return document.querySelector(el)
        }
    }
}

window.on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
        if (all) {
            selectEl.forEach(e => e.addEventListener(type, listener))
        } else {
            selectEl.addEventListener(type, listener)
        }
    }
}

/*--------------------------------------------------------------
# debounce
--------------------------------------------------------------
HOW TO USE THIS


*/

window.debounce = (func, wait, immediate) => {
    var timeout;
    return function executedFunction() {
        var context = this;
        var args = arguments;
        var later = function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};

/*--------------------------------------------------------------
# Tabs
--------------------------------------------------------------
let triggerTabList = [].slice.call(document.querySelectorAll('ul[role=tablist]'))
const urlSearchParams = new URLSearchParams(window.location.search);
const params = Object.fromEntries(urlSearchParams.entries());
triggerTabList.forEach(function (triggerEl) {
    if (params.tab) {
        let urlTabParam = params.tab
        let aTabSaved = triggerEl.querySelector(`a[href="#${urlTabParam}"]`)
        if (aTabSaved) {
            bootstrap.Tab.getOrCreateInstance(aTabSaved).show()
        }
    } else {
        let aEls = triggerEl.querySelectorAll('a[data-bs-toggle="tab"]');
        let screen = triggerEl.dataset.screen ?? null;
        aEls.forEach(aEl => {
            aEl.addEventListener('click', () => {
                localStorage.setItem(`${triggerEl.getAttribute('id')}_${screen}`, JSON.stringify(aEl.getAttribute('href')));
            });
        })
        let tabSaved = JSON.parse(localStorage.getItem(`${triggerEl.getAttribute('id')}_${screen}`));
        let aTabSaved = triggerEl.querySelector(`a[href="${tabSaved}"]`)
        if (aTabSaved) {
            bootstrap.Tab.getOrCreateInstance(aTabSaved).show()
        }
    }
})
*/

/*--------------------------------------------------------------
# Tooltip
--------------------------------------------------------------*/
let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

/*--------------------------------------------------------------
# Preload
--------------------------------------------------------------*/
window.preload = (name = 'preload', width = "md") => {
    return `
        <div class="d-flex justify-content-center ${name} mb-5" id="preload-${name}">
          <div class="spinner-border text-primary spinner-border-${width}" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
    `;
}

window.buttonPreload = (text = '') => {
    return `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        ${text}`
}

/*--------------------------------------------------------------
# Axios
--------------------------------------------------------------*/
const axiosFormCath = (error, form) => {
    let errors = error.data.errors;
    if (errors) {
        Object.entries(errors).forEach(([key, value]) => {
            let inputForm = form.querySelector(`input[name="${key}"]`);
            if (inputForm) {
                inputForm.classList.add('is-invalid');
                inputForm.addEventListener('keyup', (e) => {
                    e.target.classList.remove('is-invalid')
                })
            }

            toast(value[0], 'danger');
        });
    }
}

const axiosMessage = (param) => {
    let message = param.response.data.message != ""
        ? param.response.data.message
        : 'Verifique sua conexão com a internet';

    switch (param.response.status) {
        case 404:
            type = 'warning';
            break;
        case 500:
            type = 'error';
            break;

        default:
            type = 'success';
            break;
    }
    toast(message, type);
}

/*--------------------------------------------------------------
# Money
--------------------------------------------------------------*/
window.numberFormat = (number) => {
    return number.toLocaleString('pt-br', {
        minimumFractionDigits: 2
    })
}

window.clearNumber = (number) => {
    if (number == '' || number == null) {
        return 0;
    }
    number = number.toString().replace("R$", "").replace(".", "").replace(".", "");
    number = number.replace(",", ".");
    return number != '' ? numeral(number).value() : 0;
}

/*--------------------------------------------------------------
# Inputs
--------------------------------------------------------------*/
let inputsInValid = document.querySelectorAll('input');
inputsInValid.forEach(function (input) {
    input.addEventListener('keyup', (e) => {
        if (e.target.classList.contains('is-invalid')) {
            if (e.target.value != '') {
                e.target.classList.remove('is-invalid');
            }
        }
    })
})

const addModalConfirmInTheDom = btn => {

    let token = document.querySelector('meta[name="csrf-token"]').content;
    let route = btn.target.dataset.route;
    let text = btn.target.dataset.btnText || 'Deletar';
    let action = btn.target.dataset.action || 'POST';
    let btnClass = btn.target.dataset.btnClass || btn.target.getAttribute('class');
    let btnHtml = btn.target.innerHTML;

    let htmlModalEl = `
        <div class="modal fade effect-scale" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <form id="form-confirm" role="form" class="needs-validation" action="${route}" method="POST">
                        <div class="modal-header">
                            <h6 class="modal-title"></h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <span class="mg-b-0 modal-text-body"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="modal-cancel" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="hidden" name="_token" value="${token}">
                            <input type="hidden" name="_method" value="${action}">
                            <button type="submit" data-btn-text="" class="btn-modal ${btnClass}">
                                ${btnHtml}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>`
    document.body.insertAdjacentHTML('beforeend', htmlModalEl);

    let actionModalEl = new bootstrap.Modal(document.querySelector('#modal-delete'))
    let modalEl = document.querySelector('#modal-delete');
    modalEl.querySelector('.modal-title').innerHTML = text;
    modalEl.querySelector('.modal-text-body').innerHTML = `Tem certeza que deseja ${text}?`;
    if (btn.target.dataset.observation) {
        modalEl.querySelector('.modal-body').insertAdjacentHTML('beforeend',
            `<div class="form-group mt-2">
                <label for="input-observations">Motivo</label>
                <textarea name="observations" type="text" class="form-control" rows="5"
                    id="input-observations" required></textarea>
            </div>`
        );
    }
    actionModalEl.show();
    modalEl.addEventListener('hidden.bs.modal', function (event) {
        modalEl.remove();
    })
}

document.querySelectorAll('[data-js=btn-confirm-submit]').forEach(item => {
    item.addEventListener('click', addModalConfirmInTheDom);
})

const getValueByTypeInput = (e) => {
    if (e.type === 'select-multiple') {
        return e.tomselect.getValue()
    }
    return e.value;
}

/*--------------------------------------------------------------
# Form
--------------------------------------------------------------*/
const resetButtonSubmit = (button, htmlOld) => {
    button.innerHTML = htmlOld;
    button.disabled = false;
}

on('click', '[type="submit"]', async (e) => {
    e.preventDefault();
    e.stopPropagation();
    const button = e.target;
    const form = button.closest('form');
    const buttonHtmlOld = button.innerHTML;
    button.innerHTML = '';
    const buttonDataText = button.dataset.text ?? 'Salvando';

    button.innerHTML = buttonPreload(buttonDataText);
    button.disabled = true;

    if (!form.checkValidity()) {
        form.classList.add('was-validated')
        resetButtonSubmit(button, buttonHtmlOld);
        return;
    }

    if (form.dataset.type) {
        let formValid = await formSubmitApi(form);
        let isValid = formValid;
        if (isValid) {
            form.reset();
        }
        resetButtonSubmit(button, buttonHtmlOld);
        return;
    }

    form.submit();
}, true)

/*--------------------------------------------------------------
# Copy
Use
<button class="btn btn-small btn-info" data-js="copy"
    data-copy="$">
    Copiar Código
</button>
--------------------------------------------------------------*/
let inputsByCopy = document.querySelectorAll('[data-js=copy]');
inputsByCopy.forEach(function (input) {
    input.addEventListener('click', (e) => {
        let text = e.target.dataset.copy;
        copyText(text);
        toast('Texto copiado')
    })
})

function copyText(textToCopy) {
    if (navigator.clipboard && window.isSecureContext) {
        // navigator clipboard api method'
        return navigator.clipboard.writeText(textToCopy);
    } else {
        // text area method
        let textArea = document.createElement("textarea");
        textArea.value = textToCopy;
        // make the textarea out of viewport
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        return new Promise((res, rej) => {
            // here the magic happens
            document.execCommand('copy') ? res() : rej();
            textArea.remove();
        });
    }
}
/*--------------------------------------------------------------
--------------------------------------------------------------*/


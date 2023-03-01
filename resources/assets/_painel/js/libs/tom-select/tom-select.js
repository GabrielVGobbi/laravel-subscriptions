/*
USAGE:


*/


const selectAxOption = (request, valueField) => {
    return {
        valueField: valueField,
        labelField: 'name',
        searchField: 'name',
        preload: true,
        firstUrl: function (query) {
            return `${request}` + encodeURIComponent(query) + '&pageSize=30';
        },
        load: function (query, callback) {
            var url = `${request}?search=` + encodeURIComponent(query) + '&pageSize=30';
            fetch(url)
                .then(response => response.json())
                .then(response => {
                    callback(response.data);
                }).catch(() => {
                    callback();
                });
        },
    }
}

const newSelect = (item) => {
    let createIn = item.dataset.create ? true : false;
    let request = item.dataset.request;
    let valueField = item.dataset.valueField ?? 'id';
    let searchTableCloset = item.dataset.searchTable ?? null;

    let options = {
        persist: false,
        createOnBlur: false,
        create: createIn,
        openOnFocus: true,
        maxOptions: null,
    }

    if (request) {
        options = Object.assign(options, selectAxOption(request, valueField))
    }

    if (item.getAttribute('multiple') != undefined) {
        options = Object.assign(options, {
            plugins: {
                remove_button: {
                    title: 'Remove this item',
                }
            },
        })
    }

    new TomSelect(item, options);

    if (searchTableCloset) {
        let inputSearchTom = item.querySelector(`#${item.id}-ts-control`)
        if (inputSearchTom) {
            inputSearchTom.setAttribute('data-search-table', searchTableCloset);
        }
    }
}

document.querySelectorAll('.t-select').forEach(item => {
    newSelect(item)
})

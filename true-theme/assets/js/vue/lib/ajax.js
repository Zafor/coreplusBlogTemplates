export const ajax = (data) => {
    return $.ajax({
        type: 'POST',
        dataType: 'json',
        url: ajax_object.ajax_url,
        data
    })
}


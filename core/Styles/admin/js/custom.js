function select2Ajax(selector = '.select2-ajax', url = '', method = 'get', callback = false)
{   
    if(!url) url = $(selector).data('url');
    $(selector).select2({
        ajax: {
            url: url,
            method: method,
            dataType: 'json',
            data: (params) =>{
                return {
                    q: params.term,
                    page: params.page
                }
            },
            processResults: (result, params) => {
                params.page = params.page || 1;
                return {
                  results: result.data.data,
                  pagination: {
                    more: (params.page * 10) < result.total
                  }
                };
            },
            complete: (result) => {
                if(callback) callback(result);
            }
        },
        
        width: "100%"
    })
}

function showMessages(messages, type = 'success')
{
    if(messages.length <= 0) return;
    for (const title in messages) {
        if(Array.isArray(messages[title])){
            messages[title].forEach(content => {
                toastr[type](content, title)
            });
        }else{
            toastr[type](messages[title], title);
        }
    }
}

module.exports = {
    select2Ajax,
    showMessages
}
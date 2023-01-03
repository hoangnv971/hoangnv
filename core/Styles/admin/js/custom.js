function select2Ajax(selector = '.select2-ajax', url = '', method = 'get')
{   
    if(!url) url = $(selector).data('url');
    $(selector).select2({
        ajax: {
            url: url,
            method: method,
            dataType: 'json',
            data: (params) =>{
                console.log(params)
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
        },
        
        width: "100%"
    })
}

module.exports = {
    select2Ajax
}
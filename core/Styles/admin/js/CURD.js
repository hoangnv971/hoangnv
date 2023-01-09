function createForm(html, action= '', method='GET', modalId = "#modal-xl"){
    let modal = $(modalId);
    if(modal.length == 0) return;
    modal.find('.modal-body').html(html);
    let form = modal.find('form');
    if(form.length == 0) return;
    modal.modal('show');
    form.attr('id', 'form-submit')
    if(action != '') form.attr('action', action);
    if(method != 'GET') form.attr('method', method);
    return form;
}

function submitForm(buttonID = '#submit-modal', formId= '#form-submit', callback = false){
    let form = $(formId),
        method = form.attr('method'),
        url = form.attr('action'),
        data = form.serialize();
    form.on('submit', (e) => e.preventDefault());
    $(buttonID).on('click', () => {
        $.ajax({
            method: method,
            url: url,
            data: data,
            success: (result) => {
                let msgType = result.msgType ?? undefined;
                custom.showMessages(result.messages, msgType);
            },
            complete: (result) => {
                if(callback) callback(result);
            }
        });
    });
}
function resetModal(table = false, modalID = '#modal-xl')
{
    let modal = $(modalID);
    modal.find('.modal-body').html('');
    if(table) table.ajax.reload();
    return modal;
}


module.exports = {
    createForm,
    submitForm,
    resetModal
};
function createForm(html, action= '', method='GET', modalClass = "#modal-xl"){
    let modal = $(modalClass);
    if(modal.length == 0) return;
    modal.find('.modal-body').html(html);
    let form = modal.find('form');
    if(form.length == 0) return;
    modal.modal('show');
    form.attr('id', 'submit')
    if(action != '') form.attr('action', action);
    if(method != 'GET') form.attr('method', method);
    return form;
}

function submitForm(form = '#submit', modalClass= '#modal-xl'){
    $(modalClass).on('submit', form, function(){
        $.ajax({
            method: 'post',
            url: this.url,
            data: this.form.serialize(),
            success: function () {
                
            }
        });
    });
}
// function resetModal(table = false, modal = '#modal-xl')
// {
//     let modal = $(modal);
//     modal.find('.modal-body').html('');
//     if(table) table.ajax.reload();
//     return modal;
// }


module.exports = {
    createForm,
    submitForm
};
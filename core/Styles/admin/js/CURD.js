
class Curd {
    constructor(html, url, table = null, modal = "#modal-xl"){
        if(table) this.table = table;
        this.modal = $(modal);
        this.html = html;
        this.url = url;
        this.modalBody = this.modal.find('.modal-body');
        this.form = null;
        this.init();
    }
    init(){
        this.modal.modal('show');
        this.modalBody.html(this.html);
        this.form = this.modal.find('form');
        this.action();
        this.reset();
        return this;
    }
    reset(){
        let modalBody = this.modalBody,
            table = this.table;
        this.modal.on('hidden.bs.modal', function(){
            modalBody.html("");
            if(table) table.ajax.reload();
        });
        return this;
    }
    action(){
        this.modal.on('click', '.submit-modal', () => {
            if(!this.form) return this;
            $.ajax({
                method: 'post',
                url: this.url,
                data: this.form.serialize(),
                success: function () {
                    
                }
            });
        });
        return this;
    }
    edit(){
    }
}

module.exports = Curd;
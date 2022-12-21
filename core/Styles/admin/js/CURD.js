class CURD {
	constructor(inputs, modal, action, method = 'GET')
	{
		this.inputs = inputs;
		this.action = action;
		this.method = method;
		this.modal = modal
		this.modalBody = modal.find('.modal-body');
		this.form = "";
	}
	showModal()
	{
		this.modal.modal('show');
		return this;
	}
	hideModal()
	{
		this.modal.modal('hide')
		return this;
	}
	resetModal()
	{
		this.modalBody.html('');
		return this;
	}
	createForm()
	{
		this.form = document.createElement("form");
		this.form.setAttribute('action', this.action);
		this.form.setAttribute('method', this.method);
		this.inputs.forEach((input, key) => {
			let tag = input.tag ? document.createElement(input.tag) : null;
			if(tag){
				if(typeof input.attr != "undefined"){
					this.setAttributeTag(tag, input.attr);
				}
				this.form.appendChild(tag);
			}
		});
		this.modalBody.html(this.form)
		return this;
	}

	setAttributeTag(tag, attributes)
	{
		for(let attr in attributes){
			tag.setAttribute(attr, attributes[attr]);
		}
	}
}
function disableSubmit(form){
	$(form);
	item = form.down('submit');
	$(item);
	item.disabled = true;
}
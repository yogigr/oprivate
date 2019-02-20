module.exports =  {
	methods: {
		notify: function(message, type, timeout=2000) {
			 new Noty({
					text: message,
					type: type,
					timeout: timeout,
					layout: 'bottomRight',
					animation: {
						 open: null,
						 close: null
					}
			 }).show();
		},
		sendErrors: function(errors) {
			 for (var error in errors) {
					this.notify(errors[error][0], 'error', 3000);
			 }
		}
	}
}

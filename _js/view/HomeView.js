var HomeView = Backbone.View.extend
({
		id: 'container',
		tagName: 'div',
		template: tpl.home,

		initialize: function()
		{
			// net zoals in de AppRouter initialize binden we alles samen
			_.bindAll.apply(_, [this].concat(_.functions(this)));
		},

		render: function()
		{
			this.$el.append(this.template());
			return this;
		}
});
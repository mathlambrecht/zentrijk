/* globals HomeView:true */

var AppRouter = Backbone.Router.extend
({
		initialize: function()
		{
			// deze magische code gaat deze klasse met al haar functies binden
			// zo kunnen we ze in de initialize functie kunnen uitvoeren
			_.bindAll.apply(_, [this].concat(_.functions(this)));


		},

		routes:
		{
			// als er geen path in de url zit, laden we standaard de overview in:
			"":"home",
			"grid/:id": "grid",
			"*path":"index"
		},

		render: function()
		{
		},

		home: function()
		{
			this.homeView = new HomeView();
			$("body").prepend(this.homeView.render().$el);
		},

		grid: function(id)
		{
		}
});
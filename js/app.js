(function(){

this["tpl"] = this["tpl"] || {};

this["tpl"]["home"] = Handlebars.template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  


  return "<h1>Test</h1>";
  });

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

/* globals AppRouter:true */

var router = new AppRouter();
// Backbone.history.start() zorgt ervoor dat onze huidige url onze initiële url wordt:
// als we nu dus ergens Backbone.history.navigate oproepen zullen we telkens deze url houden 
// en er iets aan toevoegen, er op 'verder bouwen'. 
Backbone.history.start();

})();
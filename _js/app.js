/* globals AppRouter:true */

var router = new AppRouter();
// Backbone.history.start() zorgt ervoor dat onze huidige url onze initiële url wordt:
// als we nu dus ergens Backbone.history.navigate oproepen zullen we telkens deze url houden 
// en er iets aan toevoegen, er op 'verder bouwen'. 
Backbone.history.start();
var person = Backbone.Model.extend({
		defaults: {
			firstName: 'Hizbul',
			lastName:  'Bahar',
			age		:  25,  
		},

		getName: function() {
			return this.get('firstName') + ' ' + this.get('lastName');
		},
		validate: function(attributes, options) {
			if(attributes.age <= 0) {
				return 'invalide age';
			}
		},
		urlRoot: 'http://php-app.local/backbone/data'
	});

var p1 = new person({id : 1});
p1.fetch({
    success:function(){
        alert(p1.getName() + "\n" + "Age: " + p1.get("age"));
    }
});
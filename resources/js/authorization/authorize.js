import policies from './policies';

export default {
	install (Vue, options){
		// prototype is a way to inheret a class and by doing this we can add an authorize function directly to a component instence  without any injection mechanism
		// Call like this authorize('modify', answer);
		Vue.prototype.authorize = function (policy, model) {
			//make sure user has signed in
			if( ! window.Auth.signedIn) return false;

			if(typeof policy === 'string' && typeof model === 'object') {
				// import current user object and assigned to varriable
				const user = window.Auth.user;

				return policies[policy](user, model);
				// this will be
				// return policies['modify'](user, model);
				// return policies.modify(user, model); or
				// authorize('modify', answer);
			}
		};

		Vue.prototype.signedIn = window.Auth.signedIn;
	}
}

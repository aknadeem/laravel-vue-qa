<template>
	<div class="d-fex flex column vote-controls">
	  <a :title="title('up')" 
	      class="vote-up" :class='classes' @click.prevent='voteUp' > 
	    <i class="fas fa-caret-up fa-3x"></i>
	  </a>
	  <span class="votes-count">{{counts}}</span>
	  <a :title="title('down')" 
	      class="vote-down" :class='classes' @click.prevent='voteDown' ><i class="fas fa-caret-down fa-3x"></i>
	  </a>

	<favourite v-if="name === 'question'" :question='model'></favourite>

	<accept v-else :answer='model'></accept>
	</div>
</template>
<script>
	// Vue.component('favourite', require('./components/Favourite.vue').default);
	// Vue.component('accept', require('./components/Accept.vue').default);
	import Favourite from './Favourite.vue';
	import Accept from './Accept.vue';
	export default {
		props: ['model', 'name'],

		computed: {
			classes () {
				return  this.signedIn ? '' : 'off';
			},

			endPoint () {
				return `/${this.name}s/${this.id}/vote`;
			}
		},

		components: {
			Favourite, //Favourite:Favourite <favourite></favourite>
			Accept//Accept:Accept,
		},

		data () {
			return {
				counts: this.model.votes_count,
				id: this.model.id
			}
		},

		methods: {
			title (voteType) {
				let titles = {
					up: `This ${this.name} is useful`,
					down: `This ${this.name} is useful`
				};
				return titles[voteType];
			},

			voteUp () {
				this._vote(1);
			},

			voteDown () {
				this._vote(-1);
			},

			_vote (vote) {
				if(! this.signedIn) {
					this.$toast.warning(`Please Login to Vote the ${this.name}`, 'Warning', {
						timeout: '3000',
						position: 'bottomLeft'
					});
					return;
				}
				axios.post(this.endPoint, { vote })
				.then(res => {
					console.log(res.data.message);
					this.$toast.success(res.data.message, "Success" ,{
						timeout: 3000,
						position: 'bottomLeft'
					});

					this.counts = res.data.votesCount;
				});
			}
		}
	}
</script>
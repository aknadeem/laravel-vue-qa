<template>
	<a title="Mark to as favorite question (Click again to undo)" :class='classes' @click.prevent='toggle'> 
	<i class="fas fa-star fa-2x"></i>
	<span class="favorite-counts">{{favouriteCount}}</span>
	</a>
</template>

<script>
	export default {
		props: ['question'],	

		data () {
			return {
				isFavourited: this.question.is_favourited,
				favouriteCount: this.question.favourites_count,
				id:this.question.id
			}
		},

		computed: {
			classes () {
				return [
					'favorite' ,'mt-2',
					! this.signedIn ? 'off' : (this.isFavourited ? 'favorited' : '')
				];
			},

			endPoint () {
				return `/questions/${this.id}/favourites` ;
			}
		},

		methods: {
			toggle () {
				if(! this.signedIn) {
					this.$toast.warning('Please login to favoutite this question', 'Warning', {
						timeout: 3000,
						position: 'bottomLeft'
					});
					return;
				}
				this.isFavourited ? this.destroy() : this.create();
			},

			destroy () {
				axios.delete(this.endPoint)
				.then(res => {
					this.favouriteCount--;
					this.isFavourited = false;
				});
			},

			create () {
				axios.post(this.endPoint)
				.then(res => {
					this.favouriteCount++;
					this.isFavourited = true;
				});
			}
		}
	}
</script>
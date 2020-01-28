<script>
	export default {
		props: ['answer'],

		data () {
			return {
				editing: false,
				body: this.answer.body,
				bodyHtml: this.answer.body_html,
				id: this.answer.id,
				questionId: this.answer.question_id,
				beforeEditCache: null
			}
		},

		methods: {
			edit () {
				this.beforeEditCache = this.body; // if cancel button is click then original data show again
				this.editing = true;
			},

			cancel () {
				this.body = this.beforeEditCache; // original data is back 
				this.editing = false;
			},

			update () {
				axios.patch(this.endPoint, {
					body: this.body
				})
				.then(res => {
					console.log(res);
					this.editing = false;
					this.bodyHtml = res.data.body_html;
					alert(res.data.message);
				})
				.catch(err => {
					alert(err.response.data.message);
					//console.log('Something Went Wrong');
				});
			},
			destroy () {
				if(confirm('Are You Sure')) {
					axios.delete(this.endpoint)
					.then(res => {
						$(this.$el).fadeOut(500, () => {
							alert(res.data.message);
						})
					});
				}
			}
		},

		computed: {
			isInvalid () {
				return this.body.length < 10;
			},

			endpoint () {
				return `/questions/${this.questionId}/answers/${this.id}`; 
			}
		}
	}
</script>
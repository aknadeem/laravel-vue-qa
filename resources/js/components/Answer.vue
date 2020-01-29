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
					//alert(res.data.message);
					this.$toast.success(res.data.message, 'Success', { timeout: 3000 });
				})
				.catch(err => {
					//console.log('err.response.data.message'+ err.response.data.message);
					//alert(err.response.data.message);
					this.$toast.error(err.response.data.message, 'Error', {timeout: 3000});
				});
			},
			destroy () {

				this.$toast.question('Are you sure about that?','Confirm', {
			    timeout: 20000,
			    close: false,
			    overlay: true,
			    displayMode: 'once',
			    id: 'question',
			    zindex: 999,
			    title: 'Hey',
			    position: 'center',
			    buttons: [
			        ['<button><b>YES</b></button>',  (instance, toast) => {

						axios.delete(this.endPoint)
						.then(res => {
							$(this.$el).fadeOut(500, () => {
								//alert(res.data.message);
								this.$toast.success(res.data.message, 'Success', { timeout: 3000 });
							})
						});

						instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

			        }, true],
			        ['<button>NO</button>', function (instance, toast) {
			 
			            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
			 
			        }],
			    ],
			    onClosing: function(instance, toast, closedBy){
			        console.info('Closing | closedBy: ' + closedBy);
			    },
			    onClosed: function(instance, toast, closedBy){
			        console.info('Closed | closedBy: ' + closedBy);
			    }
			});

			}
		},

		computed: {
			isInvalid () {
				return this.body.length < 10;
			},

			endPoint () {
				return `/questions/${this.questionId}/answers/${this.id}`; 
			}
		}
	}
</script>
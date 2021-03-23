<template>
	<div>
		<fade>
			<div
				v-if="showModal"
				@click="$emit('overlayClicked')"
				class="fixed top-0 left-0 bg-black bg-opacity-75 w-full h-full"
			></div
		></fade>

		<fade-up> </fade-up>
	</div>
</template>

<script>
import FadeUp from "@/Components/FadeUp";
import Fade from "@/Components/Fade";
export default {
	props: ["show", "showModal"],

	components: {
		FadeUp,
		Fade,
	},

	data() {
		return {
			form: this.$inertia.form({
				name: "",
				username: "",
				password: "",
				password_confirmation: "",
				terms: false,
			}),
		};
	},

	watch: {
		show(value) {
			if (value) {
				this.focus = true;
			} else {
				this.focus = false;
			}
		},
	},

	methods: {
		submit() {
			this.form.post(this.route("register"), {
				onFinish: () =>
					this.form.reset("password", "password_confirmation"),
			});
		},
	},

	mounted() {},
};
</script>
<template>
	<fade-up>
		<div
			v-if="toast && toast.message"
			class="fixed bottom-0 right-0 m-4 rounded-md bg-indigo-400 p-4 shadow-lg w-full max-w-sm flex items-center justify-center"
		>
			<icon class="text-white mr-4" name="check-icon"></icon>
			<p class="text-base text-center text-white">
				{{ toast.message }}
			</p>
		</div>
	</fade-up>
</template>

<script>
import Icon from "@/Components/Icon";
import FadeUp from "@/Components/FadeUp";
export default {
	components: {
		Icon,
		FadeUp,
	},

	props: ["toast"],

	watch: {
		toast(val) {
			if (val) {
				setTimeout(() => {
					this.toast.message = null;
				}, 3000);
			}
		},
	},
};
</script>
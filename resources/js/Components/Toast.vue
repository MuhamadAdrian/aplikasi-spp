<template>
	<fade-up>
		<div
			v-if="toast && toast.message"
			class="fixed top-0 right-0 m-4 rounded-md p-4 shadow-lg w-full max-w-sm flex items-center justify-center"
			:class="[toast.success ? 'bg-indigo-400' : 'bg-red-400']"
		>
			<icon
				class="text-white mr-4"
				:name="[toast.success ? 'check-icon' : 'x-icon']"
			></icon>
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
					this.$page.props.toast = null;
				}, 4000);
			}
		},
	},
};
</script>
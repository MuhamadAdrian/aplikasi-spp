<template>
	<fade>
		<div
			v-if="show"
			class="text-gray-400 whitespace-nowrap transform translate-x-16 bg-white shadow rounded-md p-2 text-xs text-center absolute right-0 z-50"
		>
			{{ text }}
		</div>
	</fade>
</template>

<script>
import Fade from "@/Components/Fade";
export default {
	props: ["text", "show"],

	components: {
		Fade,
	},
};
</script>
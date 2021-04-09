<template>
	<div
		class="bg-white dark:bg-gray-800 bg-color-transition p-5 rounded-md mt-5 md:block shadow-lg"
	>
		<p class="text-sm text-gray-400 font-bold mb-5">{{ title }}</p>
		<slot></slot>
	</div>
</template>

<script>
export default {
	props: {
		title: {
			default: "Title",
		},
	},
};
</script>
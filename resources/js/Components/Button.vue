<template>
	<button
		:type="type"
		class="inline-flex items-center px-4 py-2 bg-indigo-400 hover:bg-indigo-500 dark:bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest dark:hover:bg-indigo-600 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
	>
		<slot />
	</button>
</template>

<script>
export default {
	props: {
		type: {
			type: String,
			default: "submit",
		},
	},
};
</script>

<template>
	<div class="flex items-center mb-3">
		<inertia-link
			:href="href"
			as="button"
			type="button"
			preserve-scroll
			class="rounded-md p-3 bg-indigo-400 hover:bg-indigo-500 transition-colors duration-100 text-white shadow-md"
		>
			<icon name="add-icon"></icon>
		</inertia-link>
		<p class="ml-3 font-semibold"><slot>Tambah Data</slot></p>
	</div>
</template>

<script>
import Icon from "@/Components/Icon";
export default {
	components: {
		Icon,
	},
	props: ["href"],
};
</script>
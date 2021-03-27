<template>
	<div
		v-if="data"
		class="pagination flex items-center justify-end w-full mt-5"
	>
		<div class="information">
			<p class="text-xs text-gray-400">
				<span class="mr-3">Halaman {{ data.current_page }} </span>
				<span>Tampil {{ data.from }} - {{ data.to }} </span>
				<span class="mr-3"> dari {{ data.total }} </span>
			</p>
		</div>
		<div class="button-link">
			<inertia-link
				preserveScroll
				as="button"
				:href="buttonLink.url ? buttonLink.url : '#'"
				v-for="(buttonLink, index) in data.links"
				:disabled="buttonLink.active || buttonLink.url == null"
				:key="index"
				class="inline-block rounded-md text-white px-3 py-2 text-xs mr-1 transition-all duration-200"
				:class="[
					buttonLink.active || buttonLink.url == null
						? 'bg-indigo-200 hover:bg-indigo-300 cursor-not-allowed'
						: 'bg-indigo-400 hover:bg-indigo-500 transform hover:-translate-y-1',
				]"
			>
				<span v-html="buttonLink.label"></span>
			</inertia-link>
		</div>
	</div>
</template>

<script>
export default {
	props: ["data"],
};
</script>
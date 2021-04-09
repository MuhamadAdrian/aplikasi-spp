<template>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div
				class="bg-white dark:bg-gray-800 bg-color-transition md:p-10 p-4 rounded-md shadow-md"
			>
				<form-data></form-data>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import FormData from "@/Pages/Spp/FormData";

export default {
	layout: MainLayout,
	components: {
		FormData,
	},
};
</script>
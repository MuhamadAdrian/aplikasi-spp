<template>
	<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
		<h1 class="md:text-3xl text-xl font-semibold mb-5">Dashboard</h1>
		<div class="inline-flex items-center p-6 bg-white rounded-md shadow-md">
			<div class="text-sm text-gray-400 self-start mr-3">
				<p>Jumlah Siswa</p>
			</div>
			<div class="count text-4xl font-bold">
				<p v-if="jumlah_siswa == null">0</p>
				<p v-else>{{ jumlah_siswa }}</p>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";

export default {
	layout: MainLayout,
	components: {
		MainLayout,
	},

	props: ["jumlah_siswa"],
};
</script>

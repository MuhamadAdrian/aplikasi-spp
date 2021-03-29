<template>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white md:p-10 p-4 rounded-md shadow-md">
				<form-data
					:kelas="kelas"
					:spp="spp"
					:id_kelas="id_kelas"
					:from-current-class="from_current_class"
				></form-data>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import FormData from "@/Pages/Siswa/FormData";

export default {
	layout: MainLayout,
	components: {
		FormData,
	},
	props: ["kelas", "spp", "id_kelas", "from_current_class"],

	mounted() {
		console.log(this.route());
	},
};
</script>
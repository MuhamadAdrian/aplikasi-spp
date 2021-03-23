<template>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white md:p-10 p-4 rounded-md">
				<form-siswa
					:edit="true"
					:data="data"
					:kelas="kelas"
					:spp="spp"
				></form-siswa>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import FormSiswa from "@/Pages/Siswa/FormSiswa";

export default {
	layout: MainLayout,
	components: {
		FormSiswa,
	},
	props: ["kelas", "spp", "data"],
};
</script>
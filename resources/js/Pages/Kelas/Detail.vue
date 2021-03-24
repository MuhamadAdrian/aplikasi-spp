<template>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<h1 class="text-2xl font-bold">Kelas {{ detail.nama_kelas }}</h1>
			<h2 class="text-xl font-semibold">
				{{ detail.kompetensi_keahlian }}
			</h2>

			<div
				class="bg-indigo-400 text-white p-4 rounded-md shadow mt-5 inline-block text-center"
			>
				<p>Jumlah Siswa</p>
				<p class="text-xl font-semibold">
					{{ detail.siswa.data.length }}
				</p>
			</div>

			<h2 class="text-sm font-semibold mt-10">
				Data Siswa {{ detail.nama_kelas }}
			</h2>
			<div class="bg-white p-5 rounded-md shadow-md mt-5">
				<div
					class="flex flex-col md:flex-row md:items-center justify-between mb-3"
				>
					<add-button
						:href="route('siswa.tambah', { id_kelas: detail.id })"
					></add-button>
					<search-input :params="detail.id"></search-input>
				</div>
				<table-siswa :data="detail.siswa"></table-siswa>
				<pagination :data="detail.siswa"></pagination>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import TableSiswa from "@/Pages/Siswa/TableSiswa";
import Pagination from "@/Components/Pagination";
import AddButton from "@/Components/AddButton";
import SearchInput from "@/Components/SearchInput";

export default {
	layout: MainLayout,

	components: {
		TableSiswa,
		Pagination,
		AddButton,
		SearchInput,
	},

	props: ["detail"],
};
</script>
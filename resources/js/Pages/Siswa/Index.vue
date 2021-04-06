<template>
	<div>
		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<h1 class="text-2xl font-bold ml-3">Data Siswa</h1>

				<div
					class="main-content bg-white p-5 rounded-md shadow-md mt-5"
				>
					<div
						class="flex flex-col md:flex-row md:items-center justify-between mb-3 md:relative sticky z-20 top-0 left-0 md:py-0 bg-white py-4"
					>
						<add-button :href="route('siswa.tambah')"></add-button>
						<search-input
							placeholder="Cari Nama / NISN / NIS"
						></search-input>
					</div>
					<!-- table -->
					<table-data :data="siswa"></table-data>
					<pagination :data="siswa"></pagination>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import Pagination from "@/Components/Pagination";
import TableData from "@/Pages/Siswa/TableData";
import AddButton from "@/Components/AddButton";
import SearchInput from "@/Components/SearchInput";

export default {
	layout: MainLayout,
	components: {
		Pagination,
		TableData,
		AddButton,
		SearchInput,
	},
	props: ["siswa"],
};
</script>
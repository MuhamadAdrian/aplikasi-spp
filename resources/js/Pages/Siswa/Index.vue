<template>
	<div>
		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<h1 class="text-2xl font-bold">Data Siswa</h1>

				<div
					class="main-content bg-white p-5 rounded-md shadow-md mt-5"
				>
					<div
						class="flex flex-col md:flex-row md:items-center justify-between mb-3"
					>
						<add-button :href="route('siswa.tambah')"></add-button>
						<search-input></search-input>
					</div>
					<!-- table -->
					<table-siswa :data="siswa"></table-siswa>
					<pagination :data="siswa"></pagination>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import Pagination from "@/Components/Pagination";
import TableSiswa from "@/Pages/Siswa/TableSiswa";
import AddButton from "@/Components/AddButton";
import SearchInput from "@/Components/SearchInput";

export default {
	layout: MainLayout,
	components: {
		MainLayout,
		Pagination,
		TableSiswa,
		AddButton,
		SearchInput,
	},
	props: ["siswa"],
};
</script>
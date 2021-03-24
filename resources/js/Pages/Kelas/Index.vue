<template>
	<div>
		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<h1 class="text-2xl font-bold">Data Kelas</h1>

				<div class="bg-white p-5 rounded-md shadow-md mt-5">
					<div
						class="flex flex-col md:flex-row md:items-center justify-between mb-3"
					>
						<add-button :href="route('kelas.tambah')"></add-button>
						<search-input
							placeholder="Cari Nama Kelas, cont : 'rpl 1'"
						></search-input>
					</div>
					<!-- table -->
					<table-kelas :data="kelas"></table-kelas>
					<pagination :data="kelas"></pagination>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import Pagination from "@/Components/Pagination";
import TableKelas from "@/Pages/Kelas/TableKelas";
import AddButton from "@/Components/AddButton";
import SearchInput from "@/Components/SearchInput";

export default {
	layout: MainLayout,
	components: {
		MainLayout,
		Pagination,
		TableKelas,
		AddButton,
		SearchInput,
	},
	props: ["kelas"],
};
</script>
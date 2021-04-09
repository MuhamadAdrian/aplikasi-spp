<template>
	<div>
		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<h1 class="text-2xl dark:text-gray-400 font-bold ml-3">
					Data Kelas
				</h1>

				<div
					class="bg-white dark:bg-gray-800 dark:text-gray-300 bg-color-transition p-5 rounded-md shadow-md mt-5"
				>
					<div
						class="flex flex-col md:flex-row md:items-center justify-between mb-3"
					>
						<add-button :href="route('kelas.tambah')"></add-button>
						<search-input
							placeholder="Cari Nama Kelas, cont : 'rpl 1'"
						></search-input>
					</div>
					<!-- table -->
					<table-data :data="kelas"></table-data>
					<pagination :data="kelas"></pagination>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import Pagination from "@/Components/Pagination";
import TableData from "@/Pages/Kelas/TableData";
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
	props: ["kelas"],
};
</script>
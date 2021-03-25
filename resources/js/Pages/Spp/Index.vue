<template>
	<div>
		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<h1 class="text-2xl font-bold">Data Spp</h1>

				<div class="bg-white p-5 rounded-md shadow-md mt-5">
					<div
						class="flex flex-col md:flex-row md:items-center justify-between mb-3"
					>
						<add-button :href="route('spp.tambah')"></add-button>
						<search-input
							placeholder="Cari tahun spp"
						></search-input>
					</div>
					<!-- table -->
					<table-data :data="spp"></table-data>
					<pagination :data="spp"></pagination>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import Pagination from "@/Components/Pagination";
import TableData from "@/Pages/Spp/TableData";
import AddButton from "@/Components/AddButton";
import SearchInput from "@/Components/SearchInput";

export default {
	layout: MainLayout,
	components: {
		MainLayout,
		Pagination,
		TableData,
		AddButton,
		SearchInput,
	},
	props: ["spp"],
};
</script>
<template>
	<div>
		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<h1 class="text-2xl font-bold ml-3 dark:text-gray-400">
					Cari Siswa
				</h1>

				<div
					class="bg-white dark:bg-gray-800 dark:text-gray-300 p-5 rounded-md shadow-md mt-5"
				>
					<div
						class="flex flex-col md:flex-row md:items-center justify-between mb-3"
					>
						<search-input
							class="w-full"
							:w-full="true"
							placeholder="Cari Nama Siswa / NISN / NIS"
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
import TableData from "@/Pages/Pembayaran/TableData";
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
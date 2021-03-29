<template>
	<div>
		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<h1 class="text-2xl font-bold">Histori Pembayaran</h1>

				<div class="bg-white p-5 rounded-md shadow-md mt-5">
					<div
						class="flex flex-col md:flex-row md:items-center justify-between mb-3"
					>
						<add-button :href="route('pembayaran')"></add-button>
					</div>
					<!-- table -->
					<table-data :data="histori"></table-data>
					<pagination :data="histori"></pagination>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import Pagination from "@/Components/Pagination";
import TableData from "@/Pages/Histori/TableData";
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
	props: ["histori"],
};
</script>
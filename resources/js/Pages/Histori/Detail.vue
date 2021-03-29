<template>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<h2 class="text-sm font-semibold mt-10">Histori Pembayaran</h2>
			<div class="bg-white p-5 rounded-md shadow-md mt-5">
				<div
					class="flex flex-col md:flex-row md:items-center justify-between mb-3"
				>
					<add-button
						:href="
							route('pembayaran.tambah', {
								nisn: route().params.nisn,
							})
						"
					></add-button>
					<!--<search-input :params="detail.id"></search-input>-->
				</div>
				<table-data :data="detail"></table-data>
				<pagination :data="detail"></pagination>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import TableData from "@/Pages/Histori/TableData";
import Pagination from "@/Components/Pagination";
import AddButton from "@/Components/AddButton";
import SearchInput from "@/Components/SearchInput";
import Icon from "@/Components/Icon";

export default {
	layout: MainLayout,

	components: {
		TableData,
		Pagination,
		AddButton,
		SearchInput,
		Icon,
	},

	props: ["detail", "jumlah_siswa"],

	mounted() {
		console.log(this.detail);
	},
};
</script>
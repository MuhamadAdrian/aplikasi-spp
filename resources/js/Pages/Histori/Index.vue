<template>
	<div>
		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<h1 class="text-2xl font-bold ml-3">Histori Pembayaran</h1>

				<div
					class="bg-white p-5 rounded-md shadow-md md:inline-block block mt-5"
				>
					<form @submit.prevent="search">
						<div
							class="flex md:items-center items-end md:flex-row flex-col"
						>
							<input
								id="nisn"
								type="text"
								placeholder="Cari Histori dengan NISN"
								class="border-gray-300 md:w-72 w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
								v-model="nisn"
								autocomplete="nisn"
								name="nisn"
							/>
							<select
								required
								v-model="selected_tahun"
								class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
							>
								<option selected value="semua">
									Semua Tahun
								</option>
								<option
									v-for="(t, index) in tahun"
									:key="index"
									:value="t.tahun_dibayar"
								>
									{{ t.tahun_dibayar }}
								</option>
							</select>
							<button
								type="submit"
								class="bg-indigo-400 rounded-md hover:bg-indigo-500 transition-colors duration-200 p-3 text-white"
							>
								<icon name="search-icon"></icon>
							</button>
						</div>
					</form>
				</div>
				<div
					v-if="histori"
					class="bg-white p-5 rounded-md shadow-md mt-5"
				>
					<!-- table -->
					<table-data :data="histori"></table-data>
					<pagination
						:data="histori"
						:tahun="route().params.tahun"
						:nisn="route().params.nisn"
					></pagination>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import Pagination from "@/Components/Pagination";
import TableData from "@/Pages/Histori/TableData";
import SearchInput from "@/Components/SearchInput";
import Icon from "@/Components/Icon";

export default {
	layout: MainLayout,
	components: {
		Pagination,
		TableData,
		SearchInput,
		Icon,
	},
	props: ["histori", "tahun"],

	data() {
		return {
			nisn: route().params.nisn ? route().params.nisn : "",
			selected_tahun: route().params.tahun
				? route().params.tahun
				: "semua",
		};
	},

	methods: {
		search() {
			this.$inertia.get(
				route("histori.show", {
					histori_pembayaran: this.nisn,
					tahun: this.selected_tahun,
				})
			);
		},
	},
};
</script>
<template>
	<div>
		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="overflow-hidden shadow-sm sm:rounded-lg">
					<h1 class="text-2xl font-bold ml-3 dark:text-gray-400">
						Cetak Laporan
					</h1>
					<div
						class="p-6 bg-white dark:bg-gray-800 bg-color-transition border-gray-200 mt-10 relative"
					>
						<div
							class="flex md:items-center items-end md:flex-row flex-col"
						>
							<select
								required
								v-model="selected_tahun"
								class="dark:focus:border-indigo-500 dark:focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 bg-color-transition dark:text-gray-300 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
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
							<select
								required
								v-model="selected_bulan"
								class="dark:focus:border-indigo-500 dark:focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 bg-color-transition dark:text-gray-300 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
							>
								<option selected value="semua">
									Semua Bulan
								</option>
								<option
									v-for="(b, index) in bulan"
									:key="index"
									:value="b"
								>
									{{ b }}
								</option>
							</select>
							<a
								:href="`/generate-laporan/generate?tahun=${selected_tahun}&bulan=${selected_bulan}`"
								target="blank"
								class="bg-indigo-400 rounded-md hover:bg-indigo-500 transition-colors duration-200 p-3 text-white"
							>
								<icon name="search-icon"></icon>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import months from "@/Helper/month.js";
import Icon from "@/Components/Icon";

export default {
	layout: MainLayout,
	components: {
		Icon,
	},

	props: ["tahun"],

	data() {
		return {
			bulan: months,
			selected_tahun: "semua",
			selected_bulan: "semua",
		};
	},

	methods: {
		search() {},
	},
};
</script>
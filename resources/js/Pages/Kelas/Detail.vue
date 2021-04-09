<template>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<header class="flex justify-between items-start">
				<div class="title">
					<h1 class="text-2xl font-bold dark:text-gray-300">
						Kelas {{ detail.nama_kelas }}
					</h1>
					<h2 class="text-xl font-semibold dark:text-gray-300">
						{{ detail.kompetensi_keahlian }}
					</h2>
				</div>

				<div
					class="bg-white dark:bg-gray-800 dark:text-gray-400 text-gray-600 px-8 py-4 rounded-md text-center flex items-center"
				>
					<icon name="big-siswa-icon"></icon>
					<div class="text ml-3">
						<p class="text-sm">Jumlah Siswa</p>
						<p class="text-2xl font-semibold text-indigo-400">
							{{ jumlah_siswa }}
						</p>
					</div>
				</div>
			</header>

			<h2 class="text-sm font-semibold mt-10 dark:text-gray-300">
				Data Siswa {{ detail.nama_kelas }}
			</h2>
			<div
				class="bg-white dark:bg-gray-800 bg-color-transition dark:text-gray-300 p-5 rounded-md shadow-md mt-5"
			>
				<div
					class="flex flex-col md:flex-row md:items-center justify-between mb-3"
				>
					<add-button
						:href="route('siswa.tambah', { id_kelas: detail.id })"
					></add-button>
					<search-input :params="detail.id"></search-input>
				</div>
				<table-data :data="detail.siswa"></table-data>
				<pagination :data="detail.siswa"></pagination>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import TableData from "@/Pages/Siswa/TableData";
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
};
</script>
<template>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<h2
				class="rounded-md mb-5 text-gray-400 text-sm font-semibold ml-3"
			>
				Informasi Siswa
			</h2>
			<div class="bg-white p-5 rounded-md shadow-md mt-5">
				<table class="table-auto w-full mx-2">
					<tr class="h-10">
						<td class="font-semibold">Nama</td>
						<td>:</td>
						<td>{{ siswa.nama }}</td>
					</tr>
					<tr class="h-10">
						<td class="font-semibold">Kelas</td>
						<td>:</td>
						<td>{{ siswa.kelas.nama_kelas }}</td>
					</tr>
					<tr class="h-10">
						<td class="font-semibold">Kompetensi Keahlian</td>
						<td>:</td>
						<td>{{ siswa.kelas.kompetensi_keahlian }}</td>
					</tr>
					<tr class="h-10">
						<td class="font-semibold">SPP</td>
						<td>:</td>
						<td>{{ siswa.spp.tahun }} - {{ siswa.spp.nominal }}</td>
					</tr>
					<tr class="h-10">
						<td class="font-semibold">NISN</td>
						<td>:</td>
						<td>{{ siswa.nisn }}</td>
					</tr>
					<tr class="h-10">
						<td class="font-semibold">NIS</td>
						<td>:</td>
						<td>{{ siswa.nis }}</td>
					</tr>
					<tr class="h-10">
						<td class="font-semibold">No Telepon</td>
						<td>:</td>
						<td>{{ siswa.no_telp }}</td>
					</tr>
					<tr class="h-10">
						<td class="font-semibold">Alamat</td>
						<td>:</td>
						<td>{{ siswa.alamat }}</td>
					</tr>
				</table>
				<inertia-link
					as="button"
					:href="route('siswa', { search: siswa.nisn })"
					class="hover:bg-indigo-50 transition-colors duration-200 text-indigo-600 ml-auto block mt-5 text-sm py-2 px-3 rounded-md"
					>Ke Halaman Siswa</inertia-link
				>
			</div>
			<h2 class="text-sm font-semibold mt-10 ml-3 text-gray-400">
				Histori Pembayaran Siswa
			</h2>
			<div class="bg-white p-5 rounded-md shadow-md mt-5">
				<div
					class="flex flex-col md:flex-row md:items-center justify-between mb-3"
				>
					<add-button
						:href="
							route('pembayaran.tambah', {
								nisn: siswa.nisn,
							})
						"
						>Entri Pembayaran</add-button
					>
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

	props: ["detail", "siswa"],

	mounted() {
		console.log(this.detail);
	},
};
</script>
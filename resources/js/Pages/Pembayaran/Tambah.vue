<template>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white md:p-10 p-4 rounded-md">
				<form-data :data="data.siswa"></form-data>
			</div>
			<div class="bg-white mt-10 md:p-10 p-4 rounded-md">
				<h1>Informasi Pembayaran Siswa</h1>
				<table class="table-auto w-full text-base">
					<thead class="rounded-md">
						<tr class="h-14">
							<th>No</th>
							<th>NISN</th>
							<th>Petugas</th>
							<th>Tanggal Bayar</th>
							<th>Bulan</th>
							<th>Tahun</th>
							<th>SPP</th>
							<th>Jumlah</th>
							<th>Tunggakan</th>
						</tr>
					</thead>
					<tbody
						v-if="historiPembayaran"
						class="text-center mt-5 text-sm"
					>
						<tr
							v-for="(histori, index) in historiPembayaran.data"
							:key="index"
							class="border-b border-gray-300"
						>
							<td class="font-bold">{{ index + number }}</td>
							<td>{{ histori.siswa.nisn }}</td>
							<td>{{ histori.petugas.nama_petugas }}</td>
							<td>{{ histori.tgl_bayar }}</td>
							<td>{{ histori.bulan_dibayar }}</td>
							<td>{{ histori.tahun_dibayar }}</td>
							<td>
								{{ histori.spp.tahun }} -
								{{ histori.spp.nominal }}
							</td>
							<td>{{ histori.jumlah_dibayar }}</td>
							<td>{{ histori.tunggakan }}</td>
							<td
								class="flex justify-center items-center h-12"
							></td>
						</tr>
					</tbody>
				</table>
				<pagination :data="historiPembayaran"></pagination>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import FormData from "@/Pages/Pembayaran/FormData";
import Pagination from "@/Components/Pagination";

export default {
	layout: MainLayout,
	components: {
		FormData,
		Pagination,
	},

	computed: {
		number() {
			return (
				(this.historiPembayaran.current_page - 1) *
					this.historiPembayaran.per_page +
				1
			);
		},
	},

	props: ["data", "historiPembayaran"],

	mounted() {
		console.log(this.historiPembayaran);
	},
};
</script>
<template>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white md:p-10 p-4 rounded-md shadow-md">
				<form-data :spp="spp" :data="data.siswa"></form-data>
			</div>
			<h1 class="font-semibold text-sm mb-5 mt-16 text-gray-400 ml-3">
				3 Pembayaran Terakhir Siswa
			</h1>
			<div class="bg-white md:p-10 p-4 rounded-md shadow-md">
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
					<tbody class="text-center mt-5 text-sm">
						<tr
							v-for="(histori, index) in historiPembayaran"
							:key="index"
							class="border-b border-gray-300"
						>
							<td class="font-bold">{{ ++index }}</td>
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
					<tbody
						v-if="historiPembayaran == null"
						class="text-center mt-5 text-sm"
					>
						<tr>
							<td>Test</td>
						</tr>
					</tbody>
				</table>
				<p
					v-if="historiPembayaran.length == 0"
					class="text-center my-10"
				>
					Tidak ada data
				</p>
				<inertia-link
					v-if="historiPembayaran.length > 0"
					as="button"
					:href="route('histori.show', route().params.nisn)"
					class="px-3 py-2 rounded-md bg-indigo-400 hover:bg-indigo-500 text-white text-sm ml-auto mt-4 block"
				>
					Tampilkan Semua
				</inertia-link>
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

	props: ["data", "historiPembayaran", "spp"],

	mounted() {
		console.log(this.historiPembayaran);
	},
};
</script>
<template>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white md:p-10 p-4 rounded-md">
				<form-data :data="data.siswa"></form-data>
			</div>
			<h1 class="font-semibold text-sm mb-5 mt-16 text-gray-500">
				3 Pembayaran Terakhir Siswa
			</h1>
			<div class="bg-white md:p-10 p-4 rounded-md">
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

	props: ["data", "historiPembayaran"],
};
</script>
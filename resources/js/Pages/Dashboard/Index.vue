<template>
	<div class="py-12 px-4 md:px-0">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<h1 class="text-2xl font-bold ml-3 mb-5 dark:text-gray-400">
				Dashboard
			</h1>
			<div
				class="grid md:grid-cols-4 gap-5 sm:grid-cols-2 grid-cols-1 grid-flow-row-dense"
			>
				<div class="col-span-1">
					<div
						class="block p-6 relative overflow-hidden bg-gradient-to-br from-indigo-400 to-indigo-600 text-white rounded-md shadow-lg"
					>
						<div class="text-sm text-gray-100 self-start mr-3">
							<p>Jumlah Siswa</p>
						</div>
						<div class="count text-4xl font-bold">
							<p v-if="jumlah_siswa == null">0</p>
							<p v-else>{{ jumlah_siswa }}</p>
						</div>
						<img
							class="absolute -right-5 opacity-20 top-0 w-32"
							src="/images/person.svg"
							alt=""
						/>
					</div>
				</div>
				<div class="col-span-1">
					<div
						class="block relative overflow-hidden items-center p-6 bg-gradient-to-br from-yellow-500 text-white to-red-400 rounded-md shadow-lg"
					>
						<div class="text-sm text-gray-100 self-start mr-3">
							<p>Jumlah Kelas</p>
						</div>
						<div class="count text-4xl font-bold">
							<p v-if="jumlah_kelas == null">0</p>
							<p v-else>{{ jumlah_kelas }}</p>
						</div>
						<img
							class="absolute -right-5 opacity-20 top-0 w-32"
							src="/images/school.svg"
							alt=""
						/>
					</div>
				</div>
				<div class="col-span-1">
					<div
						class="block relative overflow-hidden items-center p-6 bg-gradient-to-br from-green-400 to-green-600 text-white rounded-md shadow-lg"
					>
						<div class="text-sm text-gray-100 self-start mr-3">
							<p>Jumlah Petugas</p>
						</div>
						<div class="count text-4xl font-bold">
							<p v-if="jumlah_petugas == null">0</p>
							<p v-else>{{ jumlah_petugas }}</p>
						</div>
						<img
							class="absolute -right-5 opacity-20 top-0 w-32"
							src="/images/admin-white.svg"
							alt=""
						/>
					</div>
				</div>
				<div class="col-span-1">
					<div
						class="block relative overflow-hidden items-center p-6 bg-gradient-to-br from-blue-400 to-blue-600 text-white rounded-md shadow-lg"
					>
						<div class="text-sm text-gray-100 self-start mr-3">
							<p>Jumlah Spp</p>
						</div>
						<div class="count text-4xl font-bold">
							<p v-if="jumlah_spp == null">0</p>
							<p v-else>{{ jumlah_spp }}</p>
						</div>
						<img
							class="absolute -right-5 opacity-20 top-0 w-32"
							src="/images/payments.svg"
							alt=""
						/>
					</div>
				</div>
				<div class="md:col-span-4 col-span-1">
					<transaksi-chart
						title="Transaksi SPP"
						:data="data_transaksi_per_bulan"
					></transaksi-chart>
				</div>
				<div class="md:col-span-3 col-span-1">
					<spp-chart title="Data SPP" :data="data_spp"></spp-chart>
				</div>
				<div class="col-span-1">
					<p class="text-gray-400 text-sm font-bold mb-5 mt-5">
						Pemasukan Bulan Ini
					</p>
					<div
						class="p-4 rounded-md bg-blue-400 text-white mb-3 shadow-lg"
					>
						<p class="mb-3 font-bold">
							{{ pemasukan.bulan.pemasukan.bulan }}
						</p>
						<p
							class="text-2xl font-bold text-gray-100 bg-blue-300 p-2 rounded-xl inline-block"
						>
							{{ currency(pemasukan.bulan.pemasukan.nilai) }}
						</p>
					</div>
					<div
						class="p-4 rounded-md bg-blue-400 text-white mb-3 shadow-lg"
					>
						<p class="mb-3 font-bold">
							{{ pemasukan.tahun.pemasukan.tahun }}
						</p>
						<p
							class="text-2xl font-bold text-gray-100 bg-blue-300 p-2 rounded-xl inline-block"
						>
							{{ currency(pemasukan.tahun.pemasukan.nilai) }}
						</p>
					</div>
				</div>
				<div class="md:col-span-2 col-span-1">
					<p class="text-gray-400 text-sm font-bold mb-5">
						Entri Pembayaran Terakhir
					</p>
					<div
						v-for="(his, index) in histori"
						:key="index"
						class="p-4 shadow-lg rounded-md bg-gradient-to-br from-indigo-400 to-indigo-500 text-white mb-3 flex md:flex-row items-center justify-between"
					>
						<p
							class="text-xs text-gray-100 bg-indigo-300 p-2 rounded-xl inline-block"
						>
							{{ his.humanedTglBayar }}
						</p>
						<div>
							<p class="text-base text-right text-gray-100">
								Atas nama : {{ his.siswa.nama }}
							</p>
							<p class="text-base text-right text-gray-100">
								Oleh : {{ his.petugas.nama_petugas }}
							</p>
						</div>
					</div>
				</div>
				<div class="md:col-span-2 col-span-1">
					<kelas-chart
						title="Data siswa berdasar kelas"
						:data="kelas"
					></kelas-chart>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import SppChart from "./Chart/SppChart";
import KelasChart from "./Chart/KelasChart";
import TransaksiChart from "./Chart/TransaksiChart";
import currency from "@/Helper/currency";
export default {
	layout: MainLayout,

	components: {
		SppChart,
		KelasChart,
		TransaksiChart,
	},

	mixins: [currency],

	props: [
		"jumlah_siswa",
		"jumlah_petugas",
		"jumlah_kelas",
		"jumlah_spp",
		"data_spp",
		"kelas",
		"histori",
		"pemasukan",
		"data_transaksi_per_bulan",
	],
};
</script>

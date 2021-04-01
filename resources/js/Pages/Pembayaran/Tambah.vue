<template>
	<div class="md:py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white md:p-10 p-4 md:rounded-md md:shadow-md">
				<form-data :spp="spp" :data="data.siswa"></form-data>
			</div>
			<div v-if="historiPembayaran.length">
				<div class="flex justify-between items-center mt-16">
					<h1 class="font-semibold text-sm mb-2 text-gray-400 ml-5">
						4 Pembayaran Terakhir Siswa
					</h1>
					<inertia-link
						as="button"
						:href="route('histori.show', data.siswa.nisn)"
						class="bg-indigo-400 rounded-md px-3 py-2 text-white hover:bg-indigo-500 text-sm"
					>
						Lihat Semuanya...
					</inertia-link>
				</div>

				<div
					class="grid md:grid-cols-2 grid-cols-1 grid-flow-coll gap-7 p-4"
				>
					<div
						v-for="histori in historiPembayaran"
						:key="histori.id"
						class="col-span-1"
					>
						<div
							class="tgl text-xs md:text-sm md:p-2 text-gray-100 bg-indigo-400 rounded-md p-1 mb-1"
						>
							<p class="ml-2">
								{{ histori.tgl_bayar }}
							</p>
						</div>
						<div
							class="detail bg-white rounded-md shadow-md md:p-4 p-2"
						>
							<div
								class="header p-1 md:p-2 mx-2 flex items-center justify-between"
							>
								<p class="text-xs md:text-sm text-gray-500">
									Spp bulan {{ histori.bulan_dibayar }}
								</p>
								<p class="text-xs md:text-sm text-gray-500">
									Spp tahun {{ histori.tahun_dibayar }}
								</p>
							</div>

							<div
								class="main-content grid grid-cols-2 p-4 text-base"
							>
								<div
									class="col-span-1 mt-2 font-semibold text-gray-600"
								>
									Nama Siswa
								</div>
								<div class="col-span-1 mt-2 text-gray-600">
									{{ histori.siswa.nama }}
								</div>
								<div
									class="col-span-1 mt-2 font-semibold text-gray-600"
								>
									Nama Petugas
								</div>
								<div class="col-span-1 mt-2 text-gray-600">
									{{ histori.petugas.nama_petugas }}
								</div>
								<div
									class="col-span-1 mt-2 font-semibold text-gray-600"
								>
									Yang Harus Dibayar
								</div>
								<div class="col-span-1 mt-2 text-gray-600">
									{{ currency(histori.jumlah_dibayar) }}
								</div>
								<div
									class="col-span-1 mt-2 font-semibold text-gray-600"
								>
									Uang Masuk
								</div>
								<div class="col-span-1 mt-2 text-gray-600">
									{{ currency(histori.jumlah_masuk) }}
								</div>
								<div
									class="col-span-1 mt-2 font-semibold text-gray-600"
								>
									Status
								</div>
								<div class="col-span-1 mt-2 text-gray-600">
									<span
										:class="[
											histori.status == 'lunas'
												? 'bg-green-400'
												: 'bg-yellow-400',
										]"
										class="px-2 py-1 rounded-md text-white"
									>
										{{ histori.status }}
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import FormData from "@/Pages/Pembayaran/FormData";
import Pagination from "@/Components/Pagination";
import currency from "@/Helper/currency.js";

export default {
	layout: MainLayout,
	components: {
		FormData,
		Pagination,
	},

	mixins: [currency],

	props: ["data", "historiPembayaran", "spp"],

	mounted() {
		console.log(this.historiPembayaran);
	},
};
</script>
<template>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="information md:block hidden">
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
							<td v-if="siswa.kelas">
								{{ siswa.kelas.nama_kelas }}
							</td>
							<td v-else>-</td>
						</tr>
						<tr class="h-10">
							<td class="font-semibold">Kompetensi Keahlian</td>
							<td>:</td>
							<td v-if="siswa.kelas">
								{{ siswa.kelas.kompetensi_keahlian }}
							</td>
							<td v-else>-</td>
						</tr>
						<tr class="h-10">
							<td class="font-semibold">SPP</td>
							<td>:</td>
							<td v-if="siswa.spp">
								{{ siswa.spp.tahun }} - {{ siswa.spp.nominal }}
							</td>
							<td v-else>
								<inertia-link
									:href="route('siswa.edit', siswa.nisn)"
									class="text-sm text-indigo-500 underline"
									>Update Data Siswa</inertia-link
								>
							</td>
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
						v-if="$page.props.auth.user.level"
						as="button"
						:href="route('siswa', { search: siswa.nisn })"
						class="hover:bg-indigo-50 transition-colors duration-200 text-indigo-600 ml-auto block mt-5 text-sm py-2 px-3 rounded-md"
						>Ke Data Siswa</inertia-link
					>
				</div>
			</div>
			<h2 class="text-sm font-semibold md:mt-10 ml-8 text-gray-400">
				Histori Pembayaran Siswa
			</h2>
			<!-- desktop -->
			<div class="bg-white p-5 rounded-md shadow-md mt-5 md:block hidden">
				<div
					class="flex flex-col md:flex-row md:items-center justify-between mb-3"
				>
					<add-button
						v-if="$page.props.auth.user.level"
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
			<!--dekstop-->

			<!--mobile-->
			<div class="p-4 md:hidden">
				<div
					v-for="histori in detail.data"
					:key="histori.id"
					class="flex flex-col mb-5"
				>
					<div
						class="tgl text-xs text-gray-100 bg-indigo-400 rounded-md p-1 mb-1"
					>
						<p class="ml-2">
							{{ histori.tgl_bayar }}
						</p>
					</div>
					<div class="detail bg-white rounded-md shadow-md text-sm">
						<div
							class="header px-2 py-1 flex items-center justify-between"
						>
							<p class="text-xs text-gray-500">
								Spp bulan {{ histori.bulan_dibayar }}
							</p>
							<p class="text-xs text-gray-500">
								Spp tahun {{ histori.tahun_dibayar }}
							</p>
						</div>

						<div class="main-content grid grid-cols-2 p-4">
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
								{{ histori.jumlah_dibayar }}
							</div>
							<div
								class="col-span-1 mt-2 font-semibold text-gray-600"
							>
								Uang Masuk
							</div>
							<div class="col-span-1 mt-2 text-gray-600">
								{{ histori.jumlah_masuk }}
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
			<!--mobile-->
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
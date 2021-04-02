<template>
	<div class="overflow-x-auto">
		<table
			class="table-auto w-full text-base whitespace-nowrap overflow-x-auto"
		>
			<thead class="rounded-md">
				<tr class="h-14">
					<th>No</th>
					<th>Tanggal Bayar</th>
					<th>Atas Nama</th>
					<th>Bulan</th>
					<th>Tahun</th>
					<th>Petugas</th>
					<th>Nominal Dibayar</th>
					<th>Uang Masuk</th>
					<th>Tunggakan</th>
					<th>Status</th>
					<th v-if="$page.props.auth.user.level">Aksi</th>
				</tr>
			</thead>
			<tbody class="text-center mt-5 text-sm">
				<tr
					v-for="(histori, index) in data.data"
					:key="index"
					class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200 h-12"
				>
					<td class="font-bold">{{ index + number }}</td>
					<td>{{ histori.tgl_bayar }}</td>
					<td>{{ histori.siswa.nama }}</td>
					<td>{{ histori.bulan_dibayar }}</td>
					<td>{{ histori.tahun_dibayar }}</td>
					<td>{{ histori.petugas.nama_petugas }}</td>
					<td>{{ currency(histori.jumlah_dibayar) }}</td>
					<td>{{ currency(histori.jumlah_masuk) }}</td>
					<td>{{ currency(histori.tunggakan) }}</td>
					<td>
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
					</td>
					<td
						v-if="$page.props.auth.user.level"
						class="flex justify-center items-center h-12"
					>
						<button
							@click="
								updatePembayaran(
									histori.id,
									histori.jumlah_dibayar
								)
							"
							:disabled="histori.status == 'lunas'"
							:class="{
								'cursor-not-allowed': histori.status == 'lunas',
							}"
							class="rounded-md relative mr-1 h-3 p-4 disabled:opacity-40 transition-colors duration-200 bg-indigo-400 hover:bg-indigo-500 text-sm flex items-center justify-center text-white"
						>
							Lunasi
						</button>
						<inertia-link
							:href="route('siswa')"
							as="button"
							class="rounded-md relative mr-1 w-3 h-3 p-4 transition-colors duration-200 bg-indigo-400 hover:bg-indigo-500 text-sm flex items-center justify-center text-white"
						>
							<icon name="sm-print-icon"></icon>
						</inertia-link>
					</td>
				</tr>
			</tbody>
		</table>
		<p v-if="!data.data.length" class="text-center my-10">Tidak ada data</p>
	</div>
</template>

<script>
import Icon from "@/Components/Icon";
import ButtonDelete from "@/Components/ButtonDelete";
import number from "@/Helper/number.js";
import currency from "@/Helper/currency.js";
export default {
	props: ["data"],
	mixins: [number, currency],

	components: {
		Icon,
		ButtonDelete,
	},

	methods: {
		deleteData(id) {
			this.$inertia.delete(this.route("data-kelas.destroy", id));
		},

		updatePembayaran(id, jumlah_bayar) {
			this.$inertia.put(
				route("pembayaran.update", id),
				{
					jumlah_dibayar: jumlah_bayar,
				},
				{
					preserveScroll: true,
				}
			);
		},
	},
};
</script>
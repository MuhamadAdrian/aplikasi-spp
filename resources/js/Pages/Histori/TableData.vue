<template>
	<table class="table-auto w-full text-base">
		<thead class="rounded-md">
			<tr class="h-14">
				<th>No</th>
				<th>NISN</th>
				<th>NIS</th>
				<th>Nama Siswa</th>
				<th>Petugas</th>
				<th>Tanggal Bayar</th>
				<th>Spp</th>
				<th>Bulan</th>
				<th>Tahun</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tbody class="text-center mt-5 text-sm">
			<tr
				v-for="(histori, index) in data.data"
				:key="index"
				class="border-b border-gray-300"
			>
				<td class="font-bold">{{ index + number }}</td>
				<td>{{ histori.nisn }}</td>
				<td>{{ histori.siswa.nis }}</td>
				<td>{{ histori.siswa.nama }}</td>
				<td>{{ histori.petugas.nama_petugas }}</td>
				<td>{{ histori.tgl_bayar }}</td>
				<td>{{ histori.spp.tahun }}</td>
				<td>{{ histori.bulan_dibayar }}</td>
				<td>{{ histori.tahun_dibayar }}</td>
				<td>{{ histori.jumlah_dibayar }}</td>
				<td class="flex justify-center items-center h-12">
					<!--<inertia-link
						:href="route('data-kelas.edit', kelas.id)"
						as="button"
						class="rounded-md relative mr-1 w-3 h-3 p-4 transition-colors duration-200 bg-indigo-400 hover:bg-indigo-500 text-sm flex items-center justify-center text-white"
					>
						<icon name="edit-icon"></icon>
					</inertia-link>
					<inertia-link
						:href="route('data-kelas.show', kelas.id)"
						as="button"
						class="rounded-md relative mr-1 w-3 h-3 p-4 transition-colors duration-200 bg-green-400 hover:bg-green-500 text-sm flex items-center justify-center text-white"
					>
						<icon name="eye-icon"></icon>
					</inertia-link>
					<button-delete
						@delete="deleteData(kelas.id)"
					></button-delete>-->
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
import Icon from "@/Components/Icon";
import ButtonDelete from "@/Components/ButtonDelete";
import number from "@/Helper/number.js";
export default {
	props: ["data"],
	mixins: [number],

	components: {
		Icon,
		ButtonDelete,
	},

	methods: {
		deleteData(id) {
			this.$inertia.delete(this.route("data-kelas.destroy", id));
		},
	},
};
</script>
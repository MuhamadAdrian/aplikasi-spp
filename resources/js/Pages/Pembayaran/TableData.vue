<template>
	<div class="overflow-x-auto">
		<table class="table-auto w-full text-base whitespace-nowrap">
			<thead class="rounded-md">
				<tr class="h-14">
					<th>No</th>
					<th>NISN</th>
					<th>NIS</th>
					<th>Nama</th>
					<th>Kelas</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody v-if="data" class="text-center mt-5">
				<tr
					v-for="(siswa, index) in data.data"
					:key="index"
					class="border-b border-gray-300 dark:border-gray-700 dark:hover:bg-gray-700 hover:bg-gray-50 transition-colors duration-200"
				>
					<td class="font-bold">{{ index + number }}</td>
					<td>{{ siswa.nisn }}</td>
					<td>{{ siswa.nis }}</td>
					<td>{{ siswa.nama }}</td>
					<td v-if="siswa.kelas">{{ siswa.kelas.nama_kelas }}</td>
					<td v-else>Tidak Ada Kelas</td>
					<td class="flex justify-center items-center h-14">
						<inertia-link
							:href="
								route('pembayaran.tambah', { nisn: siswa.nisn })
							"
							as="button"
							class="text-xs bg-indigo-400 text-white px-3 py-2 rounded-md hover:bg-indigo-500 transition-colors duration-200"
						>
							Pilih Siswa
						</inertia-link>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	<p v-if="!data.data.length" class="text-center my-10">Tidak ada data</p>
</template>

<script>
import Icon from "@/Components/Icon";
import number from "@/Helper/number.js";
export default {
	props: ["data"],
	mixins: [number],

	components: {
		Icon,
	},

	methods: {},
};
</script>
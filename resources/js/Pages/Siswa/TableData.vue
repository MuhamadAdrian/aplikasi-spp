<template>
	<table class="table-auto w-full">
		<thead class="rounded-md md:table-header-group hidden">
			<tr class="h-14">
				<th>No</th>
				<th>NISN</th>
				<th>NIS</th>
				<th>Nama</th>
				<th>Kelas</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody class="md:text-center mt-5">
			<tr
				v-for="(siswa, index) in data.data"
				:key="index"
				class="border-b border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 md:table-row flex flex-col py-4"
			>
				<td class="font-bold">
					<span class="font-semibold md:hidden"># </span
					>{{ index + number }}
				</td>
				<td>
					<span class="font-semibold md:hidden">NISN : </span>
					{{ siswa.nisn }}
				</td>
				<td>
					<span class="font-semibold md:hidden">NIS : </span
					>{{ siswa.nis }}
				</td>
				<td>
					<span class="font-semibold md:hidden">Nama : </span
					>{{ siswa.nama }}
				</td>
				<td v-if="siswa.kelas">
					<span class="font-semibold md:hidden">Kelas : </span
					>{{ siswa.kelas.nama_kelas }}
				</td>
				<td v-else>
					<span class="font-semibold md:hidden">Kelas : </span>Tidak
					ada kelas
				</td>
				<td
					class="flex md:justify-center justify-end items-center h-14"
				>
					<inertia-link
						:href="route('siswa.edit', siswa.nisn)"
						as="button"
						class="rounded-md relative mr-1 w-3 h-3 p-4 transition-colors duration-200 bg-indigo-400 hover:bg-indigo-500 text-sm flex items-center justify-center text-white"
					>
						<icon name="edit-icon"></icon>
					</inertia-link>
					<button-delete
						@delete="deleteData(siswa.nisn)"
					></button-delete>
				</td>
			</tr>
		</tbody>
	</table>
	<p v-if="!data.data.length" class="text-center my-10">Tidak ada data</p>
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
		deleteData(nisn) {
			this.$inertia.delete(this.route("siswa.destroy", nisn));
		},
	},
};
</script>
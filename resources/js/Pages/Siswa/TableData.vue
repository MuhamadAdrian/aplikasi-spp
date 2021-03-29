<template>
	<table class="table-auto w-full text-base">
		<thead class="rounded-md">
			<tr class="h-14">
				<th>No</th>
				<th>NISN</th>
				<th>NIS</th>
				<th>Nama</th>
				<th>Kelas</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody class="text-center mt-5 text-sm">
			<tr
				v-for="(siswa, index) in data.data"
				:key="index"
				class="border-b border-gray-300"
			>
				<td class="font-bold">{{ index + number }}</td>
				<td>{{ siswa.nisn }}</td>
				<td>{{ siswa.nis }}</td>
				<td>{{ siswa.nama }}</td>
				<td v-if="siswa.kelas">{{ siswa.kelas.nama_kelas }}</td>
				<td v-else>Tidak ada kelas</td>
				<td class="flex justify-center items-center h-12">
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
<template>
	<div class="overflow-x-auto">
		<table class="table-auto w-full text-base whitespace-nowrap">
			<thead class="rounded-md">
				<tr class="h-14">
					<th>No</th>
					<th>Nama Kelas</th>
					<th>Kompetensi Keahlian</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody class="text-center mt-5">
				<tr
					v-for="(kelas, index) in data.data"
					:key="index"
					class="border-b border-gray-300 hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-700 transition-colors duration-200"
				>
					<td class="font-bold">{{ index + number }}</td>
					<td>{{ kelas.nama_kelas }}</td>
					<td>{{ kelas.kompetensi_keahlian }}</td>
					<td class="flex justify-center items-center h-14">
						<inertia-link
							:href="route('kelas.edit', kelas.id)"
							as="button"
							class="rounded-md relative mr-1 w-3 h-3 p-4 transition-colors duration-200 bg-indigo-400 hover:bg-indigo-500 text-sm flex items-center justify-center text-white"
						>
							<icon name="edit-icon"></icon>
						</inertia-link>
						<inertia-link
							:href="route('kelas.show', kelas.id)"
							as="button"
							class="rounded-md relative mr-1 w-3 h-3 p-4 transition-colors duration-200 bg-green-400 hover:bg-green-500 text-sm flex items-center justify-center text-white"
						>
							<icon name="eye-icon"></icon>
						</inertia-link>
						<button-delete
							@delete="deleteData(kelas.id)"
						></button-delete>
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
export default {
	props: ["data"],
	mixins: [number],

	components: {
		Icon,
		ButtonDelete,
	},

	methods: {
		deleteData(id) {
			this.$inertia.delete(this.route("kelas.destroy", id));
		},
	},
};
</script>
<template>
	<div class="overflow-x-auto">
		<table class="table-auto w-full text-base whitespace-nowrap">
			<thead class="rounded-md">
				<tr class="h-14">
					<th>No</th>
					<th>Nama Petugas</th>
					<th>Username</th>
					<th>Level</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody class="mt-5 text-center">
				<tr
					v-for="(petugas, index) in data.data"
					:key="index"
					class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200"
				>
					<td class="font-bold">{{ index + number }}</td>
					<td>{{ petugas.nama_petugas }}</td>
					<td>{{ petugas.username }}</td>
					<td>{{ petugas.level }}</td>
					<td class="flex justify-center items-center h-14">
						<inertia-link
							:href="route('petugas.edit', petugas.id)"
							as="button"
							class="rounded-md relative mr-1 w-3 h-3 p-4 transition-colors duration-200 bg-indigo-400 hover:bg-indigo-500 text-sm flex items-center justify-center text-white"
						>
							<icon name="edit-icon"></icon>
						</inertia-link>
						<button-delete
							@delete="deleteData(petugas.id)"
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
			this.$inertia.delete(this.route("petugas.destroy", id));
		},
	},
};
</script>
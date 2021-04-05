<template>
	<table class="table-auto w-full text-base">
		<thead class="rounded-md">
			<tr class="h-14">
				<th>No</th>
				<th>Tahun</th>
				<th>Nominal</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody class="text-center mt-5">
			<tr
				v-for="(spp, index) in data.data"
				:key="index"
				class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200"
			>
				<td class="font-bold">{{ index + number }}</td>
				<td>{{ spp.tahun }}</td>
				<td>{{ currency(spp.nominal) }}</td>
				<td class="flex justify-center items-center h-14">
					<inertia-link
						:href="route('spp.edit', spp.id)"
						as="button"
						class="rounded-md relative mr-1 w-3 h-3 p-4 transition-colors duration-200 bg-indigo-400 hover:bg-indigo-500 text-sm flex items-center justify-center text-white"
					>
						<icon name="edit-icon"></icon>
					</inertia-link>
					<button-delete @delete="deleteData(spp.id)"></button-delete>
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
			this.$inertia.delete(this.route("spp.destroy", id));
		},
	},

	mounted() {
		console.log(this.data);
	},
};
</script>
<template>
	<div class="relative">
		<input
			id="search"
			type="text"
			class="w-full md:w-80 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
			@keyup="searchData()"
			v-model="search"
			autocomplete="search"
			:placeholder="placeholder"
		/>
		<button
			@click="reset()"
			v-if="search"
			class="absolute right-0 h-full p-2"
		>
			<icon name="x-icon"></icon>
		</button>
	</div>
</template>

<script>
import { debounce } from "lodash";
import Icon from "@/Components/Icon";
export default {
	components: {
		Icon,
	},

	props: {
		placeholder: {
			default: "Cari Nama",
		},
	},

	data() {
		return {
			search: "",
		};
	},

	methods: {
		searchData: debounce(function () {
			this.$inertia.get(
				this.route(this.route().current()),
				{ search: this.search },
				{ preserveState: true, replace: true }
			);
		}, 200),

		reset() {
			this.search = "";
			this.searchData();
		},
	},

	mounted() {
		if (this.route().params) {
			this.search = this.route().params.search;
		}
	},
};
</script>
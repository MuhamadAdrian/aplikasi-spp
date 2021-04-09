<template>
	<div class="relative">
		<input
			id="search"
			type="text"
			class="w-full dark:focus:border-indigo-500 dark:focus:ring-indigo-500 bg-color-transition border-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
			:class="[wFull ? 'md:w-full' : 'md:w-80']"
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
import debounce from "lodash/debounce";
import Icon from "@/Components/Icon";
export default {
	components: {
		Icon,
	},

	props: {
		placeholder: {
			default: "Cari Nama",
		},
		params: null,
		wFull: {
			default: false,
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
				this.route(this.route().current(), this.params),
				{ search: this.search },
				{ preserveState: true, replace: true, preserveScroll: true }
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
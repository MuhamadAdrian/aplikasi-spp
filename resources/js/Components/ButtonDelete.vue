<template>
	<div class="relative">
		<button
			@blur="toggleConfirm()"
			@focus="toggleConfirm()"
			class="rounded-md relative mr-1 w-3 h-3 p-4 transition-colors duration-200 bg-red-400 hover:bg-red-500 text-sm flex items-center justify-center text-white"
		>
			<icon name="delete-icon"></icon>
		</button>
		<fade-up>
			<div
				v-if="showConfirm"
				class="absolute top-0 right-0 transform -translate-x-5 -translate-y-5 bg-white justify-center flex items-center text-xs shadow p-1 rounded-md"
			>
				<p class="text-xs whitespace-nowrap mx-3">
					Anda Yakin ingin menghapusnya ?
				</p>
				<button
					@click="this.$emit('delete')"
					class="bg-red-400 px-4 py-3 rounded-md hover:bg-red-500 transition-colors duration-200 text-white"
				>
					Hapus
				</button>
			</div>
		</fade-up>
	</div>
</template>

<script>
import Icon from "@/Components/Icon";
import FadeUp from "@/Components/FadeUp";
export default {
	components: {
		Icon,
		FadeUp,
	},

	emits: ["delete"],

	data() {
		return {
			showConfirm: false,
		};
	},

	methods: {
		toggleConfirm() {
			this.showConfirm = !this.showConfirm;
		},
	},
};
</script>
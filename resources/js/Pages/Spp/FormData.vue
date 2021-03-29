<template>
	<form @submit.prevent="submit()">
		<div class="flex items-center justify-between mb-5">
			<h1 v-if="edit" class="text-lg font-bold">
				<span>Edit Data Spp</span>
			</h1>
			<h1 v-else class="text-lg font-bold">
				<span>Tambah Data Spp</span>
			</h1>
			<form-button
				class="ml-4 bg-indigo-400"
				:class="{ 'opacity-25': form.processing }"
				:disabled="form.processing"
			>
				<fade>
					<icon
						v-if="!form.processing"
						name="save-icon"
						class="mr-3"
					></icon>
					<spin-animation
						v-else-if="form.processing"
						:animation-showed="form.processing"
					></spin-animation>
				</fade>
				<span>Simpan</span>
			</form-button>
		</div>
		<div class="grid grid-cols-2 md:gap-5 gap-3">
			<div class="mt-4">
				<input-label for="tahun" value="Tahun" />
				<form-input
					id="tahun"
					type="number"
					class="mt-1 block w-full"
					:class="{ 'border-red-500': form.errors.tahun }"
					v-model="form.tahun"
					required
					autofocus
					autocomplete="tahun"
				/>
				<form-error
					class="mt-3"
					:message="form.errors.tahun"
				></form-error>
			</div>

			<div class="mt-4">
				<input-label for="nominal" value="Nominal" />
				<form-input
					id="nominal"
					type="number"
					class="mt-1 block w-full"
					:class="{
						'border-red-500': form.errors.nominal,
					}"
					v-model="form.nominal"
					required
					autocomplete="nominal"
				/>
				<form-error
					class="mt-3"
					:message="form.errors.nominal"
				></form-error>
			</div>
		</div>
	</form>
</template>

<script>
import FormButton from "@/Components/Button";
import FormInput from "@/Components/Input";
import FormError from "@/Components/InputError";
import InputLabel from "@/Components/Label";
import Icon from "@/Components/Icon";
import SpinAnimation from "@/Components/SpinAnimation.vue";
import Fade from "@/Components/Fade";

export default {
	components: {
		FormInput,
		InputLabel,
		FormButton,
		FormError,
		Icon,
		SpinAnimation,
		Fade,
	},

	props: {
		edit: {
			default: false,
		},
		data: {
			default: null,
		},
	},

	data() {
		return {
			form: this.$inertia.form({
				tahun: this.data ? this.data.tahun : null,
				nominal: this.data ? this.data.nominal : null,
			}),
		};
	},

	methods: {
		submit() {
			if (this.edit && this.data) {
				//console.log(this.data);
				this.form.put(this.route("spp.update", this.data.id));
			} else {
				this.form.post(this.route("spp.store"));
			}
		},
	},
};
</script>
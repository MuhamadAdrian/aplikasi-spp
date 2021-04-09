<template>
	<form @submit.prevent="submit()">
		<div class="flex items-center justify-between mb-5">
			<h1 v-if="edit" class="text-lg font-bold dark:text-gray-300">
				<span>Edit Data Kelas</span>
			</h1>
			<h1 v-else class="text-lg font-bold dark:text-gray-300">
				<span>Tambah Data Kelas</span>
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
				<input-label for="nama_kelas" value="Nama Kelas" />
				<form-input
					id="nama_kelas"
					type="text"
					class="mt-1 block w-full"
					:class="{ 'border-red-500': form.errors.nama_kelas }"
					v-model="form.nama_kelas"
					required
					autofocus
					autocomplete="nama_kelas"
				/>
				<form-error
					class="mt-3"
					:message="form.errors.nama_kelas"
				></form-error>
			</div>

			<div class="mt-4">
				<input-label
					for="kompetensi_keahlian"
					value="Kompetensi Keahlian"
				/>
				<form-input
					id="kompetensi_keahlian"
					type="text"
					class="mt-1 block w-full"
					:class="{
						'border-red-500': form.errors.kompetensi_keahlian,
					}"
					v-model="form.kompetensi_keahlian"
					required
					autocomplete="kompetensi_keahlian"
				/>
				<form-error
					class="mt-3"
					:message="form.errors.kompetensi_keahlian"
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
				nama_kelas: this.data ? this.data.nama_kelas : "",
				kompetensi_keahlian: this.data
					? this.data.kompetensi_keahlian
					: "",
			}),
		};
	},

	methods: {
		submit() {
			if (this.edit && this.data) {
				this.form.put(this.route("kelas.update", this.data.id));
			} else {
				this.form.post(this.route("kelas.store"));
			}
		},
	},
};
</script>
<template>
	<form @submit.prevent="submit()">
		<div class="flex items-center justify-between mb-5">
			<h1 v-if="edit" class="text-lg font-bold">
				<span>Edit Data Petugas</span>
			</h1>
			<h1 v-else class="text-lg font-bold">
				<span>Tambah Data Petugas</span>
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
				<input-label for="nama_petugas" value="Nama Petugas" />
				<form-input
					id="nama_petugas"
					type="text"
					class="mt-1 block w-full"
					:class="{ 'border-red-500': form.errors.nama_petugas }"
					v-model="form.nama_petugas"
					required
					autofocus
					autocomplete="nama_petugas"
				/>
				<form-error
					class="mt-3"
					:message="form.errors.nama_petugas"
				></form-error>
			</div>

			<div class="mt-4">
				<input-label for="username" value="Username" />
				<form-input
					id="username"
					type="text"
					class="mt-1 block w-full"
					:class="{ 'border-red-500': form.errors.username }"
					v-model="form.username"
					required
					autocomplete="username"
				/>
				<form-error
					class="mt-3"
					:message="form.errors.username"
				></form-error>
			</div>

			<div class="mt-4">
				<input-label for="password" value="Password" />
				<form-input
					id="password"
					type="password"
					class="mt-1 block w-full"
					:class="{ 'border-red-500': form.errors.password }"
					v-model="form.password"
					required
					autocomplete="password"
				/>
				<form-error
					class="mt-3"
					:message="form.errors.password"
				></form-error>
			</div>

			<div class="mt-4">
				<input-label for="level" value="Level" />
				<select
					required
					v-model="form.level"
					:class="{
						'border-red-500': form.errors.level,
					}"
					class="w-full block mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
				>
					<option selected disabled hidden :value="null">
						Pilih Level
					</option>
					<option value="admin">Admin</option>
					<option value="petugas">Petugas</option>
				</select>
				<form-error
					class="mt-3"
					:message="form.errors.level"
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
				nama_petugas: this.data ? this.data.nama_petugas : "",
				username: this.data ? this.data.username : "",
				password: this.data ? this.data.password : "",
				level: this.data ? this.data.level : null,
				create_account: !this.edit ? true : false,
			}),
		};
	},

	methods: {
		submit() {
			if (this.edit && this.data) {
				this.form.put(this.route("petugas.update", this.data.id), {
					preserveScroll: true,
				});
			} else {
				this.form.post(this.route("petugas.store"), {
					preserveScroll: true,
				});
			}
		},
	},
};
</script>
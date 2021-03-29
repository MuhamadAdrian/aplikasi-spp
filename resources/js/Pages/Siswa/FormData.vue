<template>
	<form @submit.prevent="submit()">
		<div class="flex items-center justify-between mb-5">
			<h1 v-if="edit" class="text-lg font-bold">
				<span>Edit Data Siswa</span>
			</h1>
			<h1 v-else class="text-lg font-bold">
				<span>Tambah Data Siswa</span>
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
				<input-label for="nisn" value="NISN" />
				<form-input
					id="nisn"
					type="number"
					class="mt-1 block w-full"
					:class="{ 'border-red-500': form.errors.nisn }"
					v-model="form.nisn"
					required
					autofocus
					autocomplete="nisn"
				/>
				<form-error
					class="mt-3"
					:message="form.errors.nisn"
				></form-error>
			</div>

			<div class="mt-4">
				<input-label for="nis" value="NIS" />
				<form-input
					id="nis"
					type="number"
					class="mt-1 block w-full"
					:class="{ 'border-red-500': form.errors.nis }"
					v-model="form.nis"
					required
					autocomplete="nis"
				/>
				<form-error
					class="mt-3"
					:message="form.errors.nis"
				></form-error>
			</div>

			<div class="mt-4">
				<input-label for="nama" value="Nama" />
				<form-input
					id="nama"
					type="text"
					class="mt-1 block w-full"
					:class="{ 'border-red-500': form.errors.nama }"
					v-model="form.nama"
					required
					autocomplete="nama"
				/>
				<form-error
					class="mt-3"
					:message="form.errors.nama"
				></form-error>
			</div>

			<div class="mt-4">
				<input-label for="no_telp" value="No Telepon" />
				<form-input
					id="no_telp"
					type="number"
					class="mt-1 block w-full"
					:class="{
						'border-red-500': form.errors.no_telp,
					}"
					v-model="form.no_telp"
					required
					autocomplete="no_telp"
				/>
				<form-error
					class="mt-3"
					:message="form.errors.no_telp"
				></form-error>
			</div>

			<div class="mt-4">
				<input-label for="kelas" value="Kelas" />
				<select
					:disabled="id_kelas"
					required
					v-model="form.id_kelas"
					:class="{
						'border-red-500': form.errors.id_kelas,
					}"
					class="w-full block mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
				>
					<option
						:selected="id_kelas == null"
						disabled
						hidden
						:value="null"
					>
						Pilih Kelas
					</option>
					<option
						:selected="id_kelas == k.id"
						:value="k.id"
						v-for="k in kelas"
						:key="k.id"
					>
						{{ k.nama_kelas }}
					</option>
				</select>
				<form-error
					class="mt-3"
					:message="form.errors.id_kelas"
				></form-error>
				<form-error
					v-if="!kelas.length"
					class="mt-3"
					message="Tambahkan data kelas terlebih dahulu"
				></form-error>
			</div>

			<div class="mt-4">
				<input-label for="spp" value="Spp" />
				<select
					required
					v-model="form.id_spp"
					:class="{
						'border-red-500': form.errors.id_spp,
					}"
					class="w-full block mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
				>
					<option selected disabled hidden :value="null">
						Pilih Spp
					</option>
					<option
						v-for="eachSpp in spp"
						:key="eachSpp.id"
						:value="eachSpp.id"
					>
						Tahun {{ eachSpp.tahun }} - Nominal
						{{ eachSpp.nominal }}
					</option>
				</select>
				<form-error
					class="mt-3"
					:message="form.errors.id_spp"
				></form-error>
				<form-error
					v-if="!spp.length"
					class="mt-3"
					message="Tambahkan data spp terlebih dahulu"
				></form-error>
			</div>

			<div class="mt-4 col-span-2">
				<input-label for="alamat" value="Alamat" />
				<textarea
					required
					v-model="form.alamat"
					id="alamat"
					cols="30"
					rows="5"
					:class="{
						'border-red-500': form.errors.alamat,
					}"
					class="w-full block mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
				></textarea>
				<form-error
					class="mt-3"
					:message="form.errors.alamat"
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
		kelas: Array,
		spp: Array,
		id_kelas: {
			default: null,
			type: Number,
		},
		fromCurrentClass: {
			default: false,
			type: Boolean,
		},
	},

	data() {
		return {
			form: this.$inertia.form({
				nisn: this.data ? this.data.nisn : "",
				nis: this.data ? this.data.nis : "",
				nama: this.data ? this.data.nama : "",
				id_kelas: this.data ? this.data.id_kelas : null,
				alamat: this.data ? this.data.alamat : "",
				no_telp: this.data ? this.data.no_telp : "",
				id_spp: this.data ? this.data.id_spp : null,
				create_account: !this.edit ? true : false,
				from_current_class: this.fromCurrentClass,
			}),
		};
	},

	methods: {
		submit() {
			if (this.edit && this.data) {
				this.form.put(this.route("siswa.update", this.data.nisn), {
					preserveScroll: true,
				});
			} else {
				this.form.post(this.route("siswa.store"), {
					preserveScroll: true,
				});
			}
		},
	},

	mounted() {
		if (this.id_kelas) {
			this.form.id_kelas = this.id_kelas;
		}
	},
};
</script>